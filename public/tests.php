<?php

use App\Domain\Events\UserCreatedEvent;
use App\UseCases\UserCreateInputBoundary;

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
