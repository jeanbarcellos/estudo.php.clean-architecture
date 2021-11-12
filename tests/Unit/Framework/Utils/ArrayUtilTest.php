<?php

namespace Tests\Unit\Framework\Utils;

use Framework\Utils\ArrayUtil;
use PHPUnit\Framework\TestCase;

class ArrayUtilTest extends TestCase
{
    public function test_exists_ShouldReturnTrue()
    {
        // Arrange
        $data = [
            'key1' => 'value1',
        ];
        $key = 'key1';

        // Act
        $actual = ArrayUtil::exists($data, $key);

        // Assert
        $this->assertTrue($actual);
    }

    public function test_exists_ShouldReturnFalse()
    {
        // Arrange
        $data = [
            'key1' => 'value1',
        ];
        $key = 'key2';

        // Act
        $actual = ArrayUtil::exists($data, $key);

        // Assert
        $this->assertFalse($actual);
    }

    public function test_set_ShouldAddOneValue()
    {
        // Arrange
        $data = [
            'key1' => 'value1',
        ];
        $key = 'key2';
        $value = 'value2';

        // Act
        ArrayUtil::set($data, $key, $value);

        // Assert
        $this->assertCount(2, $data);
        $this->assertEquals($data[$key], $value);
    }

    public function test_get_ShouldReturnValue()
    {
        // Arrange
        $data = [
            'key' => 'value',
        ];

        // Act
        $actual = ArrayUtil::get($data, 'key');

        // Assert
        $this->assertEquals('value', $actual);
    }

    public function test_get_ShouldReturnValueDefault()
    {
        // Arrange
        $data = [
            'key' => 'value',
        ];

        // Act
        $actual = ArrayUtil::get($data, 'key2', 123);

        // Assert
        $this->assertEquals(123, $actual);
    }
}
