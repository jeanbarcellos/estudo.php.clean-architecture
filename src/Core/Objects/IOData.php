<?php

namespace Core\Objects;

use ArrayAccess;
use Core\Interfaces\Arrayable;
use RuntimeException;

class IOData implements ArrayAccess, Arrayable
{
    private $data;

    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    public function getValues(): array
    {
        return $this->data;
    }

    public function hasValue(string $key): bool
    {
        return isset($this->data[$key]);
    }

    public function getValue(string $key)
    {
        return $this->data[$key];
    }

    public function exists(string $key): bool
    {
        return array_key_exists($key, $this->data);
    }

    public function count(): int
    {
        return count($this->data);
    }

    public function toArray(): array
    {
        return $this->getValues();
    }

    public function __get(string $name)
    {
        if (!$this->exists($name)) {
            throw new RuntimeException(sprintf("Undefined property: '%s'", $name));
        }

        return $this->getValue($name);
    }

    public function offsetExists($offset): bool
    {
        return $this->hasValue($offset);
    }

    public function offsetGet($offset)
    {
        return $this->getValue($offset);
    }

    public function offsetSet($offset, $value)
    {
        throw new RuntimeException('Action not allowed!');
    }

    public function offsetUnset($offset)
    {
        throw new RuntimeException('Action not allowed!');
    }

    public static function create(array $data = []): self
    {
        return new static($data);
    }
}
