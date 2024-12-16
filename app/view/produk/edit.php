
<div class="p-4" style="width: 500px; display: block; margin: 10px auto 0; border: 1px solid #dddddd;">
    <div>
        <h4><?= $data['judul'] ?></h4>
    </div>
    <form action="<?= BASE_URL ?>/produk/update/<?= $data['detail']['id'] ?>" method="post">
        <div class="mb-3">
            <label for="nama" class="form-label nama">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" value="<?= $data['detail']['nama'] ?>">
        </div>
        <div class="mb-3">
            <label for="brand_id" class="form-label">Kategori Produk</label>
            <select name="brand_id" id="brand_id" class="form-select" aria-label="select">
                <?php foreach ($data['kategori'] as $item) { ?>
                    <option value="<?php echo $item['id']?>"
                        <?php echo $data['detail']['nama_kategori'] == $item['nama'] ? 'selected' : '' ?>><?php echo $item['nama']?></option>
                <?php } ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="kategori_id" class="form-label">Kategori Brand</label>
            <select name="kategori_id" id="kategori_id" class="form-select" aria-label="select">
                <?php foreach ($data['brand'] as $item) { ?>
                    <option value="<?php echo $item['id']?>"
                        <?php echo $data['detail']['nama_brand'] == $item['nama'] ? 'selected' : '' ?>><?php echo $item['nama']?></option>
                <?php } ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="harga" class="form-label harga">Harga Produk</label>
            <input type="number" class="form-control" id="harga" name="harga" value="<?= $data['detail']['harga'] ?>">
        </div>
        <div class="mb-3">
            <label for="diskon" class="form-label diskon">Diskon</label>
            <input type="number" class="form-control" id="diskon" name="diskon" value="<?= $data['detail']['diskon'] ?>">
        </div>
        <div class="mb-3">
            <label for="stok" class="form-label stok">Stok Barang</label>
            <input type="number" class="form-control" id="stok" name="stok" value="<?= $data['detail']['stok'] ?>">
        </div>
        <label for="deskripsi" class="form-label deskripsi">Deskripsi</label>
        <div class="mb-3">
            <textarea name="deskripsi" id="deskripsi" rows="5" class="form-control"><?= $data['detail']['deskripsi'] ?></textarea>
        </div>
        <div class="mb-3">
            <label for="foto" class="form-label foto">Foto Produk</label>
            <input type="file" name="foto" class="form-control" id="foto">
        </div>
        <button type="submit" class="btn btn-primary" value="simpan">Submit</button>
        <a href="<?= BASE_URL ?>/<?= strtolower($data['halaman']) ?>" class="btn btn-danger">Kembali</a>
    </form>
</div>