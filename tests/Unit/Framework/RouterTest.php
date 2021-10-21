<?php

namespace Tests\Unit\Framework;

use Framework\Router;
use PHPUnit\Framework\TestCase;

class RouterTest extends TestCase
{
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
        $router = new Router();
        $expected = true;

        // Action
        $actual = $router->handler();

        // Assert
        $this->assertEquals($expected, $actual);
    }
}
