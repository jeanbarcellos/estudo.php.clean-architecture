<?php

namespace Tests\Unit\Core\Objects;

use DateTime;
use RuntimeException;
use Core\Objects\IOData;
use PHPUnit\Framework\TestCase;

class IODataTest extends TestCase
{
    private function getData(): array
    {
        return [
            'name' => 'Jean Barcellos',
            'email' => 'teste@teste.com.br',
            'createdAt' => new DateTime(),
            'comments' => [
                [
                    'title' => 'Text 01',
                    'text' => 'asdasdasdasdas',
                ],
                [
                    'title' => 'Text 02',
                    'text' => 'asdasdasdasdas',
                ],
            ],
        ];
    }

    private function getInstance(): IOData
    {
        return new IOData($this->getData());
    }

    public function test_newInstance_instance()
    {
        $actual = new IOData($this->getData());

        // Assert
        $this->assertInstanceOf(IOData::class, $actual);
    }

    public function test_getValues()
    {
        // Arrange
        $iodata = $this->getInstance();
        $data = $this->getData();

        // Act
        $actual = $iodata->getValues();

        // Assert
        $this->assertIsArray($actual);
        $this->assertEquals($data['name'], $actual['name']);
        $this->assertEquals($data['email'], $actual['email']);
    }

    public function test_hasValue()
    {
        // Arrange
        $iodata = $this->getInstance();
        $data = $this->getData();

        // Act
        $actual = $iodata->hasValue('email');

        // Assert
        $this->assertTrue($actual);
    }

    public function test_getValue()
    {
        // Arrange
        $iodata = $this->getInstance();
        $data = $this->getData();

        // Act
        $actual = $iodata->getValue('email');

        // Assert
        $this->assertEquals($data['email'], $actual);
    }

    public function test_exists()
    {
        // Arrange
        $iodata = $this->getInstance();
        $data = $this->getData();

        // Act
        $actual = $iodata->exists('email');

        // Assert
        $this->assertTrue($actual);
    }

    public function test_count()
    {
        // Arrange
        $iodata = $this->getInstance();
        $data = $this->getData();

        // Act
        $actual = $iodata->count();

        // Assert
        $this->assertSame(4, $actual);
    }

    public function test_toArray()
    {
        // Arrange
        $iodata = $this->getInstance();
        $data = $this->getData();

        // Act
        $actual = $iodata->toArray();

        // Assert
        $this->assertIsArray($actual);
        $this->assertEquals($data['name'], $actual['name']);
        $this->assertEquals($data['email'], $actual['email']);
    }
    public function test_magicGet()
    {
        // Arrange
        $input = $this->getInstance();
        $data = $this->getData();

        // Act && Assert
        $this->assertEquals($data['name'], $input->name);
        $this->assertEquals($data['email'], $input->email);
    }

    public function test_magicGet_throwException()
    {
        $this->expectException(RuntimeException::class);

        // Arrange
        $actual = $this->getInstance();

        // Act
        $actual->name2;
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
        $data = $this->getData();

        // Act && Assert
        $this->assertEquals($data['name'], $actual['name']);
        $this->assertEquals($data['email'], $actual['email']);
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

    public function test_create_instance()
    {
        $actual = IOData::create($this->getData());

        // Assert
        $this->assertInstanceOf(IOData::class, $actual);
    }
}
