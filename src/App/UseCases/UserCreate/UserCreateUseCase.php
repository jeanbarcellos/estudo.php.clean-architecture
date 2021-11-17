<?php

namespace App\UseCases\UserCreate;

use App\Domain\Entities\User;
use App\Domain\Events\UserCreatedEvent;
use App\Domain\Repositories\UserRepositoryInterface;
use App\UseCases\UserCreate\UserCreateInputBoundary;
use App\UseCases\UserCreate\UserCreateOutputBoundary;
use App\UseCases\UserCreate\UserCreateValidator;
use Core\Communication\EventDispatcherInterface;
use Core\UseCase\UseCase;

class UserCreateUseCase
{
    /**
     * @var \App\Domain\Repositories\UserRepositoryInterface
     */
    private $repository;

    /**
     * @var \App\UseCases\UserCreate\UserCreateValidator
     */
    private $validator;

    /**
     * @var \Core\Communication\EventDispatcherInterface
     */
    private $eventDispatcher;

    public function __construct(
        UserRepositoryInterface $repository,
        UserCreateValidator $validator,
        EventDispatcherInterface $eventDispatcher
    ) {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->eventDispatcher = $eventDispatcher;
    }

    public function handle(UserCreateInputBoundary $inputData): UserCreateOutputBoundary
    {
        // Validar o InputData
        if (!$this->validator->isValid()) {
            return UserCreateOutputBoundary::createFromFailure($this->validator->getErrors());
        }

        // Criar o  usuário
        $user = new User($inputData['name'], $inputData['email']);

        // Persistir no repository
        $this->repository->insert($user);

        // Despachar evento de usuário criado
        $this->eventDispatcher->dispatch(UserCreatedEvent::create($user->toArray()));

        // Retornar o OutputData
        return UserCreateOutputBoundary::createFromSuccess($user->toArray());
    }
}
