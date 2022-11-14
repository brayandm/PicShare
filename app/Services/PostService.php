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

    public function getForCurrentPerson()
    {
        return Post::where('person_id', Auth::user()->person->id)->get();
    }

    public function get($id)
    {
        return Post::where('id', $id)->first();
    }

    public function update($id, $fields)
    {
        Post::find($id)->update($fields);
    }

    public function delete($id)
    {
        Post::find($id)->delete();
    }

    public function create($fields)
    {
        $fields['person_id'] = Auth::user()->person->id;
        Post::create($fields);
    }

    public function like($id)
    {
        $post = Post::find($id);

        $post->update([
            'likes' => $post->likes + 1,
        ]);
    }
}
