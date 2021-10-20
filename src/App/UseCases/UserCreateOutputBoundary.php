<?php

namespace App\UseCases;

use Core\UseCase\OutputBoundary;
use DateTimeInterface;

class UserCreateOutputBoundary extends OutputBoundary
{
    protected $id;
    protected $name;
    protected $email;
    protected $createdAt;

    public static function create(string $id, string $name, string $email, DateTimeInterface $createdAt): self
    {
        $output = new static();
        $output->id = $id;
        $output->name = $name;
        $output->email = $email;
        $output->createdAt = $createdAt;
    }
}
