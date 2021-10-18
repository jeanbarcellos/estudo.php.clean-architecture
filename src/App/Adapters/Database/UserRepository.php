<?php

namespace App\Adapters\Database;

use App\Domain\Entities\User;
use App\Domain\Repositories\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function findAll(): array
    {
        return [];
    }

    public function findById(): ?User
    {
        return null;
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
