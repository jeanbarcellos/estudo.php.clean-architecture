<?php

namespace Core\Iterator;

abstract class IOData
{
    public $data;

    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    public function getData()
    {
        return $this->data;
    }

    public static function create(array $data = [])
    {
        return new static($data);
    }
}
