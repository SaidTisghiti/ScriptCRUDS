<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Crear comments</title>
</head>
<body>
<div class="container">
    <h1 class="my-4">Crear comments</h1>
    <form action="{{ route('comments.store') }}" method="POST">
        @csrf        <div class="mb-3">
            <label for="post_id" class="form-label">{{ ucfirst('post_id') }}</label>
            <input type="text" class="form-control" id="post_id" name="post_id" required>
        </div>        <div class="mb-3">
            <label for="user_id" class="form-label">{{ ucfirst('user_id') }}</label>
            <input type="text" class="form-control" id="user_id" name="user_id" required>
        </div>        <div class="mb-3">
            <label for="comment" class="form-label">{{ ucfirst('comment') }}</label>
            <input type="text" class="form-control" id="comment" name="comment" required>
        </div>        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>
</body>
</html>