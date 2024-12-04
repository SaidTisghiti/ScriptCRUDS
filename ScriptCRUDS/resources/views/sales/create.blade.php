<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Crear sales</title>
</head>
<body>
<div class="container">
    <h1 class="my-4">Crear sales</h1>
    <form action="{{ route('sales.store') }}" method="POST">
        @csrf        <div class="mb-3">
            <label for="car_id" class="form-label">{{ ucfirst('car_id') }}</label>
            <input type="text" class="form-control" id="car_id" name="car_id" required>
        </div>        <div class="mb-3">
            <label for="customer_id" class="form-label">{{ ucfirst('customer_id') }}</label>
            <input type="text" class="form-control" id="customer_id" name="customer_id" required>
        </div>        <div class="mb-3">
            <label for="employee_id" class="form-label">{{ ucfirst('employee_id') }}</label>
            <input type="text" class="form-control" id="employee_id" name="employee_id" required>
        </div>        <div class="mb-3">
            <label for="date" class="form-label">{{ ucfirst('date') }}</label>
            <input type="text" class="form-control" id="date" name="date" required>
        </div>        <div class="mb-3">
            <label for="quantity" class="form-label">{{ ucfirst('quantity') }}</label>
            <input type="text" class="form-control" id="quantity" name="quantity" required>
        </div>        <div class="mb-3">
            <label for="total" class="form-label">{{ ucfirst('total') }}</label>
            <input type="text" class="form-control" id="total" name="total" required>
        </div>        <div class="mb-3">
            <label for="not" class="form-label">{{ ucfirst('not') }}</label>
            <input type="text" class="form-control" id="not" name="not" required>
        </div>        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>
</body>
</html>