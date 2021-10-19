<?php

namespace Core\Messages;

use DateTime;

abstract class Event
{
    public $timestamp;

    public function __construct()
    {
        $this->timestamp = new DateTime();
    }
}
