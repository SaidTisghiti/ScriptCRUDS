<?php

// Verificar si se proporcionó el archivo SQL como argumento
if ($argc < 2) {
    echo "Uso: php generar.php archivo.sql\n";
    exit(1);
}

$sqlFile = $argv[1];

// Verificar si el archivo SQL existe
if (!file_exists($sqlFile)) {
    echo "El archivo $sqlFile no existe. Intenta nuevamente.\n";
    exit(1);
}

// Función para ejecutar comandos y validar su salida
function ejecutarComando($comando, $descripcion)
{
    echo "Ejecutando: $descripcion...\n";
    $salida = null;
    $estado = null;
    exec($comando, $salida, $estado);

    if ($estado !== 0) {
        echo "Error ejecutando $descripcion.\n";
        exit($estado);
    }

    echo "$descripcion completado correctamente.\n";
}

// Mostrar menú interactivo
do {
    echo "==============================\n";
    echo "       Generador de CRUD      \n";
    echo "==============================\n";
    echo "1. Generar Migraciones\n";
    echo "2. Generar Modelos\n";
    echo "3. Generar Seeders\n";
    echo "4. Generar Controladores\n";
    echo "5. Generar Vistas\n";
    echo "6. Generar Todo\n";
    echo "0. Salir\n";
    echo "==============================\n";
    echo "Selecciona una opción: ";
    $opcion = trim(fgets(STDIN));

    switch ($opcion) {
        case '1':
            ejecutarComando("php generate_migrations.php $sqlFile", "Migraciones");
            break;
        case '2':
            ejecutarComando("php generate_models.php $sqlFile", "Modelos");
            break;
        case '3':
            ejecutarComando("php generate_seeders.php $sqlFile", "Seeders");
            break;
        case '4':
            ejecutarComando("php generate_controllers.php $sqlFile", "Controladores");
            break;
        case '5':
            ejecutarComando("php generate_views.php $sqlFile", "Vistas");
            break;
        case '6':
            echo "Generando todos los componentes...\n";
            ejecutarComando("php generate_migrations.php $sqlFile", "Migraciones");
            ejecutarComando("php generate_models.php $sqlFile", "Modelos");
            ejecutarComando("php generate_seeders.php $sqlFile", "Seeders");
            ejecutarComando("php generate_controllers.php $sqlFile", "Controladores");
            ejecutarComando("php generate_views.php $sqlFile", "Vistas");
            break;
        case '0':
            echo "Saliendo...\n";
            exit(0);
        default:
            echo "Opción no válida. Intenta nuevamente.\n";
    }

    echo "\n";

} while (true);
