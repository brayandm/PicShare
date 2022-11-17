<?php

namespace App\Http\Controllers;

use App\Services\PostService;
use Illuminate\Http\Request;

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
        ]);

        $this->postService->update($id, $validated);

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
        ]);

        $this->postService->create($validated);

        return redirect()->route('myposts.show');
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
