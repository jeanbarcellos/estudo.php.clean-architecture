<?php

namespace App\Adapters\Http\Controllers;

use Core\Presentation\Presenter;
use Framework\Http\RequestInterface;
use App\UseCases\UserCreate\UserCreateUseCase;
use App\UseCases\UserUpdate\UserUpdateUseCase;
use App\UseCases\UserCreate\UserCreateInputBoundary;
use App\UseCases\UserUpdate\UserUpdateInputBoundary;

class UserController
{
    /**
     * @var \App\UseCases\UserCreate\UserCreateUseCase
     */
    private $createUseCase;

    /**
     * @var \App\UseCases\UpdateCreate\UserUpdateUseCase
     */
    private $updateUseCase;

    /**
     * @var \Core\Presentation\Presenter
     */
    private $presenter;

    public function __construct(
        UserCreateUseCase $createUseCase,
        UserUpdateUseCase $updateUseCase,
        Presenter $presenter
    ) {
        $this->createUseCase = $createUseCase;
        $this->updateUseCase = $updateUseCase;
        $this->presenter = $presenter;
    }

    public function index(RequestInterface $request)
    {
        $inputData = UserCreateInputBoundary::create($request->body());

        $outputData = $this->createUseCase->handle($inputData);

        return $this->presenter->handle($outputData);
    }

    public function show(int $id)
    {
        dump($id);
    }

    public function insert(RequestInterface $request)
    {
        $inputData = UserCreateInputBoundary::create($request->body());

        $outputData = $this->createUseCase->handle($inputData);

        return $this->presenter->handle($outputData);
    }

    public function update(int $id, RequestInterface $request)
    {
        $data = $request->body();
        $data['id'] = $id;

        $inputData = UserUpdateInputBoundary::create($data);

        $outputData = $this->updateUseCase->handle($inputData);

        return $this->presenter->handle($outputData);
    }
}
