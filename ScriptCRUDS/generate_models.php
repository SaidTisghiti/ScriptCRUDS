<?php

require 'vendor/autoload.php'; // Cargar dependencias de Laravel

use Illuminate\Support\Facades\File;

// Configurar el entorno de Laravel
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$outputDir = app_path('Models'); // Carpeta donde se guardarán los modelos

// Verificar que se haya pasado un archivo SQL como argumento
if ($argc < 2) {
    die("Uso: php generate_models.php archivo.sql\n");
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
        echo "Procesando modelo para la tabla: $table...\n";

        // Crear el contenido del modelo
        $modelContent = createModel($table, $schema, $tables);

        // Guardar el nuevo archivo del modelo
        $modelName = ucfirst(Str::camel(Str::singular($table))); // Formatear el nombre del modelo
        if (!file_exists($outputDir)) {
            mkdir($outputDir, 0777, true);
        }
        $filePath = "$outputDir/$modelName.php";
        file_put_contents($filePath, $modelContent);
        echo "Modelo creado: $filePath\n";
    }

    echo "Modelos generados correctamente.\n";
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
 * Crear el contenido del modelo basado en la tabla y esquema
 */
function createModel($table, $schema, $allTables)
{
    $modelName = ucfirst(Str::camel(Str::singular($table))); // Nombre del modelo
    $fillableColumns = detectFillableColumns($schema);
    $relationships = generateRelationships($table, $schema, $allTables);

    return <<<EOT
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class $modelName extends Model
{
    use HasFactory;

    protected \$table = '$table'; // Tabla asociada

    protected \$fillable = [
        $fillableColumns
    ];

    $relationships
}
EOT;
}

/**
 * Detecta columnas asignables masivamente.
 */
function detectFillableColumns($schema)
{
    $columns = [];
    foreach ($schema as $column) {
        if (preg_match('/`?(\w+)`?\s+\w+/i', $column, $matches)) {
            $field = $matches[1];
            
            // Omitir columnas no válidas en $fillable
            if (strtolower($field) === 'foreign') {
                continue;
            }

            $columns[] = "'{$field}'";
        }
    }
    return implode(",\n        ", $columns);
}

/**
 * Genera relaciones Eloquent basadas en claves foráneas.
 */
function generateRelationships($table, $schema, $allTables)
{
    $relationships = '';

    foreach ($schema as $column) {
        if (preg_match('/FOREIGN KEY\s*\((\w+)\)\s*REFERENCES\s*(\w+)\((\w+)\)/i', $column, $matches)) {
            $localKey = $matches[1];
            $foreignTable = $matches[2];
            $foreignKey = $matches[3];

            $relatedModel = ucfirst(Str::camel(Str::singular($foreignTable)));

            // Relación belongsTo
            $relationships .= <<<EOT

    public function $relatedModel()
    {
        return \$this->belongsTo($relatedModel::class, '$localKey', '$foreignKey');
    }
EOT;
        }
    }

    // Relación hasMany (inversas)
    foreach ($allTables as $relatedTable => $relatedSchema) {
        foreach ($relatedSchema as $relatedColumn) {
            if (preg_match("/FOREIGN KEY\s*\((\w+)\)\s*REFERENCES\s*`?$table`?\(`?id`?\)/i", $relatedColumn)) {
                $relatedModel = ucfirst(Str::camel(Str::singular($relatedTable)));
                $relationships .= <<<EOT

    public function {$relatedTable}()
    {
        return \$this->hasMany($relatedModel::class, '{$table}_id', 'id');
    }
EOT;
            }
        }
    }

    return $relationships;
}
