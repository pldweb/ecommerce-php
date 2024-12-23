<div class="p-4" style="width: 500px; display: block; margin: 10px auto 0; border: 1px solid #dddddd;">
    <div>
        <h4><?= $data['judul'] ?></h4>
    </div>
    <form action="<?= BASE_URL ?>/user/simpan" method="POST">
        <div class="mb-3">
            <label for="nama" class="form-label nama">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" placeholder="nama" value="<?= isset($_POST['nama']) ? $_POST['nama'] : '' ?>">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label email">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="email" value="<?= isset($_POST['email']) ? $_POST['email'] : '' ?>">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label password">Password</label>
            <input type="password" class="form-control" value="<?= isset($_POST['password']) ? $_POST['password'] : '' ?>" id="password" name="password" placeholder="password">
        </div>
        <div class="mb-3">
            <label for="alamat" class="form-label alamat">Alamat</label>
            <textarea class="form-control" id="alamat" name="alamat" placeholder="alamat"><?= isset($_POST['alamat']) ? $_POST['alamat'] : '' ?></textarea>
        </div>
        <label for="nomor_telp" class="form-label nomor_telp">Nomor Telp</label>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">+62</span>
            <input type="text" class="form-control" id="nomor_telp" name="nomor_telp" placeholder="ex:8757834" value="<?= isset($_POST['nomor_telp']) ? $_POST['nomor_telp'] : '' ?>">
        </div>
        <div class="mb-3">
            <label for="role_id" class="form-label password">Role</label>
            <select name="role_id" id="role_id" class="form-select" aria-label="select">
                <?php foreach ($data['role'] as $item) { ?>
                    <option value="<?php echo $item['id']?>" <?php echo (isset($_POST['role_id']) && $_POST['role_id'] == $item['id']) ? 'selected' : ''; ?>>
                        <?php echo $item['nama']?>
                    </option>
                <?php } ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>

</div>
