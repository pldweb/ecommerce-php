<html lang="en">
<head>
    <?php
    include '../komponen/script-top.php';
    ?>
</head>
<body>

<div class="p-4" style="width: 500px; display: block; margin: 10px auto 0; border: 1px solid #dddddd;">
    <div>
        <h4>Ini Create Data Role Form</h4>
    </div>
    <form action="proses.php?aksi=tambah" method="post">
        <div class="mb-3">
            <label for="nama" class="form-label nama">Nama Role</label>
            <input type="text" class="form-control" id="nama" name="nama" placeholder="nama">
        </div>
        <input type="submit" class="btn btn-primary" value="simpan">
    </form>
</div>

<?php
    include '../komponen/script-bottom.php';
?>
</body>
</html>
