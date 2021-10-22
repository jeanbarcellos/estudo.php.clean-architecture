<?php

namespace Framework;

class Router
{
    private $routes = [];

    private $method;

    private $path;

    public function __construct($method, $path)
    {
        $this->method = $method;
        $this->path = $path;
    }

    public function get(string $route, callable $action): self
    {
        $this->add('GET', $route, $action);
        return $this;
    }

    public function post(string $route, callable $action): self
    {
        $this->add('POST', $route, $action);
        return $this;
    }

    public function put(string $route, callable $action): self
    {
        $this->add('PUT', $route, $action);
        return $this;
    }

    public function patch(string $route, callable $action): self
    {
        $this->add('PATCH', $route, $action);
        return $this;
    }

    public function delete(string $route, callable $action): self
    {
        $this->add('DELETE', $route, $action);
        return $this;
    }

    public function add(string $method, string $route, callable $action): self
    {
        $this->routes[$method][$route] = $action;

        return $this;
    }

    public function handler()
    {
        if (empty($this->routes[$this->method])) {
            return false;
        }

        if (isset($this->routes[$this->method][$this->path])) {
            return $this->routes[$this->method][$this->path];
        }

        return false;
    }
}
