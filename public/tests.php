<?php

use App\Adapters\Http\Controllers\UserController;
use App\Domain\Events\UserCreatedEvent;
use App\UseCases\UserCreateInputBoundary;
use App\UseCases\UserCreateUseCase;
use Framework\DI\Container;
use Framework\DI\DependencyResolver;

$container = Container::getInstance();

$dependencyResolver = $container->get(DependencyResolver::class);
dump($dependencyResolver);

$resolved = $dependencyResolver->resolveClassMethodParameters(UserController::class, 'test');
dump($resolved);
exit;

// $container->instance('config', ['app' => ['name' => 'teste']]);

// dump($container->get(UserCreateUseCase::class));
dump($container->get(UserCreateUseCase::class));
dump($container->get(UserCreateUseCase::class));
// dump($container->get('config'));

exit;

exit;

$input = new UserCreateInputBoundary('Jean Barcellos', 'jeanbarcellos@hotmail.com');
dump($input);

$data = [
    'email' => 'jeanbarcellos@hotmail.com',
    'name' => 'Jean Barcellos',
];

// __call
dump($input->getName());
dump($input->getEmail());

// __get
dump($input->name);
dump($input->email);

// ArrayAccess
dump($input['name']);
dump($input['email']);

// Factory
$input = UserCreateInputBoundary::create($data);

dump($input);

// Arrayable
dump($input->toArray());

exit;

$event = new UserCreatedEvent($outputData['id'], $outputData['name'], $outputData['email']);

dump($event);
