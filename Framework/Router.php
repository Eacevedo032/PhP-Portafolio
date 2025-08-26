<?php

class Router
{
    protected $routes = [];

    
    
    
    public function __construct(){
        $this->loadRoutes('web');
    }
    public function get($uri, $action)
    {
        $this->routes['GET'][$uri] = $action;
    }

    public function post($uri, $action)
    {
        $this->routes['POST'][$uri] = $action;
    }

    public function run()
    {
        $Uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        $method = $_SERVER['REQUEST_METHOD']; // GET, POST

        $action = $this->routes[$method][$Uri] ?? null;

        // echo '<pre>';
        // var_dump($this->routes);
        // die();

        if (!$action){
            exit('Route not found'.$method.''.$Uri);
        }

        [$controller, $method] = $action;

        (new $controller)->$method();
    }

    protected function loadRoutes(string $file){
        $router = $this; 

        $filePath = __DIR__ . '/../routes/' . $file . '.php';

        require $filePath;
    }
}
