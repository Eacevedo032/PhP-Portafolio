<?php

use Framework\Database;

if (!function_exists('root_path')) {
    function root_path(string $path): string
    {
        //return __DIR__ . '/../';
        return dirname(__DIR__ ) . '/' . normalize_path($path);
    }
}

if (!function_exists('normalize_path')) {
    function normalize_path(string $path): string
    {
      return trim($path, '/');
    }   

}

if(!function_exists('view')){
    function view($view, $data = []): void
    {
        extract($data);


          $filePath = root_path("resources/{$view}.template.php");
        //$filePath = __DIR__ .'/../../resources/' . $view . '.template.php';

        require $filePath;
    }
}

if (!function_exists('old')) {
    function old(string $key, mixed $default = null)
    {
        return $_POST[$key] ?? $default;
    }
}

if (!function_exists('requestIs')) {
    function requestIs(string $uri): bool
    {
        return $_SERVER['REQUEST_URI'] === normalize_path($uri);
    }
}

if (!function_exists('config')) {
    function config(string $key, mixed $default = null)
    {
        $config = require root_path('config/app.php');
        return $config[$key] ?? $default;
    }
}

if (!function_exists('redirect')) {
    function redirect(string $uri): void
    {
        header("Location: /" .normalize_path($uri));
        exit;
    }
}

if (!function_exists("db")){
function db(): Database
    {
        static $db = null;
    if ($db === null) {
        $db = new Database();
    }

    return $db;
    }
}

if (!function_exists('resource_path')) {
    function resource_path(string $path = ''): string
    {
        return root_path("resources/{$path}");
    }
}

if (!function_exists('isAuthenticated')) {
    function isAuthenticated(): bool
    {
        return isset($_SESSION['user']);
        //return (bool) ($_SESSION['user'] ?? false);
    }
}