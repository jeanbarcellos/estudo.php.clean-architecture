<?php

namespace App\UseCases\UserUpdate;

use App\UseCases\UserUpdate\UserUpdateInputBoundary;
use Core\Validation\Validator;

class UserUpdateValidator extends Validator
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

    public function validate(UserUpdateInputBoundary $inputData): void
    {

    }
}
