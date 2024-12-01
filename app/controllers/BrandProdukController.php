<?php


class BrandProduk extends Controller
{
    public function index()
    {
        $data['judul'] = 'Data Brand Produk';
        $data['halaman'] = substr($data['judul'], 5);
        $data['brand-produk'] = $this->model('BrandProdukModel')->getBrandProduk();

        $this->render('komponen/script-top');
        $this->render('komponen/header');
        $this->render('brand-produk/index', $data);
        $this->render('komponen/script-bottom');
    }

    public function tambah()
    {
        $data['judul'] = 'Tambah Data BrandProduk';
        $data['brand-produk'] = $this->model('BrandProdukModel')->getBrandProduk();

        $this->render('komponen/script-top');
        $this->render('komponen/header');
        $this->render('brand-produk/tambah', $data);
        $this->render('komponen/script-bottom');
    }

    public function delete($id)
    {
        if ($id){
            if ($this->model('BrandProdukModel')->deleteBrandProduk($id) == true) {
                Flasher::setFlash('Berhasil', 'Data berhasil dihapus', 'success');
                header('location:' . BASE_URL . '/brand-produk');
                exit;
            }
        } else {
            Flasher::setFlash('Kesalahan tidak ada ID', 'Data gagal dihapus', 'danger');
            header('location:' . BASE_URL . '/brand-produk');
            exit;
        }
    }

    public function simpan($id = null)
    {
        if ($id) {
            if ($this->model('BrandProdukModel')->updateDataBrandProduk($_POST, $id) == true) {
                Flasher::setFlash('Berhasil', 'Data berhasil diedit', 'success');
                header('location:' . BASE_URL . '/brand-produk');
                exit;
            } else {
                Flasher::setFlash('Kesalahan', 'Data gagal disimpan', 'danger');
                header('location:' . BASE_URL . '/brand-produk');
                exit;
            }
        } else {
            if ($this->model('BrandProdukModel')->simpanDataBrandProduk($_POST) > 0) {
                Flasher::setFlash('Berhasil', 'Data berhasil ditambahkan', 'success');
                header('location:' . BASE_URL . '/brand-produk');
                exit;
            } else {
                Flasher::setFlash('Kesalahan', 'Data gagal disimpan', 'danger');
                header('location:' . BASE_URL . '/brand-produk');
                exit;
            }
        }
    }

    public function detail($id)
    {
        $data['judul'] = 'Edit Data BrandProduk';
        $data['halaman'] = substr($data['judul'], 10);
        $data['detail'] = $this->model('BrandProdukModel')->getBrandProdukById($id);
        $data['brand-produk'] = $this->model('BrandProdukModel')->getBrandProduk();

        $this->render('komponen/script-top');
        $this->render('komponen/header');
        $this->render('brand-produk/edit', $data);
        $this->render('komponen/script-bottom');
    }

}