<?php

namespace App\UseCases;

use Core\UseCase\InputBoundary;
use DateTimeInterface;

class UserCreateOutputBoundary extends InputBoundary
{
    protected $id;
    protected $name;
    protected $email;
    protected $createdAt;

    public function __construct(string $id, string $name, string $email, DateTimeInterface $createdAt)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->createdAt = $createdAt;
    }
}
