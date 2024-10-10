<!DOCTYPE html>
<html>
<head>
    <title>Settings</title>
</head>
<body>
    <h2>Settings</h2>

    @if(session('success'))
        <div style="color: green;">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('settings.update') }}" enctype="multipart/form-data">
        @csrf
        <div>
            <label>Upload Avatar:</label>
            <input type="file" name="avatar" accept="image/*">
        </div>
        <div>
            <button type="submit">Update Avatar</button>
        </div>
    </form>

    <h3>Your Current Avatar:</h3>
    @if(Auth::user()->avatar)
        <img src="{{ Storage::url(Auth::user()->avatar) }}" alt="Avatar" style="width: 150px; height: 150px;">
    @else
        <p>No avatar uploaded.</p>
    @endif
</body>
</html>
