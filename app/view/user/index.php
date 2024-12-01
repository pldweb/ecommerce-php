<div class="p-4" style="width: 1200px; display: block; margin: 10px auto 0; border: 1px solid #dddddd;">
    <div>
        <h4><?= $data['judul'] ?></h4>
    </div>
    <a href="<?= BASE_URL ?>/user/tambah" class="btn btn-primary mb-2">Tambah Data User</a>
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
            foreach ($data['user'] as $data){?>
        <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo $data['nama']; ?></td>
            <td><?php echo $data['email']; ?></td>
            <td><?php echo $data['alamat']; ?></td>
            <td><?php echo $data['nomor_telp']; ?></td>
            <td><?php echo $data['role_id']; ?></td>
            <td class="">
                <a href="<?= BASE_URL ?>/user/detail/<?= $data['id'] ?>" class="btn btn-warning">Edit</a>
                <form action="<?= BASE_URL ?>/user/delete/<?= $data['id']?>" method="post">
                    <input type="hidden" name="id" value="<?= $data['id']?>">
                    <button class="btn btn-danger">Hapus</button>
                </form>
            </td>
        </tr>
        <?php  }  ?>
        </tbody>
    </table>
</div>
