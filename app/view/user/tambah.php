


<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ecommerce</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>

<div class="p-4" style="width: 500px; display: block; margin: 10px auto 0; border: 1px solid #dddddd;">
    <div>
        <h4>Ini Create Data User Form</h4>
    </div>
    <form action="proses.php?aksi=tambah" method="POST">
        <div class="mb-3">
            <label for="nama" class="form-label nama">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" placeholder="nama">
        </div>
        <div class=" mb-3">
            <label for="email" class="form-label email">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="email">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label password">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="password">
        </div>
        <div class="mb-3">
            <label for="alamat" class="form-label alamat">Alamat</label>
            <textarea class="form-control" id="alamat" name="alamat" placeholder="alamat"></textarea>
        </div>
        <label for="nomor_telp" class="form-label nomor_telp">Nomor Telp</label>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">+62</span>
            <input type="number" class="form-control" id="nomor_telp" name="nomor_telp" placeholder="ex:8757834">
        </div>
        <div class="mb-3">
            <label for="role_id" class="form-label password">Role</label>
            <select name="role_id" id="role_id" class="form-select" aria-label="select">
                <?php foreach ($data as $item) { ?>
                    <option value="<?php echo $item['id']?>"><?php echo $item['nama']?></option>
                <?php } ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>

<?php
    include '../komponen/script-bottom.php';
?>
</body>
</html>
