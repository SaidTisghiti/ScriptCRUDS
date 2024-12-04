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

    foreach ($tables as $table => $schema) {
        echo "Procesando migración para la tabla: $table...\n";

        // Buscar y eliminar migración existente
        deleteExistingMigration($outputDir, $table);

        // Crear el contenido de la nueva migración
        $migrationContent = createMigration($table, $schema);

        // Guardar el nuevo archivo de migración
        $fileName = date('Y_m_d_His') . "_create_{$table}_table.php";
        if (!file_exists($outputDir)) {
            mkdir($outputDir, 0777, true);
        }
        file_put_contents("$outputDir/$fileName", $migrationContent);
        echo "Nueva migración creada: $outputDir/$fileName\n";
        sleep(1); // Evitar conflictos de timestamps
    }

    echo "Migraciones generadas correctamente. Ejecuta 'php artisan migrate' para aplicarlas.\n";
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
            $schema = explode(",", $matches[2]);
            $tables[$tableName] = array_map('trim', $schema);
            echo "Tabla detectada: $tableName\n";
        }
    }
    return $tables;
}

/**
 * Crear el contenido de la migración basado en la tabla y esquema
 */
function createMigration($table, $schema)
{
    $columns = generateColumns($schema);
    $foreignKeys = generateForeignKeys($schema);

    return <<<EOT
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('$table', function (Blueprint \$table) {
            \$table->id(); // Clave primaria automática
            $columns
            $foreignKeys
            \$table->timestamps(); // created_at y updated_at automáticos
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('$table');
    }
};
EOT;
}

/**
 * Generar las columnas para la migración
 */
function generateColumns($schema)
{
    $columns = '';
    $seenColumns = [];

    foreach ($schema as $column) {
        if (preg_match('/`?(\w+)`?\s+([\w\(\),\s]+)(,|$)/', $column, $matches)) {
            $field = $matches[1];

            if (strtolower($field) === 'foreign') continue;

            // Ignorar duplicados de 'id' si ya se manejó como clave primaria
            if (strtolower($field) === 'id') continue;

            // Ignorar created_at y updated_at explícitos (se reemplazan por timestamps())
            if (in_array(strtolower($field), ['created_at', 'updated_at'])) continue;

            if (in_array($field, $seenColumns)) continue;

            $seenColumns[] = $field;
            $typeDefinition = $matches[2];
            $type = mapTypeToMigration($typeDefinition);

            // Ajustar claves foráneas para que sean unsignedBigInteger
            if (preg_match('/_id$/', $field)) {
                $type = 'unsignedBigInteger';
            }

            $nullable = stripos($typeDefinition, 'NOT NULL') === false ? '->nullable()' : '';
            $unique = stripos($typeDefinition, 'UNIQUE') !== false ? '->unique()' : '';
            $columns .= "\$table->$type('$field')$nullable$unique;\n            ";
        }
    }
    return $columns;
}

/**
 * Generar claves foráneas para la migración
 */
function generateForeignKeys($schema)
{
    $foreignKeys = '';
    foreach ($schema as $column) {
        if (preg_match('/FOREIGN KEY\s*\((\w+)\)\s*REFERENCES\s*(\w+)\((\w+)\)/i', $column, $matches)) {
            $localKey = $matches[1];
            $foreignTable = $matches[2];
            $foreignKey = $matches[3];

            // Asegurarse de que las claves foráneas sean unsignedBigInteger
            $foreignKeys .= "\$table->foreign('$localKey')->references('$foreignKey')->on('$foreignTable')->onDelete('cascade');\n            ";
        }
    }
    return $foreignKeys;
}

/**
 * Mapear tipos de MySQL a tipos de Laravel
 */
function mapTypeToMigration($type)
{
    $type = strtolower($type);

    if (str_contains($type, 'tinyint')) return 'tinyInteger';
    if (str_contains($type, 'smallint')) return 'smallInteger';
    if (str_contains($type, 'mediumint')) return 'mediumInteger';
    if (str_contains($type, 'int')) return 'integer';
    if (str_contains($type, 'bigint')) return 'bigInteger';
    if (str_contains($type, 'decimal')) return 'decimal';
    if (str_contains($type, 'float')) return 'float';
    if (str_contains($type, 'double')) return 'double';
    if (str_contains($type, 'char')) return 'string';
    if (str_contains($type, 'varchar')) return 'string';
    if (str_contains($type, 'text')) return 'text';
    if (str_contains($type, 'blob')) return 'binary';
    if (str_contains($type, 'date')) return 'date';
    if (str_contains($type, 'datetime')) return 'dateTime';
    if (str_contains($type, 'timestamp')) return 'timestamp';
    if (str_contains($type, 'time')) return 'time';
    if (str_contains($type, 'year')) return 'year';
    if (str_contains($type, 'json')) return 'json';
    if (str_contains($type, 'geometry')) return 'geometry';
    if (str_contains($type, 'enum')) return 'enum';
    return 'string';
}

/**
 * Buscar y eliminar migración existente para una tabla
 */
