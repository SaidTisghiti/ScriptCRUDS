-- Crear base de datos
CREATE DATABASE IF NOT EXISTS mi_base_de_datos DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE mi_base_de_datos;

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

-- Insertar datos de ejemplo en la tabla de usuarios
INSERT INTO new_users (name, email, password) VALUES
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
