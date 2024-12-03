@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Listado de new_users</h1>
    <a href="{{ route('new_users.create') }}" class="btn btn-primary">Crear nuevo</a>
    <table class="table">
        <thead>
            <tr>                <th>Id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Password</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
            <tr>                <td>{{ $item->id }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->email }}</td>
                <td>{{ $item->password }}</td>
                <td>
                    <a href="{{ route('new_users.show', $item->id) }}" class="btn btn-info">Ver</a>
                    <a href="{{ route('new_users.edit', $item->id) }}" class="btn btn-warning">Editar</a>
                    <form action="{{ route('new_users.destroy', $item->id) }}" method="POST" style="display:inline;">
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