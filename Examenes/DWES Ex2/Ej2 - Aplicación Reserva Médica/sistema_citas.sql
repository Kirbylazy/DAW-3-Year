-- Usar la base de datos existente
USE sistema_citas;

-- Eliminar las tablas si existen (en orden inverso para respetar las restricciones de clave externa)
DROP TABLE IF EXISTS citas;
DROP TABLE IF EXISTS pacientes;
DROP TABLE IF EXISTS medicos;

-- Crear tabla de pacientes
CREATE TABLE pacientes (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL UNIQUE,
  clave VARCHAR(255) NOT NULL
);

-- Crear tabla de médicos
CREATE TABLE medicos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(100) NOT NULL,
  especialidad VARCHAR(50) NOT NULL,
  consulta VARCHAR(10) NOT NULL
);

-- Crear tabla de citas
CREATE TABLE citas (
  id INT AUTO_INCREMENT PRIMARY KEY,
  paciente_id INT NOT NULL,
  medico_id INT NOT NULL,
  fecha DATE DEFAULT CURRENT_DATE,
  activa BOOLEAN DEFAULT TRUE,
  motivo VARCHAR(255) NOT NULL,
  FOREIGN KEY (paciente_id) REFERENCES pacientes(id) ON DELETE CASCADE,
  FOREIGN KEY (medico_id) REFERENCES medicos(id) ON DELETE CASCADE
);

-- Insertar datos de médicos
INSERT INTO medicos (nombre, especialidad, consulta) VALUES
('Dr. García López', 'Medicina General', 'C101'),
('Dra. Martínez Ruiz', 'Pediatría', 'C102'),
('Dr. Rodríguez Sanz', 'Cardiología', 'C201'),
('Dra. Fernández Díaz', 'Dermatología', 'C202');
COMMIT;