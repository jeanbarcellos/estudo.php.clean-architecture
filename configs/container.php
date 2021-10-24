<?php

use App\Adapters\Database\UserRepository;
use App\Adapters\Event\EventDispatcher;
use App\Domain\Repositories\UserRepositoryInterface;
use Core\Communication\EventDispatcherInterface;
use Framework\DI\Container;
use Framework\DI\DependencyResolver;
use Framework\Routing\Router;

return function (Container $container) {

    // Framework
    $container->singleton(DependencyResolver::class);

    $container->singleton(Router::class);

    // App
    $container->singleton(EventDispatcherInterface::class, EventDispatcher::class);

    $container->singleton(UserRepositoryInterface::class, UserRepository::class);

    $container->singleton(UserRepositoryInterface::class, UserRepository::class);
};
