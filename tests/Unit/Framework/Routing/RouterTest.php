<?php

namespace Tests\Unit\Framework\Routing;

use Framework\DI\Container;
use Framework\DI\DependencyResolver;
use Framework\Http\Exceptions\NotFoundHttpException;
use Framework\Http\JsonResponse;
use Framework\Http\Request;
use Framework\Http\Response;
use Framework\Routing\Router;
use PHPUnit\Framework\TestCase;
use Tests\Unit\Framework\Routing\DemoController;

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

    private function createRequest($method, $path, $query = [], $body = [])
    {
        $server = $_SERVER;
        $server['REQUEST_METHOD'] = $method;
        $server['REQUEST_URI'] = $path;

        return new Request($query, $body, [], $_COOKIE, $_FILES, $server);
    }

    public function test_contruct()
    {
        // Arrange
        $container = $this->getContainer()->get(Container::class);
        $dependencyResolve = $this->getContainer()->get(DependencyResolver::class);

        // Act
        $actual = new Router($container, $dependencyResolve);

        // Assert
        $this->assertInstanceOf(Router::class, $actual);
    }

    public function test_getRoutes()
    {
        // Assert
        $router = $this->getRouter();

        // Act
        $actual = $router->get('/test', fn() => true);

        // Assert
        $this->assertCount(1, $router->getRoutes());
    }

    public function test_get()
    {
        // Arrange
        $router = $this->getRouter();
        $route = '/test';
        $action = fn() => true;

        // Act
        $actual = $router->get($route, $action);

        // Assert
        $this->assertInstanceOf(Router::class, $actual);
        $this->assertCount(1, $router->getRoutes());
    }

    public function test_post()
    {
        // Arrange
        $router = $this->getRouter();
        $route = '/test';
        $action = fn() => true;

        // Act
        $actual = $router->post($route, $action);

        // Assert
        $this->assertInstanceOf(Router::class, $actual);
        $this->assertCount(1, $router->getRoutes());
    }

    public function test_put()
    {
        // Arrange
        $router = $this->getRouter();
        $route = '/test';
        $action = fn() => true;

        // Act
        $actual = $router->put($route, $action);

        // Assert
        $this->assertInstanceOf(Router::class, $actual);
        $this->assertCount(1, $router->getRoutes());
    }

    public function test_patch()
    {
        // Arrange
        $router = $this->getRouter();
        $route = '/test';
        $action = fn() => true;

        // Act
        $actual = $router->patch($route, $action);

        // Assert
        $this->assertInstanceOf(Router::class, $actual);
        $this->assertCount(1, $router->getRoutes());
    }

    public function test_delete()
    {
        // Arrange
        $router = $this->getRouter();
        $route = '/test';
        $action = fn() => true;

        // Act
        $actual = $router->delete($route, $action);

        // Assert
        $this->assertInstanceOf(Router::class, $actual);
        $this->assertCount(1, $router->getRoutes());
    }

    public function test_handle_EsseMetodoDescreveOQueDeveAcontecer()
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

    public function test_handle_closureTypeAction_ShouldReturnTrue()
    {
        $method = 'GET';
        $path = 'ola-mundo';

        $router = $this->getRouter();

        $router->add($method, $path, fn() => true);

        $request = $this->createRequest($method, $path);

        // Act
        $result = $router->handle($request);
        $actual = $result->getContent();

        // Assert
        $this->assertEquals(true, $actual);
        $this->assertCount(0, $router->getParameters());
    }

    public function test_handle_closureTypeAction_ShouldThrowException()
    {
        $this->expectException(NotFoundHttpException::class);

        $method = 'GET';
        $path = 'outra-mundo';

        $router = $this->getRouter();

        // esta rota não é a que está sendo usada
        $router->add($method, $path, fn() => true);

        $request = $this->createRequest($method, 'outra-url');

        $result = $router->handle($request);
    }

    public function test_handle_arrayTypeAction_ShouldReturnJsonResponseAndCode200()
    {
        $method = 'GET';
        $path = 'ola-mundo';

        $router = $this->getRouter();

        $router->add($method, $path, [DemoController::class, 'index']);

        $request = $this->createRequest($method, $path);

        // Act
        $actual = $router->handle($request);

        // Assert
        $this->assertInstanceOf(JsonResponse::class, $actual);
        $this->assertEquals(Response::HTTP_OK, $actual->getStatusCode());
    }

    public function test_handle_stringTypeAction_ShouldReturnJsonResponseAndCode200()
    {
        $method = 'GET';
        $path = 'ola-mundo';

        $router = $this->getRouter();

        $router->add($method, $path, DemoController::class);

        $request = $this->createRequest($method, $path);

        // Act
        $actual = $router->handle($request);

        // Assert
        $this->assertInstanceOf(JsonResponse::class, $actual);
        $this->assertEquals(Response::HTTP_OK, $actual->getStatusCode());
    }

    public function test_handle_arrayTypeActionAndParameters_ShouldReturnJsonResponseAndCode200()
    {
        $method = 'GET';
        $path = 'show/{id}';
        $uri = 'show/999';
        $query = ['id' => 999];

        $router = $this->getRouter();

        $router->add($method, $path, [DemoController::class, 'show']);

        $request = $this->createRequest($method, $uri, $query);

        // Act
        $actual = $router->handle($request);

        // Assert
        $this->assertInstanceOf(JsonResponse::class, $actual);
        $this->assertEquals(Response::HTTP_OK, $actual->getStatusCode());
    }

    public function test_handle_intTypeAction_ShouldReturnResponseAndCode200()
    {
        $method = 'GET';
        $path = 'ola-mundo';

        $router = $this->getRouter();

        $router->add($method, $path, 123456);

        $request = $this->createRequest($method, $path);

        // Act
        $actual = $router->handle($request);

        // Assert
        $this->assertInstanceOf(Response::class, $actual);
        $this->assertEquals(Response::HTTP_OK, $actual->getStatusCode());
    }

}
