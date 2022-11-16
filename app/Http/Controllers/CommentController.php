<?php

namespace App\Http\Controllers;

use App\Services\CommentService;
use Exception;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    private CommentService $commentService;

    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    public function create($id, $type)
    {
        return view('comment.show', ['id' => $id, 'type' => $type]);
    }

    public function store(Request $request, $id, $type)
    {
        $validated = $request->validate([
            'text' => 'max:255',
        ]);

        if ($type == 'post') {
            $validated['post_id'] = $id;
        } elseif ($type == 'comment') {
            $validated['comment_id'] = $id;
        } else {
            throw new Exception();
        }

        $this->commentService->store($validated);

        return redirect()->route('dashboard');
    }
}
