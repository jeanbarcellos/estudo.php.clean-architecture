<?php

namespace App\Adapters\Http\Controllers;

use App\UseCases\UserCreateInputBoundary;
use App\UseCases\UserCreateUseCase;

class UserController
{
    /**
     * @var \App\UseCases\UserCreateUseCase
     */
    private $useCase;

    public function __construct(UserCreateUseCase $useCase)
    {
        $this->useCase = $useCase;
    }

    public function insert()
    {
        $inputData = new UserCreateInputBoundary('Jean Barcellos', 'jeanbarcellos@hotmail.com');

        dump($inputData);

        $outputData = $this->useCase->handle($inputData);

        dump($outputData);
    }
}
