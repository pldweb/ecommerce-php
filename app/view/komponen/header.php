<div class="container">
    <header class="d-flex justify-content-center py-3">
        <ul class="nav nav-pills">
            <li class="nav-item"><a href="<?= BASE_URL ?>" class="nav-link active" aria-current="page">Home</a></li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    User
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#">Profile</a></li>
                    <li><a class="dropdown-item" href="<?= BASE_URL ?>/user">Data User</a></li>
                    <li><a class="dropdown-item" href="<?= BASE_URL ?>/role">Role User</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Produk
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="<?= BASE_URL ?>/produk">Produk</a></li>
                    <li><a class="dropdown-item" href="<?= BASE_URL ?>/kategori-produk"">Kategori Produk</a></li>
                    <li><a class="dropdown-item" href="<?= BASE_URL ?>/brand-produk"">Brand Produk</a></li>
                </ul>
            </li>
            <li class="nav-item"><a href="#" class="nav-link">Transaksi</a></li>
        </ul>
    </header>
</div>

<div class="p-4" style="width: 1200px; display: block; margin: 10px auto 0; border: 1px solid #dddddd;">

<div class="row">
    <div class="col-lg-12">
        <?= Flasher::flash(); ?>
    </div>
</div>