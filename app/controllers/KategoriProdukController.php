<?php


class KategoriProduk extends Controller
{
    public function index()
    {
        $data['judul'] = 'Data Kategori Produk';
        $data['halaman'] = substr($data['judul'], 5);
        $data['kategori-produk'] = $this->model('KategoriProdukModel')->getKategoriProduk();

        $this->render('komponen/header');
        $this->render('komponen/script-top');
        $this->render('kategori-produk/index', $data);
        $this->render('komponen/script-bottom');
    }

    public function tambah()
    {
        $data['judul'] = 'Tambah Data KategoriProduk';
        $data['kategori-produk'] = $this->model('KategoriProdukModel')->getKategoriProduk();

        $this->render('komponen/header');
        $this->render('komponen/script-top');
        $this->render('kategori-produk/tambah', $data);
        $this->render('komponen/script-bottom');
    }

    public function delete($id)
    {
        if ($id){
            if ($this->model('KategoriProdukModel')->deleteKategoriProduk($id) == true) {
                Flasher::setFlash('Berhasil', 'Data berhasil dihapus', 'success');
                header('location:' . BASE_URL . '/kategori-produk');
                exit;
            }
        } else {
            Flasher::setFlash('Kesalahan tidak ada ID', 'Data gagal dihapus', 'danger');
            header('location:' . BASE_URL . '/kategori-produk');
            exit;
        }
    }

    public function simpan($id = null)
    {
        if ($id) {
            if ($this->model('KategoriProdukModel')->updateDataKategoriProduk($_POST, $id) == true) {
                Flasher::setFlash('Berhasil', 'Data berhasil diedit', 'success');
                header('location:' . BASE_URL . '/kategori-produk');
                exit;
            } else {
                Flasher::setFlash('Kesalahan', 'Data gagal disimpan', 'danger');
                header('location:' . BASE_URL . '/kategori-produk');
                exit;
            }
        } else {
            if ($this->model('KategoriProdukModel')->simpanDataKategoriProduk($_POST) > 0) {
                Flasher::setFlash('Berhasil', 'Data berhasil ditambahkan', 'success');
                header('location:' . BASE_URL . '/kategori-produk');
                exit;
            } else {
                Flasher::setFlash('Kesalahan', 'Data gagal disimpan', 'danger');
                header('location:' . BASE_URL . '/kategori-produk');
                exit;
            }
        }
    }

    public function detail($id)
    {
        $data['judul'] = 'Edit Data KategoriProduk';
        $data['halaman'] = substr($data['judul'], 10);
        $data['detail'] = $this->model('KategoriProdukModel')->getKategoriProdukById($id);
        $data['kategori-produk'] = $this->model('KategoriProdukModel')->getKategoriProduk();

        $this->render('komponen/header');
        $this->render('komponen/script-top');
        $this->render('kategori-produk/edit', $data);
        $this->render('komponen/script-bottom');
    }

}