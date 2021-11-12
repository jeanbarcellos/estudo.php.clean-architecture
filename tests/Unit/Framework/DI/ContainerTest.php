<?php

namespace Tests\Unit\Framework\DI;

use Framework\DI\Container;
use PHPUnit\Framework\TestCase;

interface RepositoryInterface
{
    public function findAll(): array;
}

class Repository implements RepositoryInterface
{
    public function findAll(): array
    {
        return [
            ['id' => 1, 'name' => 'First Name'],
            ['id' => 2, 'name' => 'Second Name'],
        ];
    }
}

class ContainerTest extends TestCase
{
    private function getInstance(): Container
    {
        return new Container();
    }

    public function test_construct_newInstance_instance()
    {
        // Arrange && Act
        $actual = new Container();

        // Assert
        $this->assertInstanceOf(Container::class, $actual);
    }

    public function test_set_get()
    {
        // Arrange && Act
        $container = $this->getInstance();

        $container->set(RepositoryInterface::class, Repository::class);

        $actual = $container->get(RepositoryInterface::class);

        // Assert
        $this->assertInstanceOf(RepositoryInterface::class, $actual);
    }

}
