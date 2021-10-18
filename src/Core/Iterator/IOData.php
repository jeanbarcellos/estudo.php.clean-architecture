<?php

namespace Core\Iterator;

use RuntimeException;

abstract class IOData
{
    private array $data;

    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    public function getData(): array
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

    public function __get(string $name)
    {
        if (!$this->exists($name)) {
            throw new RuntimeException(sprintf("Undefined property: '%s'", $name));
        }

        return $this->getValue($name);
    }

    public static function create(array $data = []): self
    {
        return new static($data);
    }
}
