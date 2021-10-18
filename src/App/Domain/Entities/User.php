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

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getCreatedAt(): DateTimeInterface
    {
        return $this->createdAt;
    }
}
