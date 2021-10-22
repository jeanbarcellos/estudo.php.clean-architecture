<?php

use App\Adapters\Http\Controllers\HomeController;
use App\Adapters\Http\Controllers\UserController;
use Framework\Router;

return function (Router $router) {
    $router->get('/', [HomeController::class, 'index']);

    $router->get('/user', [UserController::class, 'insert']);

    $router->get('/test/{id}', [HomeController::class, 'show']);

    $router->get('/cursos/{cursoId}/aulas/{aulaId}/eita/{id}', function () {
        return 'Olá mundo 3';
    });
};
