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
    FOREIGN KEY (user_id) REFERENCES new_users(id) ON DELETE CASCADE
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
    FOREIGN KEY (user_id) REFERENCES new_users(id) ON DELETE CASCADE
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


