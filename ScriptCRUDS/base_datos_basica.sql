-- Tabla de usuarios
CREATE TABLE new_users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Tabla de publicaciones
CREATE TABLE posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    title VARCHAR(200) NOT NULL,
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Tabla de comentarios
CREATE TABLE comments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    post_id INT NOT NULL,
    user_id INT NOT NULL,
    comment TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (post_id) REFERENCES posts(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE all_data_types (
    id INT AUTO_INCREMENT PRIMARY KEY,         -- Entero con autoincremento
    tinyint_col TINYINT NOT NULL,              -- Número pequeño (1 byte)
    smallint_col SMALLINT NOT NULL,            -- Número pequeño (2 bytes)
    mediumint_col MEDIUMINT NOT NULL,          -- Número mediano (3 bytes)
    int_col INT NOT NULL,                      -- Número entero (4 bytes)
    bigint_col BIGINT NOT NULL,                -- Número grande (8 bytes)

    decimal_col DECIMAL(10, 2) NOT NULL,       -- Decimal (número con precisión fija)
    float_col FLOAT NOT NULL,                  -- Número de coma flotante (precisión simple)
    double_col DOUBLE NOT NULL,                -- Número de coma flotante (precisión doble)

    char_col CHAR(10) NOT NULL,                -- Cadena fija (10 caracteres)
    varchar_col VARCHAR(255) NOT NULL,         -- Cadena variable (máx. 255 caracteres)
    text_col TEXT NOT NULL,                    -- Cadena larga de texto
    blob_col BLOB,                             -- Datos binarios (binario largo)

    date_col DATE NOT NULL,                    -- Fecha
    datetime_col DATETIME NOT NULL,            -- Fecha y hora
    timestamp_col TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Fecha y hora con autoactualización
    time_col TIME NOT NULL,                    -- Hora
    year_col YEAR NOT NULL,                    -- Año

    enum_col ENUM('small', 'medium', 'large') DEFAULT 'medium', -- Enumeración
    set_col SET('a', 'b', 'c', 'd') NOT NULL,   -- Conjunto de valores

    json_col JSON,                             -- Datos JSON
    spatial_col GEOMETRY                      -- Datos espaciales
);


-- Insertar datos de ejemplo en la tabla de usuarios
INSERT INTO users (name, email, password) VALUES
('Admin', 'admin@example.com', 'password_encriptada'),
('Usuario1', 'usuario1@example.com', 'password_encriptada'),
('Usuario2', 'usuario2@example.com', 'password_encriptada');

-- Insertar datos de ejemplo en la tabla de publicaciones
INSERT INTO posts (user_id, title, content) VALUES
(1, 'Primer Post', 'Contenido del primer post'),
(2, 'Segundo Post', 'Contenido del segundo post'),
(3, 'Tercer Post', 'Contenido del tercer post');

-- Insertar datos de ejemplo en la tabla de comentarios
INSERT INTO comments (post_id, user_id, comment) VALUES
(1, 2, 'Comentario en el primer post'),
(1, 3, 'Otro comentario en el primer post'),
(2, 1, 'Comentario en el segundo post');

INSERT INTO all_data_types (
    tinyint_col, smallint_col, mediumint_col, int_col, bigint_col,
    decimal_col, float_col, double_col,
    char_col, varchar_col, text_col, blob_col,
    date_col, datetime_col, timestamp_col, time_col, year_col,
    enum_col, set_col, json_col, spatial_col
)
VALUES (
    127, 32767, 8388607, 2147483647, 9223372036854775807,
    99999.99, 123.45, 678.90,
    'charvalue', 'varcharvalue', 'text value example', NULL,
    '2024-01-01', '2024-01-01 12:34:56', CURRENT_TIMESTAMP, '12:34:56', 2024,
    'medium', 'a,b,c', '{"key": "value"}', NULL
);

