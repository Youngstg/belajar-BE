<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function toggleLike($answerId)
    {
        $answer = Answer::findOrFail($answerId);
        $like = Like::where('user_id', Auth::id())->where('answer_id', $answerId)->first();

        if ($like) {
            // Jika like sudah ada, hapus like
            $like->delete();
            return redirect()->back()->with('success', 'You unliked the answer.');
        } else {
            // Jika like belum ada, tambahkan like
            Like::create([
                'user_id' => Auth::id(),
                'answer_id' => $answerId
            ]);
            return redirect()->back()->with('success', 'You liked the answer.');
        }
    }
}

