<?php

require 'vendor/autoload.php'; // Cargar dependencias de Laravel

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

// Configurar el entorno de Laravel
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$outputDir = database_path('migrations'); // Carpeta donde se guardan las migraciones

// Verificar que se haya pasado un archivo SQL como argumento
if ($argc < 2) {
    die("Uso: php generate_migrations.php archivo.sql\n");
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

    foreach ($tables as $tableName => $columns) {
        echo "Procesando migración para la tabla: $tableName...\n";

        // Buscar y eliminar migración existente
        deleteExistingMigration($outputDir, $tableName);

        // Crear y guardar la migración
        $migrationContent = createMigration($tableName, $columns);
        saveMigration($outputDir, $tableName, $migrationContent);

        // Crear seeder
        generateSeeder($tableName);

        // Crear controlador
        generateController($tableName);

        // Crear vistas
        generateViews($tableName);
    }

    echo "Archivos generados correctamente. Ejecuta 'php artisan migrate' para aplicarlas.\n";
} catch (Exception $e) {
    die("Error al procesar el archivo SQL: " . $e->getMessage() . "\n");
}

/**
 * Limpiar comentarios del SQL
 */
function removeCommentsFromSQL($sql)
{
    $sql = preg_replace('/(--.*?$)|(#.*?$)/m', '', $sql); // Comentarios de línea
    $sql = preg_replace('/\/\*.*?\*\//s', '', $sql); // Comentarios de bloque
    return $sql;
}

/**
 * Analizar tablas del SQL
 */
function parseTablesFromSQL($queries)
{
    $tables = [];
    foreach ($queries as $query) {
        $query = trim($query);
        if (preg_match('/CREATE TABLE\s+`?(\w+)`?\s*\((.+)\)/si', $query, $matches)) {
            $tableName = $matches[1];
            $columns = explode(",", $matches[2]);
            $tables[$tableName] = array_map('trim', $columns);
        }
    }
    return $tables;
}

/**
 * Crear contenido de migración
 */
function createMigration($tableName, $columns)
{
    $migrationColumns = generateColumns($columns);
    $foreignKeys = generateForeignKeys($columns);

    return <<<EOT
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('$tableName', function (Blueprint \$table) {
            \$table->id(); // Clave primaria automática
            $migrationColumns
            $foreignKeys
            \$table->timestamps(); // Timestamps automáticos
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('$tableName');
    }
};
EOT;
}

/**
 * Generar columnas de la tabla
 */
function generateColumns($columns)
{
    $output = '';
    foreach ($columns as $column) {
        if (preg_match('/`?(\w+)`?\s+([\w\(\)]+).*/', $column, $matches)) {
            $field = $matches[1];
            $type = mapTypeToMigration($matches[2]);

            // Ignorar claves foráneas, id redundantes y timestamps
            if (strtolower($field) === 'id' || strtolower($field) === 'foreign') continue;
            if (strtolower($field) === 'created_at' || strtolower($field) === 'updated_at') continue;

            $nullable = stripos($column, 'NOT NULL') === false ? '->nullable()' : '';
            $output .= "\$table->$type('$field')$nullable;\n            ";
        }
    }
    return $output;
}

/**
 * Generar claves foráneas
 */
function generateForeignKeys($columns)
{
    $output = '';
    foreach ($columns as $column) {
        if (preg_match('/FOREIGN KEY\s*\((\w+)\)\s*REFERENCES\s*(\w+)\((\w+)\)/i', $column, $matches)) {
            $localField = $matches[1];
            $foreignTable = $matches[2];
            $foreignField = $matches[3];
            $output .= "\$table->foreign('$localField')->references('$foreignField')->on('$foreignTable')->onDelete('cascade');\n            ";
        }
    }
    return $output;
}

/**
 * Mapear tipos SQL a Laravel
 */
function mapTypeToMigration($type)
{
    return match (true) {
        str_contains($type, 'int') => 'integer',
        str_contains($type, 'varchar') => 'string',
        str_contains($type, 'text') => 'text',
        str_contains($type, 'float') => 'float',
        str_contains($type, 'double') => 'double',
        str_contains($type, 'decimal') => 'decimal',
        str_contains($type, 'timestamp') => 'timestamp',
        str_contains($type, 'date') => 'date',
        str_contains($type, 'time') => 'time',
        str_contains($type, 'json') => 'json',
        default => 'string',
    };
}

/**
 * Guardar migración
 */
function saveMigration($outputDir, $tableName, $content)
{
    $fileName = date('Y_m_d_His') . "_create_{$tableName}_table.php";
    if (!file_exists($outputDir)) {
        mkdir($outputDir, 0777, true);
    }
    file_put_contents("$outputDir/$fileName", $content);
    echo "Migración creada: $outputDir/$fileName\n";
    sleep(1); // Evitar conflicto de timestamps
}

/**
 * Eliminar migraciones existentes
 */
function deleteExistingMigration($outputDir, $tableName)
{
    $files = scandir($outputDir);
    foreach ($files as $file) {
        if (str_contains($file, "create_{$tableName}_table")) {
            unlink("$outputDir/$file");
            echo "Migración existente eliminada: $outputDir/$file\n";
        }
    }
}

/**
 * Generar Seeder
 */
function generateSeeder($tableName)
{
    $seederName = ucfirst(Str::singular($tableName)) . 'Seeder';
    $outputDir = database_path('seeders');
    if (!is_dir($outputDir)) {
        mkdir($outputDir, 0777, true);
    }

    $content = <<<PHP
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class $seederName extends Seeder
{
    public function run()
    {
        // Añade datos de ejemplo aquí
    }
}
PHP;

    file_put_contents("$outputDir/{$seederName}.php", $content);
    echo "Seeder creado: $outputDir/{$seederName}.php\n";
}

/**
 * Generar Controlador
 */
function generateController($tableName)
{
    $controllerName = Str::studly(Str::singular($tableName)) . 'Controller';
    $outputDir = app_path('Http/Controllers');
    if (!is_dir($outputDir)) {
        mkdir($outputDir, 0777, true);
    }

    $content = <<<PHP
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class $controllerName extends Controller
{
    public function index()
    {
        //
    }
}
PHP;

    file_put_contents("$outputDir/{$controllerName}.php", $content);
    echo "Controlador creado: $outputDir/{$controllerName}.php\n";
}

/**
 * Generar Vistas
 */
function generateViews($tableName)
{
    $outputDir = resource_path("views/$tableName");
    if (!is_dir($outputDir)) {
        mkdir($outputDir, 0777, true);
    }

    $views = ['index', 'create', 'edit'];
    foreach ($views as $view) {
        file_put_contents("$outputDir/{$view}.blade.php", "<!-- Vista $view -->");
        echo "Vista $view creada: $outputDir/{$view}.blade.php\n";
    }
}
