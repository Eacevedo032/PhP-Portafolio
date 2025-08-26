<?php

require __DIR__ .'/../app/controllers/AboutController.php';
require __DIR__ .'/../app/controllers/HomeController.php';
require __DIR__ .'/../app/controllers/LinkController.php';
require __DIR__ .'/../app/controllers/PostController.php';

$router->get('/', [HomeController::class, 'index']);
$router->get('/about', [AboutController::class, 'index']);
$router->get('/post', [PostController::class, 'show']);

$router->get('/links', [LinkController::class, 'index']);
$router->get('/links/create', [LinkController::class, 'create']);
$router->post('/links', [LinkController::class, 'store']);
