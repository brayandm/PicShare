<?php

namespace App\Http\Controllers;

use App\Services\PostService;

class PostController extends Controller
{
    private PostService $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function getPosts()
    {
        return view('dashboard', ['posts' => $this->postService->getPosts()]);
    }
}
