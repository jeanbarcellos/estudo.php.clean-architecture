<?php

namespace App\UseCases\UserUpdate;

use Core\UseCase\InputBoundary;

class UserUpdateInputBoundary extends InputBoundary
{
    protected $id;
    protected $name;
    protected $email;

    public function __construct(string $id, string $name, string $email)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
    }
}
