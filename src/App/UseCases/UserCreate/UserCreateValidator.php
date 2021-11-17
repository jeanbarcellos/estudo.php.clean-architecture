<?php

namespace App\UseCases\UserCreate;

use App\UseCases\UserCreate\UserCreateInputBoundary;
use Core\Validation\Validator;

class UserCreateValidator extends Validator
{
    private $errors = [];

    public function isValid(): bool
    {
        if (rand(0, 1) === 0) {
            $this->errors = ['Validation error test'];
        }

        return empty($this->errors);
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function validate(UserCreateInputBoundary $inputData): void
    {

    }
}
