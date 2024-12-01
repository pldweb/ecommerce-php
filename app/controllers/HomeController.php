<?php


class Home extends Controller {
    public function index()
    {
        $data['nama'] = $this->model('UserModel')->getUser();

        $this->render('komponen/header');
        $this->render('komponen/script-top');
        $this->render('index', $data);
        $this->render('komponen/script-bottom');
    }
}