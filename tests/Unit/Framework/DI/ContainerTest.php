<?php

namespace Tests\Unit\Framework\DI;

use Framework\DI\Container;
use PHPUnit\Framework\TestCase;
use RuntimeException;

class Category
{

}

class Comment
{
    private $text;

    public function __construct(string $text)
    {
        $this->text = $text;
    }
}

class Post
{
    private $category;
    private $name;

    public function __construct(Category $category, string $name = 'Default')
    {
        $this->category = $category;
        $this->name = $name;
    }
}

class EntityNotInstanciable
{

    private function __construct()
    {
    }
}

class EntityWithContructWithParamOptional
{
    function __construct(?Post $post = null)
    {
    }
}

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

    private function getInstanceWithObjects(): Container
    {
        $container = new Container();
        $container->set(RepositoryInterface::class, Repository::class, true);
        $container->instance('config', 123);

        return $container;
    }

    public function test_construct_newInstance_instance()
    {
        // Arrange && Act
        $actual = new Container();

        // Assert
        $this->assertInstanceOf(Container::class, $actual);
    }

    public function test_getInstance_instance()
    {
        // Arrange && Act
        $actual = Container::getInstance();

        // Assert
        $this->assertInstanceOf(Container::class, $actual);
    }

    public function test_set_inputIdAndOperation()
    {
        // Arrange
        $container = $this->getInstance();

        // Act
        $container->set(RepositoryInterface::class, Repository::class);

        // Assert
        $this->assertInstanceOf(RepositoryInterface::class, $container->get(RepositoryInterface::class));
    }

    public function test_set_inputOnlyId()
    {
        // Arrange
        $container = $this->getInstance();

        // Act
        $container->set(Repository::class);

        // Assert
        $this->assertInstanceOf(Repository::class, $container->get(Repository::class));
    }

    public function test_set_inputIdAndOperationAndSinleton()
    {
        // Arrange
        $container = $this->getInstance();

        // Act
        $container->set(RepositoryInterface::class, Repository::class, true);

        // Assert
        $this->assertInstanceOf(RepositoryInterface::class, $container->get(RepositoryInterface::class));
    }

    public function test_singleton()
    {
        // Arrange
        $container = $this->getInstance();

        // Act
        $container->singleton(RepositoryInterface::class, Repository::class);

        // Assert
        $this->assertInstanceOf(RepositoryInterface::class, $container->get(RepositoryInterface::class));
    }

    public function test_isSingleton_returnTrue()
    {
        // Arrange
        $container = $this->getInstance();
        $container->singleton(RepositoryInterface::class, Repository::class);

        // Act
        $actual = $container->isSingleton(RepositoryInterface::class);

        // Assert
        $this->assertTrue($actual);
    }

    public function test_isSingleton_returnFalse()
    {
        // Arrange
        $container = $this->getInstance();
        $container->set(RepositoryInterface::class, Repository::class);

        // Act
        $actual = $container->isSingleton(RepositoryInterface::class);

        // Assert
        $this->assertFalse($actual);
    }

    public function test_instance()
    {
        // Arrange
        $container = $this->getInstance();

        // Act
        $container->instance('config', 123);

        // Assert
        $this->assertSame(123, $container->get('config'));
    }

    public function test_has()
    {
        // Arrange
        $container = $this->getInstance();
        $container->instance('config', 123);

        // Act
        $actual = $container->has('config');

        // Assert
        $this->assertTrue($actual);
    }

    /**
     * Obter interface
     */
    public function test_get_resolveInterface_returnIstance()
    {
        // Arrange
        $container = $this->getInstanceWithObjects();

        // Act
        $actual = $container->get(RepositoryInterface::class);

        // Act
        $this->assertInstanceOf(RepositoryInterface::class, $actual);
    }

    /**
     * Obter classe concreta
     */
    public function test_get_resolveClass_returnIstance()
    {
        // Arrange
        $container = $this->getInstanceWithObjects();

        // Act
        $actual = $container->get(Post::class);

        // Act
        $this->assertInstanceOf(Post::class, $actual);
    }

    /**
     * Obter classse concreto com construtor com parametro opcional
     */
    public function test_get_resolveClassWithContructWithParamOptional_returnIstance()
    {
        // Arrange
        $container = $this->getInstanceWithObjects();

        // Act
        $actual = $container->get(EntityWithContructWithParamOptional::class);

        // Act
        $this->assertInstanceOf(EntityWithContructWithParamOptional::class, $actual);
    }

    /**
     * Tentar obter classe não intanciável não pré definida
     * Deve retornar uma exception
     */
    public function test_get_resolveClassNotInstanciable_throwException()
    {
        $this->expectException(RuntimeException::class);

        // Arrange
        $container = $this->getInstanceWithObjects();

        // Act
        $actual = $container->get(EntityNotInstanciable::class);
    }

    /**
     * Tentar obter classe não intanciável pré definida
     * Deve retornar uma exception
     */
    public function test_get_resolveClassNotInstanciable2_throwException()
    {
        $this->expectException(RuntimeException::class);

        // Arrange
        $container = $this->getInstanceWithObjects();
        $container->set(EntityNotInstanciable::class);

        // Act
        $actual = $container->get(EntityNotInstanciable::class);
    }

    /**
     * Obter classe com parametros primitivos mas sem default
     */
    public function test_get_resolveClassWithParametersContructWithoutDefault_throwException()
    {
        $this->expectException(RuntimeException::class);

        // Arrange
        $container = $this->getInstanceWithObjects();

        // Act
        $actual = $container->get(Comment::class);
    }

    public function test_get_trhowException()
    {
        $this->expectException(RuntimeException::class);

        // Arrange
        $container = $this->getInstanceWithObjects();

        // Act
        $actual = $container->get('adasdasdas');
    }

    public function test_staticGet_returnIstance()
    {
        // Act
        $actual = Container::staticGet(Post::class);

        // Act
        $this->assertInstanceOf(Post::class, $actual);
    }

}
