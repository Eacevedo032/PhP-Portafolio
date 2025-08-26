<?php 

require __DIR__ . '/../framework/Database.php';
require __DIR__ .'/../framework/Validator.php';
require __DIR__ .'/../framework/Router.php';

$db = new Database();

$router = new Router();

$router->run();