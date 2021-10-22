<?php

namespace Framework\Http;

use Framework\DI\Container;
use Framework\Router;

class Application
{
    private static $container;

    private function __construct()
    {
    }

    public static function run(array $args = []): void
    {
        self::$container = $container = Container::getInstance();

        // Request
        $method = $_SERVER['REQUEST_METHOD'];
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        $request = [$method, $path];

        $router = static::$container->get(Router::class);

        $routes = self::getConfig('routes');

        $routes($router);

        $result = $router->handler($request);

        dump($result);
    }

    private static function getConfig(string $config)
    {
        $basePath = static::$container->get('path');

        return require join(DIRECTORY_SEPARATOR, [rtrim($basePath, '\/'), 'configs', $config . '.php']);
    }
}
