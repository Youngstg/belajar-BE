<!DOCTYPE html>
<html>
<head>
    <title>All Questions</title>
</head>
<body>
    <h2>All Questions</h2>

    <!-- Form untuk Pencarian -->
    <form method="GET" action="{{ route('questions.index') }}">
        <input type="text" name="search" placeholder="Search questions..." value="{{ request('search') }}">
        <button type="submit">Search</button>
    </form>    

    <a href="{{ route('questions.create') }}">Ask a New Question</a>

    <ul>
        @forelse ($questions as $question)
            <li>
                <a href="{{ route('questions.show', $question->id) }}">{{ $question->title }}</a> - by {{ $question->user->name }}
            </li>
        @empty
            <p>No questions found.</p>
        @endforelse
    </ul>
</body>
</html>
