<?php


class Login extends Controller
{
    public function index()
    {
        $data['title'] = 'Login';
        $this->render('auth/login/index', $data);
    }
}