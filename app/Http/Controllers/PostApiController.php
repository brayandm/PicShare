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

    public function index()
    {
        return $this->postService->getAll(5);
    }

    public function get($id)
    {
        return $this->postService->get($id);
    }

    public function delete($id)
    {
        return $this->postService->delete($id);
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

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'header' => 'max:255',
            'text' => 'max:255',
            'tags' => 'max:255',
        ]);

        $request->validate([
            'picture' => 'image|max:1024',
        ]);

        $post = $this->postService->update($id, $validated);

        if ($request->picture) {
            $this->postService->savePicture($post->id, $request->file('picture'));
        }

        return $post;
    }
}
