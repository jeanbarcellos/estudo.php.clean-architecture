<?php

namespace App\Adapters\Database;

use App\Domain\Entities\User;
use App\Domain\Repositories\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function findAll(): array
    {
        return [
            new User('Aline Martins', 'aline.martins@hotnai.com'),
            new User('Bruno cardoso', 'bruno.cardoso@hotnai.com'),
            new User('Carlos eduardo santos', 'carlos.santos@hotnai.com'),
        ];
    }

    public function findById(): ?User
    {
        return new User('Aline Martins', 'aline.martins@hotnai.com');
    }

    public function insert(User $user): User
    {
        return $user;
    }

    public function update(User $user): User
    {
        return $user;
    }

    public function delete(User $user): void
    {
        //
    }
}
