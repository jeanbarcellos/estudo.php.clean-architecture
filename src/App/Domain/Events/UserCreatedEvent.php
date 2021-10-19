<?php

namespace App\Domain\Events;

use Core\Messages\Event;

class UserCreatedEvent extends Event
{
    public $id;
    public $name;
    public $email;

    public function __construct(string $id, string $name, string $email)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;

        parent::__construct();
    }
}
