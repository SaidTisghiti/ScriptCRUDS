<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Detalles de all_data_types</title>
</head>
<body>
<div class="container">
    <h1 class="my-4">Detalles de all_data_types</h1>
    <table class="table">
        <tbody>            <tr>
                <th>{{ ucfirst('id') }}</th>
                <td>{{ $item->id }}</td>
            </tr>            <tr>
                <th>{{ ucfirst('tinyint_col') }}</th>
                <td>{{ $item->tinyint_col }}</td>
            </tr>            <tr>
                <th>{{ ucfirst('smallint_col') }}</th>
                <td>{{ $item->smallint_col }}</td>
            </tr>            <tr>
                <th>{{ ucfirst('mediumint_col') }}</th>
                <td>{{ $item->mediumint_col }}</td>
            </tr>            <tr>
                <th>{{ ucfirst('int_col') }}</th>
                <td>{{ $item->int_col }}</td>
            </tr>            <tr>
                <th>{{ ucfirst('bigint_col') }}</th>
                <td>{{ $item->bigint_col }}</td>
            </tr>            <tr>
                <th>{{ ucfirst('decimal_col') }}</th>
                <td>{{ $item->decimal_col }}</td>
            </tr>            <tr>
                <th>{{ ucfirst('not') }}</th>
                <td>{{ $item->not }}</td>
            </tr>            <tr>
                <th>{{ ucfirst('float_col') }}</th>
                <td>{{ $item->float_col }}</td>
            </tr>            <tr>
                <th>{{ ucfirst('double_col') }}</th>
                <td>{{ $item->double_col }}</td>
            </tr>            <tr>
                <th>{{ ucfirst('char_col') }}</th>
                <td>{{ $item->char_col }}</td>
            </tr>            <tr>
                <th>{{ ucfirst('varchar_col') }}</th>
                <td>{{ $item->varchar_col }}</td>
            </tr>            <tr>
                <th>{{ ucfirst('text_col') }}</th>
                <td>{{ $item->text_col }}</td>
            </tr>            <tr>
                <th>{{ ucfirst('blob_col') }}</th>
                <td>{{ $item->blob_col }}</td>
            </tr>            <tr>
                <th>{{ ucfirst('date_col') }}</th>
                <td>{{ $item->date_col }}</td>
            </tr>            <tr>
                <th>{{ ucfirst('datetime_col') }}</th>
                <td>{{ $item->datetime_col }}</td>
            </tr>            <tr>
                <th>{{ ucfirst('timestamp_col') }}</th>
                <td>{{ $item->timestamp_col }}</td>
            </tr>            <tr>
                <th>{{ ucfirst('time_col') }}</th>
                <td>{{ $item->time_col }}</td>
            </tr>            <tr>
                <th>{{ ucfirst('year_col') }}</th>
                <td>{{ $item->year_col }}</td>
            </tr>            <tr>
                <th>{{ ucfirst('enum_col') }}</th>
                <td>{{ $item->enum_col }}</td>
            </tr>            <tr>
                <th>{{ ucfirst('set_col') }}</th>
                <td>{{ $item->set_col }}</td>
            </tr>            <tr>
                <th>{{ ucfirst('not') }}</th>
                <td>{{ $item->not }}</td>
            </tr>            <tr>
                <th>{{ ucfirst('json_col') }}</th>
                <td>{{ $item->json_col }}</td>
            </tr>            <tr>
                <th>{{ ucfirst('spatial_col') }}</th>
                <td>{{ $item->spatial_col }}</td>
            </tr>        </tbody>
    </table>
    <a href="{{ route('all_data_types.index') }}" class="btn btn-secondary">Volver</a>
</div>
</body>
</html>