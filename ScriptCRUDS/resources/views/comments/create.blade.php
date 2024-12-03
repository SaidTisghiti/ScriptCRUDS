@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Crear comments</h1>
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
        </div>        <div class="mb-3">
            <label for="foreign" class="form-label">{{ ucfirst('foreign') }}</label>
            <input type="text" class="form-control" id="foreign" name="foreign" required>
        </div>        <div class="mb-3">
            <label for="foreign" class="form-label">{{ ucfirst('foreign') }}</label>
            <input type="text" class="form-control" id="foreign" name="foreign" required>
        </div>        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>
@endsection