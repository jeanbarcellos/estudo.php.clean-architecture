<?php

namespace Tests\Unit\Framework\Routing;

class DemoController {

    public function index()
    {
        return [
            ['message' => 'Olá mundo'],
            ['message' => 'Olá mundo2']
        ];
    }

    public function show(int $id)
    {
        return [
            'message' => 'Olá mundo ID: ' . $id
        ];
    }

    public function insert()
    {
        return true;
    }

}