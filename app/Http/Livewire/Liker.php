<?php

namespace App\Http\Livewire;

use App\Models\Post;
use App\Services\PostService;
use Livewire\Component;

class Liker extends Component
{
    public $post;
    private PostService $postService;

    public function __construct()
    {
        $this->postService = new PostService();
    }

    public function like()
    {
        $this->postService->like($this->post->id);
    }

    public function unlike()
    {
        $this->postService->unlike($this->post->id);
    }

    public function render()
    {
        $this->post = Post::find($this->post->id);
        return view('livewire.liker');
    }
}
