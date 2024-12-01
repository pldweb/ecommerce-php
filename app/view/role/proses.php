<?=

use src\database;

include '../src/database.php';

$database = new Database();

if (isset($_GET['aksi'])) {

    // Data User
    $nama = $_POST['nama'];

    if ($_GET['aksi'] == 'tambah') {
        $database->tambahRole($nama);
        header("location:index.php");
    } elseif ($_GET['aksi'] == 'update') {
        $database->updateRole($_POST['id'], $nama);
        header("location:index.php");
    } elseif ($_GET['aksi'] == 'delete') {
        $database->hapusRole($_POST['id']);
        header("location:index.php");
    } else {
        echo 'Ngga tau aksi apa';
    }
} else {
    echo "Tidak ada aksi";
}


?>