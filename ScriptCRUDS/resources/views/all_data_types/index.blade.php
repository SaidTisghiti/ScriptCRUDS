@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Listado de all_data_types</h1>
    <a href="{{ route('all_data_types.create') }}" class="btn btn-primary">Crear nuevo</a>
    <table class="table">
        <thead>
            <tr>                <th>Id</th>
                <th>Tinyint_col</th>
                <th>Smallint_col</th>
                <th>Mediumint_col</th>
                <th>Int_col</th>
                <th>Bigint_col</th>
                <th>Decimal_col</th>
                <th>Not</th>
                <th>Float_col</th>
                <th>Double_col</th>
                <th>Char_col</th>
                <th>Varchar_col</th>
                <th>Text_col</th>
                <th>Blob_col</th>
                <th>Date_col</th>
                <th>Datetime_col</th>
                <th>Timestamp_col</th>
                <th>Time_col</th>
                <th>Year_col</th>
                <th>Enum_col</th>
                <th>Set_col</th>
                <th>Not</th>
                <th>Json_col</th>
                <th>Spatial_col</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
            <tr>                <td>{{ $item->id }}</td>
                <td>{{ $item->tinyint_col }}</td>
                <td>{{ $item->smallint_col }}</td>
                <td>{{ $item->mediumint_col }}</td>
                <td>{{ $item->int_col }}</td>
                <td>{{ $item->bigint_col }}</td>
                <td>{{ $item->decimal_col }}</td>
                <td>{{ $item->not }}</td>
                <td>{{ $item->float_col }}</td>
                <td>{{ $item->double_col }}</td>
                <td>{{ $item->char_col }}</td>
                <td>{{ $item->varchar_col }}</td>
                <td>{{ $item->text_col }}</td>
                <td>{{ $item->blob_col }}</td>
                <td>{{ $item->date_col }}</td>
                <td>{{ $item->datetime_col }}</td>
                <td>{{ $item->timestamp_col }}</td>
                <td>{{ $item->time_col }}</td>
                <td>{{ $item->year_col }}</td>
                <td>{{ $item->enum_col }}</td>
                <td>{{ $item->set_col }}</td>
                <td>{{ $item->not }}</td>
                <td>{{ $item->json_col }}</td>
                <td>{{ $item->spatial_col }}</td>
                <td>
                    <a href="{{ route('all_data_types.show', $item->id) }}" class="btn btn-info">Ver</a>
                    <a href="{{ route('all_data_types.edit', $item->id) }}" class="btn btn-warning">Editar</a>
                    <form action="{{ route('all_data_types.destroy', $item->id) }}" method="POST" style="display:inline;">
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