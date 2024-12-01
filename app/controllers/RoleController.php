<?php


class Role extends Controller
{
    public function index()
    {
        $data['judul'] = 'Data Role';
        $data['halaman'] = substr($data['judul'], 5);
        $data['role'] = $this->model('RoleModel')->getRole();

        $this->render('komponen/header');
        $this->render('komponen/script-top');
        $this->render('role/index', $data);
        $this->render('komponen/script-bottom');
    }

    public function tambah()
    {
        $data['judul'] = 'Tambah Data Role';
        $data['role'] = $this->model('RoleModel')->getRole();

        $this->render('komponen/header');
        $this->render('komponen/script-top');
        $this->render('role/tambah', $data);
        $this->render('komponen/script-bottom');
    }

    public function delete($id)
    {
        if ($id){
            if ($this->model('RoleModel')->deleteRole($id) == true) {
                Flasher::setFlash('Berhasil', 'Data berhasil dihapus', 'success');
                header('location:' . BASE_URL . '/role');
                exit;
            }
        } else {
            Flasher::setFlash('Kesalahan tidak ada ID', 'Data gagal dihapus', 'danger');
            header('location:' . BASE_URL . '/role');
            exit;
        }
    }

    public function simpan($id = null)
    {
        if ($id) {
            if ($this->model('RoleModel')->updateDataRole($_POST, $id) == true) {
                Flasher::setFlash('Berhasil', 'Data berhasil diedit', 'success');
                header('location:' . BASE_URL . '/role');
                exit;
            } else {
                Flasher::setFlash('Kesalahan', 'Data gagal disimpan', 'danger');
                header('location:' . BASE_URL . '/role');
                exit;
            }
        } else {
            if ($this->model('RoleModel')->simpanDataRole($_POST) > 0) {
                Flasher::setFlash('Berhasil', 'Data berhasil ditambahkan', 'success');
                header('location:' . BASE_URL . '/role');
                exit;
            } else {
                Flasher::setFlash('Kesalahan', 'Data gagal disimpan', 'danger');
                header('location:' . BASE_URL . '/role');
                exit;
            }
        }
    }

    public function detail($id)
    {
        $data['judul'] = 'Edit Data Role';
        $data['halaman'] = substr($data['judul'], 10);
        $data['detail'] = $this->model('RoleModel')->getRoleById($id);
        $data['role'] = $this->model('RoleModel')->getRole();

        $this->render('komponen/header');
        $this->render('komponen/script-top');
        $this->render('role/edit', $data);
        $this->render('komponen/script-bottom');
    }

}