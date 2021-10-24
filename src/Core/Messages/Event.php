<?php

namespace Core\Messages;

use Core\Utils\ObjectUtil;
use DateTime;

abstract class Event
{
    public $timestamp;

    public function __construct()
    {
        $this->timestamp = new DateTime();
    }

    public static function create(array $data): self
    {
        return ObjectUtil::createFromArray(static::class, $data);
    }
}
