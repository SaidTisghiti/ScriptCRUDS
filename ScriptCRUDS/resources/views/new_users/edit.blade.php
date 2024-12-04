<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Editar new_users</title>
</head>
<body>
<div class="container">
    <h1 class="my-4">Editar new_users</h1>
    <form action="{{ route('new_users.update', $item->id) }}" method="POST">
        @csrf
        @method('PUT')        <div class="mb-3">
            <label for="name" class="form-label">{{ ucfirst('name') }}</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $item->name }}" required>
        </div>        <div class="mb-3">
            <label for="email" class="form-label">{{ ucfirst('email') }}</label>
            <input type="text" class="form-control" id="email" name="email" value="{{ $item->email }}" required>
        </div>        <div class="mb-3">
            <label for="password" class="form-label">{{ ucfirst('password') }}</label>
            <input type="text" class="form-control" id="password" name="password" value="{{ $item->password }}" required>
        </div>        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>
</body>
</html>