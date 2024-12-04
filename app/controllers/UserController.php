<?php

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../models/UserModel.php';

use Carbon\Carbon;

class User extends Controller
{

    public function index()
    {
        $data['judul'] = 'Data User';
        $data['halaman'] = 'User';
        $data['user'] = $this->model('UserModel')->getUser();

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
        $data['role'] = $this->model('UserModel')->getRole();

        $this->render('komponen/script-top');
        $this->render('komponen/header');
        $this->render('user/tambah', $data);
        $this->render('komponen/script-bottom');
    }

    public function delete($id)
    {
        if ($id) {
            if ($this->model('UserModel')->deleteUser($id) == true) {
                Flasher::setFlash('Berhasil', 'Data berhasil dihapus', 'success');
                header('location:' . BASE_URL . '/user');
                exit;
            }
        } else {
            Flasher::setFlash('Kesalahan tidak ada ID', 'Data gagal dihapus', 'danger');
            header('location:' . BASE_URL . '/user');
            exit;
        }
    }

    public function simpan($id = null)
    {
        if (empty($_POST)) {
            Flasher::setflash('Gagal', 'terjadi kesalahan', 'danger');
            header('location:' . BASE_URL . '/user/tambah');
            exit;
        }

        if (strlen($_POST['nama']) == 0) {
            Flasher::setflash('Gagal', 'Nama tidak ada', 'danger');
            header('location:' . BASE_URL . '/user/tambah');
            exit;
        }

        if (empty($_POST['email'])) {
            Flasher::setflash('Gagal', 'Email tidak ada', 'danger');
            header('location:' . BASE_URL . '/user/tambah');
            exit;
        }

        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            Flasher::setflash('Gagal', 'Format email tidak valid', 'danger');
            header('location:' . BASE_URL . '/user/tambah');
            exit;
        }

        $userModel = new UserModel;
        if ($userModel->isEmailExist($_POST['email'])) {
            Flasher::setflash('Gagal', 'Email sudah ada', 'danger');
            header('location:' . BASE_URL . '/user/tambah');
            exit;
        }

        if (strlen($_POST['password']) == 0) {
            Flasher::setflash('Gagal', 'Password tidak ada', 'danger');
            header('location:' . BASE_URL . '/user/tambah');
            exit;
        }

        if (strlen($_POST['password']) == 0) {
            Flasher::setflash('Gagal', 'Nama tidak ada', 'danger');
            header('location:' . BASE_URL . '/user/tambah');
            exit;
        }
        $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);

        if (strlen($_POST['nomor_telp']) == 0) {
            Flasher::setflash('Gagal', 'Nomor telepon tidak ada', 'danger');
            header('location:' . BASE_URL . '/user/tambah');
            exit;
        }

        if (strlen($_POST['nomor_telp']) < 10 || strlen($_POST['nomor_telp']) > 13) {
            Flasher::setflash('Gagal', 'Digit nomor telepon tidak sesuai', 'danger');
            header('location:' . BASE_URL . '/user/tambah');
            exit;
        }

        if ($userModel->isNomorTelpExist($_POST['nomor_telp'])) {
            Flasher::setflash('Gagal', 'Nomor telepon sudah ada', 'danger');
            header('location:' . BASE_URL . '/user/tambah');
            exit;
        }

        if ($id) {
            // Update data user
            if ($this->model('UserModel')->updateDataUser($_POST, $id)) {
                Flasher::setFlash('Berhasil', 'Data berhasil diedit', 'success');
            } else {
                Flasher::setFlash('Kesalahan', 'Data gagal disimpan', 'danger');
            }
        } else {
            // Simpan data user baru
            if ($this->model('UserModel')->simpanDataUser($_POST) == true) {
                Flasher::setFlash('Berhasil', 'Data berhasil ditambahkan', 'success');
            } else {
                Flasher::setFlash('Kesalahan', 'Data gagal disimpan', 'danger');
            }
        }
        header('location:' . BASE_URL . '/user');
     }


    public function detail($id)
    {
        $data['judul'] = 'Edit Data User';
        $data['halaman'] = substr($data['judul'], 10);

        $data['detail'] = $this->model('UserModel')->getUserById($id);
        $data['role'] = $this->model('UserModel')->getRole();

        $this->render('komponen/script-top');
        $this->render('komponen/header');
        $this->render('user/edit', $data);
        $this->render('komponen/script-bottom');
    }

}