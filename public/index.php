<?php

use App\Adapters\Database\UserRepository;
use App\UseCases\UserCreateInputBoundary;
use App\UseCases\UserCreateUseCase;
use App\UseCases\UserCreateValidator;

require __DIR__ . '/../bootstrap.php';
// require 'tests.php';

$userCase = new UserCreateUseCase(new UserRepository(), new UserCreateValidator());

$inputData = new UserCreateInputBoundary('Jean Barcellos', 'jeanbarcellos@hotmail.com');

dump($inputData);

$outputData = $userCase->handle($inputData);

dump($outputData->getValues());
