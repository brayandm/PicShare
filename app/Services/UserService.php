<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    public function getAll()
    {
        return User::all();
    }

    public function delete($id)
    {
        $user = User::find($id);
        $person = $user?->person;
        $posts = $person?->posts;

        if ($posts) {
            foreach ($posts as $post) {
                $post->delete();
            }
        }
        $person?->delete();
        $user?->delete();
    }
}
