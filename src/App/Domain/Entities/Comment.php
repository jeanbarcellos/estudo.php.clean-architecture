<?php

namespace App\Domain\Entities;

use Core\Domain\Entity;

class Category extends Entity
{
    protected $post;

    protected $author;

    protected $description;
}
