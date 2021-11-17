<?php

namespace App\UseCases\UserUpdate;

use App\Domain\Entities\User;
use App\Domain\Events\UserUpdatedEvent;
use App\Domain\Repositories\UserRepositoryInterface;
use App\UseCases\UserUpdate\UserUpdateInputBoundary;
use App\UseCases\UserUpdate\UserUpdateOutputBoundary;
use App\UseCases\UserUpdate\UserUpdateValidator;
use Core\Communication\EventDispatcherInterface;
use Core\UseCase\UseCase;

class UserUpdateUseCase
{
    /**
     * @var \App\Domain\Repositories\UserRepositoryInterface
     */
    private $repository;

    /**
     * @var \App\UseCases\UserUpdate\UserUpdateValidator
     */
    private $validator;

    /**
     * @var \Core\Communication\EventDispatcherInterface
     */
    private $eventDispatcher;

    public function __construct(
        UserRepositoryInterface $repository,
        UserUpdateValidator $validator,
        EventDispatcherInterface $eventDispatcher
    ) {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->eventDispatcher = $eventDispatcher;
    }

    public function handle(UserUpdateInputBoundary $inputData): UserUpdateOutputBoundary
    {
        // Validar o InputData
        if (!$this->validator->isValid()) {
            return UserUpdateOutputBoundary::createFromFailure($this->validator->getErrors());
        }

        // Procurar usuário
        $user = $this->repository->findById($inputData['id']);

        if (is_null($user)) {
            return UserUpdateOutputBoundary::createFromFailure(["User {$inputData['id']} not found!"]);
        }

        // Alterar campos
        $user->setName($inputData['name']);
        $user->setEmail($inputData['email']);

        // Persistir no repository
        $this->repository->update($user);

        // Despachar evento de usuário criado
        $this->eventDispatcher->dispatch(UserUpdatedEvent::create($user->toArray()));

        // Retornar o OutputData
        return UserUpdateOutputBoundary::createFromSuccess($user->toArray());
    }
}
