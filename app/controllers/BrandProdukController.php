<?php

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../models/BrandProdukModel.php';

use App\Core\Database;
use App\Models\BrandProdukModel;
use Carbon\Carbon;
use EmailValidator\Validator;

class BrandProduk extends Controller
{

    public function index()
    {
        $data['judul'] = 'Data Brand Produk';
        $data['halaman'] = 'Brand Produk';
        $brandProdukModel = new BrandProdukModel();
        $data['brandProduk'] = $brandProdukModel->getBrandProduk();

        $this->render('komponen/script-top');
        $this->render('komponen/header');
        $this->render('brand-produk/index', $data);
        $this->render('komponen/script-bottom');
    }

    public function tambah()
    {
        $data['judul'] = 'Tambah Data Brand Produk';

        $this->render('komponen/script-top');
        $this->render('komponen/header');
        $this->render('brand-produk/tambah', $data);
        $this->render('komponen/script-bottom');
    }

    public function delete($id)
    {
        if (!$id) {
            Flasher::setFlash('Gagal', 'Data gagal dihapus', 'danger');
            header('location:' . BASE_URL . '/brand-produk');
            exit;
        }

        $db = new Database();

        try {

            $data_sql = "SELECT * FROM brand_produk WHERE id = '$id'";
            $db->query($data_sql);
            $db->execute();
            $data = $db->single();

            $sql = "DELETE FROM brand_produk WHERE id = '$id'";
            $db->query($sql);
            $db->execute();

            Flasher::setflash('Berhasil', 'Anda berhasil hapus data', 'success');
            header('location:' . BASE_URL . '/brand-produk');
            exit;

        } catch (PDOException $e) {
            Flasher::setflash('Gagal hapus brand produk ' . $data['nama'], 'Anda harus menghapus data yang berkaitan dengan data brandProduk', 'danger');
            header('location:' . BASE_URL . '/brand-produk');
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
            $query = "INSERT INTO brand_produk (nama) VALUES (:nama)";

            $db->query($query);
            $db->bind('nama', $nama);
            $db->execute();
            $db->dbh->commit();

            Flasher::setflash('Berhasil', 'Anda berhasil menambah brand produk baru', 'success');
            header('location:' . BASE_URL . '/brand-produk');
            exit;

        } catch (PDOException $e) {
            $db->dbh->rollback();
            Flasher::setflash('Gagal' . $e->getMessage(), 'Terjadi Kesalahan', 'danger');
            header('location:' . BASE_URL . '/brand-produk');
            exit;
        }

    }


    public function detail($id)
    {
        $data['judul'] = 'Edit Data Brand Produk';
        $data['halaman'] = substr($data['judul'], 10);

        if (!$id) {
            Flasher::setflash('Gagal', 'Terjadi Kesalahan', 'danger');
            header('location:' . BASE_URL . '/brand-produk');
            exit;
        }

        $db = new Database();
        $sql = "SELECT * FROM brand_produk WHERE id = '$id'";
        $db->query($sql);
        $db->execute();
        $data['detail'] = $db->single();

        $brandProdukModel = new BrandProdukModel();
        $data['brandProduk'] = $brandProdukModel->getBrandProduk();

        $this->render('komponen/script-top');
        $this->render('komponen/header');
        $this->render('brand-produk/edit', $data);
        $this->render('komponen/script-bottom');
    }

    public function update($id)
    {
        $sqlCheck = "SELECT * FROM brand_produk WHERE id=:id";
        $db = new Database();
        $db->query($sqlCheck);
        $db->bind('id', $id);
        $db->execute();
        $checkId = $db->single();


        if ($checkId['id'] != $id) {
            Flasher::setflash('Gagal ID BrandProduk tidak ditemukan', 'Terjadi Kesalahan', 'danger');
            header('location:' . BASE_URL . '/brand-produk/detail/' . $id);
            exit;
        }

        $nama = $_POST['nama'];

        try {
            $db->dbh->beginTransaction();
            $sql = "UPDATE brand_produk SET nama=:nama WHERE id=:id";
            $db->query($sql);
            $db->bind('id', $id);
            $db->bind('nama', $nama);

            $db->execute();
            $db->dbh->commit();

            Flasher::setflash('Berhasil', 'Anda berhasil edit brandProduk', 'success');
            header('location:' . BASE_URL . '/brand-produk');
            exit;

        } catch (PDOException $e) {
            $db->dbh->rollback();
            Flasher::setflash('Gagal'. $e->getMessage(), 'Terjadi Kesalahan', 'danger');
            header('location:' . BASE_URL . '/brand-produk/detail/' . $id);
            exit;
        }
    }

}