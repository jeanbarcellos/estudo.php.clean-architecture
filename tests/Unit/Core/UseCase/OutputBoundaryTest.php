<?php

namespace Tests\Unit\Framework;

// use App\UseCases\ModelOutputBoundary;
use PHPUnit\Framework\TestCase;
use RuntimeException;
use Tests\Unit\Core\UseCase\ModelOutputBoundary;

class ModelOutputBoundaryTest extends TestCase
{
    private $data = [
        'email' => 'jeanbarcellos@hotmail.com',
        'name' => 'Jean Barcellos',
    ];

    private function getInstance(): ModelOutputBoundary
    {
        return ModelOutputBoundary::create($this->data['name'], $this->data['email']);
    }

    public function test_create_newInstance_instance()
    {
        // Arrange && Act
        $output = ModelOutputBoundary::create($this->data['name'], $this->data['email']);

        // Assert
        $this->assertInstanceOf(ModelOutputBoundary::class, $output);
        $this->assertEquals($this->data['name'], $output->getName());
        $this->assertEquals($this->data['email'], $output->getEmail());
    }

    public function test_createFromSuccess_newInstance_instance()
    {
        // Arrange && Act
        $output = ModelOutputBoundary::createFromSuccess($this->data);

        // Assert
        $this->assertInstanceOf(ModelOutputBoundary::class, $output);
        $this->assertEquals($this->data['name'], $output->getName());
        $this->assertEquals($this->data['email'], $output->getEmail());
    }

    public function test_createFromFailure_newInstance_instance()
    {
        // Arrange
        $errors = [
            'Error 01',
            'Error 02'
        ];

        // Act
        $output = ModelOutputBoundary::createFromFailure($errors);

        // Assert
        $this->assertInstanceOf(ModelOutputBoundary::class, $output);
        $this->assertCount(2, $output->getValidationErrors());
        $this->assertSame($errors[0], $output->getValidationErrors()[0]);
    }

    public function test_magicCall()
    {
        // Arrange
        $output = $this->getInstance();

        // Act && Assert
        $this->assertEquals($this->data['name'], $output->getName());
        $this->assertEquals($this->data['email'], $output->getEmail());
    }

    public function test_magicCall_returnException()
    {
        $this->expectException(RuntimeException::class);

        // Arrange
        $output = $this->getInstance();

        // Act && Assert
        $output->getLastName();
    }

    public function test_magicGet()
    {
        // Arrange
        $output = $this->getInstance();

        // Act && Assert
        $this->assertEquals($this->data['name'], $output->name);
        $this->assertEquals($this->data['email'], $output->email);
    }

    public function test_magicGet_returnException()
    {
        $this->expectException(RuntimeException::class);

        // Arrange
        $output = $this->getInstance();

        // Act && Assert
        $eita = $output->lastName;
    }

    public function test_implementsArrayAccess_offsetExists()
    {
        // Arrange
        $actual = $this->getInstance();

        // Act && Assert
        $this->assertTrue(isset($actual['name']));
    }

    public function test_implementsArrayAccess_offsetGet()
    {
        // Arrange
        $actual = $this->getInstance();

        // Act && Assert
        $this->assertEquals($this->data['name'], $actual['name']);
        $this->assertEquals($this->data['email'], $actual['email']);
    }

    public function test_implementsArrayAccess_offsetSet()
    {
        $this->expectException(RuntimeException::class);

        // Arrange
        $actual = $this->getInstance();

        // Act
        $actual['name'] = 'teste';
    }

    public function test_implementsArrayAccess_offsetUnset()
    {
        $this->expectException(RuntimeException::class);

        // Arrange
        $actual = $this->getInstance();

        // Act
        unset($actual['name']);
    }

    public function test_create()
    {
        // Arrange
        $actual = ModelOutputBoundary::create($this->data['name'], $this->data['email']);

        // Act && Assert
        $this->assertEquals($this->data['name'], $actual['name']);
        $this->assertEquals($this->data['email'], $actual['email']);
    }

    public function test_toArray()
    {
        // Arrange
        $output = $this->getInstance();

        // Act
        $actual = $output->toArray();

        // Assert
        $this->assertIsArray($actual);
    }

    public function test_getValues()
    {
        // Arrange
        $output = $this->getInstance();

        // Act
        $actual = $output->getValues();

        // Assert
        $this->assertIsArray($actual);
        $this->assertEquals($this->data['name'], $actual['name']);
        $this->assertEquals($this->data['email'], $actual['email']);
    }

    public function test_getValue()
    {
        // Arrange
        $output = $this->getInstance();

        // Act
        $actual = $output->getValue('email');

        // Assert
        $this->assertEquals($this->data['email'], $actual);
    }

}
