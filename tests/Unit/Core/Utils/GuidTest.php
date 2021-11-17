<?php

namespace Tests\Unit\Core\Utils;

use Core\Utils\Guid;
use PHPUnit\Framework\TestCase;

class GuidTest extends TestCase
{
    public function test_create()
    {
        // Arrange && Act
        $actual = Guid::create();

        // Assert
        $this->assertSame(36, strlen($actual));
    }

}
