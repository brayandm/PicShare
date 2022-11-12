<?php

namespace App\Services;

use App\Models\Post;

class PostService
{
    public function getPosts()
    {
        return Post::all();
    }
}
