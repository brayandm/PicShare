<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use App\Models\Post;
use App\Services\PostService;
use Exception;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Poster extends Component
{
    public $post;
    public $comments = [];
    public $active = -1;
    public $message = "";

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

    public function activeComment($counter)
    {
        $this->active = $counter;
    }

    public function send($id, $type)
    {
        if($type == 'comment')
        {
            Comment::create(['person_id' => Auth::user()->person->id, 'comment_id' => $id, 'text' => $this->message]);
        }
        else if($type == 'post')
        {
            Comment::create(['person_id' => Auth::user()->person->id, 'post_id' => $id, 'text' => $this->message]);
        }
        else
        {
            throw new Exception();
        }
        $this->message = "";
        $this->active = -1;
    }

    public function render()
    {
        $this->post->refresh();

        $stack = [[$this->post, 0, false]];

        $this->comments = [];

        while (count($stack)) {
            $last = array_pop($stack);

            if ($last[1]) {
                if(count($this->comments)+1 == $this->active)
                {
                    $last[2] = true;
                }
                $this->comments[] = $last;
            }

            $temp = [];

            foreach ($last[0]->comments()->get() as $comment) {
                array_push($temp, [$comment, $last[1] + 1, false]);
            }

            $temp = array_reverse($temp);

            foreach ($temp as $comment) {
                array_push($stack, $comment);
            }
        }

        return view('livewire.poster');
    }
}
