<?php
include '../src/database.php';
$db = new Database();
?>

<!doctype html>
<html lang="en">
<head>
   <?php
   include '../komponen/script-top.php'
   ?>
</head>
<body>

<?php
    include '../komponen/header.php';
?>

<div class="p-4" style="width: 1200px; display: block; margin: 10px auto 0; border: 1px solid #dddddd;">
    <div>
        <h4>Ini Data User Form</h4>
    </div>
    <a href="tambah.php" class="btn btn-primary mb-2">Tambah Data User</a>
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
            foreach ($db->dataUser() as $data){
                ?>
        <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo $data['nama']; ?></td>
            <td><?php echo $data['email']; ?></td>
            <td><?php echo $data['alamat']; ?></td>
            <td><?php echo $data['nomor_telp']; ?></td>
            <td><?php echo $data['role_id']; ?></td>
            <td class="d-flex gap-1">
                <a href="edit.php?id=<?php echo $data['id']?>&aksi=edit" class="btn btn-warning"><i class=""></i>Edit</a>
                <form action="proses.php?aksi=delete&id=<?php echo $data['id']?>" method="post">
                    <input type="hidden" name="id" value="<?php echo $data['id']?>">
                    <button class="btn btn-danger">Hapus</button>
                </form>
            </td>
        </tr>

        <?php
        }
        ?>

        </tbody>
    </table>
</div>

<?php
    include '../komponen/script-bottom.php';
?>

</body>
</html>
