USE recetario_test;

-- Insertar datos en la tabla `categorias`
INSERT INTO `categorias` (`nombre`) VALUES
('Postres'),
('Entrantes'),
('Platos principales'),
('Bebidas'),
('Aperitivos');

-- Insertar datos en la tabla `ingredientes`
INSERT INTO `ingredientes` (`nombre`) VALUES
('Azúcar'),
('Harina'),
('Huevos'),
('Leche'),
('Aceite de oliva'),
('Tomate'),
('Pimiento'),
('Pollo'),
('Ajo'),
('Pescado'),
('Patatas'),
('Espárragos'),
('Vino tinto'),
('Cerveza'),
('Frambuesas');

-- Insertar datos en la tabla `usuarios`
INSERT INTO `usuarios` (`nombre`, `email`, `password`) VALUES
('Juan Pérez', 'juanperez@gmail.com', '123456'),
('María López', 'maria@gmail.com', 'abcdef'),
('Carlos García', 'carlosg@yahoo.es', 'password123'),
('Ana Martínez', 'ana.martinez@outlook.com', 'qwerty'),
('Luis Sánchez', 'luis.sanchez@gmail.com', '12345');

-- Insertar datos en la tabla `recetas`
INSERT INTO `recetas` (`titulo`, `descripcion`, `pasos`, `categoria_id`, `usuario_id`) VALUES
('Tarta de manzana', 'Deliciosa tarta de manzana, perfecta para postres.', '1. Precalienta el horno. 2. Mezcla los ingredientes. 3. Coloca la mezcla en un molde. 4. Hornea durante 40 minutos.', 1, 1),
('Ensalada de tomate y pepino', 'Ensalada fresca y saludable.', '1. Lava los tomates y pepinos. 2. Corta los ingredientes. 3. Añade aceite, vinagre y sal al gusto.', 2, 2),
('Paella de marisco', 'La clásica receta de la paella de marisco', '1. Sofríe los mariscos. 2. Añade arroz y caldo. 3. Cocina durante 20 minutos.', 3, 3),
('Gazpacho andaluz', 'Sopa fría ideal para el verano.', '1. Lava los ingredientes. 2. Tritura los tomates, pepino, pimiento, ajo y cebolla. 3. Añade aceite y vinagre al gusto.', 2, 4),
('Tortilla española', 'La tradicional tortilla de patatas.', '1. Pela y corta las patatas. 2. Fríelas en aceite. 3. Bate los huevos y mezcla con las patatas. 4. Cocina a fuego bajo.', 3, 5);

-- Insertar datos en la tabla `receta_ingredientes`
INSERT INTO `receta_ingredientes` (`receta_id`, `ingrediente_id`, `cantidad`) VALUES
(1, 1, '200g'),
(1, 2, '250g'),
(1, 3, '3 unidades'),
(1, 4, '150ml'),
(2, 6, '4 unidades'),
(2, 7, '2 unidades'),
(2, 5, '30ml'),
(3, 8, '500g'),
(3, 6, '200g'),
(3, 9, '200g'),
(4, 6, '4 unidades'),
(4, 7, '1 unidad'),
(4, 10, '1 diente'),
(4, 11, '1 unidad'),
(5, 11, '500g'),
(5, 12, '5 unidades'),
(5, 3, '6 unidades');

-- Insertar datos en la tabla `comentarios`
INSERT INTO `comentarios` (`receta_id`, `usuario_id`, `comentario`, `puntuacion`) VALUES
(1, 1, 'Me encantó la tarta, muy fácil de hacer y deliciosa.', 5),
(2, 2, 'Una ensalada fresca, perfecta para el verano.', 4),
(3, 3, 'Muy buena receta de paella, aunque le falta un poco de sal.', 3),
(4, 4, 'El gazpacho está riquísimo, ideal para los días calurosos.', 5),
(5, 5, 'La tortilla de patatas salió perfecta, como la de la abuela.', 5);

-- Insertar datos en la tabla `favoritos`
INSERT INTO `favoritos` (`usuario_id`, `receta_id`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5);

