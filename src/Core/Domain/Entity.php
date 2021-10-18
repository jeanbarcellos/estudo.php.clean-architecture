<?php

namespace Core\Domain;

abstract class Entity
{
    protected string $id;

    public function getId(): string
    {
        return $this->id;
    }
}
