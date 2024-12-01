<?php


class App {

    protected $controller = 'Home';
    protected $method = 'index';
    protected $params = [];

    function __construct() {
        $url = $this->parseURL();

        // Controller
        if (file_exists(__DIR__ . '/../controllers/' . ucfirst($url[0]) . 'Controller.php')) {
            $this->controller = $url[0];
            unset($url[0]);
        }

        require_once __DIR__ . '/../controllers/' . $this->controller . 'Controller.php';
        $this->controller = new $this->controller;


        // Method
        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        // Parameter
        if (!empty($url)) {
           $this->params = array_values($url);
        }

        call_user_func_array([$this->controller, $this->method], $this->params);

    }

    public function parseURL()
    {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            array_splice($url, 0, 1);
            return $url;
        } else {
            return [$this->controller, $this->method];
        }
    }
}