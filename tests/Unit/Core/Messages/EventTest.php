<?php

namespace Tests\Unit\Core\Messages;

use Core\Messages\Event;
use PHPUnit\Framework\TestCase;

class UserCreatedEvent extends Event
{
    public $name;

    public function __construct(string $name)
    {
        $this->name = $name;

        parent::__construct();
    }

}

class EventTest extends TestCase
{
    public function test_newInstance_instance()
    {
        // Arange
        $name = 'Jean Barcellos';

        //Act
        $event = new UserCreatedEvent($name);

        // Assert
        $this->assertInstanceOf(Event::class, $event);
        $this->assertSame($name, $event->name);
    }

    public function test_create_instance()
    {
        // Arange
        $data = ['name' => 'Jean Barcellos'];

        //Act
        $event = UserCreatedEvent::create($data);

        // Assert
        $this->assertInstanceOf(Event::class, $event);
        $this->assertSame($data['name'], $event->name);
    }
}
