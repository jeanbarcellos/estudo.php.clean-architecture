<?php

namespace Framework;

use Closure;
use Framework\DI\DependencyResolver;

class Router
{
    private $routes = [];

    private $method;

    private $uri;

    private $params;

    /**
     * @var \Framework\DI\DependencyResolver
     */
    private $dependencyResolver;

    public function __construct(DependencyResolver $dependencyResolver)
    {
        $this->dependencyResolver = $dependencyResolver;
    }

    public function get(string $route, $action): self
    {
        $this->add('GET', $route, $action);
        return $this;
    }

    public function post(string $route, $action): self
    {
        $this->add('POST', $route, $action);
        return $this;
    }

    public function put(string $route, $action): self
    {
        $this->add('PUT', $route, $action);
        return $this;
    }

    public function patch(string $route, $action): self
    {
        $this->add('PATCH', $route, $action);
        return $this;
    }

    public function delete(string $route, $action): self
    {
        $this->add('DELETE', $route, $action);
        return $this;
    }

    public function add(string $method, string $route, $action): self
    {
        $this->routes[$method][$route] = $action;
        return $this;
    }

    public function getParams()
    {
        return $this->params;
    }

    public function handler($request)
    {
        $this->method = $request[0];
        $this->uri = '/' . ltrim(trim($request[1]), '/');

        if (empty($this->routes[$this->method])) {
            return false;
        }

        if (isset($this->routes[$this->method][$this->uri])) {
            return $this->resolveAction($this->routes[$this->method][$this->uri]);
        }

        foreach ($this->routes[$this->method] as $route => $action) {
            if ($this->checkUrl($route, $this->uri)) {
                return $this->resolveAction($action);
            }
        }

        return false;
    }

    private function resolveAction($action)
    {
        if ($action instanceof Closure) {
            return $action();
        }

        if (is_string($action)) {
            return $this->dependencyResolver->resolveClassMethodParameters($action, 'index');
        }

        if (is_array($action)) {
            return $this->dependencyResolver->resolveClassMethodParameters($action[0], $action[1]);
        }

        return $action;
    }

    private function checkUrl(string $route, string $path)
    {
        $regex = self::extractRegex($route);

        $matched = (bool) preg_match($regex, rawurldecode($path));

        if ($matched) {
            $this->params = self::extractValuesFromVariables($path, $regex);
        }

        return $matched;
    }

    public static function extractRegex(string $route)
    {
        $path = '/' . ltrim(trim($route), '/');

        foreach (self::extractVariables($route) as $name => $expression) {
            $search = "{" . $name . "}";
            $replace = '(?P<' . $name . '>' . $expression . ')';
            $path = str_replace($search, $replace, $path);
        }

        return '#^' . $path . '$#';
    }

    public static function extractVariables(string $path)
    {
        $matches = [];

        preg_match_all('#\{(!)?(\w+)\}#', $path, $matches, PREG_PATTERN_ORDER);

        $variables = count($matches) > 0 ? array_pop($matches) : [];

        return array_reduce($variables, function ($carry, $param) {
            $carry[$param] = '[^/]++';
            return $carry;
        }, []);
    }

    public static function extractValuesFromVariables(string $path, string $regex)
    {
        $path = '/' . ltrim($path, '/');

        $pregMatch = preg_match($regex, $path, $matches);

        return array_filter(array_slice($matches, 1), fn($key) => is_string($key) && strlen($key) > 0, ARRAY_FILTER_USE_KEY);
    }
}
