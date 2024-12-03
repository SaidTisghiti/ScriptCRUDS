@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar comments</h1>
    <form action="{{ route('comments.update', $item->id) }}" method="POST">
        @csrf
        @method('PUT')        <div class="mb-3">
            <label for="post_id" class="form-label">{{ ucfirst('post_id') }}</label>
            <input type="text" class="form-control" id="post_id" name="post_id" value="{{ $item->post_id }}" required>
        </div>        <div class="mb-3">
            <label for="user_id" class="form-label">{{ ucfirst('user_id') }}</label>
            <input type="text" class="form-control" id="user_id" name="user_id" value="{{ $item->user_id }}" required>
        </div>        <div class="mb-3">
            <label for="comment" class="form-label">{{ ucfirst('comment') }}</label>
            <input type="text" class="form-control" id="comment" name="comment" value="{{ $item->comment }}" required>
        </div>        <div class="mb-3">
            <label for="foreign" class="form-label">{{ ucfirst('foreign') }}</label>
            <input type="text" class="form-control" id="foreign" name="foreign" value="{{ $item->foreign }}" required>
        </div>        <div class="mb-3">
            <label for="foreign" class="form-label">{{ ucfirst('foreign') }}</label>
            <input type="text" class="form-control" id="foreign" name="foreign" value="{{ $item->foreign }}" required>
        </div>        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>
@endsection