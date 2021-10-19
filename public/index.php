<?php

use App\Adapters\Database\UserRepository;
use App\UseCases\UserCreateInputBoundary;
use App\UseCases\UserCreateUseCase;
use Core\UseCase\InputData;

require __DIR__ . '/../bootstrap.php';

$input = new UserCreateInputBoundary('Jean Barcellos', 'jeanbarcellos@hotmail.com');

dump($input);

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
$input = UserCreateInputBoundary::create([
    'email' => 'jeanbarcellos@hotmail.com',
    'name' => 'Jean Barcellos',
]);

dump($input);

// Arrayable
dump($input->toArray());

exit;

$userCase = new UserCreateUseCase(new UserRepository());

$inputData = InputData::create([
    'name' => 'Jean Barcellos',
    'email' => 'jeanbarcellos@hotmail.com',
]);

echo "inputData";
dump($inputData->getData());

$outputData = $userCase->handle($inputData);

echo "outputData";
dump($outputData->getData());
