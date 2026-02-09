-- Base de datos
DROP DATABASE IF EXISTS `productos`;
CREATE DATABASE `productos`
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_general_ci;

USE `productos`;

-- Tabla
DROP TABLE IF EXISTS `productos`;

CREATE TABLE `productos` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(100) NOT NULL,
  `descripcion` TEXT NULL,
  `precio` DECIMAL(10,2) NOT NULL,
  `fecha_creacion` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_general_ci;

-- Datos
INSERT INTO `productos` (`id`, `nombre`, `descripcion`, `precio`, `fecha_creacion`) VALUES
(8, 'asd', 'asd', 33.00, '2025-03-03 17:28:00');

-- Ajustar autoincrement al siguiente id
ALTER TABLE `productos` AUTO_INCREMENT = 9;
