<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class QuestionController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Jika ada input pencarian, lakukan pencarian berdasarkan judul atau body
        if ($search) {
            $questions = Question::where('title', 'like', '%' . $search . '%')
                                ->orWhere('body', 'like', '%' . $search . '%')
                                ->with('user')
                                ->latest()
                                ->get();
        } else {
            // Jika tidak ada input pencarian, tampilkan semua pertanyaan
            $questions = Question::with('user')->latest()->get();
        }

        return view('questions.index', compact('questions'));
    }

    public function create()
    {
        return view('questions.create');
    }

    public function store(Request $request)
    {
        // Validasi input dari request
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'nullable|string',
            'file' => 'nullable|file|mimes:pdf,docx,jpeg,png|max:2048',
        ]);

        // Simpan file jika ada file yang diupload
        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('questions_files', 'public');
        }

        // Buat pertanyaan baru di database
        $question = Question::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'body' => $request->body,
            'file_path' => $filePath,
        ]);

        // Redirect ke halaman show menggunakan ID dari pertanyaan yang baru saja dibuat
        return redirect()->route('questions.show', $question->id)->with('success', 'Question created successfully.');
    }


    public function show($id)
    {
        $question = Question::with('answers.user')->findOrFail($id); // Mengambil pertanyaan dengan jawaban dan pengguna
        $allQuestions = Question::all(); // Mengambil semua pertanyaan

        return view('questions.show', compact('question', 'allQuestions'));
    }

}

