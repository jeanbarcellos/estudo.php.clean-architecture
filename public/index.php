<?php

use App\Adapters\Http\Controllers\UserController;
use Framework\Container;

require __DIR__ . '/../bootstrap.php';
// require 'tests.php';

$container = Container::getInstance();

$controller = $container->get(UserController::class);

$response = $controller->insert();
