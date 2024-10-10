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

    <a href="{{ route('settings.index') }}">Settings</a>

    @if ($question->file_path)
        <a href="{{ Storage::url($question->file_path) }}" target="_blank">View Attached File</a>
    @endif

</body>
</html>
