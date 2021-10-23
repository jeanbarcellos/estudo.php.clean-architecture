<?php

namespace Tests\Unit\Framework;

use Framework\DI\Container;
use Framework\Http\Request;
use Framework\Routing\Router;
use PHPUnit\Framework\TestCase;
use Framework\Http\Exceptions\NotFoundHttpException;

class RouterTest extends TestCase
{
    private function getContainer(): Container
    {
        return Container::getInstance();
    }

    private function getRouter(): Router
    {
        return $this->getContainer()->get(Router::class);
    }

    private function createRequest($method, $path)
    {
        $server = $_SERVER;
        $server['REQUEST_METHOD'] = $method;
        $server['REQUEST_URI'] = $path;

        return new Request($_GET, $_POST, [], $_COOKIE, $_FILES, $server);
    }

    /**
     * Todo método de teste precisa iniciar com test e
     * descrever o que ele está testando, como
     * testEsseMetodoDescreveOQueDeveAcontecer()
     *
     * @return void
     */
    public function testEsseMetodoDescreveOQueDeveAcontecer()
    {
        // Arrange
        $router = $this->getRouter();
        $expected = false;

        $request = $this->createRequest('GET', 'ola-mundo');

        // Action
        $actual = $router->handle($request);

        // Assert
        $this->assertEquals($expected, $actual);
    }

    public function testVerificaSeEncontraRota()
    {
        $method = 'GET';
        $path = 'ola-mundo';

        $router = $this->getRouter();

        $router->add($method, $path, function () {
            return true;
        });

        $request = $this->createRequest($method, $path);

        // Act
        $result = $router->handle($request);
        $actual = $result->getContent();

        // Assert
        $this->assertEquals(true, $actual);
    }

    public function testVerificaNaoSeEncontraRota()
    {
        $this->expectException(NotFoundHttpException::class);

        $method = 'GET';
        $path = 'outra-mundo';

        $router = $this->getRouter();

        // esta rota não é a que está sendo usada
        $router->add($method, $path, function () {
            return true;
        });

        $request = $this->createRequest($method, 'outra-url');

        $result = $router->handle($request);
    }

}
