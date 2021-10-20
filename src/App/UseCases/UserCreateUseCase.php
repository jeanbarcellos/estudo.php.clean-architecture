<?php

namespace App\UseCases;

use App\Domain\Entities\User;
use App\Domain\Repositories\UserRepositoryInterface;
use App\UseCases\UserCreateInputBoundary;
use App\UseCases\UserCreateOutputBoundary;
use App\UseCases\UserCreateValidator;
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

    public function __construct(UserRepositoryInterface $repository, UserCreateValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    public function handle(UserCreateInputBoundary $inputData): UserCreateOutputBoundary
    {
        if (!$this->validator->isValid()) {
            return UserCreateOutputBoundary::createFromFailure($this->validator->getErrors());
        }

        // Faz validação
        $this->validate($inputData);

        // TO-DO ... fazer outras verificações

        // Criar o  usuário
        $user = new User($inputData['name'], $inputData['email']);

        // Persistir no repository
        $this->repository->insert($user);

        // Despachar algum evento... se necessário, ou fazer alguma ação

        // Monta o Output
        return UserCreateOutputBoundary::createFromSuccess([
            'id' => $user->getId(),
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'createdAt' => $user->getCreatedAt(),
        ]);
    }

    private function validate(UserCreateInputBoundary $inputData): void
    {
        // ...
    }
}
