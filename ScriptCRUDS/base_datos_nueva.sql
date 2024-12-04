-- Crear base de datos
CREATE DATABASE IF NOT EXISTS nueva_base_datos DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE nueva_base_datos;

-- Tabla de clientes
CREATE TABLE clients (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Tabla de productos
CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    price DECIMAL(10, 2) NOT NULL,
    stock INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Tabla de pedidos
CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    client_id INT NOT NULL,
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    total_price DECIMAL(10, 2) NOT NULL,
    status ENUM('pending', 'completed', 'cancelled') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (client_id) REFERENCES clients(id) ON DELETE CASCADE
);

-- Tabla de detalles de pedidos
CREATE TABLE order_details (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
);

-- Insertar datos de ejemplo en la tabla de clientes
INSERT INTO clients (name, email, password) VALUES
('John Doe', 'johndoe@example.com', 'password_encriptada'),
('Jane Doe', 'janedoe@example.com', 'password_encriptada');

-- Insertar datos de ejemplo en la tabla de productos
INSERT INTO products (name, description, price, stock) VALUES
('Laptop', 'A high-performance laptop', 1200.99, 10),
('Smartphone', 'A latest-gen smartphone', 800.50, 20),
('Headphones', 'Noise-cancelling headphones', 199.99, 30);

-- Insertar datos de ejemplo en la tabla de pedidos
INSERT INTO orders (client_id, total_price, status) VALUES
(1, 1999.99, 'completed'),
(2, 800.50, 'pending');

-- Insertar datos de ejemplo en la tabla de detalles de pedidos
INSERT INTO order_details (order_id, product_id, quantity, price) VALUES
(1, 1, 1, 1200.99),
(1, 3, 4, 199.99),
(2, 2, 1, 800.50);
