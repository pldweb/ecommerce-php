<?php


class User extends Controller {
    public function index()
    {
        $data['judul'] = 'Data User';
        $data['user'] = $this->model('User_model')->getUser();

        $this->render('komponen/header');
        $this->render('komponen/script-top');
        $this->render('user/index', $data);
        $this->render('komponen/script-bottom');
    }
}