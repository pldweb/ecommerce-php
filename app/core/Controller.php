<?php

class Controller {
    public function render($view, $data = [])
    {
        require_once __DIR__ . '/../view/' . $view . '.php';
    }

    public function model($model)
    {
        require_once __DIR__ . '/../models/' . $model . '.php';
        return new $model;
    }
}