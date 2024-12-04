<?php

require 'vendor/autoload.php'; // Cargar dependencias de Laravel

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

// Configurar el entorno de Laravel
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$outputDir = database_path('seeders'); // Carpeta donde se guardan los seeders
$databaseSeederFile = database_path('seeders/DatabaseSeeder.php'); // Archivo maestro de seeders

if ($argc < 2) {
    die("Uso: php generate_seeders.php archivo.sql\n");
}

$sqlFile = $argv[1]; // Obtener el archivo SQL desde los argumentos

if (!file_exists($sqlFile)) {
    die("El archivo SQL no existe: $sqlFile\n");
}

try {
    $sql = file_get_contents($sqlFile);
    $cleanedSql = removeCommentsFromSQL($sql);
    $insertStatements = parseInsertStatements($cleanedSql);

    if (empty($insertStatements)) {
        echo "No se encontraron datos para seeders en el archivo SQL.\n";
        exit;
    }

    $newSeeders = [];
    foreach ($insertStatements as $table => $data) {
        $seederName = Str::studly(Str::singular($table)) . 'Seeder'; // Asegurar formato correcto
        echo "Procesando seeder para la tabla: $table...\n";

        $seederContent = createSeeder($table, $data, $seederName);
        $fileName = "$seederName.php";

        if (!file_exists($outputDir)) {
            mkdir($outputDir, 0777, true);
        }

        file_put_contents("$outputDir/$fileName", $seederContent);
        echo "Seeder creado: $outputDir/$fileName\n";

        $newSeeders[] = $seederName;
    }

    // Actualizar o crear DatabaseSeeder.php
    updateDatabaseSeeder($databaseSeederFile, $newSeeders);

    echo "Seeders generados correctamente y añadidos a DatabaseSeeder.php.\n";
} catch (Exception $e) {
    die("Error al procesar el archivo SQL: " . $e->getMessage() . "\n");
}

/**
 * Crear contenido del seeder para una tabla específica
 */
function createSeeder($table, $data, $seederName)
{
    $dataString = implode(",\n            ", array_map(function ($row) {
        $formattedArray = array_map(fn($key, $value) => "'$key' => " . var_export($value, true), array_keys($row), $row);
        return "array (\n                " . implode(",\n                ", $formattedArray) . "\n            )";
    }, $data));

    return <<<EOT
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class $seederName extends Seeder
{
    public function run()
    {
        DB::table('$table')->insert([
            $dataString
        ]);
    }
}
EOT;
}

/**
 * Actualizar o crear DatabaseSeeder.php con los nuevos seeders
 */
function updateDatabaseSeeder($filePath, $newSeeders)
{
    $existingContent = file_exists($filePath) ? file_get_contents($filePath) : null;
    $existingSeeders = [];

    if ($existingContent) {
        // Buscar seeders existentes en el archivo DatabaseSeeder.php
        preg_match_all('/\$this->call\((.*?)::class\);/', $existingContent, $matches);
        $existingSeeders = array_map('trim', $matches[1] ?? []);
    }

    $seedersToAdd = array_diff($newSeeders, $existingSeeders);

    if (empty($seedersToAdd)) {
        echo "No hay nuevos seeders para añadir al archivo DatabaseSeeder.php.\n";
        return;
    }

    $newSeederCalls = implode(";\n        \$this->call(", array_map(fn($seeder) => "$seeder::class", $seedersToAdd));
    $existingSeederCalls = implode(";\n        \$this->call(", array_map(fn($seeder) => "$seeder::class", $existingSeeders));

    $finalSeederCalls = $existingSeederCalls
        ? $existingSeederCalls . ";\n        \$this->call(" . $newSeederCalls . ");"
        : "\$this->call(" . $newSeederCalls . ");";

    if ($existingContent) {
        // Actualizar la función run manteniendo el contenido existente
        $updatedContent = preg_replace_callback(
            '/public function run\(\): void\s*{\s*(.*?)\s*}/s',
            function ($matches) use ($finalSeederCalls) {
                $existingCode = trim($matches[1]);
                return "public function run(): void\n    {\n        $existingCode\n        $finalSeederCalls\n    }";
            },
            $existingContent
        );
    } else {
        // Si no existe, creamos el archivo desde cero
        $updatedContent = <<<EOT
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $finalSeederCalls
    }
}
EOT;
    }

    file_put_contents($filePath, $updatedContent);
    echo "Archivo DatabaseSeeder.php actualizado correctamente.\n";
}

/**
 * Analizar las instrucciones INSERT INTO en el archivo SQL
 */
function parseInsertStatements($sql)
{
    $data = [];
    if (preg_match_all('/INSERT INTO\s+`?(\w+)`?\s*\(([^)]+)\)\s*VALUES\s*(.+?);/si', $sql, $matches, PREG_SET_ORDER)) {
        foreach ($matches as $match) {
            $table = $match[1];
            $columns = array_map('trim', explode(',', $match[2]));
            $values = parseValues($match[3]);

            foreach ($values as $valueSet) {
                $row = [];
                foreach ($columns as $index => $column) {
                    $row[trim($column, '`')] = trim($valueSet[$index], "'\"");
                }
                $data[$table][] = $row;
            }
        }
    }
    return $data;
}

/**
 * Parsear valores de las instrucciones INSERT INTO
 */
function parseValues($valuesString)
{
    $values = [];
    preg_match_all('/\(([^)]+)\)/', $valuesString, $matches);
    foreach ($matches[1] as $valueSet) {
        $values[] = array_map('trim', explode(',', $valueSet));
    }
    return $values;
}

/**
 * Eliminar comentarios del archivo SQL
 */
function removeCommentsFromSQL($sql)
{
    // Eliminar comentarios de línea -- y #
    $sql = preg_replace('/(--[^\n]*|#[^\n]*)/', '', $sql);

    // Eliminar comentarios de bloque /* */
    $sql = preg_replace('/\/\*.*?\*\//s', '', $sql);

    return $sql;
}
