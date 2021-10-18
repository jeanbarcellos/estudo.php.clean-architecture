<?php

namespace App\UseCases;

use App\Domain\Entities\User;
use App\Domain\Repositories\UserRepositoryInterface;
use Core\Iterator\InputData;
use Core\Iterator\OutputData;
use Core\Iterator\UseCase;

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
        $data = $inputData->getData();

        $user = new User($data['name'], $data['email']);

        $this->repository->insert($user);

        return new OutputData([
            'id' => rand(1, 100),
            'name' => $user->getName(),
            'email' => $user->getEmail(),
        ]);
    }
}
