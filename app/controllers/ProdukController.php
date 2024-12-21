<?php

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../models/ProdukModel.php';
require_once __DIR__ . '/../models/BrandProdukModel.php';
require_once __DIR__ . '/../models/KategoriProdukModel.php';
require_once __DIR__ . '/../models/RoleModel.php';

use App\Core\Database;
use App\Models\BrandProdukModel;
use App\Models\KategoriProdukModel;
use App\Models\ProdukModel;
use App\Models\RoleModel;

class Produk extends Controller
{

    public function index()
    {
        $data['judul'] = 'Data Produk';
        $data['halaman'] = 'Produk';
        $produkModel = new ProdukModel();
        $data['produk'] = $produkModel->getProduk();
        
        $this->render('komponen/script-top');
        $this->render('komponen/header');
        $this->render('produk/index', $data);
        $this->render('komponen/script-bottom');
    }

    public function tambah()
    {
        $data['judul'] = 'Tambah Data Produk';
        $produkModel = new RoleModel();
        $data['role'] = $produkModel->getRole();

        $brandModel = new BrandProdukModel();
        $data['brand'] = $brandModel->getBrandProduk();

        $kategoriModel = new KategoriProdukModel();
        $data['kategori'] = $kategoriModel->getKategoriProduk();

        $this->render('komponen/script-top');
        $this->render('komponen/header');
        $this->render('produk/tambah', $data);
        $this->render('komponen/script-bottom');
    }

    public function delete($id)
    {
        if (!$id) {
            Flasher::setFlash('Gagal', 'Data gagal dihapus', 'danger');
            header('location:' . BASE_URL . '/produk');
            exit;
        }

        $db = new Database();

        try {

            $sql = "DELETE FROM produk WHERE id = '$id'";
            $db->query($sql);
            $db->execute();

            Flasher::setflash('Berhasil', 'Anda berhasil hapus data', 'success');
            header('location:' . BASE_URL . '/produk');
            exit;

        } catch (PDOException $e) {
            $db->dbh->rollback();
            Flasher::setflash('Gagal' . $e->getMessage(), 'Terjadi Kesalahan', 'danger');
            header('location:' . BASE_URL . '/produk');
            exit;
        }
    }

    public function simpan($id = null)
    {

        $namaProduk = $_POST['nama'];
        if (strlen(strval($namaProduk)) == 0) {
            Flasher::setflash('Gagal', 'nama produk tidak ada', 'danger');
            header('location:' . BASE_URL . '/produk/tambah');
            exit;
        }

        $brand = $_POST['brand_id'];
        if (!is_numeric($brand)) {
            Flasher::setflash('Gagal', 'brand tidak ada', 'danger');
            header('location:' . BASE_URL . '/produk/tambah');
            exit;
        }

        $kategori = $_POST['kategori_id'];
        if (!is_numeric($kategori)) {
            Flasher::setflash('Gagal', 'kategori tidak ada', 'danger');
            header('location:' . BASE_URL . '/produk/tambah');
            exit;
        }

        $harga = $_POST['harga'];
        if (strlen(strval($harga)) == 0) {
            Flasher::setflash('Gagal', 'Harga tidak ada', 'danger');
            header('location:' . BASE_URL . '/produk/tambah');
            exit;
        }

        if ($_FILES['foto']['name']) {
            $foto = $_FILES['foto'];
            if ($foto['error'] !== UPLOAD_ERR_OK) {
                Flasher::setflash('Gagal', 'Gagal mengunggah file', 'danger');
                header('location:' . BASE_URL . '/produk/tambah');
                exit;
            }

            if ($foto['type'] !== "image/png" && $foto['type'] !== "image/jpeg") {
                Flasher::setflash('Gagal', 'Tipe file tidak didukung, hanya PNG dan JPEG', 'danger');
                header('location:' . BASE_URL . '/produk/tambah');
                exit;
            }
        }

        $db = new Database();

        try {

            $query = "INSERT INTO produk (nama, brand_id, kategori_id, harga, diskon, stok, deskripsi, foto) 
              VALUES (:nama, :brand_id, :kategori_id, :harga, :diskon, :stok, :deskripsi, :foto)";

            $db->dbh->beginTransaction();
            $db->query($query);
            $db->bind(':nama', $namaProduk);
            $db->bind(':brand_id', $brand);
            $db->bind(':kategori_id', $kategori);
            $db->bind(':harga', $harga);
            $db->bind(':diskon', $_POST['diskon']);
            $db->bind(':stok', $_POST['stok']);
            $db->bind(':deskripsi', $_POST['deskripsi']);
            if (!empty($_FILES['foto']['name'])){
                $foto = $_FILES['foto'];
                $namaFoto = implode("-", explode(" ", basename($foto['name'])));
                $saveNamaFoto = uniqid() . '_' . $namaFoto;
                $tmpFile = $foto['tmp_name'];
                $folderSimpan = __DIR__ . '/../assets/img/produk/' . $saveNamaFoto;

                $db->bind(':foto', $saveNamaFoto);
            } else {
                $db->bind(':foto', '');
            }
            $result = $db->execute();

            if ($result !== false) {

                if (move_uploaded_file($tmpFile, $folderSimpan)) {
                    $db->dbh->commit();
                    Flasher::setflash('Berhasil', 'Anda berhasil menambah produk baru', 'success');
                    header('location:' . BASE_URL . '/produk');
                    exit;
                }
            }

        } catch (PDOException $e) {
            $db->dbh->rollback();
            Flasher::setflash('Gagal' . $e->getMessage(), 'Terjadi Kesalahan', 'danger');
            header('location:' . BASE_URL . '/produk');
            exit;
        }

    }

