<?php

namespace App\UseCases;

use App\Domain\Entities\User;
use App\Domain\Repositories\UserRepositoryInterface;
use Core\UseCase\InputData;
use Core\UseCase\OutputData;
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

    public function handle(InputData $inputData): OutputData
    {
        $this->validate($inputData);

        $user = new User($inputData->getValue('name'), $inputData->getValue('email'));

        $this->repository->insert($user);

        return new OutputData([
            'id' => $user->getId(),
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'createdAt' => $user->getCreatedAt(),
        ]);
    }

    private function validate(InputData $inputData): void
    {
        // ...
    }
}
