<?php

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../models/UserModel.php';
require_once __DIR__ . '/../models/RoleModel.php';

use App\Core\Database;
use App\Models\UserModel;
use Carbon\Carbon;
use EmailValidator\Validator;
use App\Models\RoleModel;

class User extends Controller
{

    public function index()
    {
        $data['judul'] = 'Data User';
        $data['halaman'] = 'User';
        $userModel = new UserModel();
        $data['user'] = $userModel->getUser();

        foreach ($data['user'] as $key => $user) {
            $data['user'][$key]['created_at'] = Carbon::parse($user['created_at'])->locale('id')->translatedFormat('l, j F Y');
        }

        $this->render('komponen/script-top');
        $this->render('komponen/header');
        $this->render('user/index', $data);
        $this->render('komponen/script-bottom');
    }

    public function tambah()
    {
        $data['judul'] = 'Tambah Data User';
        $userModel = new RoleModel();
        $data['role'] = $userModel->getRole();

        $this->render('komponen/script-top');
        $this->render('komponen/header');
        $this->render('user/tambah', $data);
        $this->render('komponen/script-bottom');
    }

    public function delete($id)
    {
        if (!$id) {
            Flasher::setFlash('Gagal', 'Data gagal dihapus', 'danger');
            header('location:' . BASE_URL . '/user');
            exit;
        }

        $db = new Database();

        try {

            $sql = "DELETE FROM user WHERE id = '$id'";
            $db->query($sql);
            $db->execute();

            Flasher::setflash('Berhasil', 'Anda berhasil hapus data', 'success');
            header('location:' . BASE_URL . '/user');
            exit;

        } catch (PDOException $e) {
            $db->dbh->rollback();
            Flasher::setflash('Gagal' . $e->getMessage(), 'Terjadi Kesalahan', 'danger');
            header('location:' . BASE_URL . '/user');
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

        $email = $_POST['email'];
        if (strlen(strval($email)) == 0) {
            Flasher::setflash('Gagal', 'Email tidak ada', 'danger');
            header('location:' . BASE_URL . '/auth/daftar');
            exit;
        }

        $regex = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,10})$/";
        $email = strtolower($email);
        if (!preg_match($regex, $email)) {
            Flasher::setflash('Gagal', 'Email mengandung karakter yang tidak valid', 'danger');
            header('location:' . BASE_URL . '/auth/daftar');
            exit;
        }

        // Sumber = https://github.com/nojacko/email-validator
        $validator = new Validator();
        if (!$validator->isValid($email) || !$validator->isSendable($email)) {
            Flasher::setflash('Gagal', 'email tidak valid', 'danger');
            header('location:' . BASE_URL . '/auth/daftar');
            exit;
        }


        $userModel = new UserModel();
        if ($userModel->isEmailExist($email)) {
            Flasher::setflash('Gagal', 'Email sudah terdaftar', 'danger');
            header('location:' . BASE_URL . '/auth/daftar');
            exit;
        }

        $password = $_POST['password'];
        if (strlen(strval($password)) == 0) {
            Flasher::setflash('Gagal', 'password tidak ada', 'danger');
            header('location:' . BASE_URL . '/auth/daftar');
            exit;
        }

        $nomor_telp = $_POST['nomor_telp'];
        if (strlen(strval($nomor_telp)) == 0) {
            Flasher::setflash('Gagal', 'no telp tidak ada', 'danger');
            header('location:' . BASE_URL . '/auth/daftar');
            exit;
        }

        if (!preg_match('/^[0-9]{10,13}+$/', $nomor_telp)) {
            Flasher::setflash('Gagal', 'no telp invalid', 'danger');
            header('location:' . BASE_URL . '/auth/daftar');
            exit;
        }

        if ($userModel->isNomorTelpExist($nomor_telp)) {
            Flasher::setflash('Gagal', 'no telp sudah terdaftar', 'danger');
            header('location:' . BASE_URL . '/auth/daftar');
            exit;
        }

        $alamat = $_POST['alamat'];
        $role_id = $_POST['role_id'];

        try {

            $db = new Database();
            $db->dbh->beginTransaction();

            $query = "INSERT INTO user (nama, email, password, alamat, nomor_telp, role_id) 
              VALUES (:nama, :email, :password, :alamat, :nomor_telp, :role_id)";

            $db->query($query);
            $db->bind('nama', $nama);
            $db->bind('email', $email);
            $db->bind('password', $password);
            $db->bind('alamat', $alamat);
            $db->bind('nomor_telp', $nomor_telp);
            $db->bind('role_id', $role_id);
            $db->execute();
            $db->dbh->commit();

            Flasher::setflash('Berhasil', 'Anda berhasil menambah user baru', 'success');
            header('location:' . BASE_URL . '/user');
            exit;

        } catch (PDOException $e) {
            $db->dbh->rollback();
            Flasher::setflash('Gagal' . $e->getMessage(), 'Terjadi Kesalahan', 'danger');
            header('location:' . BASE_URL . '/user');
            exit;
        }

    }


    public function detail($id)
    {
        $data['judul'] = 'Edit Data User';
        $data['halaman'] = substr($data['judul'], 10);

        if (!$id) {
            Flasher::setflash('Gagal', 'Terjadi Kesalahan', 'danger');
            header('location:' . BASE_URL . '/user');
            exit;
        }

        $db = new Database();
        $sql = "SELECT user.*, role.nama as 'nama_role' FROM user LEFT JOIN role ON user.role_id = role.id WHERE user.id = '$id'";
        $db->query($sql);
        $db->execute();
        $data['detail'] = $db->single();

        $userModel = new RoleModel();
        $data['role'] = $userModel->getRole();

        $this->render('komponen/script-top');
        $this->render('komponen/header');
        $this->render('user/edit', $data);
        $this->render('komponen/script-bottom');
    }

    public function update($id)
    {
        $sqlCheck = "SELECT * FROM user WHERE id=:id";
        $db = new Database();
        $db->query($sqlCheck);
        $db->bind('id', $id);
        $db->execute();
        $checkId = $db->single();


        if ($checkId['id'] != $id) {
            Flasher::setflash('Gagal ID User tidak ditemukan', 'Terjadi Kesalahan', 'danger');
            header('location:' . BASE_URL . '/user/detail/' . $id);
            exit;
        }

        $nama = $_POST['nama'];
        $email = $_POST['email'];
        $alamat = $_POST['alamat'];
        $role_id = $_POST['role_id'];
        $nomor_telp = $_POST['nomor_telp'];
        $password = $_POST['password'];

        try {
            $db->dbh->beginTransaction();
            $sql = "UPDATE user SET nama=:nama, email=:email, alamat=:alamat, role_id=:role_id, nomor_telp=:nomor_telp, password=:password  WHERE id=:id";
            $db->query($sql);
            $db->bind('id', $id);
            $db->bind('nama', $nama);
            $db->bind('email', $email);
            $db->bind('alamat', $alamat);
            $db->bind('role_id', $role_id);
            $db->bind('nomor_telp', $nomor_telp);
            if (!empty($password)) {
                $db->bind('password', $password);
            } else {
                $db->bind('password', $checkId['password']);
            }

            $db->execute();
            $db->dbh->commit();

            Flasher::setflash('Berhasil', 'Anda berhasil edit user', 'success');
            header('location:' . BASE_URL . '/user');
            exit;

        } catch (PDOException $e) {
            $db->dbh->rollback();
            Flasher::setflash('Gagal'. $e->getMessage(), 'Terjadi Kesalahan', 'danger');
            header('location:' . BASE_URL . '/user/detail/' . $id);
            exit;
        }
    }

}