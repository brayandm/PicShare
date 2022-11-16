<?php

namespace App\Services;

use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentService
{
    public function store($fields)
    {
        $fields['person_id'] = Auth::user()->person->id;
        Comment::create($fields);
    }
}
