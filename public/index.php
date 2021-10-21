<?php

use App\Adapters\Http\Controllers\UserController;
use Framework\DI\Container;
use Framework\DI\DependencyResolver;

require __DIR__ . '/../bootstrap.php';
// require 'tests.php';

$container = Container::getInstance();

$dependencyResolver = $container->get(DependencyResolver::class);

$controllerName = UserController::class;
$actionName = 'insert';

$parameters = $dependencyResolver->resolveClassMethodParameters($controllerName, $actionName);

$controller = $container->get($controllerName);

$response = call_user_func_array([$controller, $actionName], $parameters);
