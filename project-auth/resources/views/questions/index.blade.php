<!DOCTYPE html>
<html>
<head>
    <title>All Questions</title>
</head>
<body>
    <h2>All Questions</h2>

    <a href="{{ route('questions.create') }}">Ask a New Question</a>

    <ul>
        @foreach ($questions as $question)
            <li>
                <a href="{{ route('questions.show', $question->id) }}">{{ $question->title }}</a> - by {{ $question->user->name }}
            </li>
        @endforeach
    </ul>
</body>
</html>
