<?php

namespace App\UseCases;

use App\Domain\Entities\User;
use App\Domain\Repositories\UserRepositoryInterface;
use App\UseCases\UserCreateInputBoundary;
use App\UseCases\UserCreateOutputBoundary;
use Core\UseCase\UseCase;

class UserCreateUseCase extends UseCase
{
    /**
     * @var \App\Domain\Repositories\UserRepositoryInterface
     */
    private $repository;

    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function handle(UserCreateInputBoundary $inputData): UserCreateOutputBoundary
    {
        // Faz validação
        $this->validate($inputData);

        // TO-DO ... fazer outras verificações

        // Criar o  usuário
        $user = new User($inputData['name'], $inputData['email']);

        // Persistir no repository
        $this->repository->insert($user);

        // Despachar algum evento... se necessário, ou fazer alguma ação

        // Monta o Output
        return UserCreateOutputBoundary::create([
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
