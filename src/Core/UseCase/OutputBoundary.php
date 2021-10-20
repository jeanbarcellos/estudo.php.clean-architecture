<?php

namespace Core\UseCase;

use Core\UseCase\Boundary;

abstract class OutputBoundary extends Boundary
{
    protected $validationErrors = [];

    // criar `public static create(...)` como construtor
    protected function __construct()
    {}

    public function getValidationErrors()
    {
        return $this->validationErrors;
    }

    public static function createFromSuccess(array $data): self
    {
        $output = new static();

        foreach ($output->getProperties() as $parameterName) {
            if (!array_key_exists($parameterName, $data)) {
                continue;
            }
            $output->setProperty($parameterName, $data[$parameterName]);
        }

        return $output;
    }

    public static function createFromFailure(array $errors): self
    {
        $output = new static();
        $output->validationErrors = $errors;
        return $output;
    }
}
