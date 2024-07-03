<!-- resources/views/upload.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Image Upload</title>
</head>
<body>
    <h1>Upload an Image</h1>
    <form action="{{ route('image.upload') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="image">Choose an image:</label>
        <input type="file" name="image" id="image" required>
        <button type="submit">Upload</button>
    </form>
</body>
</html>
