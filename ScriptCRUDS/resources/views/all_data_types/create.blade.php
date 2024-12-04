<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Crear all_data_types</title>
</head>
<body>
<div class="container">
    <h1 class="my-4">Crear all_data_types</h1>
    <form action="{{ route('all_data_types.store') }}" method="POST">
        @csrf        <div class="mb-3">
            <label for="tinyint_col" class="form-label">{{ ucfirst('tinyint_col') }}</label>
            <input type="text" class="form-control" id="tinyint_col" name="tinyint_col" required>
        </div>        <div class="mb-3">
            <label for="smallint_col" class="form-label">{{ ucfirst('smallint_col') }}</label>
            <input type="text" class="form-control" id="smallint_col" name="smallint_col" required>
        </div>        <div class="mb-3">
            <label for="mediumint_col" class="form-label">{{ ucfirst('mediumint_col') }}</label>
            <input type="text" class="form-control" id="mediumint_col" name="mediumint_col" required>
        </div>        <div class="mb-3">
            <label for="int_col" class="form-label">{{ ucfirst('int_col') }}</label>
            <input type="text" class="form-control" id="int_col" name="int_col" required>
        </div>        <div class="mb-3">
            <label for="bigint_col" class="form-label">{{ ucfirst('bigint_col') }}</label>
            <input type="text" class="form-control" id="bigint_col" name="bigint_col" required>
        </div>        <div class="mb-3">
            <label for="decimal_col" class="form-label">{{ ucfirst('decimal_col') }}</label>
            <input type="text" class="form-control" id="decimal_col" name="decimal_col" required>
        </div>        <div class="mb-3">
            <label for="not" class="form-label">{{ ucfirst('not') }}</label>
            <input type="text" class="form-control" id="not" name="not" required>
        </div>        <div class="mb-3">
            <label for="float_col" class="form-label">{{ ucfirst('float_col') }}</label>
            <input type="text" class="form-control" id="float_col" name="float_col" required>
        </div>        <div class="mb-3">
            <label for="double_col" class="form-label">{{ ucfirst('double_col') }}</label>
            <input type="text" class="form-control" id="double_col" name="double_col" required>
        </div>        <div class="mb-3">
            <label for="char_col" class="form-label">{{ ucfirst('char_col') }}</label>
            <input type="text" class="form-control" id="char_col" name="char_col" required>
        </div>        <div class="mb-3">
            <label for="varchar_col" class="form-label">{{ ucfirst('varchar_col') }}</label>
            <input type="text" class="form-control" id="varchar_col" name="varchar_col" required>
        </div>        <div class="mb-3">
            <label for="text_col" class="form-label">{{ ucfirst('text_col') }}</label>
            <input type="text" class="form-control" id="text_col" name="text_col" required>
        </div>        <div class="mb-3">
            <label for="blob_col" class="form-label">{{ ucfirst('blob_col') }}</label>
            <input type="text" class="form-control" id="blob_col" name="blob_col" required>
        </div>        <div class="mb-3">
            <label for="date_col" class="form-label">{{ ucfirst('date_col') }}</label>
            <input type="text" class="form-control" id="date_col" name="date_col" required>
        </div>        <div class="mb-3">
            <label for="datetime_col" class="form-label">{{ ucfirst('datetime_col') }}</label>
            <input type="text" class="form-control" id="datetime_col" name="datetime_col" required>
        </div>        <div class="mb-3">
            <label for="timestamp_col" class="form-label">{{ ucfirst('timestamp_col') }}</label>
            <input type="text" class="form-control" id="timestamp_col" name="timestamp_col" required>
        </div>        <div class="mb-3">
            <label for="time_col" class="form-label">{{ ucfirst('time_col') }}</label>
            <input type="text" class="form-control" id="time_col" name="time_col" required>
        </div>        <div class="mb-3">
            <label for="year_col" class="form-label">{{ ucfirst('year_col') }}</label>
            <input type="text" class="form-control" id="year_col" name="year_col" required>
        </div>        <div class="mb-3">
            <label for="enum_col" class="form-label">{{ ucfirst('enum_col') }}</label>
            <input type="text" class="form-control" id="enum_col" name="enum_col" required>
        </div>        <div class="mb-3">
            <label for="set_col" class="form-label">{{ ucfirst('set_col') }}</label>
            <input type="text" class="form-control" id="set_col" name="set_col" required>
        </div>        <div class="mb-3">
            <label for="not" class="form-label">{{ ucfirst('not') }}</label>
            <input type="text" class="form-control" id="not" name="not" required>
        </div>        <div class="mb-3">
            <label for="json_col" class="form-label">{{ ucfirst('json_col') }}</label>
            <input type="text" class="form-control" id="json_col" name="json_col" required>
        </div>        <div class="mb-3">
            <label for="spatial_col" class="form-label">{{ ucfirst('spatial_col') }}</label>
            <input type="text" class="form-control" id="spatial_col" name="spatial_col" required>
        </div>        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>
</body>
</html>