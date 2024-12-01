<?php


class Home extends Controller {
    public function index()
    {
        $data['nama'] =$this->model('User_model')->getUser();

        $this->render('komponen/header');
        $this->render('komponen/script-top');
        $this->render('index', $data);
        $this->render('komponen/script-bottom');
    }
}