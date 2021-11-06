<?php

namespace Core\UseCase;

use ArrayAccess;
use Core\Interfaces\Arrayable;
use Core\Traits\PropertiesTrait;
use Core\Utils\ObjectUtil;
use RuntimeException;

abstract class Boundary implements ArrayAccess, Arrayable
{
    use PropertiesTrait;

    public function __call($name, $arguments)
    {
        $propertyName = ObjectUtil::getPropertyNameFromGetterMethodName($name);

        if ($this->hasProperty($propertyName) && ObjectUtil::isGetterMethod($name)) {
            return $this->getProperty($propertyName);
        }

        throw new RuntimeException("Call to undefined method " . static::class . "::" . $name . ".");
    }

    public function __get(string $name)
    {
        if (!$this->hasProperty($name)) {
            throw new RuntimeException(sprintf("Undefined property: '%s'", $name));
        }

        return $this->getProperty($name);
    }

    public function getValues(): array
    {
        return $this->toArray();
    }

    public function getValue(string $key)
    {
        return $this->getProperty($key);
    }

    public function offsetExists($offset): bool
    {
        return $this->hasProperty($offset);
    }

    public function offsetGet($offset)
    {
        return $this->getProperty($offset);
    }

    public function offsetSet($offset, $value)
    {
        throw new RuntimeException('Action not allowed!');
    }

    public function offsetUnset($offset)
    {
        throw new RuntimeException('Action not allowed!');
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
