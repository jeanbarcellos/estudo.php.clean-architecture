<?php

namespace Core\Utils;

use ReflectionClass;

class ObjectUtil
{
    public const GETTER_PREFIX = 'get';
    public const SETTER_PREFIX = 'set';

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

    public static function isGetterMethod(string $methodName): bool
    {
        return substr($methodName, 0, strlen(static::GETTER_PREFIX)) === static::GETTER_PREFIX;
    }

    public static function isSetterMethod(string $methodName): bool
    {
        return substr($methodName, 0, strlen(static::SETTER_PREFIX)) === static::SETTER_PREFIX;
    }

    public static function getPropertyNameFromMethodName(string $name, string $prefix = '')
    {
        return lcfirst(substr($name, strlen($prefix)));
    }

    public static function getPropertyNameFromGetterMethodName(string $name)
    {
        return self::getPropertyNameFromMethodName($name, self::GETTER_PREFIX);
    }

    public static function getPropertyNameFromSetterMethodName(string $name)
    {
        return self::getPropertyNameFromMethodName($name, self::SETTER_PREFIX);
    }

    public static function getMethodNameFromPropertyName(string $name, string $prefix = '')
    {
        return $prefix . ucfirst($name);
    }

    public static function getGetterMethodNameFromPropertyName(string $name)
    {
        return self::getMethodNameFromPropertyName($name, self::GETTER_PREFIX);
    }

    public static function getSetterMethodNameFromPropertyName(string $name)
    {
        return self::getMethodNameFromPropertyName($name, self::SETTER_PREFIX);
    }

}
