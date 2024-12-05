<?php

require_once BASE_PATH . '/MyHelper/Helper.php';

?>

<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ecommerce</title>
    <link href="<?= SCRIPT_PATH ?>/css/bootstrap.css" rel="stylesheet">
</head>
<body>

<div class="p-4" style="width: 1200px; display: block; margin: 10px auto 0; border: 1px solid #dddddd;">

    <?php Flasher::flash(); ?>

    <div class="d-flex justify-content-center align-items-center flex-md-column">
        <p class="h3">Form Login</p>

        <form class="w-25" action="<?= BASE_URL ?>/auth/login" method="POST">
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
            <a href="<?= BASE_URL ?>/auth/daftar" class="">Daftar</a>
        </form>
    </div>

</div>

<script src="<?= SCRIPT_PATH ?>/js/bootstrap.bundle.js"></script>
</body>
</html>
