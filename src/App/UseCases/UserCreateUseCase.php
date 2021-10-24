<?php

namespace App\UseCases;

use App\Domain\Entities\User;
use App\Domain\Events\UserCreatedEvent;
use App\Domain\Repositories\UserRepositoryInterface;
use App\UseCases\UserCreateInputBoundary;
use App\UseCases\UserCreateOutputBoundary;
use App\UseCases\UserCreateValidator;
use Core\Communication\EventDispatcherInterface;
use Core\UseCase\UseCase;

class UserCreateUseCase
{
    /**
     * @var \App\Domain\Repositories\UserRepositoryInterface
     */
    private $repository;

    /**
     * @var \App\UseCases\UserCreateValidator
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
