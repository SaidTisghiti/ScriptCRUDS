@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalles de comments</h1>
    <table class="table">
        <tbody>            <tr>
                <th>{{ ucfirst('id') }}</th>
                <td>{{ $item->id }}</td>
            </tr>            <tr>
                <th>{{ ucfirst('post_id') }}</th>
                <td>{{ $item->post_id }}</td>
            </tr>            <tr>
                <th>{{ ucfirst('user_id') }}</th>
                <td>{{ $item->user_id }}</td>
            </tr>            <tr>
                <th>{{ ucfirst('comment') }}</th>
                <td>{{ $item->comment }}</td>
            </tr>            <tr>
                <th>{{ ucfirst('foreign') }}</th>
                <td>{{ $item->foreign }}</td>
            </tr>            <tr>
                <th>{{ ucfirst('foreign') }}</th>
                <td>{{ $item->foreign }}</td>
            </tr>        </tbody>
    </table>
    <a href="{{ route('comments.index') }}" class="btn btn-secondary">Volver</a>
</div>
@endsection