<?php

namespace Core\Utils;

use ReflectionClass;

class ObjectUtil
{
    public static function createFromArray($objectOrClass, array $data = [])
    {
        $reflectionClass = new ReflectionClass($objectOrClass);

        $args = [];

        foreach ($reflectionClass->getConstructor()->getParameters() as $parameter) {
            $value = null;

            if ($parameter->isOptional()) {
                $value = $parameter->getDefaultValue();
            }

            if (array_key_exists($parameter->getName(), $data)) {
                $value = $data[$parameter->getName()];
            }

            $args[$parameter->getName()] = $value;
        }

        return $reflectionClass->newInstanceArgs($args);
    }
}
