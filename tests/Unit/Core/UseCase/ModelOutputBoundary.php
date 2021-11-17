<?php

namespace Tests\Unit\Core\UseCase;

use Core\UseCase\OutputBoundary;

class ModelOutputBoundary extends OutputBoundary
{
    protected $name;
    protected $email;

    public static function create(string $name, string $email): self
    {
        $output = new static();
        $output->name = $name;
        $output->email = $email;

        return $output;
    }
}
