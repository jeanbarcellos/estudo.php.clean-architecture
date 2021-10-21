<?php

namespace App\Adapters\Http\Controllers;

use App\Domain\Entities\Category;
use App\Domain\Entities\Post;

class PostController
{
    public function test(Post $post, Category $category): array
    {
        return [
            'teste' => 'funcionou',
        ];
    }
}
