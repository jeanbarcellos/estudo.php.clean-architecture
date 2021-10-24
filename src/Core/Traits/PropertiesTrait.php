<?php

namespace Core\Traits;

trait PropertiesTrait
{
    protected function getProperties(): array
    {
        return array_keys(get_object_vars($this));
    }

    protected function hasProperty(string $propertyName): bool
    {
        return property_exists($this, $propertyName);
    }

    protected function getProperty(string $propertyName)
    {
        return $this->{$propertyName};
    }

    protected function setProperty(string $propertyName, $value): self
    {
        if ($this->hasProperty($propertyName)) {
            $this->{$propertyName} = $value;
        }

        return $this;
    }
}
