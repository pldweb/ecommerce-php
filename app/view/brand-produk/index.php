    <div>
        <h4><?= $data['judul'] ?></h4>
    </div>
    <a href="<?= BASE_URL ?>/brand-produk/tambah" class="btn btn-primary mb-2">Tambah Data <?= $data['halaman'] ?></a>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Nama</th>
            <th scope="col">Opsi</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($data['brand-produk'] as $num => $data){ ?>
        <tr>
            <td><?= $num+1; ?></td>
            <td><?= $data['nama']; ?></td>
            <td class="">
                <a href="<?= BASE_URL ?>/brand-produk/detail/<?= $data['id'] ?>" class="btn btn-warning">Edit</a>
                <a onclick="return confirm('Apakah anda yakin?');" href="<?= BASE_URL ?>/produk/delete/<?= $data['id'] ?>" class="btn btn-danger">Hapus</a>
            </td>
        </tr>
        <?php  }  ?>
        </tbody>
    </table>
