<?php

require 'vendor/autoload.php'; // Cargar dependencias de Laravel

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

// Configurar el entorno de Laravel
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$outputDir = resource_path('views'); // Carpeta donde se guardan las vistas

// Verificar que se haya pasado un archivo SQL como argumento
if ($argc < 2) {
    die("Uso: php generate_views.php archivo.sql\n");
}

$sqlFile = $argv[1]; // Obtener el archivo SQL desde los argumentos

if (!file_exists($sqlFile)) {
    die("El archivo SQL no existe: $sqlFile\n");
}

// Leer y analizar el archivo SQL
try {
    $sql = file_get_contents($sqlFile);

    // Limpiar comentarios y preparar el SQL
    $cleanedSql = removeCommentsFromSQL($sql);
    $queries = explode(";", $cleanedSql);
    $tables = parseTablesFromSQL($queries);

    if (empty($tables)) {
        die("No se detectaron tablas en el archivo SQL. Verifica el formato del archivo.\n");
    }

    foreach ($tables as $table => $schema) {
        echo "Procesando vistas para la tabla: $table...\n";

        $viewDir = "$outputDir/" . Str::snake($table);
        if (!file_exists($viewDir)) {
            mkdir($viewDir, 0777, true);
        }

        // Crear las vistas necesarias
        createIndexView($viewDir, $table, $schema);
        createCreateView($viewDir, $table, $schema);
        createEditView($viewDir, $table, $schema);
        createShowView($viewDir, $table, $schema); // Nueva vista `show`

        echo "Vistas generadas para la tabla: $table\n";
    }

    echo "Vistas generadas correctamente.\n";
} catch (Exception $e) {
    die("Error al procesar el archivo SQL: " . $e->getMessage() . "\n");
}

/**
 * Eliminar comentarios del archivo SQL
 */
function removeCommentsFromSQL($sql)
{
    $sql = preg_replace('/(--.*?$)|(#.*?$)/m', '', $sql); // Línea
    $sql = preg_replace('/\/\*.*?\*\//s', '', $sql); // Bloque
    return $sql;
}

/**
 * Analiza las tablas y esquemas del archivo SQL
 */
function parseTablesFromSQL($queries)
{
    $tables = [];
    foreach ($queries as $query) {
        $query = trim($query);

        if (preg_match('/CREATE TABLE\s+`?(\w+)`?\s*\((.+)\)/si', $query, $matches)) {
            $tableName = $matches[1];
            $columns = parseColumnsFromSchema($matches[2]);
            $tables[$tableName] = $columns;
            echo "Tabla detectada: $tableName\n";
        }
    }
    return $tables;
}

/**
 * Extraer columnas del esquema SQL
 */
function parseColumnsFromSchema($schema)
{
    $columns = [];
    $lines = explode(",", $schema);

    foreach ($lines as $line) {
        if (preg_match('/`?(\w+)`?\s+([\w\(\),\s]+)/', $line, $matches)) {
            $columnName = strtolower($matches[1]);
            if (!in_array($columnName, ['created_at', 'updated_at'])) { // Ignorar campos automáticos
                $columns[] = $columnName;
            }
        }
    }

    return $columns;
}

/**
 * Crear la vista index.blade.php
 */
function createIndexView($viewDir, $table, $columns)
{
    $viewContent = <<<EOT
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Listado de $table</h1>
    <a href="{{ route('$table.create') }}" class="btn btn-primary">Crear nuevo</a>
    <table class="table">
        <thead>
            <tr>
EOT;

    foreach ($columns as $column) {
        $viewContent .= "                <th>" . ucfirst($column) . "</th>\n";
    }

    $viewContent .= <<<EOT
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach (\$data as \$item)
            <tr>
EOT;

    foreach ($columns as $column) {
        $viewContent .= "                <td>{{ \$item->$column }}</td>\n";
    }

    $viewContent .= <<<EOT
                <td>
                    <a href="{{ route('$table.show', \$item->id) }}" class="btn btn-info">Ver</a>
                    <a href="{{ route('$table.edit', \$item->id) }}" class="btn btn-warning">Editar</a>
                    <form action="{{ route('$table.destroy', \$item->id) }}" method="POST" style="display:inline;">
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
EOT;

    file_put_contents("$viewDir/index.blade.php", $viewContent);
}

/**
 * Crear la vista create.blade.php
 */
function createCreateView($viewDir, $table, $columns)
{
    $viewContent = <<<EOT
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Crear $table</h1>
    <form action="{{ route('$table.store') }}" method="POST">
        @csrf
EOT;

    foreach ($columns as $column) {
        if (!in_array($column, ['id'])) { // Ignorar campos automáticos
            $viewContent .= <<<EOT
        <div class="mb-3">
            <label for="$column" class="form-label">{{ ucfirst('$column') }}</label>
            <input type="text" class="form-control" id="$column" name="$column" required>
        </div>
EOT;
        }
    }

    $viewContent .= <<<EOT
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>
@endsection
EOT;

    file_put_contents("$viewDir/create.blade.php", $viewContent);
}

/**
 * Crear la vista edit.blade.php
 */
function createEditView($viewDir, $table, $columns)
{
    $viewContent = <<<EOT
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar $table</h1>
    <form action="{{ route('$table.update', \$item->id) }}" method="POST">
        @csrf
        @method('PUT')
EOT;

    foreach ($columns as $column) {
        if (!in_array($column, ['id'])) { // Ignorar campos automáticos
            $viewContent .= <<<EOT
        <div class="mb-3">
            <label for="$column" class="form-label">{{ ucfirst('$column') }}</label>
            <input type="text" class="form-control" id="$column" name="$column" value="{{ \$item->$column }}" required>
        </div>
EOT;
        }
    }

    $viewContent .= <<<EOT
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>
@endsection
EOT;

    file_put_contents("$viewDir/edit.blade.php", $viewContent);
}

/**
 * Crear la vista show.blade.php
 */
function createShowView($viewDir, $table, $columns)
{
    $viewContent = <<<EOT
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalles de $table</h1>
    <table class="table">
        <tbody>
EOT;

    foreach ($columns as $column) {
        $viewContent .= <<<EOT
            <tr>
                <th>{{ ucfirst('$column') }}</th>
                <td>{{ \$item->$column }}</td>
            </tr>
EOT;
    }

    $viewContent .= <<<EOT
        </tbody>
    </table>
    <a href="{{ route('$table.index') }}" class="btn btn-secondary">Volver</a>
</div>
@endsection
EOT;

    file_put_contents("$viewDir/show.blade.php", $viewContent);
}
