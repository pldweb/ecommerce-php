<?php

require_once __DIR__ . '/../models/UserModel.php';

use App\Core\Database;
use App\Models\UserModel;
use EmailValidator\Validator;


class Auth extends Controller
{
    public function index()
    {
        $this->render('auth/login/index');
    }

    public function login()
    {
        $email = $_POST['email'];
        if (strlen(strval($email)) == 0) {
            Flasher::setflash('Gagal', 'email tidak ada', 'danger');
            header('location:' . BASE_URL . '/auth/login');
            exit;
        }

        $password = $_POST['password'];
        if (strlen(strval($password)) == 0) {
            Flasher::setflash('Gagal', 'password tidak ada', 'danger');
            header('location:' . BASE_URL . '/auth/login');
            exit;
        }

        $db = new Database();
        $db->dbh->beginTransaction();

        try {

            $query = "SELECT * FROM user WHERE email = :email and password = :password";
            $db->query($query);
            $db->bind('email', $email);
            $db->bind('password', $password);
            $result = $db->single();

            if (!$result) {
                $db->dbh->rollBack();
                Flasher::setflash('Gagal', 'Email atau password salah', 'danger');
                header('Location: ' . BASE_URL . '/login');
                exit;
            }

            $_SESSION['nama'] = $result['nama'];
            $db->dbh->commit();
            Flasher::setflash('Berhasil', 'Anda berhasil login', 'success');
            header('location:' . BASE_URL . '/user');
            exit;

        } catch (PDOException $e) {
            $db->dbh->rollback();
            Flasher::setflash('Gagal' . $e->getMessage(), 'Terjadi Kesalahan', 'danger');
            header('location:' . BASE_URL . '/auth/login');
            exit;
        }
    }

    public function daftar()
    {
        $this->render('auth/daftar/index');
    }

    public function prosesdaftar()
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


        $db = new Database();
        $db->dbh->beginTransaction();

        try {

            $query = "INSERT INTO user (nama, email, password, nomor_telp) 
              VALUES (:nama, :email, :password, :nomor_telp)";

            $db->query($query);
            $db->bind('nama', $nama);
            $db->bind('email', $email);
            $db->bind('password', $password);
            $db->bind('nomor_telp', $nomor_telp);
            $db->execute();
            $db->dbh->commit();

            Flasher::setflash('Berhasil', 'Anda berhasil daftar', 'success');
            header('location:' . BASE_URL . '/login');
            exit;

        } catch (PDOException $e) {
            $db->dbh->rollback();
            Flasher::setflash('Gagal' . $e->getMessage(), 'Terjadi Kesalahan', 'danger');
            header('location:' . BASE_URL . '/auth/daftar');
            exit;
        }
    }

    public function logout()
    {
        session_start();
        session_destroy();
        header("location:" . BASE_URL . '/login');
        exit;
    }

}