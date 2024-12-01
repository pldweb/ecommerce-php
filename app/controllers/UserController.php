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

    public function simpan($id = null)
    {
        if ($id) {
            if ($this->model('User_model')->updateDataUser($_POST, $id) == true) {
                header('location:' . BASE_URL . '/user/index');
                exit;
            } else {
                echo "Data Tidak Berhasil disimpan";
            }
        } else {
            if ($this->model('User_model')->simpanDataUser($_POST) > 0) {
                header('location:' . BASE_URL . '/user/index');
                exit;
            } else {
                echo "Data Tidak Berhasil disimpan";
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