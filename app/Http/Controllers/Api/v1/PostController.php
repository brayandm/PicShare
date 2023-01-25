<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Services\PostService;
use Illuminate\Http\Request;

class PostController extends Controller
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

    public function store(PostRequest $request)
    {
        $data = [
            'header' => $request->header,
            'text' => $request->text,
            'tags' => $request->tags,
        ];

        $post = $this->postService->create($data);

        if ($request->picture) {
            $this->postService->savePicture($post->id, $request->file('picture'));
        }

        return $post;
    }

    public function update(PostRequest $request, $id)
    {
        $data = [
            'header' => $request->header,
            'text' => $request->text,
            'tags' => $request->tags,
        ];

        $post = $this->postService->update($id, $data);

        if ($request->picture) {
            $this->postService->savePicture($post->id, $request->file('picture'));
        }

        return $post;
    }
}
