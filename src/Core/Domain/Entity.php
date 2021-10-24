<?php

namespace Core\Domain;

use Core\Interfaces\Arrayable;
use Core\Traits\PropertiesTrait;
use Core\Utils\ObjectUtil;
use ReflectionClass;
use ReflectionMethod;

abstract class Entity implements Arrayable
{
    private const GETTER_PREFIX = 'get';

    use PropertiesTrait;

    protected $id;

    public function getId(): string
    {
        return $this->id;
    }

    public function toArray(): array
    {
        $output = [];

        $properties = $this->getProperties();

        $replection = new ReflectionClass($this);

        $methods = $replection->getMethods(ReflectionMethod::IS_PUBLIC);

        foreach ($methods as $key => $method) {
            $propertyName = ObjectUtil::getPropertyNameFromMethodName($method->getName(), self::GETTER_PREFIX);

            if (in_array($propertyName, $properties)) {
                $output[$propertyName] = $this->{$method->getName()}();
            }
        }

        return $output;
    }
}
