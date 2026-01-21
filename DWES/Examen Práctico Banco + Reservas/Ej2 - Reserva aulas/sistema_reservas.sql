-- Crear la base de datos
CREATE DATABASE IF NOT EXISTS sistema_reservas;
USE sistema_reservas;

-- Crear tabla de profesores
CREATE TABLE IF NOT EXISTS profesores (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL
);

-- Crear tabla de aulas
CREATE TABLE IF NOT EXISTS aulas (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(50) NOT NULL,
  capacidad INT NOT NULL
);

-- Crear tabla de reservas
CREATE TABLE IF NOT EXISTS reservas (
  id INT AUTO_INCREMENT PRIMARY KEY,
  profesor_id INT NOT NULL,
  aula_id INT NOT NULL,
  fecha DATE DEFAULT CURRENT_DATE,
  reservada BOOLEAN DEFAULT TRUE,
  motivo VARCHAR(255) NOT NULL,
  FOREIGN KEY (profesor_id) REFERENCES profesores(id) ON DELETE CASCADE,
  FOREIGN KEY (aula_id) REFERENCES aulas(id) ON DELETE CASCADE
);

INSERT INTO aulas (nombre, capacidad) VALUES
('Aula 101', 30),
('Aula 102', 25),
('Laboratorio', 20),
('Salón de Actos', 100);