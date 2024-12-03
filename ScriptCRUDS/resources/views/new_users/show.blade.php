@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalles de new_users</h1>
    <table class="table">
        <tbody>            <tr>
                <th>{{ ucfirst('id') }}</th>
                <td>{{ $item->id }}</td>
            </tr>            <tr>
                <th>{{ ucfirst('name') }}</th>
                <td>{{ $item->name }}</td>
            </tr>            <tr>
                <th>{{ ucfirst('email') }}</th>
                <td>{{ $item->email }}</td>
            </tr>            <tr>
                <th>{{ ucfirst('password') }}</th>
                <td>{{ $item->password }}</td>
            </tr>        </tbody>
    </table>
    <a href="{{ route('new_users.index') }}" class="btn btn-secondary">Volver</a>
</div>
@endsection