function deleteExistingMigration($outputDir, $table)
{
    $migrationFiles = scandir($outputDir);
    foreach ($migrationFiles as $file) {
        if (str_contains($file, "create_{$table}_table")) {
            unlink("$outputDir/$file");
            echo "Migración existente eliminada: $outputDir/$file\n";
        }
    }
}

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

    foreach ($tables as $table => $schema) {
        echo "Procesando migración para la tabla: $table...\n";

        // Buscar y eliminar migración existente
        deleteExistingMigration($outputDir, $table);

        // Crear el contenido de la nueva migración
        $migrationContent = createMigration($table, $schema);

        // Guardar el nuevo archivo de migración
        $fileName = date('Y_m_d_His') . "_create_{$table}_table.php";
        if (!file_exists($outputDir)) {
            mkdir($outputDir, 0777, true);
        }
        file_put_contents("$outputDir/$fileName", $migrationContent);
        echo "Nueva migración creada: $outputDir/$fileName\n";
        sleep(1); // Evitar conflictos de timestamps
    }

    echo "Migraciones generadas correctamente. Ejecuta 'php artisan migrate' para aplicarlas.\n";
} catch (Exception $e) {
    die("Error al procesar el archivo SQL: " . $e->getMessage() . "\n");
}

/**
 * Eliminar comentarios del archivo SQL
 */
function removeCommentsFromSQL($sql)
{
    // Eliminar comentarios de línea (-- y #)
    $sql = preg_replace('/(--.*?$)|(#.*?$)/m', '', $sql);

    // Eliminar comentarios en bloque (/* */)
    $sql = preg_replace('/\/\*.*?\*\//s', '', $sql);

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

        // Intentar extraer las tablas con CREATE TABLE
        if (preg_match('/CREATE TABLE\s+`?(\w+)`?\s*\((.+)\)/si', $query, $matches)) {
            $tableName = $matches[1];
            $schema = explode(",", $matches[2]);
            $tables[$tableName] = array_map('trim', $schema);
            echo "Tabla detectada: $tableName\n"; // Depuración
        }
    }
    return $tables;
}

/**
 * Crear el contenido de la migración basado en la tabla y esquema
 */
function createMigration($table, $schema)
{
    // Detectar si la columna 'id' ya existe
    $hasIdColumn = hasIdColumn($schema);

    $columns = generateColumns($schema, $hasIdColumn);
    $foreignKeys = generateForeignKeys($schema);

    $idLine = $hasIdColumn ? "\$table->id(); // Clave primaria automática\n            " : '';

    return <<<EOT
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('$table', function (Blueprint \$table) {
            $idLine$columns
            $foreignKeys
            \$table->timestamps(); // created_at y updated_at automáticos
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('$table');
    }
};
EOT;
}

/**
 * Verificar si el esquema ya incluye una columna 'id'
 */
function hasIdColumn($schema)
{
    foreach ($schema as $column) {
        if (preg_match('/`?id`?\s+/', strtolower($column))) {
            return true; // Existe una columna 'id'
        }
    }
    return false;
}

/**
 * Generar las columnas para la migración
 */
function generateColumns($schema, $hasIdColumn)
{
    $columns = '';
    $seenColumns = []; // Para rastrear columnas ya agregadas

    foreach ($schema as $column) {
        if (preg_match('/`?(\w+)`?\s+([\w\(\),\s]+)(,|$)/', $column, $matches)) {
            $field = $matches[1];

            // Ignorar columnas FOREIGN innecesarias
            if (strtolower($field) === 'foreign') {
                continue;
            }

            // Reemplazar created_at y updated_at con timestamps
            if (strtolower($field) === 'created_at' || strtolower($field) === 'updated_at') {
                continue;
            }

            // Ignorar 'id' adicional si $table->id() ya se usó
            if (strtolower($field) === 'id' && $hasIdColumn) {
                continue;
            }

            // Evitar duplicación de columnas
            if (in_array($field, $seenColumns)) {
                continue;
            }

            // Añadir el campo a las columnas vistas
            $seenColumns[] = $field;

            $typeDefinition = $matches[2];
            $type = mapTypeToMigration($typeDefinition);

            // Configurar claves foráneas con unsignedBigInteger
            if (str_contains(strtolower($field), '_id')) {
                $type = 'unsignedBigInteger';
            }

            $nullable = stripos($typeDefinition, 'NOT NULL') === false ? '->nullable()' : '';
            $unique = stripos($typeDefinition, 'UNIQUE') !== false ? '->unique()' : '';
            $columns .= "\$table->$type('$field')$nullable$unique;\n            ";
        }
    }
    return $columns;
}

/**
 * Generar claves foráneas para la migración
 */
function generateForeignKeys($schema)
{
    $foreignKeys = '';
    foreach ($schema as $column) {
        if (preg_match('/FOREIGN KEY\s*\((\w+)\)\s*REFERENCES\s*(\w+)\((\w+)\)/i', $column, $matches)) {
            $localKey = $matches[1];
            $foreignTable = $matches[2];
            $foreignKey = $matches[3];
            $foreignKeys .= "\$table->foreign('$localKey')->references('$foreignKey')->on('$foreignTable')->onDelete('cascade');\n            ";
        }
    }
    return $foreignKeys;
}

