<?php


class User extends Controller
{
    public function index()
    {
        $data['judul'] = 'Data User';
        $data['halaman'] = substr($data['judul'], 5);
        $data['user'] = $this->model('UserModel')->getUser();


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
        if ($id) {
            if ($this->model('UserModel')->updateDataUser($_POST, $id) == true) {
                Flasher::setFlash('Berhasil', 'Data berhasil diedit', 'success');
                header('location:' . BASE_URL . '/user');
                exit;
            } else {
                Flasher::setFlash('Kesalahan', 'Data gagal disimpan', 'danger');
                header('location:' . BASE_URL . '/user');
                exit;
            }
        } else {
            if ($this->model('UserModel')->simpanDataUser($_POST) > 0) {
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
        $data['halaman'] = substr($data['judul'], 10);

        $data['detail'] = $this->model('UserModel')->getUserById($id);
        $data['role'] = $this->model('UserModel')->getRole();

        $this->render('komponen/script-top');
        $this->render('komponen/header');
        $this->render('user/edit', $data);
        $this->render('komponen/script-bottom');
    }

}