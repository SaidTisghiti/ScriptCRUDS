<?php

require 'vendor/autoload.php'; // Cargar dependencias de Laravel

use Illuminate\Support\Str;

// Configurar el entorno de Laravel
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$outputDir = app_path('Http/Controllers'); // Carpeta donde se guardan los controladores
$routeFilePath = base_path('routes/web.php'); // Archivo de rutas

// Verificar que se haya pasado un archivo SQL como argumento
if ($argc < 2) {
    die("Uso: php generate_controllers.php archivo.sql\n");
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
        echo "Procesando controlador para la tabla: $table...\n";

        // Generar nombres del modelo y controlador
        $modelName = Str::studly(Str::singular($table));
        $controllerName = $modelName . 'Controller';
        $viewName = Str::snake($table);

        $controllerContent = createController($controllerName, $modelName, $viewName);

        // Guardar el archivo del controlador
        $fileName = "$outputDir/$controllerName.php";
        if (!file_exists($outputDir)) {
            mkdir($outputDir, 0777, true);
        }
        file_put_contents($fileName, $controllerContent);
        echo "Controlador creado: $fileName\n";

        // Registrar rutas automáticamente
        registerRoute($routeFilePath, $viewName, $controllerName);
    }

    echo "Controladores y rutas generados correctamente.\n";
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
            $tables[$tableName] = [];
            echo "Tabla detectada: $tableName\n";
        }
    }
    return $tables;
}

/**
 * Crear el contenido del controlador basado en el modelo y las vistas
 */
function createController($controllerName, $modelName, $viewName)
{
    return <<<EOT
<?php

namespace App\Http\Controllers;

use App\Models\\$modelName;
use Illuminate\Http\Request;

class $controllerName extends Controller
{
    public function index()
    {
        return view('$viewName.index', ['data' => $modelName::all()]);
    }

    public function create()
    {
        return view('$viewName.create');
    }

    public function store(Request \$request)
    {
        $modelName::create(\$request->all());
        return redirect()->route('$viewName.index');
    }

    public function show(\$id)
    {
        \$item = $modelName::findOrFail(\$id);
        return view('$viewName.show', compact('item'));
    }

    public function edit(\$id)
    {
        \$item = $modelName::findOrFail(\$id);
        return view('$viewName.edit', compact('item'));
    }

    public function update(Request \$request, \$id)
    {
        \$item = $modelName::findOrFail(\$id);
        \$item->update(\$request->all());
        return redirect()->route('$viewName.index');
    }

    public function destroy(\$id)
    {
        $modelName::destroy(\$id);
        return redirect()->route('$viewName.index');
    }
}
EOT;
}

/**
 * Registrar rutas en el archivo web.php
 */
function registerRoute($routeFilePath, $viewName, $controllerName)
{
    $routeDefinition = <<<EOT
Route::resource('$viewName', App\Http\Controllers\\$controllerName::class);
EOT;

    if (file_exists($routeFilePath)) {
        $currentRoutes = file_get_contents($routeFilePath);
        
        // Verificar si la ruta ya existe
        if (strpos($currentRoutes, $routeDefinition) === false) {
            file_put_contents($routeFilePath, "\n$routeDefinition\n", FILE_APPEND);
            echo "Ruta añadida para $viewName en $routeFilePath\n";
        } else {
            echo "La ruta para $viewName ya existe en $routeFilePath. No se añadió.\n";
        }
    } else {
        echo "Archivo de rutas no encontrado: $routeFilePath. Ruta no añadida.\n";
    }
}
