<?php


class Home extends Controller {
    public function index()
    {
        $data['nama'] = $this->model('UserModel')->getUser();

        $data['title'] = 'Login';
        $this->render('komponen/header');
        $this->render('komponen/script-top');
        $this->render('index', $data);
        $this->render('komponen/script-bottom');
    }
}