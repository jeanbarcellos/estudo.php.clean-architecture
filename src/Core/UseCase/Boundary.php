<?php

namespace Core\UseCase;

use ArrayAccess;
use Core\Interfaces\Arrayable;
use Core\Utils\ObjectUtil;
use RuntimeException;

abstract class Boundary implements ArrayAccess, Arrayable
{
    private const GETTER_PREFIX = 'get';

    public function __call($name, $arguments)
    {
        $propertyName = lcfirst(substr($name, strlen(self::GETTER_PREFIX)));

        if ($this->hasProperty($propertyName) && substr($name, 0, strlen(self::GETTER_PREFIX)) === self::GETTER_PREFIX) {
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

    public function getData(): array
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

    public static function create(array $data): self
    {
        return ObjectUtil::createFromArray(static::class, $data);
    }
}
