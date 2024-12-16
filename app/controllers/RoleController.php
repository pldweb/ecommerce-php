<?php

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../models/RoleModel.php';
require_once __DIR__ . '/../models/RoleModel.php';

use App\Core\Database;
use App\Models\RoleModel;
use Carbon\Carbon;
use EmailValidator\Validator;

class Role extends Controller
{

    public function index()
    {
        $data['judul'] = 'Data Role';
        $data['halaman'] = 'Role';
        $roleModel = new RoleModel();
        $data['role'] = $roleModel->getRole();

        $this->render('komponen/script-top');
        $this->render('komponen/header');
        $this->render('role/index', $data);
        $this->render('komponen/script-bottom');
    }

    public function tambah()
    {
        $data['judul'] = 'Tambah Data Role';
        $roleModel = new RoleModel();
        $data['role'] = $roleModel->getRole();

        $this->render('komponen/script-top');
        $this->render('komponen/header');
        $this->render('role/tambah', $data);
        $this->render('komponen/script-bottom');
    }

    public function delete($id)
    {
        if (!$id) {
            Flasher::setFlash('Gagal', 'Data gagal dihapus', 'danger');
            header('location:' . BASE_URL . '/role');
            exit;
        }

        $db = new Database();

        try {

            $data_sql = "SELECT * FROM role WHERE id = '$id'";
            $db->query($data_sql);
            $db->execute();
            $data = $db->single();

            $sql = "DELETE FROM role WHERE id = '$id'";
            $db->query($sql);
            $db->execute();

            Flasher::setflash('Berhasil', 'Anda berhasil hapus data', 'success');
            header('location:' . BASE_URL . '/role');
            exit;

        } catch (PDOException $e) {
            Flasher::setflash('Gagal hapus role ' . $data['nama'], 'Anda harus menghapus data yang berkaitan dengan data role', 'danger');
            header('location:' . BASE_URL . '/role');
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

        try {

            $db = new Database();
            $db->dbh->beginTransaction();

            $query = "INSERT INTO role (nama) VALUES (:nama)";

            $db->query($query);
            $db->bind('nama', $nama);
            $db->execute();
            $db->dbh->commit();

            Flasher::setflash('Berhasil', 'Anda berhasil menambah role baru', 'success');
            header('location:' . BASE_URL . '/role');
            exit;

        } catch (PDOException $e) {
            $db->dbh->rollback();
            Flasher::setflash('Gagal' . $e->getMessage(), 'Terjadi Kesalahan', 'danger');
            header('location:' . BASE_URL . '/role');
            exit;
        }

    }


    public function detail($id)
    {
        $data['judul'] = 'Edit Data Role';
        $data['halaman'] = substr($data['judul'], 10);

        if (!$id) {
            Flasher::setflash('Gagal', 'Terjadi Kesalahan', 'danger');
            header('location:' . BASE_URL . '/role');
            exit;
        }

        $db = new Database();
        $sql = "SELECT * FROM role WHERE id = '$id'";
        $db->query($sql);
        $db->execute();
        $data['detail'] = $db->single();

        $roleModel = new RoleModel();
        $data['role'] = $roleModel->getRole();

        $this->render('komponen/script-top');
        $this->render('komponen/header');
        $this->render('role/edit', $data);
        $this->render('komponen/script-bottom');
    }

    public function update($id)
    {
        $sqlCheck = "SELECT * FROM role WHERE id=:id";
        $db = new Database();
        $db->query($sqlCheck);
        $db->bind('id', $id);
        $db->execute();
        $checkId = $db->single();


        if ($checkId['id'] != $id) {
            Flasher::setflash('Gagal ID Role tidak ditemukan', 'Terjadi Kesalahan', 'danger');
            header('location:' . BASE_URL . '/role/detail/' . $id);
            exit;
        }

        $nama = $_POST['nama'];

        try {
            $db->dbh->beginTransaction();
            $sql = "UPDATE role SET nama=:nama WHERE id=:id";
            $db->query($sql);
            $db->bind('id', $id);
            $db->bind('nama', $nama);

            $db->execute();
            $db->dbh->commit();

            Flasher::setflash('Berhasil', 'Anda berhasil edit role', 'success');
            header('location:' . BASE_URL . '/role');
            exit;

        } catch (PDOException $e) {
            $db->dbh->rollback();
            Flasher::setflash('Gagal'. $e->getMessage(), 'Terjadi Kesalahan', 'danger');
            header('location:' . BASE_URL . '/role/detail/' . $id);
            exit;
        }
    }

}