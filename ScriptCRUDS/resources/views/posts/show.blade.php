@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalles de posts</h1>
    <table class="table">
        <tbody>            <tr>
                <th>{{ ucfirst('id') }}</th>
                <td>{{ $item->id }}</td>
            </tr>            <tr>
                <th>{{ ucfirst('user_id') }}</th>
                <td>{{ $item->user_id }}</td>
            </tr>            <tr>
                <th>{{ ucfirst('title') }}</th>
                <td>{{ $item->title }}</td>
            </tr>            <tr>
                <th>{{ ucfirst('content') }}</th>
                <td>{{ $item->content }}</td>
            </tr>            <tr>
                <th>{{ ucfirst('foreign') }}</th>
                <td>{{ $item->foreign }}</td>
            </tr>        </tbody>
    </table>
    <a href="{{ route('posts.index') }}" class="btn btn-secondary">Volver</a>
</div>
@endsection