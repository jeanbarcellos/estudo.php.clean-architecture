<?php

namespace App\Adapters\Http\Controllers;

use App\UseCases\UserCreate\UserCreateInputBoundary;
use App\UseCases\UserCreate\UserCreateUseCase;
use Core\Presentation\Presenter;
use Framework\Http\RequestInterface;

class UserController
{
    /**
     * @var \App\UseCases\UserCreate\UserCreateUseCase
     */
    private $useCase;

    /**
     * @var \Core\Presentation\Presenter
     */
    private $presenter;

    public function __construct(
        UserCreateUseCase $useCase,
        Presenter $presenter
    ) {
        $this->useCase = $useCase;
        $this->presenter = $presenter;
    }

    public function index(RequestInterface $request)
    {
        $inputData = UserCreateInputBoundary::create($request->body());

        $outputData = $this->useCase->handle($inputData);

        return $this->presenter->handle($outputData);
    }

    public function show(int $id)
    {
        dump($id);
    }

    public function insert(RequestInterface $request)
    {
        $inputData = UserCreateInputBoundary::create($request->body());

        $outputData = $this->useCase->handle($inputData);

        return $this->presenter->handle($outputData);
    }
}
