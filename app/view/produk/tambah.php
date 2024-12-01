<div class="p-4" style="width: 500px; display: block; margin: 10px auto 0; border: 1px solid #dddddd;">
    <div>
        <h4><?= $data['judul'] ?></h4>
    </div>
    <form action="<?= BASE_URL ?>/produk/simpan" method="POST">
        <div class="mb-3">
            <label for="nama" class="form-label nama">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" placeholder="nama">
        </div>
        <div class="mb-3">
            <label for="brand_id" class="form-label">Kategori Brand</label>
            <select name="brand_id" id="brand_id" class="form-select" aria-label="select">
                <?php foreach ($data['brand'] as $item) { ?>
                    <option value="<?php echo $item['id']?>"><?php echo $item['nama']?></option>
                <?php } ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="brand_id" class="form-label">Kategori Brand</label>
            <select name="brand_id" id="brand_id" class="form-select" aria-label="select">
                <?php foreach ($data['kategori'] as $item) { ?>
                    <option value="<?php echo $item['id']?>"><?php echo $item['nama']?></option>
                <?php } ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
