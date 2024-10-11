<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, $answerId)
    {
        $request->validate([
            'body' => 'required',
        ]);

        $comment = new Comment();
        $comment->body = $request->input('body');
        $comment->user_id = Auth::id();
        $comment->answer_id = $answerId;
        $comment->save();

        return redirect()->back()->with('success', 'Comment added successfully.');
    }
}

