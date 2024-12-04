#!/bin/bash

echo "Generando migraciones..."
php generate_migrations.php base_datos_basica.sql
if [ $? -ne 0 ]; then
    echo "Error generando migraciones"
    exit 1
fi

echo "Generando modelos..."
php generate_models.php base_datos_basica.sql
if [ $? -ne 0 ]; then
    echo "Error generando modelos"
    exit 1
fi

echo "Generando seeders..."
php generate_seeders.php base_datos_basica.sql
if [ $? -ne 0 ]; then
    echo "Error generando seeders"
    exit 1
fi

echo "Generando controladores..."
php generate_controllers.php base_datos_basica.sql
if [ $? -ne 0 ]; then
    echo "Error generando controladores"
    exit 1
fi

echo "Generando vistas..."
php generate_views.php base_datos_basica.sql
if [ $? -ne 0 ]; then
    echo "Error generando vistas"
    exit 1
fi

echo "Todos los componentes se generaron correctamente."
