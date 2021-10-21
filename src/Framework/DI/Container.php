<?php

namespace Framework\DI;

use Closure;
use ReflectionClass;
use ReflectionParameter;
use RuntimeException;

class Container
{
    protected static $instance;

    private $bindings = [];

    private $instances = [];

    private $singleton = [];

    public function __construct()
    {
        static::$instance = $this;
        $this->instances[static::class] = $this;
    }

    public static function getInstance(): Container
    {
        if (is_null(static::$instance)) {
            static::$instance = new static;
        }

        return static::$instance;
    }

    public function set(string $id, $operation = null, $singleton = false): void
    {
        unset($this->instances[$id]);

        if (is_null($operation)) {
            $operation = $id;
        }

        if (!$operation instanceof Closure) {
            $operation = $this->createClosure($id, $operation);
        }

        $this->bindings[$id] = $operation;

        if ($singleton) {
            $this->singleton[$id] = true;
        }
    }

    public function singleton(string $id, $operation = null): void
    {
        $this->set($id, $operation, true);
    }

    public function isSingleton(string $id): bool
    {
        return (isset($this->singleton[$id]) && $this->singleton[$id] === true);
    }

    public function instance(string $id, $operation)
    {
        $this->instances[$id] = $operation;
    }

    public function has(string $id): bool
    {
        return isset($this->bindings[$id]) || isset($this->instances[$id]);
    }

    public function get(string $id)
    {
        try {
            return $this->resolve($id);
        } catch (Exception $e) {
            if ($this->has($id)) {
                throw $e;
            }

            throw new RuntimeException($id);
        }
    }

    private function createClosure(string $id, $operation): Closure
    {
        return function ($container) use ($id, $operation) {
            if ($id == $operation) {
                return $container->build($operation);
            }

            return $container->resolve($operation);
        };
    }

    private function getOperation(string $id)
    {
        if (isset($this->bindings[$id])) {
            return $this->bindings[$id];
        }

        return $id;
    }

    private function resolve(string $id)
    {
        if (isset($this->instances[$id])) {
            return $this->instances[$id];
        }

        $object = $this->build($this->getOperation($id));

        if ($this->isSingleton($id)) {
            $this->instances[$id] = $object;
        }

        return $object;
    }

    private function build($class)
    {
        if ($class instanceof Closure) {
            return $class($this);
        }

        $reflector = new ReflectionClass($class);

        if (!$reflector->isInstantiable()) {
            throw new RuntimeException("The object '" . $class . "' is not instantiable.");
        }

        $constructor = $reflector->getConstructor();

        if (is_null($constructor)) {
            return new $class();
        }

        try {
            $parameters = $this->resolveParemeters($constructor->getParameters());
        } catch (ResolutionException $e) {
            throw $e;
        }

        return $reflector->newInstanceArgs($parameters);
    }

    private function resolveParemeters(array $parameters): array
    {
        $results = [];
        foreach ($parameters as $parameter) {
            $results[] = $this->resolveParameter($parameter);
        }
        return $results;
    }

    private function resolveParameter(ReflectionParameter $parameter)
    {
        if (!is_null($parameter->getClass())) {
            return $this->resolveParameterClass($parameter);
        }

        return $this->resolveParameterPrimitive($parameter);
    }

    private function resolveParameterClass(ReflectionParameter $parameter)
    {
        try {
            return $this->resolve($parameter->getClass()->name);
        } catch (RuntimeException $e) {
            if ($parameter->isOptional()) {
                return $parameter->getDefaultValue();
            }

            throw $e;
        }
    }

    private function resolveParameterPrimitive(ReflectionParameter $parameter)
    {
        if ($parameter->isDefaultValueAvailable()) {
            return $parameter->getDefaultValue();
        }

        throw new RuntimeException("Could not resolve parameter [$parameter] in class {$parameter->getDeclaringClass()->getName()}");
    }

    public static function staticGet(string $id)
    {
        return self::getInstance()->get($id);
    }
}
