<?php

use App\Adapters\Database\UserRepository;
use App\Domain\Repositories\UserRepositoryInterface;
use Framework\DI\Container;
use Framework\DI\DependencyResolver;
use Framework\Routing\Router;

return function (Container $container) {
    $container->singleton(DependencyResolver::class);

    $container->singleton(Router::class);

    $container->singleton(UserRepositoryInterface::class, UserRepository::class);
};
