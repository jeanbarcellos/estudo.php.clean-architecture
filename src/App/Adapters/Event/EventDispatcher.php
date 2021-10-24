<?php

namespace App\Adapters\Event;

use Core\Communication\EventDispatcherInterface;
use Core\Messages\Event;

class EventDispatcher implements EventDispatcherInterface
{
    public function dispatch(Event $event): void
    {
        // TO-DO code...
    }
}