    public function detail($id)
    {
        $data['judul'] = 'Edit Data Produk';
        $data['halaman'] = substr($data['judul'], 10);

        if (!$id) {
            Flasher::setflash('Gagal', 'Terjadi Kesalahan', 'danger');
            header('location:' . BASE_URL . '/produk');
            exit;
        }

        $db = new Database();
        $sql = "SELECT produk.*, brand_produk.nama as nama_brand, kategori_produk.nama as nama_kategori FROM produk LEFT JOIN brand_produk ON brand_produk.id = produk.brand_id LEFT JOIN kategori_produk ON kategori_produk.id = produk.kategori_id WHERE produk.id = '$id'";
        $db->query($sql);
        $db->execute();
        $data['detail'] = $db->single();

        $kategoriProdukModel = new KategoriProdukModel();
        $data['kategori'] = $kategoriProdukModel->getKategoriProduk();

        $brandProdukModel = new BrandProdukModel();
        $data['brand'] = $brandProdukModel->getBrandProduk();

        $this->render('komponen/script-top');
        $this->render('komponen/header');
        $this->render('produk/edit', $data);
        $this->render('komponen/script-bottom');
    }

    public function update($id)
    {

        $sqlCheck = "SELECT * FROM produk WHERE id=:id";
        $db = new Database();
        $db->query($sqlCheck);
        $db->bind('id', $id);
        $db->execute();
        $checkId = $db->single();

        if ($checkId['id'] != $id) {
            Flasher::setflash('Gagal ID Produk tidak ditemukan', 'Terjadi Kesalahan', 'danger');
            header('location:' . BASE_URL . '/produk/detail/' . $id);
            exit;
        }

        $namaProduk = $_POST['nama'];
        if (strlen(strval($namaProduk)) == 0) {
            Flasher::setflash('Gagal', 'nama produk tidak ada', 'danger');
            header('location:' . BASE_URL . '/produk/detail/' . $id);
            exit;
        }

        $brand = $_POST['brand_id'];
        if (!is_numeric($brand)) {
            Flasher::setflash('Gagal', 'brand tidak ada', 'danger');
            header('location:' . BASE_URL . '/produk/detail/' . $id);
            exit;
        }

        $kategori = $_POST['kategori_id'];
        if (!is_numeric($kategori)) {
            Flasher::setflash('Gagal', 'kategori tidak ada', 'danger');
            header('location:' . BASE_URL . '/produk/detail/' . $id);
            exit;
        }

        $harga = $_POST['harga'];
        if (strlen(strval($harga)) == 0) {
            Flasher::setflash('Gagal', 'Harga tidak ada', 'danger');
            header('location:' . BASE_URL . '/produk/detail/' . $id);
            exit;
        }

        $nama = $_POST['nama'];
        $deskripsi = $_POST['deskripsi'];

        try {
            $db->dbh->beginTransaction();
            $sql = "UPDATE produk SET nama=:nama, brand_id=:brand_id, kategori_id=:kategori_id, harga=:harga, diskon=:diskon, stok=:stok, deskripsi=:deskripsi, foto=:foto  WHERE id=:id";
            $db->query($sql);
            $db->bind('id', $id);
            $db->bind('nama', $nama);
            $db->bind('brand_id', $brand);
            $db->bind('kategori_id', $kategori);
            $db->bind('harga', $harga);
            $db->bind('diskon', $_POST['diskon']);
            $db->bind('stok', $_POST['stok']);
            $db->bind('deskripsi', $deskripsi);

            if (!empty($_FILES['foto'])) {
                $foto = $_FILES['foto'];
                $namaFoto = implode("-", explode(" ", basename($foto['name'])));
                $saveNamaFoto = uniqid() . '_' . $namaFoto;
                $tmpFile = $foto['tmp_name'];
                $folderSimpan = __DIR__ . '/../assets/img/produk/' . $saveNamaFoto;

                $db->bind('foto', $saveNamaFoto);
            } else {
                $db->bind('foto', $checkId['foto']);
            }

            $db->execute();
            if (is_uploaded_file($saveNamaFoto)){
                move_uploaded_file($tmpFile, $folderSimpan);
            }
            $db->dbh->commit();

            Flasher::setflash('Berhasil', 'Anda berhasil edit produk', 'success');
            header('location:' . BASE_URL . '/produk');
            exit;

        } catch (PDOException $e) {
            $db->dbh->rollback();
            Flasher::setflash('Gagal' . $e->getMessage(), 'Terjadi Kesalahan', 'danger');
            header('location:' . BASE_URL . '/produk/detail/' . $id);
            exit;
        }
    }

}