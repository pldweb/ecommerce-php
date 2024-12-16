
<div class="p-4" style="width: 500px; display: block; margin: 10px auto 0; border: 1px solid #dddddd;">
    <div>
        <h4><?= $data['judul'] ?></h4>
    </div>
    <form action="<?= BASE_URL ?>/kategori-produk/update/<?= $data['detail']['id'] ?>" method="post">
        <input type="hidden" name="id" value="<?= $data['detail']['id']; ?>">
        <div class="mb-3">
            <label for="nama" class="form-label nama">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" value="<?= $data['detail']['nama']; ?>">
        </div>
        <div class="mb-3">
            <label for="nama_parent" class="form-label nama">Nama Parent</label>
            <input type="text" class="form-control" id="nama_parent" name="nama_parent" value="<?= $data['detail']['parent_id']; ?>">
        </div>
        <button type="submit" class="btn btn-primary" value="simpan">Submit</button>
        <a href="<?= BASE_URL ?>/<?= strtolower($data['halaman']) ?>" class="btn btn-danger">Kembali</a>
    </form>
</div>