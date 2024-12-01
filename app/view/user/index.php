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
            <td><?php echo $data['role_nama']; ?></td>
            <td class="">
                <a href="<?= BASE_URL ?>/user/detail/<?= $data['id'] ?>" class="btn btn-warning">Edit</a>
                <a onclick="return confirm('Apakah anda yakin?');" href="<?= BASE_URL ?>/user/delete/<?= $data['id'] ?>" class="btn btn-danger">Hapus</a>
            </td>
        </tr>
        <?php  }  ?>
        </tbody>
    </table>

