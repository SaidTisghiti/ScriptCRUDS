@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar new_users</h1>
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
@endsection