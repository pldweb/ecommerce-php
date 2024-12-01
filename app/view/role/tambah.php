<div class="p-4" style="width: 500px; display: block; margin: 10px auto 0; border: 1px solid #dddddd;">
    <div>
        <h4><?= $data['judul'] ?></h4>
    </div>
    <form action="<?= BASE_URL ?>/role/simpan" method="POST">
        <div class="mb-3">
            <label for="nama" class="form-label nama">Nama Role</label>
            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Role">
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
