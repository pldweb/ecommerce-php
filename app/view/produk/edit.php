
<div class="p-4" style="width: 500px; display: block; margin: 10px auto 0; border: 1px solid #dddddd;">
    <div>
        <h4><?= $data['judul'] ?></h4>
    </div>
    <form action="<?= BASE_URL ?>/user/simpan/<?= $data['detail']['id'] ?>" method="post">
        <input type="hidden" name="id" value="<?= $data['detail']['id']; ?>">
        <div class="mb-3">
            <label for="nama" class="form-label nama">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" value="<?= $data['detail']['nama']; ?>">
        </div>
        <div class=" mb-3">
            <label for="email" class="form-label email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?= $data['detail']['email']; ?>">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label password">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="password">
        </div>
        <div class="mb-3">
            <label for="alamat" class="form-label alamat">Alamat</label>
            <textarea class="form-control" id="alamat" name="alamat"><?= $data['detail']['alamat']; ?></textarea>
        </div>
        <label for="nomor_telp" class="form-label nomor_telp">Nomor Telp</label>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">+62</span>
            <input type="number" class="form-control" id="nomor_telp" name="nomor_telp" value="<?= $data['detail']['nomor_telp']; ?>">
        </div>
        <div class="mb-3">
            <label for="role_id" class="form-label password">Role</label>
            <select name="role_id" id="role_id" class="form-select" aria-label="select">
                <?= foreach ($data['role'] as $item) { ?>
                    <option value="<?= echo $item['id']?>"><?= echo $item['nama']?></option>
                <?= } ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary" value="simpan">Submit</button>
        <a href="<?= BASE_URL ?>/<?= strtolower($data['halaman']) ?>" class="btn btn-danger">Kembali</a>
    </form>
</div>