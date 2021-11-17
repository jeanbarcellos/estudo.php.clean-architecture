<?php

namespace App\UseCases\UserCreate;

use Core\UseCase\InputBoundary;

class UserCreateInputBoundary extends InputBoundary
{
    protected $name;
    protected $email;

    public function __construct(string $name, string $email)
    {
        $this->name = $name;
        $this->email = $email;
    }
}