/**
 * Mapear tipos de MySQL a tipos de Laravel
 */
function mapTypeToMigration($type)
{
    if (str_contains($type, 'tinyint')) return 'tinyInteger';
    if (str_contains($type, 'smallint')) return 'smallInteger';
    if (str_contains($type, 'mediumint')) return 'mediumInteger';
    if (str_contains($type, 'int')) return 'integer';
    if (str_contains($type, 'bigint')) return 'bigInteger';
    if (str_contains($type, 'decimal')) return 'decimal';
    if (str_contains($type, 'float')) return 'float';
    if (str_contains($type, 'double')) return 'double';
    if (str_contains($type, 'char')) return 'char';
    if (str_contains($type, 'varchar')) return 'string';
    if (str_contains($type, 'text')) return 'text';
    if (str_contains($type, 'blob')) return 'binary';
    if (str_contains($type, 'date')) return 'date';
    if (str_contains($type, 'datetime')) return 'dateTime';
    if (str_contains($type, 'timestamp')) return 'timestamp';
    if (str_contains($type, 'time')) return 'time';
    if (str_contains($type, 'year')) return 'year';
    if (str_contains($type, 'json')) return 'json';
    if (str_contains($type, 'geometry')) return 'geometry';
    if (str_contains($type, 'enum')) return 'enum';
    return 'string'; // Por defecto
}

/**
 * Buscar y eliminar migración existente para una tabla
 */
function deleteExistingMigration($outputDir, $table)
{
    $migrationFiles = scandir($outputDir);

    foreach ($migrationFiles as $file) {
        if (str_contains($file, "create_{$table}_table")) {
            unlink("$outputDir/$file");
            echo "Migración existente eliminada: $outputDir/$file\n";
        }
    }
}
function generateSeeder($tableName, $exampleData) {
    $seederFileName = "{$tableName}Seeder.php";
    $outputDir = __DIR__ . '/database/seeders/';
    if (!is_dir($outputDir)) {
        mkdir($outputDir, 0777, true);
    }

    $dataInsertions = '';
    foreach ($exampleData as $row) {
        $dataInsertions .= "\t\t\t['" . implode("', '", $row) . "'],\n";
    }

    $seederTemplate = <<<PHP
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class {$tableName}Seeder extends Seeder
{
    public function run()
    {
        DB::table('{$tableName}')->insert([
$dataInsertions
        ]);
    }
}
PHP;

    File::put($outputDir . $seederFileName, $seederTemplate);
    echo "Seeder for {$tableName} created at {$outputDir}{$seederFileName}\n";
}

function generateController($tableName) {
    $controllerName = Str::studly(Str::singular($tableName)) . 'Controller';
    $outputDir = __DIR__ . '/app/Http/Controllers/';
    if (!is_dir($outputDir)) {
        mkdir($outputDir, 0777, true);
    }

    $controllerTemplate = <<<PHP
<?php

namespace App\Http\Controllers;

use App\Models\\{$tableName};
use Illuminate\Http\Request;

class {$controllerName} extends Controller
{
    public function index()
    {
        return view('{$tableName}.index', ['data' => {$tableName}::all()]);
    }

    public function create()
    {
        return view('{$tableName}.create');
    }

    public function store(Request \$request)
    {
        {$tableName}::create(\$request->all());
        return redirect()->route('{$tableName}.index');
    }

    public function edit(\$id)
    {
        \$item = {$tableName}::findOrFail(\$id);
        return view('{$tableName}.edit', compact('item'));
    }

    public function update(Request \$request, \$id)
    {
        \$item = {$tableName}::findOrFail(\$id);
        \$item->update(\$request->all());
        return redirect()->route('{$tableName}.index');
    }

    public function destroy(\$id)
    {
        {$tableName}::destroy(\$id);
        return redirect()->route('{$tableName}.index');
    }
}
PHP;

    File::put($outputDir . $controllerName . '.php', $controllerTemplate);
    echo "Controller for {$tableName} created at {$outputDir}{$controllerName}.php\n";
}

function generateViews($tableName) {
    $outputDir = __DIR__ . "/resources/views/{$tableName}/";
    if (!is_dir($outputDir)) {
        mkdir($outputDir, 0777, true);
    }

    $views = ['index', 'create', 'edit'];
    foreach ($views as $view) {
        File::put($outputDir . "{$view}.blade.php", "<!-- {$view} view for {$tableName} -->");
        echo "View {$view} for {$tableName} created at {$outputDir}{$view}.blade.php\n";
    }
}

// Leer el archivo SQL
$sqlContent = file_get_contents('base_datos_basica.sql');
$tables = parseSQL($sqlContent);

// Generar archivos para cada tabla
foreach ($tables as $tableName => $columns) {
    generateMigration($tableName, $columns);
    generateSeeder($tableName, []);
    generateController($tableName);
    generateViews($tableName);
}
