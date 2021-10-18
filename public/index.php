<?php

use App\Adapters\Database\UserRepository;
use App\UseCases\UserCreateUseCase;
use Core\UseCase\InputData;

require __DIR__ . '/../bootstrap.php';

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
