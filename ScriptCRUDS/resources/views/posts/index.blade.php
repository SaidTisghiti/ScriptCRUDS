@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Listado de posts</h1>
    <a href="{{ route('posts.create') }}" class="btn btn-primary">Crear nuevo</a>
    <table class="table">
        <thead>
            <tr>                <th>Id</th>
                <th>User_id</th>
                <th>Title</th>
                <th>Content</th>
                <th>Foreign</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
            <tr>                <td>{{ $item->id }}</td>
                <td>{{ $item->user_id }}</td>
                <td>{{ $item->title }}</td>
                <td>{{ $item->content }}</td>
                <td>{{ $item->foreign }}</td>
                <td>
                    <a href="{{ route('posts.show', $item->id) }}" class="btn btn-info">Ver</a>
                    <a href="{{ route('posts.edit', $item->id) }}" class="btn btn-warning">Editar</a>
                    <form action="{{ route('posts.destroy', $item->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection