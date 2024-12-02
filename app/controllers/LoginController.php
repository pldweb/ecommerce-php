<?php


class Login extends Controller
{
    public function index()
    {
        $data['title'] = 'Login';
        $this->render('komponen/script-top');
        $this->render('komponen/header');
        $this->render('login/index', $data);
        $this->render('komponen/script-bottom');
    }

    public function login()
    {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $data['login'] = $this->model('LoginModel')->getData($email, $password);

        var_dump($data['login']);
        session_start();
        if ($data['login'] == NULL) {
            header("location:" . BASE_URL . "/login");
        } else {
            foreach ($data['login'] as $row) {
                $_SESSION['nama'] = $row['nama'];
                header("location:" . BASE_URL . "/user");
            }
        }
    }

}