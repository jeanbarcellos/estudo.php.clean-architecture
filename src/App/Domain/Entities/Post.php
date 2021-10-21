<?php

namespace App\Domain\Entities;

use Core\Domain\Entity;

class Post extends Entity
{
    protected $category;

    protected $title;

    protected $subtitle;

    protected $text;

    protected $author;

    protected $comments = [];
}
