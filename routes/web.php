<?php

use App\Controllers\AboutController;
use App\Controllers\AuthController;
use App\Controllers\HomeController;
use App\Controllers\LinkController;
use App\Controllers\PostController;
use Framework\Middleware\Authenticated;

$router->get('/',      [HomeController::class, 'index']);
$router->get('/about', [AboutController::class, 'index']);
$router->get('/post',  [PostController::class, 'show']);

$router->get('/links',           [LinkController::class, 'index']);
$router->get('/links/create',    [LinkController::class, 'create'], Authenticated::class);
$router->post('/links/store',    [LinkController::class, 'store'],  Authenticated::class);
$router->get('/links/edit',      [LinkController::class, 'edit'],   Authenticated::class);
$router->put('/links/update',    [LinkController::class, 'update'], Authenticated::class);
$router->delete('/links/delete', [LinkController::class, 'destroy'],Authenticated::class);

$router->get('/login',  [AuthController::class, 'login']);
$router->post('/login', [AuthController::class, 'authenticate']);
$router->post('/logout',[AuthController::class, 'logout'], Authenticated::class);