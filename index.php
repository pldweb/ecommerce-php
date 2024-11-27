<?php
include 'src/database.php';
$db = new Database();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ecommerce</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>

<div class="p-4" style="width: 900px; display: block; margin: 10px auto 0; border: 1px solid #dddddd;">
    <div>
        <h4>Ini Data User Form</h4>
    </div>
    <a href="tambah_user.php" class="btn btn-primary mb-2">Tambah Data User</a>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Nama</th>
            <th scope="col">Email</th>
            <th scope="col">Alamat</th>
            <th scope="col">Nomor Telp</th>
            <th scope="col">Role</th>
            <th scope="col">Opsi</th>
        </tr>
        </thead>
        <tbody>
        <?php
            $no = 1;
            foreach ($db->data_user() as $data){
                ?>
        <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo $data['nama']; ?></td>
            <td><?php echo $data['email']; ?></td>
            <td><?php echo $data['alamat']; ?></td>
            <td><?php echo $data['nomor_telp']; ?></td>
            <td><?php echo "-"; ?></td>
            <td>
                <a href="edit.php?id=<?php echo $data['id']?>&aksi=edit" class="btn btn-warning"><i class=""></i>Edit</a>
                <a href="" class="btn btn-danger"><i class=""></i>Hapus</a>
            </td>
        </tr>

        <?php
        }
        ?>

        </tbody>
    </table>
</div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>
