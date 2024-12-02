<?php

require 'vendor/autoload.php'; // Cargar dependencias de Laravel

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Database\Capsule\Manager as Capsule;

// Configurar el entorno de Laravel
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$outputDir = database_path('migrations'); // Carpeta donde se guardan las migraciones

// Verificar que se haya pasado un archivo SQL como argumento
if ($argc < 2) {
    die("Uso: php generate_and_migrate.php archivo.sql\n");
}

$sqlFile = $argv[1]; // Obtener el archivo SQL desde los argumentos

if (!file_exists($sqlFile)) {
    die("El archivo SQL no existe: $sqlFile\n");
}

// Ejecutar el archivo SQL en la base de datos de Laravel
try {
    $sql = file_get_contents($sqlFile);
    DB::unprepared($sql);
    echo "Archivo SQL ejecutado con éxito en la base de datos.\n";
} catch (Exception $e) {
    die("Error al ejecutar el archivo SQL: " . $e->getMessage());
}

// Obtener todas las tablas de la base de datos
$dbName = config('database.connections.mysql.database'); // Base de datos desde .env
$tables = DB::select("SHOW TABLES");
$tableKey = "Tables_in_{$dbName}"; // Clave de las tablas en el resultado de SHOW TABLES

foreach ($tables as $table) {
    $tableName = $table->$tableKey;
    echo "Generando migración para la tabla: $tableName...\n";

    // Obtener el esquema de la tabla
    $schema = DB::select("DESCRIBE `$tableName`");
    $migrationContent = createMigration($tableName, $schema);

    // Guardar el archivo de migración
    $fileName = date('Y_m_d_His') . "_create_{$tableName}_table.php";
    if (!file_exists($outputDir)) {
        mkdir($outputDir, 0777, true);
    }
    file_put_contents("$outputDir/$fileName", $migrationContent);
    echo "Migración creada: $outputDir/$fileName\n";
}

// Ejecutar las migraciones generadas
echo "Ejecutando migraciones...\n";
exec('php artisan migrate', $output, $returnVar);

if ($returnVar === 0) {
    echo "Migraciones ejecutadas con éxito.\n";
} else {
    echo "Error al ejecutar las migraciones. Detalles:\n";
    print_r($output);
}

/**
 * Crear el contenido de la migración basado en la tabla y esquema
 */
function createMigration($table, $schema)
{
    $className = Str::studly("create_{$table}_table");
    $columns = generateColumns($schema);

    return <<<EOT
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class {$className} extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('$table', function (Blueprint \$table) {
            \$table->id();
            $columns
            \$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('$table');
    }
}
EOT;
}

/**
 * Generar las columnas para la migración
 */
function generateColumns($schema)
{
    $columns = '';
    foreach ($schema as $column) {
        $field = $column->Field;
        $type = mapTypeToMigration($column->Type);
        $nullable = $column->Null === 'YES' ? '->nullable()' : '';
        $default = $column->Default !== null ? "->default('{$column['Default']}')" : '';
        $columns .= "\$table->$type('$field')$nullable$default;\n            ";
    }
    return $columns;
}

/**
 * Mapear tipos de MySQL a tipos de Laravel
 */
function mapTypeToMigration($type)
{
    if (str_contains($type, 'int')) return 'integer';
    if (str_contains($type, 'varchar')) return 'string';
    if (str_contains($type, 'text')) return 'text';
    if (str_contains($type, 'timestamp')) return 'timestamp';
    if (str_contains($type, 'date')) return 'date';
    if (str_contains($type, 'float') || str_contains($type, 'double')) return 'float';
    if (str_contains($type, 'decimal')) return 'decimal';
    return 'string'; // Por defecto
}
