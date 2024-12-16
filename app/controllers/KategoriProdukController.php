<?php

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../models/KategoriProdukModel.php';

use App\Core\Database;
use App\Models\KategoriProdukModel;

class KategoriProduk extends Controller
{

    public function index()
    {
        $data['judul'] = 'Data Kategori Produk';
        $data['halaman'] = 'Kategori Produk';
        $kategoriProdukModel = new KategoriProdukModel();
        $data['kategoriProduk'] = $kategoriProdukModel->getKategoriProduk();

        $this->render('komponen/script-top');
        $this->render('komponen/header');
        $this->render('kategori-produk/index', $data);
        $this->render('komponen/script-bottom');
    }

    public function tambah()
    {
        $data['judul'] = 'Tambah Data Kategori Produk';

        $this->render('komponen/script-top');
        $this->render('komponen/header');
        $this->render('kategori-produk/tambah', $data);
        $this->render('komponen/script-bottom');
    }

    public function delete($id)
    {
        if (!$id) {
            Flasher::setFlash('Gagal', 'Data gagal dihapus', 'danger');
            header('location:' . BASE_URL . '/kategori-produk');
            exit;
        }

        $db = new Database();

        try {

            $data_sql = "SELECT * FROM kategori_produk WHERE id = '$id'";
            $db->query($data_sql);
            $db->execute();
            $data = $db->single();

            $sql = "DELETE FROM kategori_produk WHERE id = '$id'";
            $db->query($sql);
            $db->execute();

            Flasher::setflash('Berhasil', 'Anda berhasil hapus data', 'success');
            header('location:' . BASE_URL . '/kategori-produk');
            exit;

        } catch (PDOException $e) {
            Flasher::setflash('Gagal hapus kategori produk ' . $data['nama'], 'Anda harus menghapus data yang berkaitan dengan data kategoriProduk', 'danger');
            header('location:' . BASE_URL . '/kategori-produk');
            exit;
        }
    }

    public function simpan($id = null)
    {
        $nama = $_POST['nama'];
        if (strlen(strval($nama)) == 0) {
            Flasher::setflash('Gagal', 'nama tidak ada', 'danger');
            header('location:' . BASE_URL . '/auth/daftar');
            exit;
        }

        $db = new Database();

        try {

            $db->dbh->beginTransaction();
            $query = "INSERT INTO kategori_produk (nama) VALUES (:nama)";

            $db->query($query);
            $db->bind('nama', $nama);
            $db->execute();
            $db->dbh->commit();

            Flasher::setflash('Berhasil', 'Anda berhasil menambah kategori produk baru', 'success');
            header('location:' . BASE_URL . '/kategori-produk');
            exit;

        } catch (PDOException $e) {
            $db->dbh->rollback();
            Flasher::setflash('Gagal' . $e->getMessage(), 'Terjadi Kesalahan', 'danger');
            header('location:' . BASE_URL . '/kategori-produk');
            exit;
        }

    }


    public function detail($id)
    {
        $data['judul'] = 'Edit Data Kategori Produk';
        $data['halaman'] = substr($data['judul'], 10);

        if (!$id) {
            Flasher::setflash('Gagal', 'Terjadi Kesalahan', 'danger');
            header('location:' . BASE_URL . '/kategori-produk');
            exit;
        }

        $db = new Database();
        $sql = "SELECT * FROM kategori_produk WHERE id = '$id'";
        $db->query($sql);
        $db->execute();
        $data['detail'] = $db->single();

        $kategoriProdukModel = new KategoriProdukModel();
        $data['kategoriProduk'] = $kategoriProdukModel->getKategoriProduk();

        $this->render('komponen/script-top');
        $this->render('komponen/header');
        $this->render('kategori-produk/edit', $data);
        $this->render('komponen/script-bottom');
    }

    public function update($id)
    {
        $sqlCheck = "SELECT * FROM kategori_produk WHERE id=:id";
        $db = new Database();
        $db->query($sqlCheck);
        $db->bind('id', $id);
        $db->execute();
        $checkId = $db->single();


        if ($checkId['id'] != $id) {
            Flasher::setflash('Gagal ID Kategori Produk tidak ditemukan', 'Terjadi Kesalahan', 'danger');
            header('location:' . BASE_URL . '/kategori-produk/detail/' . $id);
            exit;
        }

        $nama = $_POST['nama'];

        try {
            $db->dbh->beginTransaction();
            $sql = "UPDATE kategori_produk SET nama=:nama WHERE id=:id";
            $db->query($sql);
            $db->bind('id', $id);
            $db->bind('nama', $nama);

            $db->execute();
            $db->dbh->commit();

            Flasher::setflash('Berhasil', 'Anda berhasil edit kategori produk', 'success');
            header('location:' . BASE_URL . '/kategori-produk');
            exit;

        } catch (PDOException $e) {
            $db->dbh->rollback();
            Flasher::setflash('Gagal'. $e->getMessage(), 'Terjadi Kesalahan', 'danger');
            header('location:' . BASE_URL . '/kategori-produk/detail/' . $id);
            exit;
        }
    }

}