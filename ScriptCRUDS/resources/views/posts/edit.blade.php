<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Editar posts</title>
</head>
<body>
<div class="container">
    <h1 class="my-4">Editar posts</h1>
    <form action="{{ route('posts.update', $item->id) }}" method="POST">
        @csrf
        @method('PUT')        <div class="mb-3">
            <label for="user_id" class="form-label">{{ ucfirst('user_id') }}</label>
            <input type="text" class="form-control" id="user_id" name="user_id" value="{{ $item->user_id }}" required>
        </div>        <div class="mb-3">
            <label for="title" class="form-label">{{ ucfirst('title') }}</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $item->title }}" required>
        </div>        <div class="mb-3">
            <label for="content" class="form-label">{{ ucfirst('content') }}</label>
            <input type="text" class="form-control" id="content" name="content" value="{{ $item->content }}" required>
        </div>        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>
</body>
</html>