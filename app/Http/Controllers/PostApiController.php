<?php

namespace App\Http\Controllers;

use App\Services\PostService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostApiController extends Controller
{
    private PostService $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'header' => 'max:255',
            'text' => 'max:255',
            'tags' => 'max:255',
        ]);

        $request->validate([
            'picture' => 'image|max:1024',
        ]);

        $post = $this->postService->create($validated);

        if ($request->picture) {
            $this->postService->savePicture($post->id, $request->file('picture'));
        }

        return $post;
    }
}
