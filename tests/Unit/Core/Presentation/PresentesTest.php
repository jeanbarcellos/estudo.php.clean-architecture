<?php

namespace Tests\Unit\Core\Presentation;

use Core\Domain\Entity;
use Core\Presentation\Presenter;
use Core\UseCase\OutputBoundary;
use DateTime;
use DateTimeInterface;
use Framework\Http\JsonResponse;
use Framework\Http\Response;
use PHPUnit\Framework\TestCase;

class UserEntity extends Entity
{
    protected $name;
    protected $email;

    public function __construct(string $name, string $email)
    {
        $this->name = $name;
        $this->email = $email;
    }
}

class TestOutputBondary extends OutputBoundary
{
    protected $name;
    protected $email;
    protected $createdAt;
    protected $comments;

    public static function create(string $name, string $email, DateTimeInterface $createdAt, $comments = []): self
    {
        $output = new static();
        $output->name = $name;
        $output->email = $email;
        $output->createdAt = $createdAt;
        $output->comments = $comments;
    }
}

class PresenterTest extends TestCase
{
    private function getData()
    {
        return [
            'name' => 'Jean Barcellos',
            'email' => 'teste@teste.com.br',
            'createdAt' => new DateTime(),
            'comments' => [
                [
                    'title' => 'Text 01',
                    'text' => 'asdasdasdasdas',
                    'user' => new UserEntity('Name A', 'name@teste.com'),
                ],
                [
                    'title' => 'Text 02',
                    'text' => 'asdasdasdasdas',
                    'user' => new UserEntity('Name B', 'name@teste.com'),
                ],
            ],
        ];
    }

    public function test_createFromSuccess()
    {
        // Arrange
        $outputBondary = TestOutputBondary::createFromSuccess($this->getData());

        $presenter = new Presenter();

        // Act
        $actual = $presenter->handle($outputBondary);

        // Assert
        $this->assertInstanceOf(JsonResponse::class, $actual);
        $this->assertEquals(Response::HTTP_OK, $actual->getStatusCode());
    }

    public function test_createFromFailure()
    {
        // Arrange
        $outputBondary = TestOutputBondary::createFromFailure([
            'Error 1',
            'Error 2',
        ]);

        $presenter = new Presenter();

        // Act
        $actual = $presenter->handle($outputBondary);

        // Assert
        $this->assertInstanceOf(JsonResponse::class, $actual);
        $this->assertEquals(Response::HTTP_BAD_REQUEST, $actual->getStatusCode());
    }

}
