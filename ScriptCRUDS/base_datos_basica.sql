-- Create the database
CREATE DATABASE IF NOT EXISTS CarDealership;
USE CarDealership;

-- Cars table
CREATE TABLE cars (
    id INT AUTO_INCREMENT PRIMARY KEY,
    brand VARCHAR(50) NOT NULL,
    model VARCHAR(50) NOT NULL,
    year INT NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    color VARCHAR(20),
    stock INT NOT NULL
);

-- Example data for cars
INSERT INTO cars (brand, model, year, price, color, stock) VALUES
('Toyota', 'Corolla', 2021, 20000.00, 'Red', 5),
('Ford', 'Focus', 2020, 18000.00, 'Blue', 3),
('BMW', 'Series 3', 2022, 35000.00, 'Black', 2),
('Honda', 'Civic', 2021, 22000.00, 'White', 4),
('Audi', 'A4', 2023, 40000.00, 'Gray', 1);

-- Customers table
CREATE TABLE customers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    phone VARCHAR(15),
    address TEXT
);

-- Example data for customers
INSERT INTO customers (name, email, phone, address) VALUES
('John Smith', 'john.smith@example.com', '123456789', '123 Fake Street, New York'),
('Mary Johnson', 'mary.johnson@example.com', '987654321', '456 Central Avenue, Los Angeles'),
('Carlos Brown', 'carlos.brown@example.com', '654321987', '789 Sunshine Street, Miami');

-- Employees table
CREATE TABLE employees (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    position VARCHAR(50) NOT NULL,
    salary DECIMAL(10, 2) NOT NULL
);

-- Example data for employees
INSERT INTO employees (name, position, salary) VALUES
('Luis Fernandez', 'Salesperson', 2500.00),
('Ana Sanchez', 'Manager', 4000.00),
('Pedro Morales', 'Mechanic', 3000.00);

-- Sales table
CREATE TABLE sales (
    id INT AUTO_INCREMENT PRIMARY KEY,
    car_id INT NOT NULL,
    customer_id INT NOT NULL,
    employee_id INT NOT NULL,
    date DATE NOT NULL,
    quantity INT NOT NULL,
    total DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (car_id) REFERENCES cars(id),
    FOREIGN KEY (customer_id) REFERENCES customers(id),
    FOREIGN KEY (employee_id) REFERENCES employees(id)
);

-- Example data for sales
INSERT INTO sales (car_id, customer_id, employee_id, date, quantity, total) VALUES
(1, 1, 1, '2024-01-15', 1, 20000.00),
(3, 2, 2, '2024-02-10', 1, 35000.00),
(2, 3, 1, '2024-03-05', 1, 18000.00);

-- Maintenance table
CREATE TABLE maintenance (
    id INT AUTO_INCREMENT PRIMARY KEY,
    car_id INT NOT NULL,
    employee_id INT NOT NULL,
    description TEXT NOT NULL,
    date DATE NOT NULL,
    cost DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (car_id) REFERENCES cars(id),
    FOREIGN KEY (employee_id) REFERENCES employees(id)
);

-- Example data for maintenance
INSERT INTO maintenance (car_id, employee_id, description, date, cost) VALUES
(1, 3, 'Oil and filter change', '2024-01-20', 150.00),
(2, 3, 'Brake inspection', '2024-02-15', 200.00),
(3, 3, 'Tire replacement', '2024-03-01', 400.00);
