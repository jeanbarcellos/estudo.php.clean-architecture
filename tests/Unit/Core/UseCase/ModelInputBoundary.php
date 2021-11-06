<?php

namespace Tests\Unit\Core\UseCase;

use Core\UseCase\InputBoundary;

class ModelInputBoundary extends InputBoundary
{
    protected $name;
    protected $email;

    public function __construct(string $name, string $email)
    {
        $this->name = $name;
        $this->email = $email;
    }
}
