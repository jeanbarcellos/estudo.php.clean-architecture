<?php

namespace Tests\Unit\Framework\Http;

use Framework\Http\Request;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class RequestTest extends TestCase
{
    private function createRequest($method, $path, $query = [], $body = [], $files = [], $content = null): Request
    {
        $server = $_SERVER;
        $server['REQUEST_METHOD'] = $method;
        $server['REQUEST_URI'] = $path;
        $server['CONTENT_TYPE'] = 'application/json';

        return new Request($query, $body, [], $_COOKIE, $files, $server, $content);
    }

    private function createRequestWithFiles($method, $path): Request
    {
        $stub01 = $this->createMock(UploadedFile::class);
        $stub01->method('getClientOriginalName')->willReturn('teste01.jpg');

        $stub02 = $this->createMock(UploadedFile::class);
        $stub02->method('getClientOriginalName')->willReturn('teste02.jpg');

        // Arrange
        $files = [
            'image01' => $stub01,
            'image02' => $stub02,
        ];

        return $this->createRequest($method, $path, [], [], $files);
    }

    private function createRequestBodyJson($method, $path, $content = '')
    {
        $request = $this->createRequest($method, $path, [], [], [], $content);
        $request->headers->set('Content-Type', 'application/json');

        return $request;
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

    public function test_file_ShouldReturnAllValues()
    {
        // Arrange
        $request = $this->createRequestWithFiles('POST', '/test');

        // Act
        $actual = $request->file();

        // Assert
        $this->assertEquals('teste01.jpg', $actual['image01']->getClientOriginalName());
        $this->assertEquals('teste02.jpg', $actual['image02']->getClientOriginalName());
    }

    public function test_file_ShouldReturnValue()
    {
        // Arrange
        $request = $this->createRequestWithFiles('POST', '/test');

        // Act
        $actual = $request->file('image01');

        // Assert
        $this->assertEquals('teste01.jpg', $actual->getClientOriginalName());
    }

    public function test_file_ShouldReturnDefaultValue()
    {
        // Arrange
        $request = $this->createRequestWithFiles('POST', '/test');
        $default = 'jeanbarcellos';

        // Act
        $actual = $request->file('image03', $default);

        // Assert
        $this->assertEquals($default, $actual);
    }
}
