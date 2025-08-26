<?php

use App\Controllers\AboutController;
use App\Controllers\HomeController;
use App\Controllers\LinkController;
use App\Controllers\PostController;

$router->get('/',      [HomeController::class, 'index']);
$router->get('/about', [AboutController::class, 'index']);
$router->get('/post',  [PostController::class, 'show']);

$router->get('/links',           [LinkController::class, 'index']);
$router->get('/links/create',    [LinkController::class, 'create']);
$router->post('/links/store',    [LinkController::class, 'store']);
$router->get('/links/edit',      [LinkController::class, 'edit']);
$router->put('/links/update',    [LinkController::class, 'update']);
$router->delete('/links/delete', [LinkController::class, 'destroy']);