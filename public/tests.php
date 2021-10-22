<?php

use App\Adapters\Http\Controllers\PostController;
use App\Domain\Events\UserCreatedEvent;
use App\UseCases\UserCreateInputBoundary;
use App\UseCases\UserCreateUseCase;
use Framework\DI\Container;
use Framework\DI\DependencyResolver;

$container = Container::getInstance();

$dependencyResolver = $container->get(DependencyResolver::class);
dump($dependencyResolver);

$resolved = $dependencyResolver->resolveClassMethodParameters(PostController::class, 'test');
dump($resolved);
exit;

// $container->instance('config', ['app' => ['name' => 'teste']]);

// dump($container->get(UserCreateUseCase::class));
dump($container->get(UserCreateUseCase::class));
dump($container->get(UserCreateUseCase::class));
// dump($container->get('config'));

exit;

$event = new UserCreatedEvent($outputData['id'], $outputData['name'], $outputData['email']);

dump($event);
