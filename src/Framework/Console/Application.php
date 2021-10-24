<?php

namespace Framework\Console;

use Framework\DI\Container;

class Application
{
    private static $container;

    private function __construct()
    {
    }

    public static function run(array $args = []): void
    {
        self::$container = $container = Container::getInstance();

        echo "\n";
        echo "Ainda não implementado!\n";
        echo "\n";
    }

}
