<?php

namespace Tests\Unit\Core\Domain;

use PHPUnit\Framework\TestCase;
use Tests\Unit\Core\Domain\Demo;

class EntityTest extends TestCase
{
    public function test_consruct()
    {
        // Arrange && Act
        $entity = new Demo('123', 'Jean', 'teste@teste.com');

        // Assert
        $this->assertInstanceOf(Demo::class, $entity);
    }

    public function test_getId()
    {
        // Arrange
        $entity = new Demo('123', 'Jean', 'teste@teste.com');

        // Act
        $actual = $entity->getId();

        // Assert
        $this->assertEquals('123', $actual);
    }

    public function test_toArray()
    {
        // Arrange
        $entity = new Demo('123', 'Jean', 'teste@teste.com');

        // Act
        $actual = $entity->toArray();

        // Assert
        $this->assertCount(3, $actual);
    }
}
