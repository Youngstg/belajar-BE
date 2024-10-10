<!DOCTYPE html>
<html>
<head>
    <title>Ask a Question</title>
</head>
<body>
    <h2>Ask a Question</h2>

    <form method="POST" action="{{ route('questions.store') }}" enctype="multipart/form-data">
        @csrf
        <div>
            <label>Title:</label>
            <input type="text" name="title" required>
        </div>
        <div>
            <label>Body:</label>
            <textarea name="body"></textarea>
        </div>
        <div>
            <label>Attach File (optional):</label>
            <input type="file" name="file">
        </div>
        <div>
            <button type="submit">Submit</button>
        </div>
    </form>
</body>
</html>
