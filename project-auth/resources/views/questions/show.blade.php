<!DOCTYPE html>
<html>
<head>
    <title>{{ $question->title }}</title>
</head>
<body>
    <h2>{{ $question->title }}</h2>
    <p>{{ $question->body }}</p>

    @if ($question->file_path)
        <a href="{{ Storage::url($question->file_path) }}" target="_blank">View Attached File</a>
    @endif

    <h3>Answers</h3>
    <ul>
        @foreach($question->answers as $answer)
            <li>{{ $answer->answer }} - by {{ $answer->user->name }}</li>
        @endforeach
    </ul>

    <h3>Submit Your Answer</h3>
    <form method="POST" action="{{ route('answers.store', $question->id) }}">
        @csrf
        <textarea name="answer" required></textarea>
        <button type="submit">Submit Answer</button>
    </form>

    <h3>All Questions</h3>
    <ul>
        @foreach($allQuestions as $q)
            <li>
                <a href="{{ route('questions.show', $q->id) }}">{{ $q->title }}</a>
            </li>
        @endforeach
    </ul>

    @if($bestAnswer)
        <h2>Best Answer (Most Liked)</h2>
        <p>{{ $bestAnswer->body }}</p>
        <p>Likes: {{ $bestAnswer->like_count }}</p>
    @endif

    <a href="{{ route('settings.index') }}">Settings</a>

    @if ($question->file_path)
        <a href="{{ Storage::url($question->file_path) }}" target="_blank">View Attached File</a>
    @endif

    @foreach($question->answers as $answer)
        <div class="answer">
            <h4>{{ $answer->user->name }}'s Answer:</h4>
            <p>{{ $answer->body }}</p>

            <!-- Daftar Komentar -->
            <h5>Comments:</h5>
            <ul>
                @forelse ($answer->comments as $comment)
                    <li>{{ $comment->user->name }}: {{ $comment->body }}</li>
                @empty
                    <li>No comments yet.</li>
                @endforelse
            </ul>

            <!-- Form untuk Menambahkan Komentar -->
            <form method="POST" action="{{ route('comments.store', $answer->id) }}">
                @csrf
                <div>
                    <textarea name="body" placeholder="Add a comment..." required></textarea>
                </div>
                <button type="submit">Submit Comment</button>
            </form>
        </div>
    @endforeach

    @foreach($question->answers as $answer)
        <div class="answer">
            <h4>{{ $answer->user->name }}'s Answer:</h4>
            <p>{{ $answer->body }}</p>

            <!-- Menampilkan Jumlah Like -->
            <p>Likes: {{ $answer->like_count }}</p>

            <!-- Tombol Like/Unlike -->
            <form method="POST" action="{{ route('answers.like', $answer->id) }}">
                @csrf
                <button type="submit">
                    @if($answer->likes->where('user_id', auth()->id())->count())
                        Unlike
                    @else
                        Like
                    @endif
                </button>
            </form>
        </div>
    @endforeach

</body>
</html>
