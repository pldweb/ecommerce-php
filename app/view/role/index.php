<div>
    <h4><?= $data['judul'] ?></h4>
</div>
<a href="<?= BASE_URL ?>/role/tambah" class="btn btn-primary mb-2">Tambah Data <?= $data['halaman'] ?></a>
<table class="table">
    <thead>
    <tr>
        <th scope="col">No</th>
        <th scope="col">Nama</th>
        <th scope="col">Opsi</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $no = 1;
    foreach ($data['role'] as $data){?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $data['nama']; ?></td>
            <td class="">
                <a href="<?= BASE_URL ?>/role/detail/<?= $data['id'] ?>" class="btn btn-warning">Edit</a>
                <a onclick="return confirm('Apakah anda yakin?');" href="<?= BASE_URL ?>/role/delete/<?= $data['id'] ?>" class="btn btn-danger">Hapus</a>
            </td>
        </tr>
    <?php  }  ?>
    </tbody>
</table>

