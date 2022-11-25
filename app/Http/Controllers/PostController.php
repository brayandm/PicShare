<?php

namespace App\Http\Controllers;

use App\Services\PostService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    private PostService $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function getAll()
    {
        return view('dashboard', ['posts' => $this->postService->getAll(5)]);
    }

    public function getAllByTag($id)
    {
        return view('dashboard', ['posts' => $this->postService->getAllByTag(5, $id)]);
    }

    public function getForCurrentPerson()
    {
        return view('myposts.show', ['posts' => $this->postService->getForCurrentPerson()]);
    }

    public function edit($id)
    {
        return view('myposts.edit', ['post' => $this->postService->get($id)]);
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

        return redirect()->route('myposts.show');
    }

    public function delete($id)
    {
        $this->postService->delete($id);

        return redirect()->route('myposts.show');
    }

    public function create()
    {
        return view('myposts.create');
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

        return redirect()->route('myposts.show');
    }

    public function getPicture($picture)
    {
        return Storage::get('private/pictures/'.$picture);
    }

    public function like($id)
    {
        $this->postService->like($id);

        return redirect()->route('dashboard');
    }

    public function unlike($id)
    {
        $this->postService->unlike($id);

        return redirect()->route('dashboard');
    }
}
