<?php

namespace Framework\Http;

use Framework\DI\Container;
use Framework\Routing\Router;
use Framework\Http\Request;

class Application
{
    private static $container;

    private function __construct()
    {
    }

    public static function run(array $args = []): void
    {
        self::$container = $container = Container::getInstance();

        $router = static::$container->get(Router::class);

        $routes = self::getConfig('routes');

        $routes($router);

        $request = Request::capture();

        $response = $router->handler($request);

        $response->send();
    }

    private static function getConfig(string $config)
    {
        $basePath = static::$container->get('path');

        return require join(DIRECTORY_SEPARATOR, [rtrim($basePath, '\/'), 'configs', $config . '.php']);
    }
}
