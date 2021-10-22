<?php

require __DIR__ . '/vendor/autoload.php';

$container = new Framework\DI\Container();

$basePath = __DIR__ . DIRECTORY_SEPARATOR;

$container->instance('path', $basePath);

$containerConfig = require join(DIRECTORY_SEPARATOR, [rtrim($basePath, '\/'), 'configs', 'container.php']);

$containerConfig($container);
