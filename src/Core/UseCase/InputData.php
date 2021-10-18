<?php

namespace Core\UseCase;

use Core\UseCase\IOData;

class InputData extends IOData
{
    private array $errors = [];

    public function isValid(): bool
    {
        return true;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function validate(): void
    {
        // ...
    }
}
