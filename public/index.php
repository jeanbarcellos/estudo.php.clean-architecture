<?php

use App\Adapters\Database\UserRepository;
use App\UseCases\UserCreateUseCase;
use Core\Iterator\InputData;

require __DIR__ . '/../bootstrap.php';

$userCase = new UserCreateUseCase(new UserRepository());

$inputData = InputData::create([
    'name' => 'Jean Barcellos',
    'email' => 'jeanbarcellos@hotmail.com',
]);

echo "inputData";
var_dump($inputData);

$outputData = $userCase->handle($inputData);

echo "outputData";
var_dump($outputData);
