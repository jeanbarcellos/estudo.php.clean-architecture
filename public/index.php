<?php

use App\Adapters\Database\UserRepository;
use App\UseCases\UserCreateInputBoundary;
use App\UseCases\UserCreateUseCase;

require __DIR__ . '/../bootstrap.php';

$userCase = new UserCreateUseCase(new UserRepository());

$inputData = new UserCreateInputBoundary('Jean Barcellos', 'jeanbarcellos@hotmail.com');

dump($inputData);

$outputData = $userCase->handle($inputData);

dump($outputData);
