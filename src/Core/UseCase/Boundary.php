<?php

namespace Core\UseCase;

use RuntimeException;

abstract class Boundary
{
    private const GETTER_PREFIX = 'get';

    protected function hasProperty(string $propertyName): bool
    {
        return property_exists($this, $propertyName);
    }

    protected function getProperty($property)
    {
        return $this->{$property};
    }

    protected function setProperty($property, $value): self
    {
        if ($this->hasProperty($property)) {
            $this->{$property} = $value;
        }

        return $this;
    }

    public function __call($name, $arguments)
    {
        $propertyName = lcfirst(substr($name, strlen(self::GETTER_PREFIX)));

        if ($this->hasProperty($propertyName)
            && substr($name, 0, strlen(self::GETTER_PREFIX)) === self::GETTER_PREFIX
        ) {
            return $this->getProperty($propertyName);
        }

        throw new RuntimeException("Call to undefined method " . static::class . "::" . $name . ".");
    }
}
