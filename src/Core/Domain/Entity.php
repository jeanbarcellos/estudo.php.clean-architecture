<?php

namespace Core\Domain;

use Core\Interfaces\Arrayable;
use Core\Traits\PropertiesTrait;
use Core\Utils\ObjectUtil;
use ReflectionClass;
use ReflectionMethod;

abstract class Entity implements Arrayable
{
    use PropertiesTrait;

    protected $id;

    public function getId(): string
    {
        return $this->id;
    }

    public function toArray(): array
    {
        $properties = $this->getProperties();

        $methods = (new ReflectionClass($this))->getMethods(ReflectionMethod::IS_PUBLIC);

        $output = [];

        foreach ($methods as $key => $method) {
            $propertyName = ObjectUtil::getPropertyNameFromGetterMethodName($method->getName());

            if (in_array($propertyName, $properties)) {
                $output[$propertyName] = $this->{$method->getName()}();
            }
        }

        return $output;
    }
}
