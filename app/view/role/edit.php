
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
        <h4>Ini Edit Data Role Form</h4>
    </div>
    <form action="proses.php?aksi=update&id=<?php echo $role['id']; ?>" method="post">
        <input type="hidden" name="id" value="<?php echo $role['id']; ?>">
        <div class="mb-3">
            <label for="nama" class="form-label nama">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $role['nama']; ?>">
        </div>
        <input type="submit" class="btn btn-primary" value="simpan">
        <a href="index.php" class="btn btn-danger">Kembali</a>
    </form>
</div>

<?php
    include '../komponen/script-bottom.php';
?>

</body>
</html>
