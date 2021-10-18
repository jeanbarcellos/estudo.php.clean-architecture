<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\User;

interface UserRepositoryInterface
{
    public function findAll(): array;

    public function findById(): ?User;

    public function insert(User $user): User;

    public function update(User $user): User;

    public function delete(User $user): void;
}
