<?php 

require __DIR__ .'/../bootstrap.php';

/* var_dump(
    password_hash('password', PASSWORD_DEFAULT)
);

die(); */  // lineas de prueba

/* db()->query('INSERT INTO users (name,email,password) VALUES (:name, :email, :password)', [
    'name' => 'Test User', 
    'email' => 'i@test.com', 
    'password'=> password_hash('password', PASSWORD_DEFAULT),
]); */ //sirve para crear un usuario con contraseña encriptada

use Framework\Router;

$router = new Router();

$router->run();