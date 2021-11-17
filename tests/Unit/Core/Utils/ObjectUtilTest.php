<?php

namespace Tests\Unit\Core\Utils;

use Core\Utils\ObjectUtil;
use PHPUnit\Framework\TestCase;

class ObjectTest
{

    public function __construct(int $id = 1)
    {

    }
}

class ObjectUtilTest extends TestCase
{
    public function test_createFromArray()
    {
        // Arrange && Act
        $actual = ObjectUtil::createFromArray(ObjectTest::class, []);

        // Assert
        $this->assertInstanceOf(ObjectTest::class, $actual);
    }

    public function test_isGetterMethod()
    {
        // Arrange && Act
        $actual = ObjectUtil::isGetterMethod('getName');

        // Assert
        $this->assertTrue($actual);
    }

    public function test_isSetterMethod()
    {
        // Arrange && Act
        $actual = ObjectUtil::isSetterMethod('setName');

        // Assert
        $this->assertTrue($actual);
    }

    public function test_getPropertyNameFromMethodName()
    {
        // Arrange
        $name = 'getName';
        $suffix = 'get';
        $expected = 'name';

        // Act
        $actual = ObjectUtil::getPropertyNameFromMethodName($name, $suffix);

        // Assert
        $this->assertSame($expected, $actual);
    }

    public function test_getPropertyNameFromGetterMethodName()
    {
        // Arrange
        $name = 'getName';
        $expected = 'name';

        // Act
        $actual = ObjectUtil::getPropertyNameFromGetterMethodName($name);

        // Assert
        $this->assertSame($expected, $actual);
    }

    public function test_getPropertyNameFromSetterMethodName()
    {
        // Arrange
        $name = 'setName';
        $expected = 'name';

        // Act
        $actual = ObjectUtil::getPropertyNameFromSetterMethodName($name);

        // Assert
        $this->assertSame($expected, $actual);
    }

    public function test_getMethodNameFromPropertyName()
    {
        // Arrange
        $name = 'name';
        $suffix = 'get';
        $expected = 'getName';

        // Act
        $actual = ObjectUtil::getMethodNameFromPropertyName($name, $suffix);

        // Assert
        $this->assertSame($expected, $actual);
    }

    public function test_getGetterMethodNameFromPropertyName()
    {
        // Arrange
        $name = 'name';
        $expected = 'getName';

        // Act
        $actual = ObjectUtil::getGetterMethodNameFromPropertyName($name);

        // Assert
        $this->assertSame($expected, $actual);
    }

    public function test_getSetterMethodNameFromPropertyName()
    {
        // Arrange
        $name = 'name';
        $expected = 'setName';

        // Act
        $actual = ObjectUtil::getSetterMethodNameFromPropertyName($name);

        // Assert
        $this->assertSame($expected, $actual);
    }

}
