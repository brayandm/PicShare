<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostService
{
    public function getAll()
    {
        return Post::all();
    }

    public function get()
    {
        return Post::where('person_id', Auth::user()->person->id)->get();
    }
}
