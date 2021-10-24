<?php

namespace Core\Communication;

use Core\Messages\Event;

interface EventDispatcherInterface
{
    public function dispatch(Event $event): void;
}
