<?php


use App\Core\Database;

class Auth extends Controller
{
    public function index()
    {
        $this->render('auth/login/index');
    }

    public function login()
    {
        $email = $_POST['email'];
        if (strlen(strval($email)) == 0) {
            Flasher::setflash('Gagal', 'email tidak ada', 'danger');
            header('location:' . BASE_URL . '/auth/login');
            exit;
        }

        $password = $_POST['password'];
        if (strlen(strval($password)) == 0) {
            Flasher::setflash('Gagal', 'password tidak ada', 'danger');
            header('location:' . BASE_URL . '/auth/login');
            exit;
        }

        $db = new Database();
        $db->dbh->beginTransaction();

        try {

            $query = "SELECT * FROM user WHERE email = :email and password = :password";
            $db->query($query);
            $db->bind('email', $email);
            $db->bind('password', $password);
            $result = $db->single();

            if (!$result) {
                $db->dbh->rollBack();
                Flasher::setflash('Gagal', 'Email atau password salah', 'danger');
                header('Location: ' . BASE_URL . '/login');
                exit;
            }

            $_SESSION['nama'] = $result['nama'];
            $db->dbh->commit();
            Flasher::setflash('Berhasil', 'Anda berhasil login', 'success');
            header('location:' . BASE_URL . '/user');
            exit;

        } catch (PDOException $e) {
            $db->dbh->rollback();
            Flasher::setflash('Gagal' . $e->getMessage(), 'Terjadi Kesalahan', 'danger');
            header('location:' . BASE_URL . '/auth/login');
            exit;
        }


//        $data['login'] = $this->model('AuthModel')->getData($email, $password);
//        if ($data['login'] == NULL) {
//            header("location:" . BASE_URL . "/login");
//        } else {
//            foreach ($data['login'] as $sesi) {
//                $_SESSION['nama'] = $sesi['nama'];
//                header("location:" . BASE_URL . "/user");
//            }
//        }
    }

    public function daftar()
    {
        $this->render('auth/daftar/index');
    }

    public function prosesdaftar()
    {
        if (strlen($_POST['nama']) == 0) {
            Flasher::setflash('Gagal', 'email tidak ada', 'danger');
            header('location:' . BASE_URL . '/auth/daftar');
            exit;
        }

        if (strlen($_POST['email']) == 0) {
            Flasher::setflash('Gagal', 'email tidak ada', 'danger');
            header('location:' . BASE_URL . '/auth/daftar');
            exit;
        }

        if (strlen($_POST['password']) == 0) {
            Flasher::setflash('Gagal', 'password tidak ada', 'danger');
            header('location:' . BASE_URL . '/auth/daftar');
            exit;
        }
//        $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);

        if (strlen($_POST['nomor_telp']) == 0) {
            Flasher::setflash('Gagal', 'no telp tidak ada', 'danger');
            header('location:' . BASE_URL . '/auth/daftar');
            exit;
        }

        if ($_POST) {
            $data['daftar'] = $this->model('AuthModel')->daftar($_POST);
            if ($data['daftar'] == true) {
                foreach ($data['daftar'] as $sesi) {
                    $_SESSION['nama'] = $sesi['nama'];
                }
                Flasher::setFlash('Berhasil', 'Selamat Anda berhasil daftar', 'success');
                header('location:' . BASE_URL . '/user');
                exit;
            } else {
                Flasher::setFlash('Gagal', 'Data Anda tidak bisa didaftarkan', 'danger');
                header('location:' . BASE_URL . '/auth/daftar');
                exit;
            }
        }
    }

    public function logout()
    {
        session_start();
        session_destroy();
        header("location:" . BASE_URL . '/login');
        exit;
    }

}