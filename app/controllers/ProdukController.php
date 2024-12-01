<?php


class Produk extends Controller
{
    public function index()
    {
        $data['judul'] = 'Data Produk';
        $data['halaman'] = substr($data['judul'], 5);
        $data['produk'] = $this->model('ProdukModel')->getProduk();

        $this->render('komponen/header');
        $this->render('komponen/script-top');
        $this->render('produk/index', $data);
        $this->render('komponen/script-bottom');
    }

    public function tambah()
    {
        $data['judul'] = 'Tambah Data Produk';
        $data['role'] = $this->model('ProdukModel')->getRole();

        $this->render('komponen/header');
        $this->render('komponen/script-top');
        $this->render('produk/tambah', $data);
        $this->render('komponen/script-bottom');
    }

    public function delete($id)
    {
        if ($id){
            if ($this->model('ProdukModel')->deleteProduk($id) == true) {
                Flasher::setFlash('Berhasil', 'Data berhasil dihapus', 'success');
                header('location:' . BASE_URL . '/produk');
                exit;
            }
        } else {
            Flasher::setFlash('Kesalahan tidak ada ID', 'Data gagal dihapus', 'danger');
            header('location:' . BASE_URL . '/produk');
            exit;
        }
    }

    public function simpan($id = null)
    {
        if ($id) {
            if ($this->model('ProdukModel')->updateDataProduk($_POST, $id) == true) {
                Flasher::setFlash('Berhasil', 'Data berhasil diedit', 'success');
                header('location:' . BASE_URL . '/produk');
                exit;
            } else {
                Flasher::setFlash('Kesalahan', 'Data gagal disimpan', 'danger');
                header('location:' . BASE_URL . '/produk');
                exit;
            }
        } else {
            if ($this->model('ProdukModel')->simpanDataProduk($_POST) > 0) {
                Flasher::setFlash('Berhasil', 'Data berhasil ditambahkan', 'success');
                header('location:' . BASE_URL . '/produk');
                exit;
            } else {
                Flasher::setFlash('Kesalahan', 'Data gagal disimpan', 'danger');
                header('location:' . BASE_URL . '/produk');
                exit;
            }
        }
    }

    public function detail($id)
    {
        $data['judul'] = 'Edit Data Produk';
        $data['halaman'] = substr($data['judul'], 10);

        $data['detail'] = $this->model('ProdukModel')->getProdukById($id);
        $data['role'] = $this->model('ProdukModel')->getRole();

        $this->render('komponen/header');
        $this->render('komponen/script-top');
        $this->render('produk/edit', $data);
        $this->render('komponen/script-bottom');
    }

}