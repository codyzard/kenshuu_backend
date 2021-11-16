<?php

class Router
{

    private $controller = 'HomeController';
    private $method = 'index';
    private $routes = [];
    private $params = [];

    public function __construct()
    {
        $url = $this->parseUrl();

        if (file_exists('./controllers/' . ucfirst($url[0]) . 'Controller.php')) {
            $this->controller = ucfirst($url[0]) . 'Controller';
            unset($url[0]);
        }
        require_once './controllers/' . $this->controller . '.php';

        $this->controller = new $this->controller;
        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        $this->params = $url ? array_values($url) : []; // first and second key have unset
        $this->params = count($this->params)  === 1 ? $this->params[0] : $this->params;
        call_user_func([$this->controller, $this->method], $this->params);
    }

    public function parseUrl()
    {
        if (isset($_GET['url'])) {
            return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
    }


    // for defining url and method existed but not use yet
    public function route($action, $callback)
    {
        $action = trim($action, '/');
        $this->routes[$action] = $callback;
    }

}
