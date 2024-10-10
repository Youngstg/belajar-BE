<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnswerController extends Controller
{
    public function store(Request $request, $id)
    {
        $request->validate([
            'answer' => 'required|string',
        ]);

        Answer::create([
            'question_id' => $id,
            'user_id' => Auth::id(),
            'answer' => $request->answer,
        ]);

        return redirect()->route('questions.show', $id)->with('success', 'Answer submitted successfully.');
    }
}

