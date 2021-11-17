<?php

namespace App\Domain\Entities;

use Core\Domain\Entity;
use Core\Utils\Guid;
use DateTime;
use DateTimeInterface;

class User extends Entity
{
    protected string $name;
    protected string $email;
    protected DateTimeInterface $createdAt;

    public function __construct(string $name, string $email)
    {
        $this->id = Guid::create();
        $this->name = $name;
        $this->email = $email;
        $this->createdAt = new DateTime();
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getCreatedAt(): DateTimeInterface
    {
        return $this->createdAt;
    }
}
