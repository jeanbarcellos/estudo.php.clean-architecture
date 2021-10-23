<?php

namespace Framework\DI;

use Framework\DI\Container;
use Framework\Utils\ArrayUtil;
use ReflectionMethod;
use ReflectionParameter;
use RuntimeException;

class DependencyResolver
{
    /**
     * @var \Framework\DI\Container
     */
    private $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function resolveClassMethodParameters(string $className, string $methodName, array $values = []): array
    {
        if (!method_exists($className, $methodName)) {
            return $values;
        }

        $reflector = new ReflectionMethod($className, $methodName);

        return $this->resolveParemeters($reflector->getParameters(), $values);
    }

    private function resolveParemeters(array $parameters, array $values = []): array
    {
        $results = [];
        foreach ($parameters as $parameter) {
            $results[$parameter->getName()] = $this->resolveParameter($parameter, $values);
        }

        return $results;
    }

    private function resolveParameter(ReflectionParameter $parameter, array $values = [])
    {
        $value = ArrayUtil::get($values, $parameter->getName());

        if (!is_null($parameter->getClass())) {
            return $this->resolveParameterClass($parameter, $value);
        }

        return $this->resolveParameterPrimitive($parameter, $value);
    }

    private function resolveParameterClass(ReflectionParameter $parameter, $value = null)
    {
        return $this->container->get($parameter->getClass()->getName());
    }

    private function resolveParameterPrimitive(ReflectionParameter $parameter, $value = null)
    {
        if (!is_null($value)) {
            if ($parameter->hasType()) {
                settype($value, $parameter->getType()->getName());
            }

            return $value;
        }

        if ($parameter->isDefaultValueAvailable()) {
            return $parameter->getDefaultValue();
        }

        throw new RuntimeException("Could not resolve parameter [$parameter] in class {$parameter->getDeclaringClass()->getName()}");
    }
}
