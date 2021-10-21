<?php

use App\Adapters\Database\UserRepository;
use App\Domain\Repositories\UserRepositoryInterface;
use Framework\DI\Container;
use Framework\DependencyResolver;

require __DIR__ . '/vendor/autoload.php';

# Binds do container
$container = new Container();

$container->singleton(DependencyResolver::class);

$container->singleton(UserRepositoryInterface::class, UserRepository::class);
