@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Crear posts</h1>
    <form action="{{ route('posts.store') }}" method="POST">
        @csrf        <div class="mb-3">
            <label for="user_id" class="form-label">{{ ucfirst('user_id') }}</label>
            <input type="text" class="form-control" id="user_id" name="user_id" required>
        </div>        <div class="mb-3">
            <label for="title" class="form-label">{{ ucfirst('title') }}</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>        <div class="mb-3">
            <label for="content" class="form-label">{{ ucfirst('content') }}</label>
            <input type="text" class="form-control" id="content" name="content" required>
        </div>        <div class="mb-3">
            <label for="foreign" class="form-label">{{ ucfirst('foreign') }}</label>
            <input type="text" class="form-control" id="foreign" name="foreign" required>
        </div>        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>
@endsection