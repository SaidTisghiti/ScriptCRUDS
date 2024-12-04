@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Listado de comments</h1>
    <a href="{{ route('comments.create') }}" class="btn btn-primary">Crear nuevo</a>
    <table class="table">
        <thead>
            <tr>                <th>Id</th>
                <th>Post_id</th>
                <th>User_id</th>
                <th>Comment</th>
                <th>Foreign</th>
                <th>Foreign</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
            <tr>                <td>{{ $item->id }}</td>
                <td>{{ $item->post_id }}</td>
                <td>{{ $item->user_id }}</td>
                <td>{{ $item->comment }}</td>
                <td>{{ $item->foreign }}</td>
                <td>{{ $item->foreign }}</td>
                <td>
                    <a href="{{ route('comments.show', $item->id) }}" class="btn btn-info">Ver</a>
                    <a href="{{ route('comments.edit', $item->id) }}" class="btn btn-warning">Editar</a>
                    <form action="{{ route('comments.destroy', $item->id) }}" method="POST" style="display:inline;">
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