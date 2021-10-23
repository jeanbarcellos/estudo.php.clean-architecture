<?php

namespace App\Adapters\Http\Controllers;

class HomeController
{
    public function index()
    {
        return 'Olá mundo';
    }

    public function show(int $id)
    {
        return [
            'teste' => 'Olá mundo ID: ' . $id,
        ];
    }
}
