-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-11-2024 a las 22:52:37
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `marketcucei`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

CREATE TABLE `citas` (
  `id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `id_vendedor` int(11) DEFAULT NULL,
  `id_comprador` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `citas`
--

INSERT INTO `citas` (`id`, `fecha`, `id_vendedor`, `id_comprador`) VALUES
(2, '2024-09-25', 2, 2),
(3, '2024-09-26', 3, 3),
(4, '2024-09-27', 4, 4),
(5, '2024-09-28', 5, 5),
(6, '2024-09-29', 6, 6),
(7, '2024-09-30', 7, 7),
(8, '2024-10-01', 8, 8),
(9, '2024-10-02', 9, 9),
(10, '2024-10-03', 10, 10),
(11, '2024-10-04', 11, 11),
(12, '2024-10-05', 12, 12),
(13, '2024-10-06', 13, 13),
(14, '2024-10-07', 14, 14),
(15, '2024-10-08', 15, 15),
(16, '2024-10-09', 1, 2),
(17, '2024-09-23', 1, 2),
(18, '2024-10-13', 2, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comprador`
--

CREATE TABLE `comprador` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contraseña` varchar(100) NOT NULL,
  `archivo` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `baja` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `comprador`
--

INSERT INTO `comprador` (`id`, `nombre`, `email`, `contraseña`, `archivo`, `baja`) VALUES
(1, 'Emmanuel', 'emma@example.com', '12345', NULL, 0),
(2, 'Citlali Velez', 'citlali@example.com', '3456', NULL, 0),
(3, 'Raul Sanchez', 'raul@example.com', 'raulpwd', NULL, 0),
(4, 'Gloria Fuentes', 'gloria@example.com', 'gloria123', NULL, 0),
(5, 'Samuel Torres', 'samuel@example.com', 'samu1234', NULL, 0),
(6, 'Valeria Jimenez', 'valeria@example.com', 'valeria!', NULL, 0),
(7, 'Andres Nunez', 'andres@example.com', 'passandres', NULL, 0),
(8, 'Patricia Ramos', 'patricia@example.com', 'patty2024', NULL, 0),
(9, 'Ricardo Soto', 'ricardo@example.com', 'ricardo!23', NULL, 0),
(10, 'Laura Cruz', 'laura@example.com', 'laurapwd', NULL, 0),
(11, 'Tomas Herrera', 'tomas@example.com', 'tomas789', NULL, 0),
(12, 'Ana Medina', 'ana.medina@example.com', 'anapwd', NULL, 0),
(13, 'Beto Calderon', 'beto@example.com', 'betopass', NULL, 0),
(14, 'Carmen Pineda', 'carmen@example.com', 'carmen123', NULL, 0),
(15, 'Oscar Velasco', 'oscar@example.com', 'oscar456', NULL, 0),
(16, 'Silvia Morales', 'silvia@example.com', 'silvia!pw', NULL, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallescita`
--

CREATE TABLE `detallescita` (
  `id` int(11) NOT NULL,
  `id_cita` int(11) DEFAULT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detallescita`
--

INSERT INTO `detallescita` (`id`, `id_cita`, `id_producto`, `cantidad`, `precio`) VALUES
(3, 2, 3, 1, 300.00),
(4, 3, 4, 1, 500.00),
(5, 4, 5, 1, 100.00),
(6, 5, 6, 1, 40.00),
(7, 6, 7, 1, 150.00),
(8, 7, 8, 1, 80.00),
(9, 8, 9, 1, 120.00),
(10, 9, 10, 1, 250.00),
(11, 10, 11, 1, 500.00),
(12, 11, 12, 1, 200.00),
(13, 12, 13, 1, 600.00),
(14, 13, 14, 1, 150.00),
(15, 14, 15, 1, 15.00),
(16, 17, 3, 1, 200.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallesventa`
--

CREATE TABLE `detallesventa` (
  `id` int(11) NOT NULL,
  `id_venta` int(11) DEFAULT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detallesventa`
--

INSERT INTO `detallesventa` (`id`, `id_venta`, `id_producto`, `cantidad`, `precio`) VALUES
(1, 1, 1, 1, 1500.00),
(2, 1, 2, 1, 800.00),
(3, 2, 3, 1, 300.00),
(4, 3, 4, 1, 500.00),
(5, 4, 5, 1, 100.00),
(6, 5, 6, 1, 40.00),
(7, 6, 7, 1, 150.00),
(8, 7, 8, 1, 80.00),
(9, 8, 9, 1, 120.00),
(10, 9, 10, 1, 250.00),
(11, 10, 11, 1, 500.00),
(12, 11, 12, 1, 200.00),
(13, 12, 13, 1, 600.00),
(14, 13, 14, 1, 150.00),
(15, 14, 15, 1, 15.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evento`
--

CREATE TABLE `evento` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `evento`
--

INSERT INTO `evento` (`id`, `nombre`, `fecha`, `hora`, `descripcion`) VALUES
(1, 'Evento de Ventas', '2024-10-15', '09:00:00', 'Evento para potenciar ventas'),
(2, 'Feria de Productos', '2024-10-20', '10:30:00', 'Feria anual de productos'),
(3, 'Taller de Marketing', '2024-11-01', '10:00:00', 'Taller sobre estrategias de marketing'),
(4, 'Conferencia de Ventas', '2024-11-15', '09:30:00', 'Conferencia para impulsar las ventas'),
(5, 'Círculo de Innovación', '2024-11-20', '14:00:00', 'Encuentro para compartir ideas innovadoras'),
(6, 'Seminario de Capacitación', '2024-12-01', '08:30:00', 'Seminario para capacitar a los vendedores'),
(7, 'Networking de Fin de Año', '2024-12-15', '18:00:00', 'Encuentro para celebrar y hacer networking'),
(8, 'Lanzamiento de Producto', '2024-12-20', '11:00:00', 'Lanzamiento de la nueva línea de productos'),
(9, 'Taller de Ventas Online', '2025-01-10', '10:00:00', 'Taller sobre técnicas de ventas online'),
(10, 'Reunión de Estrategia', '2025-01-15', '11:00:00', 'Reunión para discutir estrategias de 2025'),
(11, 'Encuentro de Clientes VIP', '2025-02-01', '12:00:00', 'Encuentro exclusivo para clientes VIP'),
(12, 'Capacitación de Producto', '2025-02-10', '09:00:00', 'Capacitación sobre el nuevo producto'),
(13, 'Feria de Innovación', '2025-02-20', '10:00:00', 'Feria dedicada a la innovación en ventas'),
(14, 'Foro de Tendencias', '2025-03-01', '14:00:00', 'Foro sobre las tendencias del mercado'),
(15, 'Cierre de Ventas Trimestral', '2025-03-15', '16:00:00', 'Evento para el cierre de ventas del primer trimestre'),
(16, 'Kermes', '2024-09-24', '10:00:00', 'Venta para recaudar fondos para el edificio X');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `listavendedores`
--

CREATE TABLE `listavendedores` (
  `id` int(11) NOT NULL,
  `id_evento` int(11) DEFAULT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `listavendedores`
--

INSERT INTO `listavendedores` (`id`, `id_evento`, `nombre`) VALUES
(1, 1, 'Lista de Juan y Maria'),
(2, 1, 'Lista de Carlos y Lucia'),
(3, 2, 'Lista de Pedro y Sofia'),
(4, 3, 'Lista de Vendedores de Marketing'),
(5, 4, 'Lista de Conferencia de Ventas'),
(6, 5, 'Lista de Innovadores'),
(7, 6, 'Lista de Asistentes al Seminario'),
(8, 7, 'Lista de Networking 2024'),
(9, 8, 'Lista de Lanzamiento'),
(10, 9, 'Lista de Ventas Online'),
(11, 10, 'Lista de Estrategia 2025'),
(12, 11, 'Lista de Clientes VIP'),
(13, 12, 'Lista de Capacitación de Producto'),
(14, 13, 'Lista de Innovación en Ventas'),
(15, 14, 'Lista de Tendencias del Mercado'),
(16, 15, 'Lista de Cierre Trimestral');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` decimal(10,2) NOT NULL,
  `id_vendedor` int(11) DEFAULT NULL,
  `archivo` varchar(255) DEFAULT NULL,
  `baja` int(11) DEFAULT 0,
  `eliminado` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `descripcion`, `precio`, `id_vendedor`, `archivo`, `baja`, `eliminado`) VALUES
(1, 'Laptop', 'Laptop de alta gama', 1500.00, 1, 'ComputadoraPortatil.jpg', 0, 0),
(2, 'Smartphone', 'Smartphone con gran cámara', 800.00, 2, 'redmi8.jpg', 0, 1),
(3, 'Tablet', 'Tablet de 10 pulgadas', 300.00, 3, 'tabletrayo.jpg', 0, 1),
(4, 'Monitor', 'Monitor 4K de 27 pulgadas', 500.00, 4, 'Monitor.jpg', 0, 1),
(5, 'Teclado mecánico', 'Teclado mecánico retroiluminado', 100.00, 5, 'teclado.jpg', 0, 0),
(6, 'Ratón', 'Ratón ergonómico', 40.00, 6, 'mouse.jpg', 0, 0),
(7, 'Auriculares', 'Auriculares inalámbricos', 150.00, 7, 'auriculares.jpg', 0, 0),
(8, 'Cámara web', 'Cámara web HD', 80.00, 8, 'Camara web.jpg', 0, 0),
(9, 'Altavoces', 'Altavoces bluetooth', 120.00, 9, 'altavoces.jpg', 0, 0),
(10, 'Smartwatch', 'Reloj inteligente', 250.00, 10, 'smart.jpg', 0, 0),
(11, 'Consola de videojuegos', 'Consola de última generación', 9000.00, 11, 'xbox.jpg', 0, 0),
(12, 'Impresora', 'Impresora a color', 200.00, 12, 'impresora.jpg', 0, 0),
(13, 'Proyector', 'Proyector portátil', 600.00, 13, 'proyector.jpg', 0, 0),
(14, 'SSD externo', 'Unidad de estado solido  SSD de un 1TB', 150.00, 14, 'ssd.jpg', 0, 0),
(15, 'Cable HDMI', 'Cable HDMI de 2 metros', 15.00, 15, 'hdmi.jpg', 0, 0),
(16, 'Tablet', '12 pulgadas', 2000.00, 3, 'tablet.jpg', 0, 0),
(17, 'Poco f6 ', 'Telefono gamer a precio de gama media con snapdragon 8s gen 3', 7000.00, 2, 'poco f6.jpg', 0, 1),
(20, 'Poco x3 pro', 'Snapdragon 860 256gb 8gb en ram, con pantalla a 120hz', 3000.00, 5, 'poco x3.jpg', 0, 0),
(21, 'iphone', 'max 15\r\n', 10000.00, 3, 'iphone.jpg', 0, 0),
(22, 'telefono', 'analogico', 1345.56, 3, 'nokia.jpg', 0, 0),
(23, 'Ropa', 'Ropa vintage', 70.00, 1, 'ropa.jpg', 0, 0),
(24, 'Flores', 'Rosa', 50.00, 2, 'flores.jpg', 0, 1),
(25, 'ProductoRasca', 'Descripci?n del producto', 350.00, 2, 'rasca.jpg', 0, 0),
(29, 'Redmi 14 Pro Plus', 'Telefono Inteligente Xiaomi', 7600.00, 3, 'redmi14.jpg', 0, 0),
(30, 'Trufas', 'Trufas de oreo con philadelfia con cubierta para helado blanca', 10.00, 16, 'trufas.jpg', 0, 0),
(31, 'Sillon', 'sientqte', 5.00, 3, 'Imagen3.png', 0, 0),
(32, 'robot', '12 cm', 500.00, 1, 'qué-son-las-ciencias-de-la-Computación-Universidad-Sergio-Arboleda-Inteligencia-Artificial.jpg', 0, 0),
(33, 'robot', '12 cm', 500.00, 1, 'qué-son-las-ciencias-de-la-Computación-Universidad-Sergio-Arboleda-Inteligencia-Artificial.jpg', 0, 0),
(34, 'robot', 'hola', 50.00, 2, 'bee tts mos.jpg', 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vendedor`
--

CREATE TABLE `vendedor` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contraseña` varchar(100) NOT NULL,
  `archivo` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `calificacion` tinyint(1) DEFAULT 0,
  `baja` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `vendedor`
--

INSERT INTO `vendedor` (`id`, `nombre`, `email`, `contraseña`, `archivo`, `calificacion`, `baja`) VALUES
(1, 'Enrique', 'quique@example.com', '123', '', 0, 0),
(2, 'Manuel', 'manu@example.com', '123', '', 0, 0),
(3, 'Juan Perez', 'juan@example.com', '123', '', 0, 0),
(4, 'Maria Lopez', 'maria@example.com', 'password456', '', 0, 0),
(5, 'Carlos Silva', 'carlos@example.com', 'abc123', '', 0, 0),
(6, 'Lucia Gomez', 'lucia@example.com', 'xyz456', '', 0, 0),
(7, 'Pedro Martinez', 'pedro@example.com', 'pass789', '', 0, 0),
(8, 'Sofia Reyes', 'sofia@example.com', 'qwerty', '', 0, 0),
(9, 'Fernando Torres', 'fernando@example.com', '1234abcd', '', 0, 0),
(10, 'Ana Carrillo', 'ana@example.com', 'password1', '', 0, 0),
(11, 'Diego Mendoza', 'diego@example.com', 'mypassword', '', 0, 0),
(12, 'Clara Jimenez', 'clara@example.com', 'securepass', '', 0, 0),
(13, 'Javier Ortiz', 'javier@example.com', 'hello123', '', 0, 0),
(14, 'Natalia Rios', 'natalia@example.com', 'testpass', '', 0, 0),
(15, 'Roberto Alvarez', 'roberto@example.com', 'admin123', '', 0, 0),
(16, 'Luis Angel', 'lagg24@', '123', '', 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `id_vendedor` int(11) DEFAULT NULL,
  `id_comprador` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id`, `fecha`, `total`, `id_vendedor`, `id_comprador`) VALUES
(1, '2024-09-23', 2300.00, 1, 11),
(2, '2024-09-24', 1500.00, 2, 12),
(3, '2024-09-25', 800.00, 3, 1),
(4, '2024-09-26', 300.00, 1, 4),
(5, '2024-09-27', 500.00, 5, 6),
(6, '2024-09-28', 100.00, 5, 6),
(7, '2024-09-29', 40.00, 7, 7),
(8, '2024-09-30', 150.00, 8, 8),
(9, '2024-10-01', 80.00, 9, 9),
(10, '2024-10-02', 250.00, 10, 10),
(11, '2024-10-03', 500.00, 11, 11),
(12, '2024-10-04', 200.00, 12, 12),
(13, '2024-10-05', 600.00, 13, 13),
(14, '2024-10-06', 150.00, 14, 14),
(15, '2024-10-07', 15.00, 15, 15);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `citas`
--
ALTER TABLE `citas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_vendedor` (`id_vendedor`),
  ADD KEY `id_comprador` (`id_comprador`);

--
-- Indices de la tabla `comprador`
--
ALTER TABLE `comprador`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `detallescita`
--
ALTER TABLE `detallescita`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_cita` (`id_cita`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `detallesventa`
--
ALTER TABLE `detallesventa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_venta` (`id_venta`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `evento`
--
ALTER TABLE `evento`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `listavendedores`
--
ALTER TABLE `listavendedores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_evento` (`id_evento`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_vendedor` (`id_vendedor`);

--
-- Indices de la tabla `vendedor`
--
ALTER TABLE `vendedor`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_vendedor` (`id_vendedor`),
  ADD KEY `id_comprador` (`id_comprador`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `citas`
--
ALTER TABLE `citas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `comprador`
--
ALTER TABLE `comprador`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `detallescita`
--
ALTER TABLE `detallescita`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `detallesventa`
--
ALTER TABLE `detallesventa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `evento`
--
ALTER TABLE `evento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `listavendedores`
--
ALTER TABLE `listavendedores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `vendedor`
--
ALTER TABLE `vendedor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `citas`
--
ALTER TABLE `citas`
  ADD CONSTRAINT `citas_ibfk_1` FOREIGN KEY (`id_vendedor`) REFERENCES `vendedor` (`id`),
  ADD CONSTRAINT `citas_ibfk_2` FOREIGN KEY (`id_comprador`) REFERENCES `comprador` (`id`);

--
-- Filtros para la tabla `detallescita`
--
ALTER TABLE `detallescita`
  ADD CONSTRAINT `detallescita_ibfk_1` FOREIGN KEY (`id_cita`) REFERENCES `citas` (`id`),
  ADD CONSTRAINT `detallescita_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`);

--
-- Filtros para la tabla `detallesventa`
--
ALTER TABLE `detallesventa`
  ADD CONSTRAINT `detallesventa_ibfk_1` FOREIGN KEY (`id_venta`) REFERENCES `ventas` (`id`),
  ADD CONSTRAINT `detallesventa_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`);

--
-- Filtros para la tabla `listavendedores`
--
ALTER TABLE `listavendedores`
  ADD CONSTRAINT `listavendedores_ibfk_1` FOREIGN KEY (`id_evento`) REFERENCES `evento` (`id`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`id_vendedor`) REFERENCES `vendedor` (`id`);

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `ventas_ibfk_1` FOREIGN KEY (`id_vendedor`) REFERENCES `vendedor` (`id`),
  ADD CONSTRAINT `ventas_ibfk_2` FOREIGN KEY (`id_comprador`) REFERENCES `comprador` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
