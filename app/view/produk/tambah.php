<div class="p-4" style="width: 500px; display: block; margin: 10px auto 0; border: 1px solid #dddddd;">
    <div>
        <h4><?= $data['judul'] ?></h4>
    </div>
    <form action="<?= BASE_URL ?>/produk/simpan" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="nama" class="form-label nama">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" placeholder="nama">
        </div>
        <div class="mb-3">
            <label for="brand_id" class="form-label">Kategori Produk</label>
            <select name="brand_id" id="brand_id" class="form-select" aria-label="select">
                <?php foreach ($data['brand'] as $item) { ?>
                    <option value="<?php echo $item['id']?>"><?php echo $item['nama']?></option>
                <?php } ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="kategori_id" class="form-label">Kategori Brand</label>
            <select name="kategori_id" id="kategori_id" class="form-select" aria-label="select">
                <?php foreach ($data['kategori'] as $item) { ?>
                    <option value="<?php echo $item['id']?>"><?php echo $item['nama']?></option>
                <?php } ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="harga" class="form-label harga">Harga Produk</label>
            <input type="number" class="form-control" id="harga" name="harga" placeholder="80.000.000">
        </div>
        <div class="mb-3">
            <label for="stok" class="form-label diskon">Stok Barang</label>
            <input type="number" class="form-control" id="stok" name="stok" placeholder="">
        </div>
        <label for="deskripsi" class="form-label deskripsi">Deskripsi</label>
        <div class="mb-3">
            <textarea name="deskripsi" id="deskripsi" rows="5" class="form-control"></textarea>
        </div>
        <div class="mb-3">
            <label for="foto" class="form-label foto">Foto Produk</label>
            <input type="file" name="foto" class="form-control" id="foto">
        </div>
        <button type="submit" onclick="return confirm('Apakah Kamu yakin?');" class="btn btn-primary">Simpan</button>
    </form>
</div>
