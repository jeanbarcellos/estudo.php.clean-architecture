<?php

use App\Adapters\Http\Controllers;
use Framework\Routing\Router;

return function (Router $router) {
    $router->get('/', function () {
        return 'Olá mundo';
    });

    $router->get('/users', [Controllers\UserController::class, 'index']);
    $router->post('/users', [Controllers\UserController::class, 'insert']);
    $router->get('/users/{id}', [Controllers\HomeController::class, 'show']);
    $router->put('/users/{id}', [Controllers\UserController::class, 'update']);
};
