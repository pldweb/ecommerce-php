<?php
include 'src/database.php';
$db = new Database();
$user = $db->editUser($_GET['id']);

?>
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
        <h4>Ini Edit Data User Form</h4>
    </div>
    <form action="proses.php?aksi=update&id=<?php echo $user['id']; ?>" method="post">
        <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
        <div class="mb-3">
            <label for="nama" class="form-label nama">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $user['nama']; ?>">
        </div>
        <div class=" mb-3">
            <label for="email" class="form-label email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo $user['email']; ?>">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label password">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="password">
        </div>
        <div class="mb-3">
            <label for="alamat" class="form-label alamat">Alamat</label>
            <textarea class="form-control" id="alamat" name="alamat"><?php echo $user['alamat']; ?></textarea>
        </div>
        <label for="nomor_telp" class="form-label nomor_telp">Nomor Telp</label>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">+62</span>
            <input type="number" class="form-control" id="nomor_telp" name="nomor_telp" value="<?php echo $user['nomor_telp']; ?>">
        </div>
        <input type="submit" class="btn btn-primary" value="simpan">
        <a href="index.php" class="btn btn-danger">Kembali</a>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>
