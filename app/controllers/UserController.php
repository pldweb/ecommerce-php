<?php


class User extends Controller
{
    public function index()
    {
        $data['judul'] = 'Data User';
        $data['user'] = $this->model('User_model')->getUser();

        $this->render('komponen/header');
        $this->render('komponen/script-top');
        $this->render('user/index', $data);
        $this->render('komponen/script-bottom');
    }

    public function tambah()
    {
        $data['judul'] = 'Tambah Data User';
        $data['role'] = $this->model('User_model')->getRole();

        $this->render('komponen/header');
        $this->render('komponen/script-top');
        $this->render('user/tambah', $data);
        $this->render('komponen/script-bottom');
    }

    public function delete($id)
    {
        if ($id){
            if ($this->model('User_model')->deleteUser($id) == true) {
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
        if ($id) {
            if ($this->model('User_model')->updateDataUser($_POST, $id) == true) {
                Flasher::setFlash('Berhasil', 'Data berhasil diedit', 'success');
                header('location:' . BASE_URL . '/user');
                exit;
            } else {
                Flasher::setFlash('Kesalahan', 'Data gagal disimpan', 'danger');
                header('location:' . BASE_URL . '/user');
                exit;
            }
        } else {
            if ($this->model('User_model')->simpanDataUser($_POST) > 0) {
                Flasher::setFlash('Berhasil', 'Data berhasil ditambahkan', 'success');
                header('location:' . BASE_URL . '/user');
                exit;
            } else {
                Flasher::setFlash('Kesalahan', 'Data gagal disimpan', 'danger');
                header('location:' . BASE_URL . '/user');
                exit;
            }
        }
    }

    public function detail($id)
    {
        $data['judul'] = 'Edit Data User';
        $data['detail'] = $this->model('User_model')->getUserById($id);
        $data['role'] = $this->model('User_model')->getRole();

        $this->render('komponen/header');
        $this->render('komponen/script-top');
        $this->render('user/edit', $data);
        $this->render('komponen/script-bottom');
    }

}