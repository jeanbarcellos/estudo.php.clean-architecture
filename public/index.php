<?php

use App\Domain\Entities\User;

require __DIR__ . '/../bootstrap.php';

$user = new User('Jean Barcellos', 'jeanbarcellos@hotmail.com');

var_dump($user);