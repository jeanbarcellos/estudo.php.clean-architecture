<?php

namespace Core\UseCase;

use Core\UseCase\Boundary;
use Core\Utils\ObjectUtil;

abstract class InputBoundary extends Boundary
{
    public static function create(array $data): self
    {
        return ObjectUtil::createFromArray(static::class, $data);
    }
}
