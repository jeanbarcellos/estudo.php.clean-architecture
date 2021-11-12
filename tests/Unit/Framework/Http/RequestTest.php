<?php

namespace Tests\Unit\Framework\Http;

use Framework\Http\Request;
use PHPUnit\Framework\TestCase;

class RequestTest extends TestCase
{
    private function createRequest($method, $path, $query = [], $body = [])
    {
        $server = $_SERVER;
        $server['REQUEST_METHOD'] = $method;
        $server['REQUEST_URI'] = $path;

        return new Request($query, $body, [], $_COOKIE, $_FILES, $server);
    }

    public function test_capture()
    {
        // Arrange && Act
        $actual = Request::capture();

        // Assert
        $this->assertInstanceOf(Request::class, $actual);
    }

    public function test_body_ShouldReturnAllValues()
    {
        // Arrange
        $body = [
            'name' => 'Jean Barcellos',
            'email' => 'teste@teste.com',
        ];
        $request = $this->createRequest('POST', '/test', [], $body);

        // Act
        $actual = $request->body();

        // Assert
        $this->assertEquals($body['name'], $actual['name']);
        $this->assertEquals($body['email'], $actual['email']);
    }

    public function test_body_ShouldReturnValue()
    {
        // Arrange
        $body = [
            'name' => 'Jean Barcellos',
            'email' => 'teste@teste.com',
        ];
        $request = $this->createRequest('POST', '/test', [], $body);

        // Act
        $actual = $request->body('name');

        // Assert
        $this->assertEquals($body['name'], $actual);
    }

    public function test_body_ShouldReturnDefaultValue()
    {
        // Arrange
        $body = [
            'name' => 'Jean Barcellos',
            'email' => 'teste@teste.com',
        ];
        $request = $this->createRequest('POST', '/test', [], $body);
        $default = 'jeanbarcellos';


        // Act
        $actual = $request->body('login', $default);

        // Assert
        $this->assertEquals($default, $actual);
    }

    public function test_query_ShouldReturnAllValues()
    {
        // Arrange
        $query = [
            'name' => 'Jean Barcellos',
            'email' => 'teste@teste.com',
        ];
        $request = $this->createRequest('POST', '/test', $query);

        // Act
        $actual = $request->query();

        // Assert
        $this->assertEquals($query['name'], $actual['name']);
        $this->assertEquals($query['email'], $actual['email']);
    }

    public function test_query_ShouldReturnValue()
    {
        // Arrange
        $query = [
            'name' => 'Jean Barcellos',
            'email' => 'teste@teste.com',
        ];
        $request = $this->createRequest('POST', '/test', $query);

        // Act
        $actual = $request->query('name');

        // Assert
        $this->assertEquals($query['name'], $actual);
    }

    public function test_query_ShouldReturnDefaultValue()
    {
        // Arrange
        $query = [
            'name' => 'Jean Barcellos',
            'email' => 'teste@teste.com',
        ];
        $request = $this->createRequest('POST', '/test', $query);
        $default = 'jeanbarcellos';


        // Act
        $actual = $request->query('login', $default);

        // Assert
        $this->assertEquals($default, $actual);
    }
}
