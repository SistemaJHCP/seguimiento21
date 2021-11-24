-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-11-2021 a las 21:13:06
-- Versión del servidor: 10.1.40-MariaDB
-- Versión de PHP: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `seguimiento21`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cliente_codigo` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cliente_rif` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cliente_nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cliente_telefono` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cliente_direccion` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cliente_correo` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cliente_estado` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id`, `cliente_codigo`, `cliente_rif`, `cliente_nombre`, `cliente_telefono`, `cliente_direccion`, `cliente_correo`, `cliente_estado`, `created_at`, `updated_at`) VALUES
(1, 'CLI-1', 'N/A', 'Cargill de Venezuela', '8704620', 'Catia', '', 1, NULL, NULL),
(2, 'CLI-2', '0123', 'Huawei', '0123', 'Altamira', '', 1, NULL, NULL),
(3, 'CLI-3', '012345', 'ZTE', '0200', 'Plaza Venezuela', '', 1, NULL, NULL),
(4, 'CLI-4', 'J-30468971-3', 'Digitel', '012345', '012345', '', 1, NULL, NULL),
(5, 'CLI-5', '1234567890', 'Movistar', '12345', 'N/A', '', 1, NULL, NULL),
(6, 'CLI-6', '123', 'EDC Network', '123', '123', '', 1, NULL, NULL),
(7, 'CLI-7', '000', 'SIAE', '000', 'N/A', '', 1, NULL, NULL),
(8, 'CLI-8', '01234', 'Movilnet', '01234', 'Varias', '', 1, NULL, NULL),
(9, 'CLI-9', 'J-001241345', 'CANTV', '0212', 'Santa Rosa', '', 1, NULL, NULL),
(10, 'CLI-10', 'J-401516939', 'FIBRATERRA 1911, C.A.', '0212-2670035', 'AV FRANCISCO MIRANDA MULT EMP DEL ESTE  NUCLEO MIRANDA  TORRE A PISO 13 OFCI 132', 'adiaz@fibraterra.com', 1, NULL, NULL),
(11, 'CLI-11', 'J-00042000-9', 'Clover Internacional, C.A', '0212-9031300', 'Av. Luis de Camoens. Centro Clover, Piso 3. Zona Industrial La Trinidad', '', 1, NULL, NULL),
(13, 'CLI-13', 'J-301083350', 'NETUNO, C.A', '0212-7720250', 'CALLE 7 URB LA URBINA EDF INSENICA II PISO 2', '', 1, NULL, NULL),
(14, 'CLI-14', 'J-30240664-1', 'Corporacion Telemic C.A (INTER))', '0251-3355250 3355089', 'Avenida Los Leones con Calle Caroní Centro Empresarial Caracas piso 3 Barquisimeto Edo Lara', 'sergio.hoyle@inter.com.ve', 1, NULL, NULL),
(15, 'CLI-15', 'J315999595', 'GASTOS COMERCIALES', '0212-2679013', 'CARACAS', '', 1, NULL, NULL),
(16, 'CLI-16', 'J3159995951', 'PRESUPUESTO', '0212-2679013', 'CHACAO', '', 1, NULL, NULL),
(17, 'CLI-17', 'J302768365', 'Santa Barbara Airlines, C.A.', '02122044485', 'Calle 72 con Avenida 10 Edif. OK-101 piso PB Local N° 1 Sector San Benito, Maracaibo Edo. Zulia Zona Postal 4002', 'yaquelin.lorz@sbairlines.com', 1, NULL, NULL),
(18, 'CLI-18', 'J302597005', 'GALAXY ENTERTAINMENT DE VENEZUELA', '04242897841', 'AV VENEZUELA ENTRE CALLE MOHEDANO ROSAL', '', 1, NULL, NULL),
(19, 'CLI-19', 'J402997655', 'CONSORCIO ESTRUCTURAS METALICAS MODERNAS', '02122679013', 'AV FRANCISCO DE MIRANDA EDIF CENTRO GALIPAN  TORRE B PISO 4 URB EL ROSAL', 'osantiago@fgdc.co', 1, NULL, NULL),
(20, 'CLI-20', 'J0000416273', 'GAS COMUNAL, S A', '0800-2662662', 'AV N1 MANZANA EDIF PDVSA GAS COMUNAL PISO PB PARCELA 9-9A URB Z IND DEL ESTE GUARENAS', 'dadrian@pdvcomunal.com.ve', 1, NULL, NULL),
(21, 'CLI-21', 'JM0001', 'ZTE JAMAICA', '1 876 277 4371', '1st floor, Courtleigh Corporate Centre, 6-8 St. Lucia Avenue, Kingston 5, Jamaica', 'oscar.heredia@zte.com.cn ', 1, NULL, NULL),
(22, 'CLI-22', 'J-07000344-8', 'C.A CERVECERIA REGIONAL', '0212-4426928', '4427928    0212 – 4726052	Segunda Calle la Yaguara frente a Tropicana ', '', 1, NULL, NULL),
(23, 'CLI-23', 'J000195625', 'INDUSTRIAS DEL MAIZ, C.A.', '0212-', 'TURMERO', '', 1, NULL, NULL),
(24, 'CLI-24', 'J000303614', 'C.A SUCESORA DE JOSE PUIG & C.A', '0212-2391846', 'CALLE 2DA TRANSVERSAL EDIF PUIG URB LOS CORTIJOS ', 'proyectos@galletaspuig.com', 1, NULL, NULL),
(25, 'CLI-25', 'J001438092', 'DHL FLETES AEREOS, C.A', '0212-6206000', 'AV MILLAN CON CALLE CHICAGO EDIF DHL PISO PB OF SEDE  PRINCIPAL URB LA CALIFORNIA  MIRANDA', '', 1, NULL, NULL),
(26, 'CLI-26', 'DIGICEL01', 'DIGICEL BVI LTD', '284-300-1917', 'Jayla Place, Wickhams Cay 1, Tortola ', '', 1, NULL, NULL),
(27, 'CLI-27', 'J075862155', 'ALIMENTOS HEINZ, C A', '0241-813.2062', 'CTRA NACIONAL MARACAY-VALENCIA EDIF ALIMENTOS HEINZ PISO PLANTA LOCAL ALIMENTOS HEINZ URB SAN BERNANDO SAN JOAQUIN CARABOBO ZONA  POSTAL 2018', 'Pedro.Santos@kraftheinz.com', 1, NULL, NULL),
(28, 'CLI-28', 'J-30190878-3', 'Promotora Tántalo C.A.', '0241-8670051', 'Av Universidad c calle Venezuela cc la granja Valencia ', '', 1, NULL, NULL),
(29, 'CLI-29', 'J000129266', 'Nestlé Venezuela S.A.  ', '00000000', 'Calle Altagracia, Edif. P&G,Oficina Recepción  Piso 3 Urb. Sorokaima, Sector La Trinidad', '', 1, NULL, NULL),
(30, 'CLI-30', '2184301-1-770817 DV88', 'JHCP Internacional ', '+1', 'Panamá', 'pierre@jhcp.com', 1, NULL, NULL),
(31, 'CLI-31', 'J-306117270', 'SISTEM CABLE, C.A', '0212-8721143', 'CALLE ESPAÑA EDIF ESPAÑA LOCAL 1 SECTOR CATIA CARACAS', '', 1, NULL, NULL),
(32, 'CLI-32', 'G200161299', 'FEDERACION INTERNACIONAL DE SOCIEDADES DE LA CRUZ ROJAS', '0412 628 34 52', 'AV ANDRES BELLO EDIF 4 CRUZ ROJA VENEZOLANA PISO 1 OF UNICA URB SAN BERNARDINO CARACAS DISTRITO CAPITAL ZONA POSTAL 1010', 'marycruz.rivas@ifrc.org', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `codventa`
--

CREATE TABLE `codventa` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `codventa_codigo` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `codventa_nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `codventa_codigo2` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `codventa_telefono` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `codventa_direccion` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `codventa_correo` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `codventa_estado` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `codventa`
--

INSERT INTO `codventa` (`id`, `codventa_codigo`, `codventa_nombre`, `codventa_codigo2`, `codventa_telefono`, `codventa_direccion`, `codventa_correo`, `codventa_estado`, `created_at`, `updated_at`) VALUES
(20, 'PTC-06-300-0-2016', 'Clover Internacional C.A', 'PTR-20', '0241-8741000', 'Av. Ernesto Luis Branger, Zona Ind. Municipal Norte, Valencia, Edo. Carabobo ', 'carlos.gutierrez@clovergroup.com.ve', 1, NULL, NULL),
(21, 'PTC-01-296-0-4-2016', 'Movistar Planta Interna ', 'PTR-21', '', 'Alto Hatillo', '', 1, NULL, NULL),
(22, 'PTC-01-296-0-3-2016', 'Movistar Planta Interna ', 'PTR-22', '', 'Claret', '', 1, NULL, NULL),
(23, 'PTC-01-296-0-2-2016', 'Movistar Planta Interna ', 'PTR-23', '', 'La Dolorita', '', 1, NULL, NULL),
(24, 'PTC-01-296-0-1-2016', 'Movistar Planta Interna ', 'PTR-24', '', 'Palo Verde', '', 1, NULL, NULL),
(25, 'PTC-01-296-0-5-2016', 'Movistar Planta Interna ', 'PTR-25', '', 'Eprotel', '', 1, NULL, NULL),
(26, 'PTC-01-298-0-1-2016', 'Movistar-LATAM YARE', 'PTR-26', '', 'Yare', '', 1, NULL, NULL),
(27, 'PTC-01-293-0-1-2016', 'Movistar-Movimiento de Equipos en Estaciones Oct-Dic 2016', 'PTR-27', '', 'Yare', '', 1, NULL, NULL),
(28, 'PTC-01-299-0-1-2016', 'Movistar-Planta Externa ', 'PTR-28', '', 'Caraballera ', '', 1, NULL, NULL),
(29, 'PTC-01-299-0-2-2016', 'Planta Externa ', 'PTR-29', '', 'Zaraza (Ramal) ', '', 1, NULL, NULL),
(30, 'PTC-01-299-0-3-2016', 'Planta Externa ', 'PTR-30', '', 'El Sombrero (Ramal)', '', 1, NULL, NULL),
(31, 'PTC-05-292-0-2016', 'NetUno', 'PTR-31', '', 'Calle 7 de la Urbina, Caracas', '', 1, NULL, NULL),
(32, 'PTC-06-309-1-2016', 'Clover Internacional C.A', 'PTR-32', '', 'Barcelona Edo. Anzoategui', '', 1, NULL, NULL),
(33, 'PTC-01-298-0-2-2016', 'Movistar - LATAM MACHIQUES', 'PTR-33', '', 'MACHIQUES - Edo. Zulia', '', 1, NULL, NULL),
(35, 'PTC-01-298-0-3-2016', 'Movistar - LATAM LA LIMPIA SUR', 'PTR-35', '', 'LA LIMPIA SUR - Edo. Zulia ', '', 1, NULL, NULL),
(36, 'PTC-06-303-0-2016', 'Clover Internacional C.A', 'PTR-36', '', 'Barcelona Edo. Anzoategui', 'carlos.gutierrez@clovergroup.com.ve', 1, NULL, NULL),
(37, 'PTC-01-298-0-4-2016', 'LATAM PARACOTOS', 'PTR-37', '', 'Paracotos -Edo. Miranda', '', 1, NULL, NULL),
(38, 'PTC-01-298-0-5-2016', 'LATAM LOS ANAUCOS', 'PTR-38', '', 'Los Anaucos - Edo. Miranda', '', 1, NULL, NULL),
(39, 'PTC-06-305-1-2016', 'Clover Internacional C.A', 'PTR-39', '', 'Caracas, Macarao', 'armando.marcano@clovergroup.com.ve', 1, NULL, NULL),
(40, 'PTC-01-298-0-6-2016', 'LATAM CENTRAL TACARIGUA', 'PTR-40', '', 'Edo. Carabobo ', '', 1, NULL, NULL),
(41, 'PTC-01-298-0-7-2016', 'LATAM CATA', 'PTR-41', '', 'Edo. Aragua', '', 1, NULL, NULL),
(42, 'PTC-01-299-0-4-2016', 'PLEXT BUENA VISTA ', 'PTR-42', '', 'Edo. Falcón ', '', 1, NULL, NULL),
(43, 'PTC-01-296-06-2016', 'Telefonica Planta Interna Paso Real', 'PTR-43', '', 'Telefonica Venezuela', '', 1, NULL, NULL),
(44, 'PTC-01-299-05-2016', 'Telefonica Planta Externa Paso Real', 'PTR-44', '', 'Telefonica Venezuela', '', 1, NULL, NULL),
(45, 'PTC-06-302-0-2016', 'Clover Internacional C.A', 'PTR-45', '', 'Clover sede La Yaguara', 'carlos.gutierrez@clovergroup.com.ve', 1, NULL, NULL),
(46, 'PTC-06-326-1-2016', 'Clover Internacional C.A', 'PTR-46', '', 'Clover sede Macarao', 'armando.marcano@clovergroup.com.ve', 1, NULL, NULL),
(47, 'PTC-06-302-0-2016', 'CLOVER INTERNACIONAL', 'PTR-47', '', 'LA YAGUARA', 'carlos.gutierrez@clovergroup.com.ve', 1, NULL, NULL),
(48, 'PTC-06-326-1-2016', 'CLOVER INTERNACIONAL', 'PTR-48', '', 'MACARAO', 'armando.marcano@clovergroup.com.ve', 1, NULL, NULL),
(49, 'PTC-06-324-0-2016', 'CLOVER INTERNACIONAL', 'PTR-49', '', 'BARCELONA', 'carlos.gutierrez@clovergroup.com.ve', 1, NULL, NULL),
(50, 'PTC-03-335-0-2016', 'Mtto. Inter Barquisimeto-Valencia', 'PTR-50', '', 'Barquisimeto Edo. Lara', 'sergio.hoyle@inter.com.ve', 1, NULL, NULL),
(51, 'PTC-00-000-0-2016', 'Gestion Comercial JHCP', 'PTR-51', '', 'Oficina principal JHCP', 'jesus.ramirez@jhcp.com', 1, NULL, NULL),
(52, 'PTC-01-338-0-2016', 'ODF y Accesorios', 'PTR-52', '', 'Telefonica Venezuela', '', 1, NULL, NULL),
(53, 'PTC-06-319-1-2016', 'CLOVER INTERNACIONAL', 'PTR-53', '', 'LA YAGUARA', 'carlos.gutierrez@clovergroup.com.ve', 1, NULL, NULL),
(54, 'PTC-01-290-01-2016', 'Desinstalacion de Equipos (4590033653)', 'PTR-54', '', 'Prebo', 'acarrion@jhcpconstruccion.com', 1, NULL, NULL),
(55, 'PTC-01-290-02-2016', 'Desinstalacion de Equipos (4590033653)', 'PTR-55', '', 'Victoria', 'acarrion@jhcpconstruccion.com', 1, NULL, NULL),
(56, 'PTC-01-290-03-2016', 'Desinstalacion de Equipos (4590033653)', 'PTR-56', '', 'San Juan de Los Morros', 'acarrion@jhcpconstruccion.com', 1, NULL, NULL),
(57, 'PTC-01-290-04-2016', 'Desinstalacion de Equipos (4590033653)', 'PTR-57', '', 'Consmopolitan', 'acarrion@jhcpconstruccion.com', 1, NULL, NULL),
(58, 'PTC-01-289-01-2016', 'Desinstalacion de Equipos (4590033654)', 'PTR-58', '', 'Parque Canaima', 'acarrion@jhcpconstruccion.com', 1, NULL, NULL),
(59, 'PTC-01-289-02-2016', 'Desinstalacion de Equipos (4590033654)', 'PTR-59', '', 'Cablevision', 'acarrion@jhcpconstruccion.com', 1, NULL, NULL),
(60, 'PTC-01-289-03-2016', 'Desinstalacion de Equipos (4590033654)', 'PTR-60', '', 'Catia La Mar', 'acarrion@jhcpconstruccion.com', 1, NULL, NULL),
(61, 'PTC-01-289-04-2016', 'Desinstalacion de Equipos (4590033654)', 'PTR-61', '', 'Avila', 'acarrion@jhcpconstruccion.com', 1, NULL, NULL),
(62, 'PTC-01-289-05-2016', 'Desinstalacion de Equipos (4590033654)', 'PTR-62', '', 'Bautismo', 'acarrion@jhcpconstruccion.com', 1, NULL, NULL),
(63, 'PTC-01-289-06-2016', 'Desinstalacion de Equipos (4590033654)', 'PTR-63', '', 'Aeropuerto Caracas', 'acarrion@jhcpconstruccion.com', 1, NULL, NULL),
(64, 'PTC-06-314-0-2016', 'CLOVER INTERNACIONAL', 'PTR-64', '', 'MAIQUETIA', 'carlos.gutierrez@clovergroup.com.ve', 1, NULL, NULL),
(65, 'PTC-01-295-0-1-2017', 'DESMANTELAMIENTO (5602015770)', 'PTR-65', '', 'ORITOPO', 'katiuska.antelo@jhcpconstruccion.com', 1, NULL, NULL),
(66, 'PTC-01-299-0-2-2017', 'PLANTA EXTERNA (5602015419)', 'PTR-66', '', 'CUMAREBO', 'mirna.osuna@jhcpconstruccion.com', 1, NULL, NULL),
(67, 'PTC-01-299-0-3-2017', 'PLANTA EXTERNA (5602015419)', 'PTR-67', '', 'BOCA DE AROA', 'mirna.osuna@jhcpconstruccion.com', 1, NULL, NULL),
(68, 'PTC-01-299-0-4-2017', 'PLANTA EXTERNA (5602015419)', 'PTR-68', '', 'MORÓN', 'mirna.osuna@jhcpconstruccion.com', 1, NULL, NULL),
(69, 'PTC-01-299-0-5-2017', 'PLANTA EXTERNA (5602015419)', 'PTR-69', '', 'YARACAL', 'mirna.osuna@jhcpconstruccion.com', 1, NULL, NULL),
(70, 'PTC-01-293-0-3-2017', 'MOVIMIENTO DE EQUIPOS EN ESTACIONES OCT/DIC (4590033593)', 'PTR-70', '', 'LIMPIA SUR', 'victor.gandica@jhcpconstruccion.com', 1, NULL, NULL),
(71, 'PTC-01-293-0-4-2017', 'MOVIMIENTO DE EQUIPOS EN ESTACIONES OCT/DIC (4590033593)', 'PTR-71', '', 'MACHIQUES', 'victor.gandica@jhcpconstruccion.com', 1, NULL, NULL),
(72, 'PTC-01-293-0-5-2017', 'MOVIMIENTO DE EQUIPOS EN ESTACIONES OCT/DIC (4590033593)', 'PTR-72', '', 'CENTRAL TACARIGUA', 'victor.gandica@jhcpconstruccion.com', 1, NULL, NULL),
(73, 'PTC-01-293-0-2-2017', 'MOVIMIENTO DE EQUIPOS EN ESTACIONES OCT/DIC (4590033593)', 'PTR-73', '', 'PARACOTOS - TEJERIAS', 'victor.gandica@jhcpconstruccion.com', 1, NULL, NULL),
(74, 'Q1-2017-PRESUPUESTOS', 'Q1-2017-PRESUPUESTOS', 'PTR-74', '', 'OFICINA PPAL. JHCP', 'niorkys.moreno@jhcpconstruccion.com', 1, NULL, NULL),
(75, 'Q1-2017-VENTAS', 'Q1-2017-VENTAS', 'PTR-75', '', 'OFICINA PPAL. JHCP', 'jesus.ramirez@jhcp.com', 1, NULL, NULL),
(76, 'PTC-03-335-1-2016', 'DESMALEZAMIENTO CONTRATO STA RITA BARQUISIMETO', 'PTR-76', '', 'SANTA RITA - BARQUISIMETO', 'mirna.osuna@jhcpconstruccion.com', 1, NULL, NULL),
(77, 'PTC-03-336-1-2016', 'DESMALEZAMIENTO BARQUISIMETO VALENCIA', 'PTR-77', '', 'BARQUISIMETO VALENCIA', 'mirna.osuna@jhcpconstruccion.com', 1, NULL, NULL),
(78, 'PTC-14-288-0-2017', 'RED LOCAL COROCITO', 'PTR-78', '', 'COROCITO', 'mayerling.paez@jhcpconstruccion.com', 1, NULL, NULL),
(79, 'PTC-14-287-0-2017', 'RED LOCAL SOMBRERO', 'PTR-79', '', 'EL SOMBRERO', 'mayerling.paez@jhcpconstruccion.com', 1, NULL, NULL),
(80, 'PTC-01-290-0-5-2016', 'DESISTALACIÓN Y REUBICACIÓN DE EQUIPOS DE TRANSPORTE (4590033654)', 'PTR-80', '', 'VALENCIA ', 'acarrion@jhcpconstruccion.com', 1, NULL, NULL),
(81, 'PTC-01-292-0-1-2017', 'MOVIMIENTO DE EQUIPOS', 'PTR-81', '', 'ESTACION LOS ANAUCOS', 'acarrion@jhcpconstruccion.com', 1, NULL, NULL),
(82, 'PTC-01-289-7-2017', 'Desinstalacion de Equipos (4590033654)', 'PTR-82', '', 'GRAN CARACAS', 'acarrion@jhcpconstruccion.com', 1, NULL, NULL),
(83, 'PTC-01-289-8-2017', 'Desinstalacion de Equipos (4590033654)', 'PTR-83', '', 'GRAN CARACAS', 'acarrion@jhcpconstruccion.com', 1, NULL, NULL),
(84, 'PTC-06-358-0-2017', 'CERRAMIENTO OFICINA DRY WALL', 'PTR-84', '', 'MACARAO', 'katiuska.antelo@jhcpconstruccion.com', 1, NULL, NULL),
(85, 'PTC-01-299-0-6-2017', 'PLANTA EXTERNA (5602015419)', 'PTR-85', '', 'SANTA TERESA', 'mirna.osuna@jhcpconstruccion.com', 1, NULL, NULL),
(86, 'PTC-01-299-0-7-2017', 'PLANTA EXTERNA (5602015419)', 'PTR-86', '', 'YARE', 'mirna.osuna@jhcpconstruccion.com', 1, NULL, NULL),
(88, 'PTC-06-351-2-2017', 'CLOVER', 'PTR-88', '', 'MACARAO', 'katiuska.antelo@jhcpconstruccion.com', 1, NULL, NULL),
(89, 'PTC-01-296-8-2017', 'PLANTA INTERNA (5602015304)', 'PTR-89', '', 'PINTO SALINAS', 'murbaneja@jhcpconstruccion.com', 1, NULL, NULL),
(90, 'PTC-01-299-09-2017', 'PLANTA EXTERNA (5602015419)', 'PTR-90', '', 'SIERRA MAESTRA - EDO. ZULIA ', 'mirna.osuna@jhcpconstruccion.com', 1, NULL, NULL),
(91, 'PTC-01-299-08-2017', 'PLANTA EXTERNA (5602015419)', 'PTR-91', '', 'C.C. LITORAL', 'mayerling.paez@jhcpconstruccion.com', 1, NULL, NULL),
(93, 'PTC-02-369-1-2017', 'Atención de Falla Digitel', 'PTR-93', '412-960-24-68', 'Puerto Ayacucho', 'mayerling.paez@jhcpconstruccion.com', 1, NULL, NULL),
(94, 'PTC-01-298-08-2017', 'LATAM YARE', 'PTR-94', '', 'Yare', '', 1, NULL, NULL),
(95, 'PTC-01-296-0-6-2016', 'Movistar Planta Interna', 'PTR-95', '', 'CC El Recreo', 'victor.gandica@jhcpconstruccion.com', 1, NULL, NULL),
(96, 'PTC-01-296-0-7-2017', 'PLANTA INTERNA (5602015304)', 'PTR-96', '', 'Av. Tirso Salaverria', 'katiuska.antelo@jhcpconstruccion.com', 1, NULL, NULL),
(97, 'PTC-01-296-0-8-2017', 'PLANTA INTERNA (5602015304)', 'PTR-97', '', 'Hotel Federal', 'katiuska.antelo@jhcpconstruccion.com', 1, NULL, NULL),
(98, 'PTC-01-296-0-9-2017', 'PLANTA INTERNA (5602015304)', 'PTR-98', '', 'Av. Ohggins.', 'katiuska.antelo@jhcpconstruccion.com', 1, NULL, NULL),
(99, 'PTC-01-367-0-1-2017', 'Desinstalacion de Equipos ', 'PTR-99', '', 'URBINA SUR, CARACAS', 'acarrion@jhcpconstruccion.com', 1, NULL, NULL),
(100, 'PTC-22-386-1-2017', 'SUSTITUCIÓN DE COMPRESORES', 'PTR-100', '', 'LAS MERCEDES', 'mirna.osuna@jhcpconstruccion.com', 1, NULL, NULL),
(101, 'PTC-01-299-0-12-2017', 'PLANTA EXTERNA (5602015419) Tucacas Bomberos – manga Digitel. ', 'PTR-101', '', 'Tucacas Bomberos – manga Digitel. ', 'katiuska.antelo@jhcpconstruccion.com', 1, NULL, NULL),
(102, 'PTC-01-299-0-11-2017', 'PLANTA EXTERNA (5602015419)', 'PTR-102', '', 'Tucacas bombero – Tucacas.', 'katiuska.antelo@jhcpconstruccion.com', 1, NULL, NULL),
(103, 'PTC-01-367-0-2-2017', 'Desinstalacion de Equipos  (4590034051)', 'PTR-103', '', 'Charallave', 'acarrion@jhcpconstruccion.com', 1, NULL, NULL),
(104, 'PTC-01-296-0-10-2017', 'PLANTA INTERNA (5602015304)', 'PTR-104', '', 'El Roble, San Félix, Bolívar', 'katiuska.antelo@jhcpconstruccion.com', 1, NULL, NULL),
(105, 'PTC-01-296-0-11-2017', 'PLANTA INTERNA (5602015304)', 'PTR-105', '', '11 de Abril, San Félix, Estado Bolívar', 'katiuska.antelo@jhcpconstruccion.com', 1, NULL, NULL),
(106, 'PTC-01-296-0-12-2017', 'PLANTA INTERNA (5602015304)', 'PTR-106', '', 'Polideportivo el Gallo, San Félix, Estado Bolívar', 'katiuska.antelo@jhcpconstruccion.com', 1, NULL, NULL),
(107, 'PTC-01-296-0-13-2017', 'PLANTA INTERNA (5602015304)', 'PTR-107', '', 'San Félix Centro, Estado Bolívar', 'katiuska.antelo@jhcpconstruccion.com', 1, NULL, NULL),
(108, 'PTC-01-296-0-14-2017 ', 'PLANTA INTERNA (5602015304)', 'PTR-108', '', 'Vista alegre, Estado Bolívar', 'katiuska.antelo@jhcpconstruccion.com', 1, NULL, NULL),
(109, 'PTC-01-296-0-15-2017', 'PLANTA INTERNA (5602015304)', 'PTR-109', '', 'Manoa, Estado Bolívar', 'katiuska.antelo@jhcpconstruccion.com', 1, NULL, NULL),
(110, 'PTC-01-296-0-16-2017 ', 'PLANTA INTERNA (5602015304)', 'PTR-110', '', 'Chirica, Estado Bolívar', 'katiuska.antelo@jhcpconstruccion.com', 1, NULL, NULL),
(111, 'PTC-01-296-0-17-2017', 'PLANTA INTERNA (5602015304)', 'PTR-111', '', 'Barbacoa, Puerto La Cruz', 'katiuska.antelo@jhcpconstruccion.com', 1, NULL, NULL),
(112, 'PTC-01-296-0-18-2017', 'PLANTA INTERNA (5602015304)', 'PTR-112', '', 'San Mateo, Puerto La Cruz', 'katiuska.antelo@jhcpconstruccion.com', 1, NULL, NULL),
(113, 'PTC-01-296-0-19-2017', 'PLANTA INTERNA (5602015304)', 'PTR-113', '', 'Cacique Bacoa - Coro', 'mayerling.paez@jhcpconstruccion.com', 1, NULL, NULL),
(114, 'PTC-01-296-0-20-2017', 'PLANTA INTERNA (5602015304)', 'PTR-114', '', 'Distribuidor La Vela - Coro', 'mayerling.paez@jhcpconstruccion.com', 1, NULL, NULL),
(115, 'PTC-01-296-0-21-2017 ', 'PLANTA INTERNA (5602015304)', 'PTR-115', '', 'La Vela - Coro', 'mayerling.paez@jhcpconstruccion.com', 1, NULL, NULL),
(116, 'PTC-01-296-0-22-2017', 'PLANTA INTERNA (5602015304)', 'PTR-116', '', 'Independencia – Coro', 'mayerling.paez@jhcpconstruccion.com', 1, NULL, NULL),
(117, 'PTC-01-296-0-23-2017 ', 'PLANTA INTERNA (5602015304)', 'PTR-117', '', 'Cabimas Sur, Zulia', 'mayerling.paez@jhcpconstruccion.com', 1, NULL, NULL),
(118, 'PTC-01-296-0-25-2017', 'PLANTA INTERNA (5602015304)', 'PTR-118', '', 'Las Mercedes, Zulia', 'mayerling.paez@jhcpconstruccion.com', 1, NULL, NULL),
(119, 'PTC-01-296-0-26-2017 ', 'PLANTA INTERNA (5602015304)', 'PTR-119', '', 'Ojeda, Zulia', 'mayerling.paez@jhcpconstruccion.com', 1, NULL, NULL),
(120, 'PTC-01-296-0-24-2017', 'PLANTA INTERNA (5602015304)', 'PTR-120', '', 'Cuidad Ojeda, Zulia', 'mayerling.paez@jhcpconstruccion.com', 1, NULL, NULL),
(121, 'PTC-01-304-3-2017', 'Reparación Techo de Almacen', 'PTR-121', '04241506117', 'Guarenas. Miranda', 'alejandro.ojeda@jhcpconstruccion.com', 1, NULL, NULL),
(122, 'PTC-01-299-0-13-2017', 'PLANTA EXTERNA (5602015419)', 'PTR-122', '', 'EL CLARET - HATILLO', 'mirna.osuna@jhcpconstruccion.com', 1, NULL, NULL),
(123, 'PTC-12-399-0-2017', 'REMODELACION DE LOS BAÑOS DEL HANGAR DE SANTA BÁRBARA', 'PTR-123', '', 'MAIQUETÍA', 'katiuska.antelo@jhcpconstruccion.com', 1, NULL, NULL),
(124, 'PTC-01-296-0-27-2017', 'PLANTA INTERNA (5602015304)', 'PTR-124', '', 'LOS CEREZOS', 'katiuska.antelo@jhcpconstruccion.com', 1, NULL, NULL),
(125, 'PTC-01-367-0-3-2017', 'DESINTALACION DE EQUIPO (4590034051)', 'PTR-125', '', 'GRAN CARACAS', 'acarrion@jhcpcontruccion.com', 1, NULL, NULL),
(126, 'PTC-01-296-1-28-2017', 'PLANTA EXTERNA / INTERNA (5602016478)', 'PTR-126', '', 'La Salle', 'katiuska.antelo@jhcpconstruccion.com', 1, NULL, NULL),
(127, 'PTC-01-296-1-29-2017', 'PLANTA EXTERNA / INTERNA (5602016478)', 'PTR-127', '', 'Soledad', 'katiuska.antelo@jhcpconstruccion.com', 1, NULL, NULL),
(128, 'PTC-01-296-1-30-2017', 'PLANTA EXTERNA / INTERNA (5602016478)', 'PTR-128', '', 'Cabimas Sur', 'mayerling.paez@jhcpconstruccion.com', 1, NULL, NULL),
(129, 'PTC-01-296-1-31-2017', 'PLANTA EXTERNA / INTERNA (5602016478)', 'PTR-129', '', 'Ciudad Ojeda', 'mayerling.paez@jhcpconstruccion.com', 1, NULL, NULL),
(130, 'PTC-01-296-1-32-2017', 'PLANTA EXTERNA / INTERNA (5602016478)', 'PTR-130', '', 'Las Mercedes', 'mayerling.paez@jhcpconstruccion.com', 1, NULL, NULL),
(131, 'PTC-01-296-1-33-2017', 'PLANTA EXTERNA / INTERNA (5602016478)', 'PTR-131', '', 'Urb Independencia', 'mayerling.paez@jhcpconstruccion.com', 1, NULL, NULL),
(132, 'PTC-01-296-1-34-2017', 'PLANTA EXTERNA / INTERNA (5602016478)', 'PTR-132', '', 'ZI Ojeda', 'mayerling.paez@jhcpconstruccion.com', 1, NULL, NULL),
(133, 'PTC-01-296-1-35-2017', 'PLANTA EXTERNA / INTERNA (5602016478)', 'PTR-133', '', 'PLAZA MADARIAGA', 'katiuska.antelo@jhcpconstruccion.com', 1, NULL, NULL),
(134, 'PTC-03-433-0-2017', 'REPARACIÓN Y NIVELACIÓN DE TANQUILLA', 'PTR-134', '', 'AV. NUEVA GRANADA - EL CEMENTERIO', 'mirna.osuna@jhcpconstruccion.com', 1, NULL, NULL),
(135, 'PTC-03-431-0-2017', 'Desmalezamiento Tinaquillo - Valencia', 'PTR-135', '', 'Tinaquillo - Valencia', 'mirna.osuna@jhcpconstruccion.com', 1, NULL, NULL),
(136, 'PTC-01-296-1-36-2017', 'PLANTA EXTERNA / INTERNA (5602016478)', 'PTR-136', '', 'Mariche ', 'mirna.osuna@jhcpconstruccion.com', 1, NULL, NULL),
(137, 'PTC-01-296-1-37-2017', 'PLANTA EXTERNA / INTERNA (5602016478)', 'PTR-137', '', 'Club Náutico', 'ismarlin.pumero@jhcpconstruccion.com', 1, NULL, NULL),
(138, 'PTC-01-296-1-38-2017', 'PLANTA EXTERNA / INTERNA (5602016478)', 'PTR-138', '', 'Villa Latina', 'ismarlin.pumero@jhcpconstruccion.com', 1, NULL, NULL),
(139, 'PTC-01-296-1-39-2017', 'PLANTA EXTERNA / INTERNA (5602016478)', 'PTR-139', '', 'Los Sabanes', 'ismarlin.pumero@jhcpconstruccion.com', 1, NULL, NULL),
(144, 'PTC-22-372-0-2017', 'MANTENIMIENTO SISTEMA REFRIGERACION', 'PTR-144', '', 'El Rosal- Caracas', 'victor.gandica@jhcpconstruccion.com', 1, NULL, NULL),
(145, 'PTC-42-452-0-2017 ', 'IMPLANTACION OCUMARE', 'PTR-145', '', 'OCUMARE DEL TUY', 'katiuska.antelo@jhcpconstruccion.com', 1, NULL, NULL),
(146, 'PTC-02-445-0-2017', 'INSPECCION CARAYACA', 'PTR-146', '', 'CARAYACA', 'mayerling.paez@jhcpconstruccion.com', 1, NULL, NULL),
(147, 'PTC-03-463-0-2017 ', 'DESMALEZAMIENTO Y BOTE ', 'PTR-147', '', 'BEJUMA- LA LAGUNITA', 'mirna.osuna@jhcpconstruccion.com', 1, NULL, NULL),
(148, 'PTC-31-441-1-2017', 'ADQUISICIÓN EQUIPOS Y SUMINISTRO UPS PDVSA GAS COMUNAL', 'PTR-148', '', 'GUARENAS', 'ayabichino@jhcpconstruccion.com', 1, NULL, NULL),
(149, 'PTC-05-481-0-2017', 'MAKO Project TI & DT en BVI', 'PTR-149', '', 'Islas Vírgenes Británicas', '', 1, NULL, NULL),
(150, 'PTC-05-481-1-2017', 'MAKO Project TI & DT en BVI', 'PTR-150', '', 'Islas Vírgenes Británicas', '', 1, NULL, NULL),
(151, 'PTC-22-487-0-2018', 'REMODELACIÓN CENTRO ATENCIÓN CARACAS ESTE', 'PTR-151', '', 'C.C. PASEO LAS MERCEDES. CARACAS', 'magda.rodriguez@jhcpconstruccion.com', 1, NULL, NULL),
(152, 'PTC-01-484-0-2018', 'EMERGENCIA SUMINISTRO VÁLVULA EXPANSIÓN 250 TR', 'PTR-152', '', 'Centro de Cómputo Canaima. Caracas', 'ayabichino@jhcpconstruccion.com', 1, NULL, NULL),
(153, 'PTC-22-494-0-2018', 'TERMOSTATO DIGITAL 24 VOLTS PARA SISTEMA DE AGUA HELADA', 'PTR-153', '', 'Piso 1 Torre Directv Av. Venezuela El Rosal, Chacao, Caracas', 'ayabichino@jhcpconstruccion.com', 1, NULL, NULL),
(154, 'PTC-05-505-0-2018', 'MAKO Project  TI & DT en SKN', 'PTR-154', '', 'Saint Kitts & Nevis', '', 1, NULL, NULL),
(155, 'PTC-05-505-1-2018', 'MAKO Project  TI & DT en SKN', 'PTR-155', '', 'Saint Kitts & Nevis', '', 1, NULL, NULL),
(156, 'PTC-26-517-0-2018', 'REPARACIONES MENORES DE PLOMERÍA.', 'PTR-156', '', 'CERVECERÍA REGIONAL. CEDIS LA YAGUARA', 'magda.rodriguez@jhcpconstruccion.com', 1, NULL, NULL),
(157, 'PTC-26-546-0-2018', 'REPARACIONES MENORES EN SISTEMA DE BOMBA E HIDRONEUMÁTICO.', 'PTR-157', '', 'CEDIS CERVECERÍA REGIONAL CHARALLAVE', 'ismarlin.pumero@jhcpconstruccion.com', 1, NULL, NULL),
(158, 'PTC-04-462-1-2018', 'CARACTERIZACIÓN CD Y PMD. FO CAUJARITO-EL TABLAZO', 'PTR-158', '', 'ENTRE SUB-ESTACIONES CAUJARITO-EL TABLAZO.', 'victor.gandica@jhcpconstruccion.com', 1, NULL, NULL),
(159, 'PTC-06-521-0-2018', 'CONSTRUCCIÓN PARED PERIMETRAL-CERCADO-PORTÓN', 'PTR-159', '', 'CLOVER INTERNATIONAL-MACARAO-LAS ADJUNTAS', 'mirna.osuna@jhcpconstruccion.com', 1, NULL, NULL),
(160, 'PTC-29-538-0-2018', 'REMODELACIÓN ESTACIÓN LAVADO DE MANOS DEL COMEDOR Y ÁREA DE COMENSALES', 'PTR-160', '', 'KM 1 CARRETERA LA ENCRUCIJADA-TURMERO', 'magda.rodriguez@jhcpconstruccion.com', 1, NULL, NULL),
(161, 'PTC-29-554-0-2018', 'REPARACIÓN ESTRUCTURA METÁLICA, PISO EPÓXICO Y MEDIA CAÑA SANITARIA', 'PTR-161', '', 'ALFONZO RIVAS & CÍA. - TURMERO. EDO. ARAGUA', 'vilcy.bravo@jhcpconstruccion.com', 1, NULL, NULL),
(162, 'PTC-29-552-0-2018', 'SELLADO ANTIAVES EN PARED EXTERNA DEL LABORATORIO DE REFINERÍA ', 'PTR-162', '', 'ALFONZO RIVAS & CÍA. - TURMERO. EDO. ARAGUA', 'vilcy.bravo@jhcpconstruccion.com', 1, NULL, NULL),
(163, 'PTC-22-582-0-2018', 'PUESTA EN SERVICIO UMA PB', 'PTR-163', '', 'TORRE DIRECTV PB EL ROSAL CARACAS', 'victor.gandica@jhcpconstruccion.com', 1, NULL, NULL),
(164, 'PTC-26-583-0-2018', 'INSTALACIÓN TUBERÍA AGUAS BLANCAS EN CEDIS LOS CORTIJOS', 'PTR-164', '', 'CEDIS CERVECERÍA REGIONAL LOS CORTIJOS', 'ismarlin.pumero@jhcpconstruccion.com', 1, NULL, NULL),
(165, 'PTC-06-574-1-2018', 'SERVICIOS GENERALES EN ALMACENES LA YAGUARA', 'PTR-165', '', 'CLOVER LA YAGUARA ', 'ismarlin.pumero@jhcpconstruccion.com', 1, NULL, NULL),
(166, 'PTC-26-586-0-2018', 'SUMINISTROS VARIOS PARA CERVECERÍA REGIONAL', 'PTR-166', '', 'CERVECERÍA REGIONAL LOS CORTIJOS', 'ismarlin.pumero@jhcpconstruccion.com', 1, NULL, NULL),
(167, 'PTC-27-522-1-2018', 'SUMINISTRO, TRANSPORTE E INSTALACIÓN DE PORTONES METÁLICOS', 'PTR-167', '', 'GALLETAS PUIG LOS CORTIJOS', 'magda.rodriguez@jhcpconstruccion.com', 1, NULL, NULL),
(168, 'PTC-22-602-0-2018', 'SUMINISTRO DE CORREAS A41 PARA UMA', 'PTR-168', '', 'DIRECTV. Avenida Venezuela. El Rosal', 'victor.gandica@jhcpconstruccion.com', 1, NULL, NULL),
(169, 'PTC-39--596-0-2018', 'ELABORACIÓN PROYECTO ELÉCTRICO PARA EDIFICIO ADMINISTRATIVO. DHL EXPRESS VENEZUELA', 'PTR-169', '', 'DHL EXPRESS MAIQUETÍA', 'denisse.corrales@jhcpconstruccion.com', 1, NULL, NULL),
(170, 'PTC-22-621-0-2018', 'SUMINISTRO ACTUADOR HONEYWELL ML7984A4009 MODULANTE PARA VÁLVULA DE ACOPLE DE BOLA', 'PTR-170', '', 'DIRECTV EL ROSAL', 'victor.gandica@jhcpconstruccion.com', 1, NULL, NULL),
(171, 'PTC-34-623-0-2018', 'ALQUILER DE CUADRILLAS PARA EL PROYECTO MAKO EN BVI (Bs)', 'PTR-171', '', 'Islas Vírgenes Británicas', 'ayabichino@jhcpconstruccion.com', 1, NULL, NULL),
(172, 'PTC-34-623-1-2018', 'MANPOWER RENTAL IN BVI FOR MAKO PROJECT (USD)', 'PTR-172', '', 'British Virgin Islands', 'ayabichino@jhcpconstruccion.com', 1, NULL, NULL),
(173, 'PTC-22-597-1-2018', 'MANTENIMIENTO CORRECTIVO UMA ALA ESTE PISO 2 TORRE DIRECTV. EL ROSAL', 'PTR-173', '', 'TORRE DIRECTV ALA ESTE PISO 2 EL ROSAL CARACAS', 'victor.gandica@jhcpconstruccion.com', 1, NULL, NULL),
(174, 'PTC-22-628-0-2018', 'MANTENIMIENTO CORRECTIVO DE LA UMA ALA OESTE PISO 2 TORRE DIRECTV EL ROSAL', 'PTR-174', '', 'TORRE DIRECTV EL ROSAL CARACAS', 'victor.gandica@jhcpconstruccion.com', 1, NULL, NULL),
(175, 'PTC-06-634-0-2018', 'REMOCIÓN E INSTALACIÓN DE CABLE THW # 6 Y CONEXIÓN DE EQUIPOS AL TABLERO PRINCIPAL', 'PTR-175', '', 'CLOVER SEDE MACARAO', 'magda.rodriguez@jhcpconstruccion.com', 1, NULL, NULL),
(176, 'PTC-01-630-0-2018', 'SUMINISTRO E INSTALACIÓN DE BOMBA DE AGUA Y CORREA PARA MOTOGENERADOR 1 CANAIMA', 'PTR-176', '', 'Telefónica, Edificio Parque Canaima, avenida 2, urbanización Los Palos Grandes, Caracas', 'victor.gandica@jhcpconstruccion.com', 1, NULL, NULL),
(177, 'PTC-06-642-0-2018', 'TRABAJOS DE ELECTRICIDAD EN ALMACENES DE MACARAO', 'PTR-177', '', 'CLOVER MACARAO', 'magda.rodriguez@jhcpconstruccion.com', 1, NULL, NULL),
(178, 'PTC-25-641-0-2018', 'Mejora del Sistema de Drenajes de Agua de Lluvia en la entrada de la Planta de Vinagre', 'PTR-178', '', 'Planta Heinz. Sede San Joaquín', 'magda.rodriguez@jhcpconstruccion.com', 1, NULL, NULL),
(179, 'PTC-22-670-1-2019', 'Mantenimiento correctivo UMA ala oeste piso 11 torre DIRECTV ', 'PTR-179', '', 'Torre Directv, El Rosal', 'victor.gandica@jhcpconstruccion.com', 1, NULL, NULL),
(180, 'PTC-22-643-1-2019', 'SERVICIO DE MANTENIMIENTO PREVENTIVO Y CORRECTIVO DE LAS UNIDADES DE AIRE ACONDICIONADO DE LA SEDE D', 'PTR-180', '', 'Sede del Telecenter, Los Ruices, Caracas', 'victor.gandica@jhcpconstruccion.com', 1, NULL, NULL),
(181, 'PTC-22-670-3-2019', 'REPARACIÓN DE EJE DE LA UMA ALA ESTE DEL PISO 6. TORRE DIRECTV', 'PTR-181', '', 'Torre Directv, El Rosal', 'victor.gandica@jhcpconstruccion.com', 1, NULL, NULL),
(182, 'PTC-06-698-0-2019', 'REVISIÓN Y MANTENIMIENTO DE LÁMPARAS ESPECULARES Y REFLECTORES', 'PTR-182', '', 'CLOVER INTERNATIONAL C.A., Sede Barcelona, Oficinas Administrativas', 'victor.gandica@jhcpconstruccion.com', 1, NULL, NULL),
(183, 'PTC-06-704-0-2019', 'SUMINISTRO E INSTALACIÓN DE POCETA EN BAÑO DE CABALLEROS', 'PTR-183', '', 'CLOVER INTERNATIONAL C.A., Sede Maiquetía', 'magda.rodriguez@jhcpconstruccion.com', 1, NULL, NULL),
(184, 'PTC-06-717-0-2019', 'INSTALACIÓN DE 6 REFLECTORES METAL HALIDE 400 W PARA AREA EXTERNA DEL ALMACÉN. MAIQUETÍA', 'PTR-184', '', 'CLOVER INTERNATIONAL C.A., Sede Maiquetía', 'magda.rodriguez@jhcpconstruccion.com', 1, NULL, NULL),
(185, 'PTC-36-720-0-2019', 'RESTAURACIÓN DE BAÑO DE CABALLEROS', 'PTR-185', '', 'EMPORIO CHACAÍTO (BECO). PROMOTORA TÁNTALO', 'victor.gandica@jhcpconstruccion.com', 1, NULL, NULL),
(186, 'PTC-36-727-0-2019', 'REPARACIÓN DE FILTRACIONES ÁREA DE FARMACIA EXCELSIOR GAMA ', 'PTR-186', '', 'AV. LOS GUAYABITOS, C.C. EXPRESO BARUTA, BARUTA, CARACAS. PROMOTORA TÁNTALO', 'magda.rodriguez@jhcpconstruccion.com', 1, NULL, NULL),
(187, 'PTC-35-733-0-2019', 'TRANSPORTE Y CALETEO DE MOBILIARIO DESDE DEPÓSITOS KEDRON HASTA OLVC Y CONSTRUCCIÓN DE DRY WALL DE D', 'PTR-187', '', 'NESTLÉ DE VENEZUELA. Caracas.', 'magda.rodriguez@jhcpconstruccion.com', 1, NULL, NULL),
(188, 'PTC-36-721-0-2019', 'REPARACIÓN DE FILTRACIONES EN PISO 6 TORRE DE OFICINAS C.C. EXPRESO BARUTA', 'PTR-188', '', 'AV. LOS GUAYABITOS, C.C. EXPRESO BARUTA, BARUTA, CARACAS. PROMOTORA TÁNTALO', 'magda.rodriguez@jhcpconstruccion.com', 1, NULL, NULL),
(189, 'PTC-JHCP-INTERN-1-2020', 'JHCP INTERNACIONAL', 'PTR-189', '+1', 'Panamá', 'pierre@jhcp.com', 1, NULL, NULL),
(190, 'PTC-35-731-0-2019', 'ADECUACIÓN OFICINA DE VENTAS TURMERO. ANTIGUO EDIFICIO BRUNO. ESTADO ARAGUA', 'PTR-190', '', 'OFICINA DE VENTAS TURMERO DE NESTLÉ. ESTADO ARAGUA', 'magda.rodriguez@jhcpconstruccion.com', 1, NULL, NULL),
(191, 'PTC-36-736-0-2019', 'ADECUACIONES EN C.C. EMPORIO CHACAÍTO. REPARACIÓN DE TUBERÍA 1 1/2\" BAÑO ATC', 'PTR-191', '', 'EMPORIO CHACAÍTO (BECO). PROMOTORA TÁNTALO', 'magda.rodriguez@jhcpconstruccion.com', 1, NULL, NULL),
(192, 'PTC-36-736-1-2019', 'REPARACIÓN DE TUBERÍA DE CONEXIÓN DE WC CON FLUXÓMETRO EN CUBÍCULO DE DISCAPACITADOS NIVEL FERIA DAM', 'PTR-192', '', 'EMPORIO CHACAÍTO (BECO). PROMOTORA TÁNTALO', 'magda.rodriguez@jhcpconstruccion.com', 1, NULL, NULL),
(193, 'PTC-47-745-0-2020', 'EMPALME POR FUSIÓN DE 10 HILOS DE FIBRA ÓPTICA EN EL SEGMENTO ANTÍMANO - LAS ADJUNTAS', 'PTR-193', '', 'ANTÍMANO-LAS ADJUNTAS. SYSTEM CABLE', 'victor.gandica@jhcpconstruccion.com', 1, NULL, NULL),
(194, 'PTC-36-747-0-2020', 'INSTALACIÓN DE EMERGENCIA MEDIDOR DE GAS EN LOCAL COMERCIAL C.C. EXPRESO BARUTA', 'PTR-194', '', 'AV. LOS GUAYABITOS, C.C. EXPRESO BARUTA, BARUTA, CARACAS. PROMOTORA TÁNTALO', 'magda.rodriguez@jhcpconstruccion.com', 1, NULL, NULL),
(195, 'PTC-35-752-0-2020', 'REPARACIÓN DE DRENAJES DE A/A CAVAS CLIMATIZADO', 'PTR-195', '', 'NESTLÉ DE VENEZUELA - SANTA CRUZ, EDO. ARAGUA', 'magda.rodriguez@jhcpconstruccion.com', 1, NULL, NULL),
(196, 'PTC-35-763-0-2020', 'REMOCIÓN DE JUNTA Y COLOCACIÓN DE SICA FLEX NUEVO Y  RESANE DE PISO Y TAPAR HUECO EN ALMACENES LOGÍS', 'PTR-196', '', 'NESTLÉ DE VENEZUELA. LA ENCRUCIJADA, EDO.ARAGUA', 'magda.rodriguez@jhcpconstruccion.com', 1, NULL, NULL),
(197, 'PTC-35-755-0-2020', 'SUMINISTRO Y COLOCACIÓN DE MALLAS PROTECTORAS DE PLAGAS', 'PTR-197', '', 'NESTLÉ DE VENEZUELA - SANTA CRUZ, EDO. ARAGUA', 'magda.rodriguez@jhcpconstruccion.com', 1, NULL, NULL),
(198, 'PTC-35-759-0-2020', 'RESTITUCIÓN DE PARABICHOS ', 'PTR-198', '', 'NESTLÉ DE VENEZUELA - SANTA CRUZ, EDO. ARAGUA', 'magda.rodriguez@jhcpconstruccion.com', 1, NULL, NULL),
(199, 'PTC-35-770-0-2020', 'SERVICIO DE MANO DE OBRA Y REPARACIÓN DE GOTERA EN SISTEMA CONTRA INCENDIO BODEGA N°03 / LLAVE DE PA', 'PTR-199', '', 'NESTLÉ DE VENEZUELA - LA ENCRUCIJADA, EDO. ARAGUA', 'magda.rodriguez@jhcpconstruccion.com', 1, NULL, NULL),
(200, 'PTC-35-756-0-2020', 'SERVICIO DE MANTENIMIENTO GENERAL DE A/A EN EDIFICIO ADMINISTRATIVO', 'PTR-200', '', 'NESTLÉ DE VENEZUELA - SANTA CRUZ, EDO. ARAGUA', 'magda.rodriguez@jhcpconstruccion.com', 1, NULL, NULL),
(201, 'PTC-35-795-0-2020', 'SERVICIOS DE MANTENIMIENTO Y CONSERVACIÓN DE INFRAESTRUCTURA DEL EDIFICIO ADMINISTRATIVO EN CENTRO D', 'PTR-201', '', 'NESTLÈ DE VENEZUELA - CD MORÒN, EDO. CARABOBO', 'magda.rodriguez@jhcpconstruccion.com', 1, NULL, NULL),
(202, 'PTC-50-841-0-2021', 'ADECUACIÓN DEL DEPÓSITO CRV EN VALENCIA', 'PTR-202', '', 'HOSPITAL LUIS BLANCO GÁSPERI, CALLE 133 LÓPEZ LATOUCHE, VALENCIA, EDO. CARABOBO', 'amelie.acosta@jhcp.com', 1, NULL, NULL),
(203, 'PTC-50-841-1-2021', 'OBRAS ADICIONALES EN ADECUACIÓN DEL DEPÓSITO CRV EN VALENCIA', 'PTR-203', '', 'HOSPITAL LUIS BLANCO GÁSPERI, CALLE 133 LÓPEZ LATOUCHE, VALENCIA, EDO. CARABOBO', 'amelie.acosta@jhcp.com', 1, NULL, NULL),
(204, 'PTC-06-840-0-20121', 'REPARACIONES EN LAS OFICINAS DEL SINDICATO SEDE LA YAGUARA', 'PTR-204', '', 'CLOVER LA YAGUARA, CARACAS', 'amelie.acosta@jhcp.com', 1, NULL, NULL),
(205, 'PTC-50-842-0-2021', 'ADECUACIÓN DE LOS ESPACIOS DEL 1er. PISO, HOSPITAL CARLOS J. BELLO”', 'PTR-205', '', 'AVENIDA ANDRÉS BELLO, PARCELA N.° 4, EDIFICIO SEDE SOCIEDAD NACIONAL DE LA CRUZ ROJA, HOSPITAL CARLOS J. BELLO. URB. SAN BERNARDINO, CARACAS', 'amelie.acosta@jhcp.com', 1, NULL, NULL),
(206, 'PTC-06-853-0-2021', 'REPARACIÓN DE PIEZAS SANITARIAS EN BAÑO OFICINAS CLOVER MAIQUETÍA ADUANA', 'PTR-206', '', 'OFICINAS DE CLOVER EN LA ADUANA DE MAIQUETÍA. EDO. LA GUAIRA', 'amelie.acosta@jhcp.cpm', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(64, '2014_10_12_000000_create_users_table', 1),
(65, '2014_10_12_100000_create_password_resets_table', 1),
(66, '2019_08_19_000000_create_failed_jobs_table', 1),
(67, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(68, '2021_10_13_161651_cliente', 1),
(69, '2021_10_13_161950_codventa', 1),
(70, '2021_10_13_162020_tipo', 1),
(71, '2021_10_13_162114_personal', 1),
(72, '2021_10_13_162146_obra', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `obra`
--

CREATE TABLE `obra` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `obra_codigo` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `obra_nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `obra_monto` decimal(20,2) DEFAULT NULL,
  `obra_montogasto` decimal(20,2) DEFAULT NULL,
  `obra_ganancia` decimal(20,2) DEFAULT NULL,
  `obra_fechainicio` date DEFAULT NULL,
  `obra_fechafin` date DEFAULT NULL,
  `obra_residente` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `obra_coordinador` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `obra_observaciones` longtext COLLATE utf8mb4_unicode_ci,
  `obra_estado` tinyint(4) NOT NULL,
  `cliente_id` bigint(20) UNSIGNED DEFAULT NULL,
  `tipo_id` bigint(20) UNSIGNED DEFAULT NULL,
  `codventa_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `obra`
--

INSERT INTO `obra` (`id`, `obra_codigo`, `obra_nombre`, `obra_monto`, `obra_montogasto`, `obra_ganancia`, `obra_fechainicio`, `obra_fechafin`, `obra_residente`, `obra_coordinador`, `obra_observaciones`, `obra_estado`, `cliente_id`, `tipo_id`, `codventa_id`, `created_at`, `updated_at`) VALUES
(1, 'OBR-1', 'Operaciones de Oficina', NULL, NULL, NULL, NULL, NULL, 'Todos', 'Todos', NULL, 1, NULL, NULL, NULL, NULL, NULL),
(2, 'OBR-2', 'San Casimiro - Santa Lucia', NULL, NULL, NULL, NULL, NULL, 'Luis Longo', 'Fredy Altuve', NULL, 1, NULL, NULL, NULL, NULL, NULL),
(3, 'OBR-3', 'Enlace 8B2', NULL, NULL, NULL, NULL, NULL, 'Hildemaro Segura', 'Yelineth Sanchez', NULL, 1, NULL, NULL, NULL, NULL, NULL),
(4, 'OBR-4', 'Fabricación de Tanquillas', NULL, NULL, NULL, NULL, NULL, 'Marco Longo', 'Daniel Belisario', NULL, 1, NULL, NULL, NULL, NULL, NULL),
(5, 'OBR-5', 'Link 9.2', NULL, NULL, NULL, NULL, NULL, 'Miguel Aguilar', 'Yelineth Sanchez', NULL, 1, NULL, NULL, NULL, NULL, NULL),
(6, 'OBR-6', 'Tramo 12', NULL, NULL, NULL, NULL, NULL, 'Edwin Correa', 'Victor Gandica', NULL, 1, NULL, NULL, NULL, NULL, NULL),
(7, 'OBR-7', 'tramo 8B-2 soplado san Casimiro--san Sebastian', NULL, NULL, NULL, NULL, NULL, 'Victor Zambrano', 'Victor Gandica', NULL, 1, NULL, NULL, NULL, NULL, NULL),
(8, 'OBR-8', 'Tramo 7B1', NULL, NULL, NULL, NULL, NULL, 'Contratista Externa', 'Victor Gandica', NULL, 1, NULL, NULL, NULL, NULL, NULL),
(9, 'OBR-9', 'Alcatel Tramo 5', NULL, NULL, NULL, NULL, NULL, 'Omar Risales', 'Antoine Yabichino', NULL, 1, NULL, NULL, NULL, NULL, NULL),
(10, 'OBR-10', 'MSAN ', NULL, NULL, NULL, NULL, NULL, 'Varios', 'Rafael Cheng- Oscar Cisternas', 'ZTE', 1, NULL, NULL, NULL, NULL, NULL),
(11, 'OBR-11', 'Tramo 6', NULL, NULL, NULL, NULL, NULL, 'Omar Risales', 'Omar Risales', NULL, 1, NULL, NULL, NULL, NULL, NULL),
(12, 'OBR-12', 'Tramo 8B-1', NULL, NULL, NULL, NULL, NULL, 'Luis Longo', 'Fredy Altuve', NULL, 1, NULL, NULL, NULL, NULL, NULL),
(13, 'OBR-13', 'SEGURO SOCIAL OBLITARIO', NULL, NULL, NULL, NULL, NULL, 'ANA CASTAÑO', 'ANTONELLA', NULL, 1, NULL, NULL, NULL, NULL, NULL),
(14, 'OBR-14', 'BANAVIH', NULL, NULL, NULL, NULL, NULL, 'ANA CASTAÑO', 'ANTONELLA', NULL, 1, NULL, NULL, NULL, NULL, NULL),
(15, 'OBR-15', 'INCE', NULL, NULL, NULL, NULL, NULL, 'ANA CASTAÑO', 'ANTONELLA', NULL, 1, NULL, NULL, NULL, NULL, NULL),
(16, 'OBR-16', 'Tramo 13.2', NULL, NULL, NULL, NULL, NULL, 'Oswaldo Estevez', 'Fredy Altuve', NULL, 1, NULL, NULL, NULL, NULL, NULL),
(17, 'OBR-17', 'VACACIONES', NULL, NULL, NULL, NULL, NULL, '2015', 'RRHH', '0', 0, NULL, NULL, NULL, NULL, NULL),
(18, 'OBR-18', 'VACACIONES', NULL, NULL, NULL, NULL, NULL, '2015', 'RRHH', '0', 0, NULL, NULL, NULL, NULL, NULL),
(19, 'OBR-19', 'Cargill', NULL, NULL, NULL, NULL, NULL, 'Daniel Belisario', 'Fredy Altuve', NULL, 1, 1, 8, NULL, NULL, NULL),
(20, 'OBR-20', 'EDC Network', NULL, NULL, NULL, NULL, NULL, 'Lorena- Annie - Alfredo', 'Carlos Ayala-Mayerling Paez', NULL, 1, NULL, NULL, NULL, NULL, NULL),
(21, 'OBR-21', 'Digitel', NULL, NULL, NULL, NULL, NULL, 'Edwin Correa', 'Carlos Ayala', NULL, 1, NULL, NULL, NULL, NULL, NULL),
(22, 'OBR-22', 'Digitel', NULL, NULL, NULL, NULL, '2016-08-17', 'Edwin Correa', 'Carlos Ayala', NULL, 2, NULL, NULL, NULL, NULL, NULL),
(23, 'OBR-23', 'Liquidación', NULL, NULL, NULL, NULL, NULL, '0', 'RRHH', NULL, 1, NULL, NULL, NULL, NULL, NULL),
(24, 'OBR-24', 'Nómina de oficina', NULL, NULL, NULL, NULL, NULL, 'caracas', 'pierre', NULL, 1, NULL, NULL, NULL, NULL, NULL),
(25, 'OBR-25', 'LINK 7B3', NULL, NULL, NULL, NULL, NULL, 'Hildemaro Segura', 'Yelineth Sánchez', NULL, 1, NULL, NULL, NULL, NULL, NULL),
(27, 'OBR-27', 'Gastos Máquinas', NULL, NULL, NULL, NULL, NULL, 'N/A', 'N/A', NULL, 1, NULL, NULL, NULL, NULL, NULL),
(28, 'OBR-28', 'Máquinas', NULL, NULL, NULL, NULL, NULL, 'N/A', 'Joelis Blanco', NULL, 1, NULL, NULL, NULL, NULL, NULL),
(29, 'OBR-29', 'Vehículos', '0.00', NULL, NULL, NULL, NULL, 'N/A', 'Joelis Blanco', NULL, 1, NULL, NULL, NULL, NULL, NULL),
(30, 'OBR-30', 'TRAMO 8B-2 soplado San Sebastian-- San Juan de los Morros', '0.00', NULL, NULL, NULL, NULL, 'Edwin Correa', 'Victor Gandica', NULL, 1, NULL, NULL, NULL, NULL, NULL),
(31, 'OBR-31', 'MSAN (Instalación de Equipos)', '0.00', NULL, NULL, NULL, NULL, 'Carlos Ayala', 'Carlos Ayala', NULL, 1, NULL, NULL, NULL, NULL, NULL),
(32, 'OBR-32', 'Obras Varias', '0.00', NULL, NULL, NULL, NULL, 'Varios', 'Varios', NULL, 1, NULL, NULL, NULL, NULL, NULL),
(33, 'OBR-33', 'PRESTAMO', '0.00', NULL, NULL, NULL, NULL, '0', 'JESUS FORNERINO', '0', 1, NULL, NULL, NULL, NULL, NULL),
(34, 'OBR-34', 'Acarigua', '0.00', NULL, NULL, NULL, NULL, 'Omar Risales', 'Jose Alejandro Flores', '0', 1, NULL, NULL, NULL, NULL, NULL),
(35, 'OBR-35', 'Tramo 7B - Asbuilt Fase 6', NULL, NULL, NULL, NULL, NULL, 'Edwin Correa', 'Victor Gandica', NULL, 1, NULL, NULL, NULL, NULL, NULL),
(36, 'OBR-36', 'SIAE', '0.00', NULL, NULL, NULL, NULL, 'Lorena Arria', 'Edwin Blanco', NULL, 1, NULL, NULL, NULL, NULL, NULL),
(37, 'OBR-37', 'EDC Network Fase 2', NULL, NULL, NULL, NULL, NULL, 'Edwin Blanco', 'Mayerling Paez', NULL, 1, NULL, NULL, NULL, NULL, NULL),
(38, 'OBR-38', 'CGL-CD-20-DB', '145405.00', NULL, NULL, NULL, NULL, 'Daniel Belisario', 'Fredy Altuve', 'Remoción de láminas plásticas y revestimiento de pintura de carriles. 20 Portones a sustituir láminas y 10 perfiles a pintar', 1, NULL, NULL, NULL, NULL, NULL),
(39, 'OBR-39', 'CGL-CD-19-DB', '50203.00', NULL, NULL, NULL, NULL, 'Daniel Belisario', 'Fredy Altuve', 'Revestimiento de pintura en guías de santa maría', 1, NULL, NULL, NULL, NULL, NULL),
(40, 'OBR-40', 'CGL-CD-18-DB', '324942.00', NULL, NULL, NULL, NULL, 'Daniel Belisario', 'Fredy Altuve', 'Reparaciones a portón 8 completo: laminas, guias, zocalo, pintura, mantenimiento', 1, NULL, NULL, NULL, NULL, NULL),
(41, 'OBR-41', 'CGL-CD-18-DB.AO y CGL-CD-19-DB.AO', '242529.00', NULL, NULL, NULL, NULL, 'Daniel Belisario', 'Fredy Altuve', 'Reparacion de agujeros y roturas en cubierta de techo, laminas noral', 1, NULL, NULL, NULL, NULL, NULL),
(42, 'OBR-42', 'Enlace 9-1', NULL, NULL, NULL, NULL, NULL, 'Oswaldo Estevez', 'Fredy Altuve', NULL, 1, NULL, NULL, NULL, NULL, NULL),
(43, 'OBR-43', 'CGL-LP-02-AO.DB', '7010737.00', NULL, NULL, NULL, NULL, 'Daniel Belisario, Alejandro Ojeda', 'Fredy Altuve', 'Instalación de techo liviano en casa sindical, obras varias de electricidad y cerramiento', 1, NULL, NULL, NULL, NULL, NULL),
(44, 'OBR-44', 'CGL-CD-MALLA-DB.AO-O.A. ADICIONALES instalación de malla', '513332.00', NULL, NULL, NULL, NULL, 'Daniel Belisario, Alejandro Ojeda', 'Fredy Altuve', 'Obras Adicionales referentes a la instalación de malla multifilamento', 1, NULL, NULL, NULL, NULL, NULL),
(45, 'OBR-45', 'CGL-PC-19-DB.AO', NULL, NULL, NULL, NULL, NULL, 'Daniel Belisario', 'Alejandro Ojeda', NULL, 1, NULL, NULL, NULL, NULL, NULL),
(46, 'OBR-46', 'Gastos de Recursos Humanos', NULL, NULL, NULL, NULL, NULL, 'Jordy Colmenares', 'Ana Castaño', NULL, 1, NULL, NULL, NULL, NULL, NULL),
(47, 'OBR-47', 'Construcción de Cubierta de Techo en Estacionamiento', '7204555.00', NULL, NULL, NULL, NULL, 'Daniel Belisario', 'Alejandro Ojeda', 'En planta Catia', 1, NULL, NULL, NULL, NULL, NULL),
(48, 'OBR-48', 'Tramo 7B3 (soplado)', NULL, NULL, NULL, '2015-07-22', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL),
(49, 'OBR-49', 'Barridos de Frecuencia ZTE', NULL, NULL, NULL, '2015-08-31', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL),
(50, 'OBR-50', 'Digitel Pto Ayacucho F.O', NULL, NULL, NULL, '2015-09-07', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL),
(51, 'OBR-51', 'TRAMO 7B-2 (SOPLADO)', NULL, NULL, NULL, '2015-09-29', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL),
(52, 'OBR-52', 'Digitel Coro - Morón', NULL, NULL, NULL, '2015-10-12', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL),
(53, 'OBR-53', 'Planta Interna Movistar', NULL, NULL, NULL, '2015-10-12', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL),
(54, 'OBR-54', 'Ingeniería Movistar', NULL, NULL, NULL, '2015-10-26', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL),
(55, 'OBR-55', 'Enlace MW ZTE', NULL, NULL, NULL, '2015-11-09', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL),
(56, 'OBR-56', 'Tramo 14', NULL, NULL, NULL, '2015-11-11', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL),
(57, 'OBR-57', 'Soplado Tramo 5A', NULL, NULL, NULL, '2015-12-14', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL),
(58, 'OBR-58', 'EDC Network Fase 3', NULL, NULL, NULL, '2016-02-03', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL),
(59, 'OBR-59', 'Planta Interna Movistar Maracaibo', NULL, NULL, NULL, '2016-02-22', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL),
(60, 'OBR-60', 'Ingeniería SIAE', NULL, NULL, NULL, '2016-02-29', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL),
(61, 'OBR-61', 'Soplado Tramo 13.2', NULL, NULL, NULL, '2016-03-07', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL),
(62, 'OBR-62', 'Movilnet Gul', NULL, NULL, NULL, '2016-03-31', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL),
(63, 'OBR-63', 'Digitel Prioridad II Valle del Tuy', NULL, NULL, NULL, '2016-04-11', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL),
(64, 'OBR-64', 'Soplado 9.1', NULL, NULL, NULL, '2016-04-13', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL),
(65, 'OBR-65', 'Soplado Tramo 14', NULL, NULL, NULL, '2016-05-04', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL),
(66, 'OBR-66', 'TMVE-PLEX-STAPAUL', NULL, NULL, NULL, '2016-05-18', NULL, NULL, NULL, NULL, 1, 5, 11, NULL, NULL, NULL),
(67, 'OBR-67', 'TMVE-PLIN-CTRO', NULL, NULL, NULL, '2016-05-20', NULL, NULL, NULL, NULL, 1, 5, 11, NULL, NULL, NULL),
(68, 'OBR-68', 'TMVE-PLIN-ORIENT', NULL, NULL, NULL, '2016-05-20', NULL, NULL, NULL, NULL, 1, 5, 11, NULL, NULL, NULL),
(69, 'OBR-69', 'TMVE-PLIN-OCCDT', NULL, NULL, NULL, '2016-05-20', NULL, NULL, NULL, NULL, 1, 5, 11, NULL, NULL, NULL),
(70, 'OBR-70', 'PMD-HUAWEI', NULL, NULL, NULL, '2016-05-31', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL),
(71, 'OBR-71', 'Auditoria Movistar', NULL, NULL, NULL, '2016-06-08', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL),
(72, 'OBR-72', 'CANTV La Reyera', NULL, NULL, NULL, '2016-06-08', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL),
(73, 'OBR-73', 'Mtso. Maracaibo', NULL, NULL, NULL, '2016-06-17', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL),
(74, 'OBR-74', 'Fibraterra - La Baralt', NULL, NULL, NULL, '2016-06-20', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL),
(75, 'OBR-75', 'Planta Externa Movistar Coro Morn', NULL, NULL, NULL, '2016-07-06', '2016-07-08', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL),
(76, 'OBR-76', 'FIBRATERRA – OCUMARE', NULL, NULL, NULL, '2016-07-11', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL),
(77, 'OBR-77', 'Planta interna CORO MORON', NULL, NULL, NULL, '2016-07-25', '2016-07-27', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL),
(79, 'OBR-79', 'TMVE-PLIN-MQTA', NULL, NULL, NULL, '2016-07-25', NULL, NULL, NULL, NULL, 1, 5, 11, NULL, NULL, NULL),
(80, 'OBR-80', 'TMVE-PLIN-ANDE', NULL, NULL, NULL, '2016-07-20', NULL, NULL, NULL, NULL, 1, 5, 11, NULL, NULL, NULL),
(81, 'OBR-81', 'TMVE-PLEX-MCBO', NULL, NULL, NULL, '2016-08-01', NULL, NULL, NULL, NULL, 1, 8, 11, NULL, NULL, NULL),
(82, 'OBR-82', 'TMVE-PLEX-MQTA', NULL, NULL, NULL, '2016-08-11', NULL, NULL, NULL, NULL, 1, 8, 11, NULL, NULL, NULL),
(83, 'OBR-83', 'TMVE-PLEX-ORIENT', NULL, NULL, NULL, '2016-08-23', NULL, NULL, NULL, NULL, 1, 5, 11, NULL, NULL, NULL),
(84, 'OBR-84', 'TMVE-PLEX-EPROTEL', NULL, NULL, NULL, '2016-08-19', NULL, NULL, NULL, NULL, 1, 5, 11, NULL, NULL, NULL),
(85, 'OBR-85', 'TMVE-TEND-MCBO', NULL, NULL, NULL, '2016-09-01', NULL, NULL, NULL, NULL, 1, 5, 11, NULL, NULL, NULL),
(86, 'OBR-86', 'TMVE--LATAM-YARE', NULL, NULL, NULL, '2016-09-05', NULL, NULL, NULL, NULL, 1, 5, 11, 26, NULL, NULL),
(87, 'OBR-87', 'TMVE-PLIN-LATAM-RMVERDE', NULL, NULL, NULL, '2016-09-06', NULL, NULL, NULL, NULL, 1, 5, 11, NULL, NULL, NULL),
(88, 'OBR-88', 'CANT-TEND-CANTV', NULL, NULL, NULL, '2016-09-19', NULL, NULL, NULL, NULL, 1, 9, 11, NULL, NULL, NULL),
(89, 'OBR-89', 'TMVE-PLEX-DABAJURO_CORO', NULL, NULL, NULL, '2016-10-17', NULL, NULL, NULL, NULL, 1, 5, 11, NULL, NULL, NULL),
(90, 'OBR-90', 'TMVE-DESM-RAMOVERDE', '2800000.00', NULL, '66.50', '2016-10-05', '2016-10-14', NULL, NULL, 'POSIBLEMENTE SE CULMINE ANTES', 1, 5, 8, NULL, NULL, NULL),
(91, 'OBR-91', 'TMVE-PTOVENTA-MX', NULL, NULL, NULL, '2016-10-07', '2016-10-07', NULL, NULL, NULL, 1, 5, 1, NULL, NULL, NULL),
(92, 'OBR-92', 'TMVE-DESM-EPROTEL-STAPLA', NULL, NULL, '40.00', '2016-10-10', '2016-10-14', NULL, NULL, NULL, 1, 5, 8, NULL, NULL, NULL),
(93, 'OBR-93', 'TMVE-INGENIERIA-PLEX', NULL, NULL, NULL, '2016-10-28', NULL, NULL, NULL, NULL, 1, 5, 4, NULL, NULL, NULL),
(94, 'OBR-94', 'TMVE-DESINT-OCTDIC16', NULL, NULL, NULL, '2016-11-01', NULL, NULL, NULL, 'PO 4590033653 PENDIENTE ASIGNACION', 1, 5, 4, NULL, NULL, NULL),
(95, 'OBR-95', 'CVER-CRTOPRT-MCRO', NULL, NULL, NULL, '2016-11-09', NULL, NULL, NULL, NULL, 0, 11, 8, 20, NULL, NULL),
(96, 'OBR-96', 'TMVE-PLIN-HATILLO', NULL, NULL, NULL, '2016-11-09', NULL, NULL, NULL, NULL, 1, 5, 8, 21, NULL, NULL),
(97, 'OBR-97', 'TMVE-PLIN-CLRET', NULL, NULL, NULL, '2016-11-09', NULL, NULL, NULL, NULL, 1, 5, 8, 22, NULL, NULL),
(98, 'OBR-98', 'TMVE-PLIN-DOLORITA', NULL, NULL, NULL, '2016-11-09', NULL, NULL, NULL, NULL, 1, 5, 8, 23, NULL, NULL),
(100, 'OBR-100', 'TMVE-PLIN-PALOVERDE', NULL, NULL, NULL, '2016-11-09', NULL, NULL, NULL, NULL, 1, 5, 8, 24, NULL, NULL),
(103, 'OBR-103', 'TMVE-MOVEQ-YARE', NULL, NULL, NULL, '2016-11-11', NULL, NULL, NULL, NULL, 1, 5, 11, 27, NULL, NULL),
(104, 'OBR-104', 'TMVE-PLEX-CBLLDA', NULL, NULL, NULL, '2016-11-11', NULL, NULL, NULL, NULL, 1, 5, 8, 28, NULL, NULL),
(105, 'OBR-105', 'TMVE-PLIN-EPROTEL', NULL, NULL, NULL, '2016-11-11', NULL, NULL, NULL, NULL, 1, 5, 8, 25, NULL, NULL),
(106, 'OBR-106', 'TMVE-PLEX-ZRZA', NULL, NULL, NULL, '2016-11-14', NULL, NULL, NULL, NULL, 1, 5, 11, 29, NULL, NULL),
(107, 'OBR-107', 'TMVE-PLEX-SMBRO', NULL, NULL, NULL, '2016-11-14', NULL, NULL, NULL, NULL, 1, 5, 11, 30, NULL, NULL),
(108, 'OBR-108', 'CVER-SUMIBOMB-BARCLA', NULL, NULL, NULL, '2016-11-18', NULL, NULL, NULL, NULL, 1, 11, 8, 32, NULL, NULL),
(109, 'OBR-109', 'TMVE-LATAM-LIPSUR', NULL, NULL, NULL, '2016-11-21', NULL, NULL, NULL, NULL, 1, 5, 11, 35, NULL, NULL),
(110, 'OBR-110', 'TMVE-LATAM-MACHIQ', NULL, NULL, NULL, '2016-11-21', NULL, NULL, NULL, NULL, 1, 5, 11, 33, NULL, NULL),
(111, 'OBR-111', 'CVER-LIMPLPRO-BARCLA', '1.25', NULL, '13.00', '2016-11-24', '2016-12-24', NULL, NULL, NULL, 1, 11, 3, 36, NULL, NULL),
(112, 'OBR-112', 'TMVE-LATAM-PARCTOS', NULL, NULL, NULL, '2016-11-23', NULL, NULL, NULL, NULL, 1, 5, 11, 37, NULL, NULL),
(113, 'OBR-113', 'TMVE-LATAM-ANAUC', NULL, NULL, NULL, '2016-11-23', NULL, NULL, NULL, NULL, 1, 5, 11, 38, NULL, NULL),
(114, 'OBR-114', 'CVER-INSTOLD-MCRO', '255000.00', NULL, '23.00', '2016-11-24', '2016-11-25', NULL, NULL, NULL, 1, 11, 3, 39, NULL, NULL),
(115, 'OBR-115', 'NUNO-PMDCD-SANDCCS', NULL, NULL, NULL, '2016-11-29', NULL, NULL, NULL, NULL, 1, 13, 11, 31, NULL, NULL),
(116, 'OBR-116', 'TMVE-LATAM-CATA', NULL, NULL, NULL, '2016-12-01', NULL, NULL, NULL, NULL, 1, 5, 11, 41, NULL, NULL),
(117, 'OBR-117', 'TMVE-PLEX-BUVISTA', NULL, NULL, NULL, '2016-12-01', NULL, NULL, NULL, NULL, 1, 5, 11, 42, NULL, NULL),
(118, 'OBR-118', 'TMVE-LATAM -CENTAGUA', NULL, NULL, NULL, '2016-12-05', NULL, NULL, NULL, NULL, 1, 5, 11, 40, NULL, NULL),
(119, 'OBR-119', 'TMVE-PLEX-PSREAL', NULL, NULL, NULL, '2016-12-09', NULL, NULL, NULL, NULL, 1, 5, 11, 44, NULL, NULL),
(120, 'OBR-120', 'TMVE-PLIN PSREAL', NULL, NULL, NULL, '2016-12-09', NULL, NULL, NULL, NULL, 1, 5, 11, 43, NULL, NULL),
(121, 'OBR-121', 'CVER-REPACOELEC-YAGUA', '30000.00', NULL, '54.00', '2016-12-08', NULL, NULL, NULL, NULL, 1, 11, 7, 45, NULL, NULL),
(122, 'OBR-122', 'CVER-INSTPUERPLE-MCRAO', '1.01', NULL, '27.00', '2016-12-16', NULL, NULL, NULL, NULL, 0, 11, 3, 46, NULL, NULL),
(123, 'OBR-123', 'CVER-INSTPUERPLE-MCRO', '1010000.00', NULL, '27.00', '2016-12-16', NULL, NULL, NULL, NULL, 1, 11, 3, 46, NULL, NULL),
(124, 'OBR-124', 'INTER-MTTO-BQTO-VLC', '150000.00', NULL, NULL, '2016-12-15', '2016-12-15', NULL, NULL, NULL, 1, 14, 11, 50, NULL, NULL),
(125, 'OBR-125', 'CESTA NAVIDEÑA', NULL, NULL, NULL, '2016-12-15', '2016-12-15', NULL, NULL, NULL, 1, 15, 15, 51, NULL, NULL),
(126, 'OBR-126', 'TMVE-VTASUMINT', NULL, NULL, NULL, '2016-12-16', '2016-12-16', NULL, NULL, NULL, 1, 5, 15, 52, NULL, NULL),
(127, 'OBR-127', 'CVER-REPTECHO-YAGUA', '3000000.00', NULL, '33.00', '2016-12-22', NULL, NULL, NULL, NULL, 1, 11, 8, 53, NULL, NULL),
(128, 'OBR-128', 'TMVE-DESINT-PAQCAIMA', NULL, NULL, NULL, '2016-12-16', NULL, NULL, NULL, NULL, 1, 5, 4, 58, NULL, NULL),
(129, 'OBR-129', 'TMVE-DESINT-CBLVISION', NULL, NULL, NULL, '2016-12-26', '2016-12-27', NULL, NULL, NULL, 1, 5, 4, 59, NULL, NULL),
(130, 'OBR-130', 'TMVE-DESINT-CATMAR ', NULL, NULL, NULL, '2016-12-28', '2016-12-28', NULL, NULL, NULL, 1, 5, 4, 60, NULL, NULL),
(131, 'OBR-131', 'TMVE-DESINT-COSMLITAN', NULL, NULL, NULL, '2016-12-29', '2016-12-29', NULL, NULL, NULL, 1, 5, 4, 55, NULL, NULL),
(132, 'OBR-132', 'TMVE-DESINT-VICTORIA', NULL, NULL, NULL, '2016-12-30', '2016-12-30', NULL, NULL, NULL, 1, 5, 4, 56, NULL, NULL),
(133, 'OBR-133', 'CVER-REPSISELEC-GUAI', '382800.00', NULL, '44.00', '2017-01-09', '2017-01-13', NULL, NULL, 'instalacion electrica', 1, 11, 7, 64, NULL, NULL),
(134, 'OBR-134', 'TMVE-MOVEQ-PARCTOSTEJ', NULL, NULL, NULL, '2016-11-01', NULL, NULL, NULL, NULL, 1, 5, 11, 27, NULL, NULL),
(135, 'OBR-135', 'TMVE- DESINT-AVILA', NULL, NULL, NULL, '2017-01-09', NULL, NULL, NULL, NULL, 1, 5, 4, 61, NULL, NULL),
(136, 'OBR-136', 'TMVE-DESINT-BAUTISMO', NULL, NULL, NULL, '2017-01-09', NULL, NULL, NULL, NULL, 1, 5, 4, 62, NULL, NULL),
(137, 'OBR-137', 'TMVE-DESINT-AEROCCS', NULL, NULL, NULL, '2017-01-04', NULL, NULL, NULL, NULL, 1, 5, 4, 63, NULL, NULL),
(138, 'OBR-138', 'TMVE- DESINT-PREBO', NULL, NULL, NULL, '2016-12-09', NULL, NULL, NULL, NULL, 1, 5, 4, 54, NULL, NULL),
(139, 'OBR-139', 'TMVE-DESINT-SJM', NULL, NULL, NULL, '2017-01-09', NULL, NULL, NULL, NULL, 1, 5, 4, 56, NULL, NULL),
(140, 'OBR-140', 'TMVE-DESM-ORIPOTO', '2770000.00', NULL, '60.00', '2017-01-11', '2017-01-17', NULL, NULL, NULL, 1, 5, 11, 65, NULL, NULL),
(141, 'OBR-141', 'TMVE-PLEX-CMEBO', '382750.00', NULL, '88.00', '2017-01-30', '2017-02-27', NULL, NULL, NULL, 1, 5, 8, 66, NULL, NULL),
(142, 'OBR-142', 'TMVE-PLEX-BCROA', '2043467.00', NULL, '56.00', '2017-01-30', '2017-02-27', NULL, NULL, NULL, 1, 5, 8, 67, NULL, NULL),
(143, 'OBR-143', 'TMVE-PLEX-MORON', '2604357.00', NULL, '31.00', '2017-01-30', '2017-02-27', NULL, NULL, NULL, 1, 5, 8, 68, NULL, NULL),
(144, 'OBR-144', 'TMVE-PLEX-YACAL', '1177083.00', NULL, '54.00', '2017-01-30', '2017-02-27', NULL, NULL, NULL, 1, 5, 8, 69, NULL, NULL),
(145, 'OBR-145', 'TMVE-MOVEQ-LIPSUR', '3200000.00', NULL, '40.00', '2017-01-23', '2017-04-23', NULL, NULL, NULL, 1, 5, 11, 70, NULL, NULL),
(146, 'OBR-146', 'TMVE-MOVEQ-MACHIQ', '3200000.00', NULL, '40.00', '2017-01-23', '2017-04-24', NULL, NULL, NULL, 1, 5, 11, 71, NULL, NULL),
(147, 'OBR-147', 'TMVE-MOVEQ-CENTAQR', '3200000.00', NULL, '40.00', '2017-01-23', '2017-04-23', NULL, NULL, NULL, 1, 5, 11, 72, NULL, NULL),
(148, 'OBR-148', 'Q1-2017-PRESUPUESTOS', NULL, NULL, NULL, '2017-01-19', NULL, NULL, NULL, NULL, 1, 16, 4, 74, NULL, NULL),
(149, 'OBR-149', 'INTER-DESMALZ-BQTOVLC', '38000000.00', NULL, '76.00', '2017-02-20', '2017-08-09', NULL, NULL, NULL, 1, 14, 3, 77, NULL, NULL),
(150, 'OBR-150', 'INTER-DESMALZ-STARITABQTO', '84000000.00', NULL, '60.00', '2017-02-20', '2017-09-11', NULL, NULL, NULL, 1, 14, 3, 76, NULL, NULL),
(151, 'OBR-151', 'CANT-REDLOCAL-SMBRO', '1146202.00', NULL, '40.00', '2017-02-08', NULL, NULL, NULL, NULL, 1, 9, 11, 79, NULL, NULL),
(152, 'OBR-152', 'CANT-REDLOCAL-CORCIT', '6560315.00', NULL, '40.00', '2017-02-08', NULL, NULL, NULL, NULL, 1, 9, 11, 78, NULL, NULL),
(153, 'OBR-153', 'TMVE-DESINT-CHICCO', '1000000.00', NULL, '40.00', '2017-02-10', '2017-02-28', NULL, NULL, NULL, 1, 5, 11, 80, NULL, NULL),
(154, 'OBR-154', 'TMVE-MOVEQ- ANAUC ', '3500000.00', NULL, '40.00', '2017-02-20', NULL, NULL, NULL, NULL, 1, 5, 11, 81, NULL, NULL),
(155, 'OBR-155', 'TMVE-DESINT-CANTVCHACAO', '700000.00', NULL, '40.00', '2017-02-20', NULL, NULL, NULL, NULL, 1, 5, 11, 82, NULL, NULL),
(156, 'OBR-156', 'CVER-CRTOFC-MCRO', '1864000.00', NULL, NULL, '2017-03-13', '2017-03-22', NULL, NULL, NULL, 1, 11, 8, 84, NULL, NULL),
(157, 'OBR-157', 'TMVE-PLEX-STATSA', '6445000.00', NULL, '42.00', '2017-03-28', '2017-04-11', NULL, NULL, NULL, 1, 5, 8, 85, NULL, NULL),
(158, 'OBR-158', 'TMVE-PLEX-YARE', '5176500.00', NULL, '38.00', '2017-03-29', '2017-04-12', NULL, NULL, NULL, 1, 5, 8, 86, NULL, NULL),
(159, 'OBR-159', 'TMVE-PLIN-PTSLN', '8423629.00', NULL, NULL, '2017-03-23', '2017-04-10', NULL, NULL, NULL, 1, 5, 11, 89, NULL, NULL),
(160, 'OBR-160', 'CVER-INSTPS-MCRO', '872949.00', NULL, NULL, '2017-03-22', '2017-03-24', NULL, NULL, NULL, 1, 11, 8, 88, NULL, NULL),
(161, 'OBR-161', 'TMVE-PLEX-SMZUL', '1459170.00', NULL, NULL, '2017-04-03', '2017-04-06', NULL, NULL, NULL, 1, 5, 11, 90, NULL, NULL),
(162, 'OBR-162', 'TMVE-PLEX-CCLIT', '1624000.00', NULL, NULL, '2017-03-10', '2017-03-14', NULL, NULL, NULL, 1, 5, 11, 91, NULL, NULL),
(163, 'OBR-163', 'TMVE-LATAM-YARE-2', '16763951.00', NULL, NULL, '2017-03-27', '2017-04-07', NULL, NULL, NULL, 1, 5, 11, 94, NULL, NULL),
(164, 'OBR-164', 'TMVE-PLIN-CCREC', '3500000.00', NULL, NULL, '2017-04-24', '2017-05-04', NULL, NULL, NULL, 1, 5, 11, 43, NULL, NULL),
(165, 'OBR-165', 'TMVE-PLIN-AVTIRSO', NULL, NULL, NULL, '2017-04-26', '2017-05-03', NULL, NULL, NULL, 1, 5, 11, 96, NULL, NULL),
(166, 'OBR-166', 'TMVE-PLIN-HTLFED', NULL, NULL, NULL, '2017-04-26', '2017-05-03', NULL, NULL, NULL, 1, 5, 11, 97, NULL, NULL),
(167, 'OBR-167', 'TMVE-PLIN-AVOHIG', '3322000.00', NULL, NULL, '2017-05-08', '2017-06-06', NULL, NULL, NULL, 1, 5, 11, 98, NULL, NULL),
(168, 'OBR-168', 'TMVE-DSINT-URBSUR', '525000.00', NULL, NULL, '2017-05-09', '2017-05-16', NULL, NULL, NULL, 1, 5, 11, 99, NULL, NULL),
(169, 'OBR-169', 'TMVE-PLEX-TCCSBOM', NULL, NULL, NULL, '2017-06-12', NULL, NULL, NULL, NULL, 1, 5, 11, 102, NULL, NULL),
(170, 'OBR-170', 'TMVE-PLEX-TCCSMAN', NULL, NULL, NULL, '2017-06-12', NULL, NULL, NULL, NULL, 1, 5, 11, 101, NULL, NULL),
(171, 'OBR-171', 'TMVE-DESINT-CHA053', '3000000.00', NULL, '55.00', '2017-05-31', '2017-06-30', NULL, NULL, NULL, 1, 5, 11, 103, NULL, NULL),
(172, 'OBR-172', 'TMVE-PLIN-SAMTEO', NULL, NULL, NULL, '2017-06-05', NULL, NULL, NULL, NULL, 1, 5, 11, 112, NULL, NULL),
(173, 'OBR-173', 'TMVE-PLIN-BARCOA', NULL, NULL, NULL, '2017-06-05', NULL, NULL, NULL, NULL, 1, 5, 11, 111, NULL, NULL),
(174, 'OBR-174', 'TMVE-PLIN-CHRCA', NULL, NULL, NULL, '2017-06-08', NULL, NULL, NULL, NULL, 1, 5, 11, 110, NULL, NULL),
(175, 'OBR-175', 'TMVE-PLIN-MNOA', NULL, NULL, NULL, '2017-06-07', NULL, NULL, NULL, NULL, 1, 5, 11, 109, NULL, NULL),
(176, 'OBR-176', 'TMVE-PLIN-VTGRE', NULL, NULL, NULL, '2017-06-07', NULL, NULL, NULL, NULL, 1, 5, 11, 108, NULL, NULL),
(177, 'OBR-177', 'TMVE-PLIN-FLXCTRO', NULL, NULL, NULL, '2017-06-06', NULL, NULL, NULL, NULL, 1, 5, 11, 107, NULL, NULL),
(178, 'OBR-178', 'TMVE-PLIN-POLFLX', NULL, NULL, NULL, '2017-06-06', NULL, NULL, NULL, NULL, 1, 5, 11, 106, NULL, NULL),
(179, 'OBR-179', 'TMVE-PLIN-11ABRFLX', NULL, NULL, NULL, '2017-06-05', NULL, NULL, NULL, NULL, 1, 5, 11, 105, NULL, NULL),
(180, 'OBR-180', 'TMVE-PLIN-ROBLE', NULL, NULL, NULL, '2017-06-05', NULL, NULL, NULL, NULL, 1, 5, 11, 104, NULL, NULL),
(181, 'OBR-181', 'TMVE-PLIN-CDOJDA', NULL, NULL, NULL, '2017-06-05', NULL, NULL, NULL, NULL, 1, 5, 11, 120, NULL, NULL),
(182, 'OBR-182', 'TMVE-PLIN-OJDA', NULL, NULL, NULL, '2017-06-05', NULL, NULL, NULL, NULL, 1, 5, 11, 119, NULL, NULL),
(183, 'OBR-183', 'TMVE-PLIN-MCDESZ', NULL, NULL, NULL, '2017-06-05', NULL, NULL, NULL, NULL, 1, 5, 11, 118, NULL, NULL),
(184, 'OBR-184', 'TMVE-PLIN-CBMASU', NULL, NULL, NULL, '2017-06-05', NULL, NULL, NULL, NULL, 1, 5, 11, 117, NULL, NULL),
(185, 'OBR-185', 'TMVE-PLIN-INDPCIA', NULL, NULL, NULL, '2017-06-05', NULL, NULL, NULL, NULL, 1, 5, 11, 116, NULL, NULL),
(186, 'OBR-186', 'TMVE-PLIN-LAVELA', NULL, NULL, NULL, '2017-06-05', NULL, NULL, NULL, NULL, 1, 5, 11, 115, NULL, NULL),
(187, 'OBR-187', 'TMVE-PLIN-DISVELA', NULL, NULL, NULL, '2017-06-05', NULL, NULL, NULL, NULL, 1, 5, 11, 114, NULL, NULL),
(188, 'OBR-188', 'TMVE-PLIN-CAQBCO', NULL, NULL, NULL, '2017-06-05', NULL, NULL, NULL, NULL, 1, 5, 11, 113, NULL, NULL),
(189, 'OBR-189', 'TMVE-OBCIV-GUARENAS', NULL, NULL, NULL, '2017-06-05', NULL, NULL, NULL, NULL, 1, 5, 8, 121, NULL, NULL),
(190, 'OBR-190', 'TMVE-PLEX-CLRET', '337394.00', NULL, '29.00', '2017-07-03', NULL, NULL, NULL, NULL, 1, 5, 11, 122, NULL, NULL),
(191, 'OBR-191', 'SBA-REMODWC-MQTA', '0.00', NULL, '0.00', '2017-07-10', NULL, NULL, NULL, NULL, 1, 17, 6, 123, NULL, NULL),
(192, 'OBR-192', 'TMVE-PLIN-CRZOS', '7275546.91', NULL, '66.00', '2017-07-10', NULL, NULL, NULL, NULL, 1, 5, 11, 124, NULL, NULL),
(193, 'OBR-193', 'TMVE-DESINT-REUBGCCS', '6000000.00', NULL, '55.00', '2017-07-17', '2017-08-17', NULL, NULL, NULL, 1, 5, 11, 125, NULL, NULL),
(194, 'OBR-194', 'TMVE-PLIN-LASALLE', '1895030.00', NULL, '31.00', '2017-07-31', NULL, NULL, NULL, NULL, 1, 5, 11, 126, NULL, NULL),
(195, 'OBR-195', 'TMVE-PLIN-SLDAD', '4061726.00', NULL, '57.00', '2017-07-31', NULL, NULL, NULL, NULL, 1, 5, 11, 127, NULL, NULL),
(196, 'OBR-196', 'TMVE-PLIN-PLZAMADGA', '5524845.28', NULL, '58.00', '2017-07-26', NULL, NULL, NULL, NULL, 1, 5, 11, 133, NULL, NULL),
(197, 'OBR-197', 'INTER-RENITANQ-AVUGRADA', '1200000.00', NULL, NULL, '2017-07-28', NULL, NULL, NULL, NULL, 1, 14, 3, 134, NULL, NULL),
(198, 'OBR-198', 'INTER-DESMALZ-TINQVAL', '36969400.00', NULL, '48.00', '2017-08-07', '2017-10-02', NULL, NULL, NULL, 1, 14, 3, 135, NULL, NULL),
(199, 'OBR-199', 'TMVE-PLIN-MRCHE', '29670321.00', NULL, '28.00', '2017-08-21', '2017-09-04', NULL, NULL, NULL, 1, 5, 11, 136, NULL, NULL),
(200, 'OBR-200', 'TMVE-PLIN-LSABNLE', '4292406.80', NULL, '20.34', '2017-08-21', NULL, NULL, NULL, NULL, 1, 5, 11, 139, NULL, NULL),
(201, 'OBR-201', 'TMVE-PLIN-VLLATIN', '9422466.49', NULL, '38.81', '2017-08-21', NULL, NULL, NULL, NULL, 1, 5, 11, 138, NULL, NULL),
(202, 'OBR-202', 'TMVE-PLIN-CNAUTIC', '4292406.00', NULL, '23.00', '2017-08-28', NULL, NULL, NULL, NULL, 1, 5, 11, 137, NULL, NULL),
(203, 'OBR-203', 'DRTV-MANTSIREFR-CCS', '22424310.00', NULL, '48.00', '2017-09-15', '2018-02-15', NULL, NULL, 'RENOVACION MANTENIMIENTO PERIODO ENE-MARZO BS 1.191.117,69 ABRI-MAY BS2.593.123,50', 1, 18, 3, 144, NULL, NULL),
(204, 'OBR-204', 'CEMM-IMPLANT-OCMRE', '0.00', NULL, '30.00', '2017-10-02', '2017-09-13', NULL, NULL, NULL, 1, 19, 8, 145, NULL, NULL),
(205, 'OBR-205', 'DGTE-INGENIERIA-CARAYACA', NULL, NULL, '70.00', '2017-10-31', '2017-11-17', NULL, NULL, NULL, 1, 4, 11, 146, NULL, NULL),
(206, 'OBR-206', 'INTER-DESMALZ-BJMLGTA', '48218899.00', NULL, '48.00', '2017-11-13', '2017-12-04', NULL, NULL, NULL, 1, 14, 3, 147, NULL, NULL),
(207, 'OBR-207', 'PDVG-ADQEQP-GRNAS', NULL, NULL, NULL, '2017-11-22', '2017-11-23', NULL, NULL, NULL, 1, 20, 16, 148, NULL, NULL),
(208, 'OBR-208', 'ZTE-USDMAKO-BVI', '0.00', NULL, NULL, '2018-02-05', '2018-03-28', NULL, NULL, NULL, 1, 21, 11, 150, NULL, NULL),
(209, 'OBR-209', 'ZTE-BSMAKO-BVI', NULL, NULL, NULL, '2018-02-05', '2018-03-28', NULL, NULL, NULL, 1, 21, 11, 149, NULL, NULL),
(210, 'OBR-101', 'DEVOLUCIÓN DE PRÉSTAMO', '0.00', NULL, NULL, '2018-01-22', NULL, 'Jesús Fornerino', 'Jesús Fornerino', '0', 1, NULL, NULL, 0, NULL, '2021-11-23 23:07:37'),
(211, 'OBR-211', 'DRTV-REMOFIC-CCS', '519045018.00', NULL, '30.00', '2018-02-19', NULL, NULL, NULL, NULL, 0, 18, 8, 151, NULL, NULL),
(212, 'OBR-212', 'TMVE-VALVUEXPA-CCS', NULL, NULL, NULL, '2018-02-06', NULL, NULL, NULL, NULL, 1, 5, 16, 152, NULL, NULL),
(213, 'OBR-213', 'ZTE-USDMAKO-SKN', NULL, NULL, NULL, '2018-02-26', NULL, NULL, NULL, NULL, 1, 21, 11, 155, NULL, NULL),
(214, 'OBR-214', 'ZTE-BSMAKO-SKN', NULL, NULL, NULL, '2018-02-26', NULL, NULL, NULL, NULL, 1, 21, 11, 154, NULL, NULL),
(215, 'OBR-215', 'CVRG-REPMPLO-YAGUA', '10000000.00', NULL, '20.00', '2018-03-19', NULL, NULL, NULL, NULL, 1, 22, 10, 156, NULL, NULL),
(216, 'OBR-216', 'Gastos Logísticos', '0.00', NULL, NULL, '2018-01-22', NULL, 'Compras', 'Compras', '0', 1, NULL, NULL, NULL, NULL, NULL),
(217, 'OBR-217', 'CVRG-REPMPLO-CHRLLVE', '19340000.00', NULL, '20.00', '2018-04-05', NULL, NULL, NULL, NULL, 1, 22, 10, 157, NULL, NULL),
(218, 'OBR-218', 'NUNO-CARACTFBRA-CAUJZL', '48300000.00', NULL, '40.00', '2018-04-11', '2018-04-13', NULL, NULL, NULL, 1, 13, 11, 158, NULL, NULL),
(219, 'OBR-219', 'ARCO-REMESTLAV-TURMERO', '1248179704.52', NULL, '15.00', '2018-04-27', NULL, NULL, NULL, NULL, 1, 23, 10, 160, NULL, NULL),
(220, 'OBR-220', 'CVER-CONSPAREPRT-MCRO', '7141306688.19', NULL, '21.00', '2018-04-30', NULL, NULL, NULL, NULL, 1, 11, 8, 159, NULL, NULL),
(221, 'OBR-221', 'ARCO-SELLPARLAB-TURMERO', '184949031.00', NULL, '23.00', '2018-05-05', NULL, NULL, NULL, NULL, 1, 23, 3, 162, NULL, NULL),
(222, 'OBR-222', 'ARCO-REPESTMET-TURMERO', '447020601.90', NULL, '24.00', '2018-05-05', NULL, NULL, NULL, NULL, 1, 23, 3, 161, NULL, NULL),
(223, 'OBR-223', 'DRTV-UMAPB-CCS', '120684997.00', NULL, '40.00', '2018-06-07', NULL, NULL, NULL, NULL, 1, 18, 3, 163, NULL, NULL),
(224, 'OBR-224', 'CVER-SERVGALM-YAGUA', '7164213416.49', NULL, '9.09', '2018-06-18', NULL, NULL, NULL, NULL, 1, 11, 3, 165, NULL, NULL),
(225, 'OBR-225', 'CVRG-INSTUBAGU-CORTIJOS', '312804510.00', NULL, '20.00', '2018-06-18', NULL, NULL, NULL, NULL, 1, 22, 8, 164, NULL, NULL),
(226, 'OBR-226', 'CVRG-SUMIVAR-CORTIJOS', '39650000.00', NULL, '5.00', '2018-06-21', NULL, NULL, NULL, NULL, 1, 22, 16, 166, NULL, NULL),
(227, 'OBR-227', 'PUIG-INSTPORTMET-CORTIJOS', NULL, NULL, NULL, '2018-07-09', NULL, NULL, NULL, NULL, 1, 24, 8, 167, NULL, NULL),
(228, 'OBR-228', 'VEHI-TAHOE-5MT', NULL, NULL, NULL, '2018-07-01', NULL, NULL, NULL, NULL, 1, NULL, NULL, 0, NULL, NULL),
(229, 'OBR-229', 'VEH-F150-K0D', NULL, NULL, NULL, '2018-07-01', NULL, NULL, NULL, NULL, 1, NULL, NULL, 0, NULL, NULL),
(230, 'OBR-230', 'VEHI-LUVD-ABH', NULL, NULL, NULL, '2018-07-01', NULL, NULL, NULL, NULL, 1, NULL, NULL, 0, NULL, NULL),
(231, 'OBR-232', 'VEHI-SILV-I2H', '0.00', '0.00', '0.00', '2018-07-01', NULL, NULL, NULL, NULL, 1, NULL, NULL, 0, NULL, NULL),
(232, 'OBR-231', 'VEHI-CHEY-SAI', NULL, NULL, NULL, '2018-07-01', NULL, NULL, NULL, NULL, 1, NULL, 8, 0, NULL, NULL),
(233, 'OBR-233', 'VEHI-F350-H1E', NULL, NULL, NULL, '2018-07-01', NULL, NULL, NULL, NULL, 1, NULL, NULL, 0, NULL, NULL),
(234, 'OBR-234', 'VEHI-IVEC-G4D', NULL, NULL, NULL, '2018-07-01', NULL, NULL, NULL, NULL, 1, NULL, NULL, 0, NULL, NULL),
(235, 'OBR-235', 'DRTV-SUMICORR-CCS', '576000000.00', NULL, '46.00', '2018-07-26', NULL, NULL, NULL, NULL, 1, 18, 3, 168, NULL, NULL),
(236, 'OBR-236', 'DHL-ELECEDIF-MQTA', '1885000000.00', NULL, '59.00', '2018-07-28', NULL, NULL, NULL, NULL, 1, 25, 8, 169, NULL, NULL),
(237, 'OBR-237', 'DRTV-SUMIHOPE-CCS', '1200000000.00', NULL, NULL, '2018-08-13', '2018-08-14', NULL, NULL, NULL, 1, 18, 3, 170, NULL, NULL),
(238, 'OBR-238', 'DGCE-USDMAKO-BVI', '0.00', NULL, '25.00', '2018-08-22', NULL, NULL, NULL, NULL, 1, 26, 11, 172, NULL, NULL),
(239, 'OBR-239', 'DGCE-BSMAKO-BVI', NULL, NULL, '25.00', '2018-08-22', NULL, NULL, NULL, NULL, 1, 26, 11, 171, NULL, NULL),
(240, 'OBR-240', 'DRTV-UMAP2-CCS', '8500.00', NULL, '50.00', '2018-08-27', NULL, NULL, NULL, NULL, 1, 18, 3, 173, NULL, NULL),
(241, 'OBR-241', 'DRTV-UMAP2O-CCS', '6525.00', NULL, '50.00', '2018-09-17', '2018-09-19', NULL, NULL, NULL, 1, 18, 3, 174, NULL, NULL),
(242, 'OBR-242', 'Operaciones de Oficina USD', NULL, NULL, NULL, NULL, NULL, 'Todos', 'Todos', NULL, 1, NULL, NULL, NULL, NULL, NULL),
(243, 'OBR-243', 'CVER-INSTCBLE-MCRO', '206690.00', NULL, '68.00', '2018-09-20', NULL, NULL, NULL, NULL, 1, 11, 8, 175, NULL, NULL),
(244, 'OBR-244', 'TMVE-SUMBOMBAG-CCS', '59249.99', NULL, NULL, '2018-09-26', '2018-10-26', NULL, NULL, NULL, 1, 5, 16, 176, NULL, NULL),
(245, 'OBR-245', 'CVER-ELECALMA-MCRO', '5433.00', NULL, NULL, '2018-10-03', '2018-10-05', NULL, NULL, NULL, 1, 11, 3, 177, NULL, NULL),
(246, 'OBR-246', 'HEIZ-DRENAJE AGUA-SANJOQ', '1989211.50', NULL, NULL, '2018-10-29', '2018-11-12', NULL, NULL, NULL, 1, 27, 3, 178, NULL, NULL),
(247, 'OBR-247', 'DRTV-UMAP11O-CCS', '690000.00', NULL, '45.00', '2019-04-15', '2019-04-24', NULL, NULL, NULL, 1, 18, 3, 179, NULL, NULL),
(248, 'OBR-248', 'DRTV-MANTELCENT-CCS', '2772247.44', NULL, '55.00', '2019-04-21', NULL, NULL, NULL, NULL, 1, 18, 3, 180, NULL, NULL),
(249, 'OBR-249', 'DRTV-UMAP6E-CCS', '204600.00', NULL, '36.00', '2019-06-06', '2019-06-10', NULL, NULL, NULL, 1, 18, 3, 181, NULL, NULL),
(250, 'OBR-250', 'CVER-REVELECT-BLA', NULL, NULL, NULL, '2019-06-26', NULL, NULL, NULL, NULL, 1, 11, 7, 182, NULL, NULL),
(251, 'OBR-251', 'CVER-INSTPOCETA-MQTA', '3003075.00', NULL, NULL, '2019-07-25', '2019-07-25', NULL, NULL, NULL, 1, 11, 10, 183, NULL, NULL),
(252, 'OBR-252', 'CVER-REMREFLECT-MQTA', '1930000.00', NULL, '38.00', '2019-10-28', '2019-10-28', NULL, NULL, NULL, 1, 11, 3, 184, NULL, NULL),
(253, 'OBR-253', 'PTLO-RESTBAÑO-CHT', '6300000.00', NULL, '48.00', '2019-12-06', NULL, NULL, NULL, NULL, 0, 28, 10, 185, NULL, NULL),
(254, 'OBR-254', 'PTLO-REPADRYWALL-BARUTA', '5700000.00', NULL, '47.00', '2019-12-12', '2019-12-14', NULL, NULL, NULL, 1, 28, 3, 186, NULL, NULL),
(255, 'OBR-255', 'NEST-REPOFCTRAL-TRIN', '52704673.72', NULL, '40.00', '2020-01-17', '2020-01-20', NULL, NULL, NULL, 1, 29, 3, 187, NULL, NULL),
(256, 'OBR-256', 'PTLO-REPFILTOFC-BARUTA', '0.00', NULL, '30.00', '2019-12-13', '2019-12-31', NULL, NULL, NULL, 1, 28, 10, 188, NULL, NULL),
(257, 'OBR-257', 'JHCP-INTERN-SO1', '139550.00', NULL, '0.00', '2020-01-30', '2020-12-31', NULL, NULL, NULL, 1, 30, 19, 189, NULL, NULL),
(258, 'OBR-258', 'NEST-ADOFICVTAS-TURMRO', '3037862460.00', NULL, NULL, '2020-02-17', '2020-03-31', NULL, NULL, NULL, 1, 29, 3, 190, NULL, NULL),
(259, 'OBR-258', 'NEST-USD-ADOFICVTAS-TURMRO', '0.00', NULL, NULL, '2020-02-17', '2020-03-31', NULL, NULL, NULL, 1, 29, 3, 190, NULL, NULL),
(260, 'OBR-260', 'PTLO-RESTBAÑOII-CHT', '6979505.00', NULL, NULL, '2020-02-19', '2020-02-19', NULL, NULL, NULL, 1, 28, 6, 191, NULL, NULL),
(261, 'OBR-261', 'PTLO-REPFLUXBÑO-CHT', NULL, NULL, NULL, '2020-02-21', '2020-02-21', NULL, NULL, NULL, 1, 28, 6, 192, NULL, NULL),
(262, 'OBR-262', 'RRHH-BON-FEB', '108770000.00', NULL, NULL, '2020-03-03', '2020-03-04', 'Jordy Colmenares', 'Josselyn Tovar', NULL, 1, 30, 19, 20, NULL, NULL),
(263, 'OBR-263', 'SCAB-FUSFIBR-ADJUNTAS', '11250000.00', NULL, '33.00', '2020-02-28', '2020-02-29', NULL, NULL, NULL, 1, 31, 4, 193, NULL, NULL),
(264, 'OBR-264', 'COMPRA DE DIVISA', NULL, NULL, NULL, NULL, NULL, 'Todos', 'Todos', NULL, 1, NULL, NULL, NULL, NULL, NULL),
(265, 'OBR-265', 'PTLO-MEDORGAS-BARUTA', NULL, NULL, NULL, '2020-03-09', NULL, NULL, NULL, NULL, 1, 28, 3, 194, NULL, NULL),
(266, 'OBR-266', 'RRHH-BON-MAR', '121910000.00', NULL, NULL, '2020-04-01', '2020-04-30', '', 'Josselyn Tovar', NULL, 1, 30, 19, 20, NULL, NULL),
(267, 'OBR-267', 'NEST-REPDREAA-STACRUZ ', '101119939.00', NULL, NULL, '2020-05-01', '2020-05-04', NULL, NULL, NULL, 1, 29, 3, 195, NULL, NULL),
(268, 'OBR-268', 'NEST-REMOJUNTA-ENCRCJDA', '17204923.00', NULL, NULL, '2020-05-06', '2020-05-12', NULL, NULL, NULL, 1, 29, 3, 196, NULL, NULL),
(269, 'OBR-269', 'NEST-SUMMAYAPLA -STACRUZ ', '508857791.00', NULL, NULL, '2020-05-08', NULL, NULL, NULL, NULL, 1, 29, 3, 197, NULL, NULL),
(270, 'OBR-270', 'NEST-SUMATGOMA -STACRUZ ', NULL, NULL, NULL, '2020-05-08', NULL, NULL, NULL, NULL, 1, 29, 3, 198, NULL, NULL),
(271, 'OBR-271', 'NEST-REPSINCENBO-ENCRCJDA', '126561774.00', NULL, NULL, '2020-05-13', NULL, NULL, NULL, NULL, 1, 29, 3, 199, NULL, NULL),
(272, 'OBR-272', 'NEST-MANTENA/A -STACRUZ ', '206201982.00', NULL, NULL, '2020-05-15', '2020-05-22', NULL, NULL, NULL, 1, 29, 3, 200, NULL, NULL),
(273, 'OBR-273', 'RRHH-BON-MAY', '0.00', NULL, NULL, '2020-05-01', '2020-05-31', '', 'Josselyn Tovar', NULL, 1, 30, 19, 20, NULL, NULL),
(274, 'OBR-274', 'NEST-MANTECONS-EDFMORON', '999999999.00', NULL, NULL, '2020-07-17', '2020-08-30', NULL, NULL, NULL, 1, 29, 3, 201, NULL, NULL),
(275, 'OBR-275', 'IFRC-ADCDEPOSTO-VAL', NULL, NULL, NULL, '2021-01-25', NULL, NULL, NULL, NULL, 1, 32, 3, 202, NULL, NULL),
(276, 'OBR-276', 'IFRC-INSTAAVENT-VAL', NULL, NULL, NULL, '2021-03-11', NULL, NULL, NULL, NULL, 1, 32, 3, 203, NULL, NULL),
(277, 'OBR-277', 'CVER-REPOFICSIN-YAGUA', NULL, NULL, NULL, '2021-03-22', NULL, NULL, NULL, NULL, 1, 11, 10, 204, NULL, NULL),
(278, 'OBR-278', 'IFRC-ADEHOSP-CCS', NULL, NULL, '9.00', '2021-05-17', NULL, NULL, NULL, NULL, 1, 32, 8, 205, NULL, NULL),
(279, 'OBR-279', 'IFRC-USD-ADEHOSP-CCS', NULL, NULL, '9.00', '2021-05-17', NULL, NULL, NULL, NULL, 1, 32, 8, 205, NULL, NULL),
(280, 'OBR-280', 'Gastos USD de Recursos Humanos ', NULL, NULL, NULL, NULL, NULL, 'Josselyn Tovar', 'Josselyn Tovar', NULL, 1, NULL, NULL, NULL, NULL, NULL),
(281, 'OBR-281', 'CVER-REPSANIT-MQTA', NULL, NULL, NULL, '2021-08-09', NULL, NULL, NULL, NULL, 1, 11, 6, 206, NULL, NULL),
(283, 'OBR-282', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore', '10002222222222222.00', NULL, '111111.00', '2021-11-04', '2021-11-26', NULL, NULL, 'El número habilitado es el 22688 y están disponibles los servicios de consulta de saldo de líneas fijas, reporte de incidencias en los servicios de telefonía fija e Internet y consulta de estatus de a', 1, 9, 8, 201, '2021-11-19 20:11:23', '2021-11-19 20:11:23'),
(284, 'OBR-283', 'bbbbbbbb', '2000.00', NULL, '18.00', '2021-11-25', '2021-11-25', NULL, NULL, 'se ha realizado modificaciones en tdos los campos', 1, 27, 5, 74, '2021-11-19 20:16:49', '2021-11-23 22:23:56'),
(285, 'OBR-284', 'Gastos generales de rrhh JHCP Vzla', '1000.00', NULL, '6.00', '2021-11-12', '2021-11-20', NULL, NULL, 'sssss', 1, 30, 4, 0, '2021-11-22 18:19:46', '2021-11-22 18:19:46'),
(286, 'OBR-285', 'Prueba de eliminacion de personal', '100.00', NULL, '3.00', NULL, NULL, NULL, NULL, NULL, 1, 24, 10, 204, '2021-11-23 19:57:21', '2021-11-23 19:57:21'),
(287, 'OBR-286', 'hahahhaa', '5466049.00', NULL, '5.00', '2021-11-04', '2021-11-03', NULL, NULL, 'wertyujikbyhnujmk,l', 0, 9, 1, 0, '2021-11-23 22:28:11', '2021-11-24 22:54:41'),
(288, 'OBR-287', 'para eliminar', '2826739.00', NULL, '3.00', '2021-11-11', '2021-11-26', NULL, NULL, 'xxxxxx xxxxxx xxxxxx xxx xxxxxx x', 1, 30, 4, 0, '2021-11-23 23:57:04', '2021-11-24 23:02:40'),
(289, 'OBR-288', 'erfrerferf', '1000.00', NULL, '3.00', '2021-11-11', NULL, NULL, NULL, 'eee  eefef wfwesdsvdvd', 1, 22, 8, 0, '2021-11-24 23:12:04', '2021-11-24 23:12:42'),
(290, 'OBR-289', 'compra de engrapadora', '200.00', NULL, '0.00', '2021-11-18', NULL, NULL, NULL, 'necesito un aengrapadora', 0, 22, 10, 0, '2021-11-24 23:26:58', '2021-11-24 23:27:12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `obra_personal`
--

CREATE TABLE `obra_personal` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `op_cargo` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `obra_id` bigint(20) UNSIGNED NOT NULL,
  `personal_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `obra_personal`
--

INSERT INTO `obra_personal` (`id`, `op_cargo`, `obra_id`, `personal_id`, `created_at`, `updated_at`) VALUES
(1, '1', 37, 3, NULL, NULL),
(2, '1', 20, 3, NULL, NULL),
(3, '2', 20, 4, NULL, NULL),
(4, '2', 20, 6, NULL, NULL),
(5, '1', 10, 3, NULL, NULL),
(6, '1', 10, 7, NULL, NULL),
(7, '1', 20, 12, NULL, NULL),
(8, '1', 36, 7, NULL, NULL),
(9, '2', 41, 9, NULL, NULL),
(10, '1', 41, 8, NULL, NULL),
(11, '1', 42, 2, NULL, NULL),
(12, '1', 36, 5, NULL, NULL),
(13, '1', 35, 2, NULL, NULL),
(14, '2', 35, 17, NULL, NULL),
(15, '1', 34, 3, NULL, NULL),
(16, '1', 31, 3, NULL, NULL),
(17, '1', 30, 2, NULL, NULL),
(18, '1', 25, 2, NULL, NULL),
(19, '1', 16, 8, NULL, NULL),
(20, '1', 12, 8, NULL, NULL),
(21, '1', 11, 2, NULL, NULL),
(22, '1', 10, 4, NULL, NULL),
(23, '1', 9, 2, NULL, NULL),
(24, '1', 7, 1, NULL, NULL),
(25, '1', 3, 2, NULL, NULL),
(26, '1', 8, 1, NULL, NULL),
(27, '1', 8, 2, NULL, NULL),
(28, '1', 8, 17, NULL, NULL),
(29, '1', 43, 1, NULL, NULL),
(30, '1', 48, 1, NULL, NULL),
(31, '1', 49, 5, NULL, NULL),
(32, '1', 49, 7, NULL, NULL),
(33, '1', 50, 3, NULL, NULL),
(34, '1', 51, 1, NULL, NULL),
(35, '1', 52, 3, NULL, NULL),
(36, '1', 53, 3, NULL, NULL),
(37, '1', 54, 7, NULL, NULL),
(38, '1', 55, 7, NULL, NULL),
(39, '1', 56, 2, NULL, NULL),
(40, '1', 57, 1, NULL, NULL),
(41, '2', 58, 14, NULL, NULL),
(42, '1', 59, 11, NULL, NULL),
(43, '2', 60, 6, NULL, NULL),
(44, '1', 61, 2, NULL, NULL),
(45, '2', 62, 6, NULL, NULL),
(46, '1', 63, 4, NULL, NULL),
(47, '1', 64, 1, NULL, NULL),
(48, '1', 64, 2, NULL, NULL),
(49, '1', 65, 2, NULL, NULL),
(50, '1', 66, 11, NULL, NULL),
(51, '1', 67, 11, NULL, NULL),
(52, '1', 68, 11, NULL, NULL),
(53, '1', 69, 11, NULL, NULL),
(54, '2', 70, 14, NULL, NULL),
(55, '1', 71, 1, NULL, NULL),
(56, '1', 72, 2, NULL, NULL),
(57, '1', 73, 3, NULL, NULL),
(58, '1', 74, 2, NULL, NULL),
(59, '1', 75, 18, NULL, NULL),
(60, '1', 76, 2, NULL, NULL),
(61, '1', 77, 18, NULL, NULL),
(62, '1', 79, 11, NULL, NULL),
(63, '1', 80, 11, NULL, NULL),
(64, '1', 81, 3, NULL, NULL),
(65, '2', 82, 15, NULL, NULL),
(66, '1', 83, 16, NULL, NULL),
(67, '1', 84, 19, NULL, NULL),
(68, '1', 85, 3, NULL, NULL),
(69, '1', 86, 19, NULL, NULL),
(70, '1', 87, 19, NULL, NULL),
(71, '1', 88, 3, NULL, NULL),
(72, '1', 89, 19, NULL, NULL),
(73, '1', 90, 20, NULL, NULL),
(74, '1', 91, 3, NULL, NULL),
(75, '2', 92, 20, NULL, NULL),
(76, '1', 93, 11, NULL, NULL),
(77, '1', 94, 21, NULL, NULL),
(78, '1', 95, 19, NULL, NULL),
(79, '1', 96, 22, NULL, NULL),
(80, '1', 97, 22, NULL, NULL),
(81, '1', 98, 22, NULL, NULL),
(83, '1', 103, 21, NULL, NULL),
(84, '1', 103, 1, NULL, NULL),
(85, '1', 104, 19, NULL, NULL),
(86, '1', 105, 22, NULL, NULL),
(87, '1', 106, 16, NULL, NULL),
(88, '2', 106, 13, NULL, NULL),
(89, '1', 107, 16, NULL, NULL),
(90, '2', 107, 13, NULL, NULL),
(91, '1', 108, 19, NULL, NULL),
(92, '1', 109, 19, NULL, NULL),
(93, '1', 110, 19, NULL, NULL),
(94, '1', 111, 23, NULL, NULL),
(95, '1', 112, 19, NULL, NULL),
(96, '1', 113, 19, NULL, NULL),
(97, '1', 114, 23, NULL, NULL),
(98, '1', 116, 19, NULL, NULL),
(99, '1', 117, 16, NULL, NULL),
(100, '1', 118, 19, NULL, NULL),
(101, '1', 119, 22, NULL, NULL),
(102, '1', 120, 22, NULL, NULL),
(103, '1', 121, 23, NULL, NULL),
(104, '1', 123, 23, NULL, NULL),
(105, '1', 124, 24, NULL, NULL),
(106, '1', 125, 25, NULL, NULL),
(107, '1', 126, 25, NULL, NULL),
(108, '2', 127, 26, NULL, NULL),
(109, '1', 129, 21, NULL, NULL),
(110, '1', 130, 21, NULL, NULL),
(111, '1', 131, 21, NULL, NULL),
(112, '1', 132, 21, NULL, NULL),
(113, '2', 133, 26, NULL, NULL),
(114, '1', 134, 21, NULL, NULL),
(115, '1', 135, 21, NULL, NULL),
(116, '1', 136, 21, NULL, NULL),
(117, '1', 137, 21, NULL, NULL),
(118, '1', 138, 21, NULL, NULL),
(119, '1', 139, 21, NULL, NULL),
(120, '1', 140, 19, NULL, NULL),
(121, '1', 141, 16, NULL, NULL),
(122, '1', 142, 16, NULL, NULL),
(123, '1', 143, 16, NULL, NULL),
(124, '1', 144, 16, NULL, NULL),
(125, '1', 145, 1, NULL, NULL),
(126, '1', 146, 1, NULL, NULL),
(127, '1', 147, 1, NULL, NULL),
(128, '1', 148, 23, NULL, NULL),
(129, '1', 149, 16, NULL, NULL),
(130, '1', 150, 16, NULL, NULL),
(131, '1', 151, 3, NULL, NULL),
(132, '1', 152, 3, NULL, NULL),
(133, '1', 153, 21, NULL, NULL),
(134, '1', 154, 21, NULL, NULL),
(135, '1', 155, 21, NULL, NULL),
(136, '1', 156, 19, NULL, NULL),
(137, '1', 157, 16, NULL, NULL),
(138, '1', 158, 16, NULL, NULL),
(139, '1', 159, 22, NULL, NULL),
(140, '1', 160, 19, NULL, NULL),
(141, '1', 161, 16, NULL, NULL),
(142, '1', 162, 3, NULL, NULL),
(143, '1', 163, 19, NULL, NULL),
(144, '1', 164, 1, NULL, NULL),
(145, '1', 165, 19, NULL, NULL),
(146, '1', 166, 19, NULL, NULL),
(147, '1', 167, 19, NULL, NULL),
(148, '1', 168, 21, NULL, NULL),
(149, '1', 169, 19, NULL, NULL),
(150, '1', 170, 19, NULL, NULL),
(151, '1', 171, 21, NULL, NULL),
(152, '1', 172, 19, NULL, NULL),
(153, '1', 173, 19, NULL, NULL),
(154, '1', 174, 19, NULL, NULL),
(155, '1', 175, 19, NULL, NULL),
(156, '1', 176, 19, NULL, NULL),
(157, '1', 177, 19, NULL, NULL),
(158, '1', 178, 19, NULL, NULL),
(159, '1', 179, 19, NULL, NULL),
(160, '1', 180, 19, NULL, NULL),
(161, '1', 181, 3, NULL, NULL),
(162, '1', 182, 3, NULL, NULL),
(163, '1', 183, 3, NULL, NULL),
(164, '1', 184, 3, NULL, NULL),
(165, '1', 185, 3, NULL, NULL),
(166, '1', 186, 3, NULL, NULL),
(167, '1', 187, 3, NULL, NULL),
(168, '1', 188, 3, NULL, NULL),
(169, '1', 189, 11, NULL, NULL),
(170, '1', 190, 16, NULL, NULL),
(171, '1', 191, 19, NULL, NULL),
(172, '1', 192, 19, NULL, NULL),
(173, '1', 193, 21, NULL, NULL),
(174, '1', 194, 19, NULL, NULL),
(175, '1', 195, 19, NULL, NULL),
(176, '1', 196, 19, NULL, NULL),
(177, '1', 197, 16, NULL, NULL),
(178, '1', 198, 16, NULL, NULL),
(179, '1', 199, 16, NULL, NULL),
(180, '1', 200, 19, NULL, NULL),
(181, '1', 201, 19, NULL, NULL),
(182, '1', 202, 19, NULL, NULL),
(183, '1', 203, 1, NULL, NULL),
(184, '1', 204, 19, NULL, NULL),
(185, '1', 205, 3, NULL, NULL),
(186, '1', 206, 16, NULL, NULL),
(187, '1', 207, 27, NULL, NULL),
(188, '1', 208, 21, NULL, NULL),
(189, '1', 209, 21, NULL, NULL),
(190, '1', 211, 28, NULL, NULL),
(191, '1', 212, 27, NULL, NULL),
(192, '1', 213, 21, NULL, NULL),
(193, '1', 214, 21, NULL, NULL),
(194, '1', 215, 28, NULL, NULL),
(195, '1', 217, 29, NULL, NULL),
(196, '1', 218, 1, NULL, NULL),
(197, '1', 219, 28, NULL, NULL),
(198, '1', 220, 29, NULL, NULL),
(199, '2', 221, 30, NULL, NULL),
(200, '2', 222, 30, NULL, NULL),
(201, '1', 223, 1, NULL, NULL),
(202, '1', 224, 28, NULL, NULL),
(203, '1', 225, 29, NULL, NULL),
(204, '1', 226, 29, NULL, NULL),
(205, '1', 227, 28, NULL, NULL),
(206, '1', 235, 1, NULL, NULL),
(207, '1', 236, 28, NULL, NULL),
(208, '1', 237, 1, NULL, NULL),
(209, '2', 238, 21, NULL, NULL),
(210, '1', 239, 31, NULL, NULL),
(211, '2', 239, 21, NULL, NULL),
(212, '1', 240, 1, NULL, NULL),
(213, '1', 241, 1, NULL, NULL),
(214, '1', 243, 28, NULL, NULL),
(215, '1', 244, 1, NULL, NULL),
(216, '1', 245, 28, NULL, NULL),
(217, '1', 246, 28, NULL, NULL),
(218, '1', 247, 1, NULL, NULL),
(219, '1', 248, 1, NULL, NULL),
(220, '1', 249, 1, NULL, NULL),
(221, '1', 250, 1, NULL, NULL),
(222, '1', 251, 28, NULL, NULL),
(223, '1', 252, 1, NULL, NULL),
(225, '1', 253, 28, NULL, NULL),
(226, '1', 254, 28, NULL, NULL),
(227, '1', 255, 28, NULL, NULL),
(228, '1', 256, 28, NULL, NULL),
(229, '1', 257, 32, NULL, NULL),
(230, '1', 258, 28, NULL, NULL),
(231, '1', 260, 28, NULL, NULL),
(232, '1', 261, 28, NULL, NULL),
(233, '1', 262, 32, NULL, NULL),
(234, '1', 263, 1, NULL, NULL),
(235, '1', 265, 28, NULL, NULL),
(236, '1', 267, 28, NULL, NULL),
(237, '1', 268, 28, NULL, NULL),
(238, '1', 269, 28, NULL, NULL),
(239, '1', 270, 28, NULL, NULL),
(240, '1', 271, 28, NULL, NULL),
(241, '1', 272, 28, NULL, NULL),
(242, '1', 274, 28, NULL, NULL),
(243, '1', 275, 33, NULL, NULL),
(244, '1', 276, 33, NULL, NULL),
(245, '1', 277, 33, NULL, NULL),
(246, '1', 278, 33, NULL, NULL),
(247, '1', 281, 33, NULL, NULL),
(249, '1', 283, 31, NULL, NULL),
(253, '1', 286, 14, NULL, NULL),
(254, '1', 286, 17, NULL, NULL),
(255, '2', 286, 31, NULL, NULL),
(260, '1', 284, 31, NULL, NULL),
(261, '1', 287, 33, NULL, NULL),
(263, '1', 288, 1, NULL, NULL),
(264, '2', 288, 33, NULL, NULL),
(265, '1', 284, 14, NULL, NULL),
(267, '2', 289, 21, NULL, NULL),
(268, '1', 289, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre_permiso` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `usuario` tinyint(1) NOT NULL DEFAULT '0',
  `crear_usuario` tinyint(1) NOT NULL DEFAULT '0',
  `modificar_usuario` tinyint(1) NOT NULL DEFAULT '0',
  `ver_botones_usuario` tinyint(1) NOT NULL DEFAULT '0',
  `desactivar_usuario` tinyint(1) NOT NULL DEFAULT '0',
  `reactivar_usuario` tinyint(1) NOT NULL DEFAULT '0',
  `cliente` tinyint(1) NOT NULL DEFAULT '0',
  `crear_cliente` tinyint(1) NOT NULL DEFAULT '0',
  `modificar_cliente` tinyint(1) NOT NULL DEFAULT '0',
  `ver_botones_cliente` tinyint(1) NOT NULL DEFAULT '0',
  `desactivar_cliente` tinyint(1) NOT NULL DEFAULT '0',
  `reactivar_cliente` tinyint(1) NOT NULL DEFAULT '0',
  `ptc` tinyint(1) NOT NULL DEFAULT '0',
  `crear_ptc` tinyint(1) NOT NULL DEFAULT '0',
  `modificar_ptc` tinyint(1) NOT NULL DEFAULT '0',
  `ver_botones_ptc` tinyint(1) NOT NULL DEFAULT '0',
  `desactivar_ptc` tinyint(1) NOT NULL DEFAULT '0',
  `reactivar_ptc` tinyint(1) NOT NULL DEFAULT '0',
  `obra` tinyint(1) NOT NULL DEFAULT '0',
  `crear_obra` tinyint(1) NOT NULL DEFAULT '0',
  `modificar_obra` tinyint(1) NOT NULL DEFAULT '0',
  `ver_botones_obra` tinyint(1) NOT NULL DEFAULT '0',
  `desactivar_obra` tinyint(1) NOT NULL DEFAULT '0',
  `reactivar_obra` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`id`, `nombre_permiso`, `usuario`, `crear_usuario`, `modificar_usuario`, `ver_botones_usuario`, `desactivar_usuario`, `reactivar_usuario`, `cliente`, `crear_cliente`, `modificar_cliente`, `ver_botones_cliente`, `desactivar_cliente`, `reactivar_cliente`, `ptc`, `crear_ptc`, `modificar_ptc`, `ver_botones_ptc`, `desactivar_ptc`, `reactivar_ptc`, `obra`, `crear_obra`, `modificar_obra`, `ver_botones_obra`, `desactivar_obra`, `reactivar_obra`, `created_at`, `updated_at`) VALUES
(1, 'Supremo', 1, 1, 1, 1, 1, 1, 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, NULL, NULL),
(2, 'dos', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, NULL, NULL),
(3, 'tres', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, NULL, NULL),
(4, 'cuatro', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, NULL, NULL),
(5, 'cinco', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, NULL, NULL),
(6, 'seis', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, NULL, NULL),
(7, 'siete', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, NULL, NULL),
(8, 'ocho', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, NULL, NULL),
(9, 'nueve', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, NULL, NULL),
(10, 'diez', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, NULL, NULL),
(11, 'once', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, NULL, NULL),
(12, 'doce', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, NULL, NULL),
(13, 'trece', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, NULL, NULL),
(14, 'catorce', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, NULL, NULL),
(15, 'quince', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, NULL, NULL),
(16, 'dieciseis', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, NULL, NULL),
(17, 'diecisiete', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, NULL, NULL),
(18, 'dieciocho', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, NULL, NULL),
(19, 'diecinueve', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, NULL, NULL),
(20, 'veinte', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal`
--

CREATE TABLE `personal` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `personal_codigo` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_profesion` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_estado` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `personal`
--

INSERT INTO `personal` (`id`, `personal_codigo`, `personal_nombre`, `personal_profesion`, `personal_estado`, `created_at`, `updated_at`) VALUES
(1, 'PER-1', 'Victor Gandica', 'Ingeniero de Sistemas', 1, NULL, NULL),
(2, 'PER-2', 'Yelineth Sanchez', 'Ingeniero Mecánico', 1, NULL, NULL),
(3, 'PER-3', 'Mayerling Paez', 'Ingeniero Telecomunicaciones', 1, NULL, NULL),
(4, 'PER-4', 'Lorena Arria', 'Ingeniero Telecomunicaciones', 1, NULL, NULL),
(5, 'PER-5', 'Luis Rodriguez', 'Ingeniero Telecomunicaciones', 1, NULL, NULL),
(6, 'PER-6', 'Alfredo Rosado', 'Ingeniero Telecomunicaciones', 1, NULL, NULL),
(7, 'PER-7', 'Edwin Blanco', 'Ingeniero Telecomunicaciones', 1, NULL, NULL),
(8, 'PER-8', 'Fredy Altuve', 'Ingeniero Civil', 1, NULL, NULL),
(9, 'PER-9', 'Daniel Belisario Salcedo', 'Pasante Ingenieria Civil', 0, NULL, NULL),
(10, 'PER-10', 'Edwind Correa', 'Ingeniero Telecomunicaciones', 1, NULL, NULL),
(11, 'PER-11', 'Alejandro Ojeda', 'Arquitecto', 1, NULL, NULL),
(12, 'PER-12', 'Joelis Blanco', 'Ingeniero de Planificación', 1, NULL, NULL),
(13, 'PER-13', 'Victor Zambrano', 'Ingeniero Telecomunicaciones', 1, NULL, NULL),
(14, 'PER-14', 'Ali Hernandez', 'Ingeniero Telecomunicaciones', 1, NULL, NULL),
(15, 'PER-15', 'Oswaldo Estevez', 'Ingeniero Electrico', 1, NULL, NULL),
(16, 'PER-16', 'Mirna Osuna', 'Ingeniero Civil', 1, NULL, NULL),
(17, 'PER-17', 'Carlos Ayala', 'Ingeniero Telecomunicaciones', 1, NULL, NULL),
(18, 'PER-18', 'ARIANNA BELLO', 'Ingeniero Telecomunicaciones', 1, NULL, NULL),
(19, 'PER-19', 'Katiuska Antelo', 'Ingeniero Civil', 1, NULL, NULL),
(20, 'PER-20', 'MOISES GUERRA', 'INGENIERO DE PETROLEO', 1, NULL, NULL),
(21, 'PER-21', 'ANDRES CARRION', 'INGENIERO ELECTRICISTA', 1, NULL, NULL),
(22, 'PER-22', 'Miriuscar Urbaneja', 'Ingeniero Civil', 1, NULL, NULL),
(23, 'PER-23', 'NIORKYS MORENO', 'INGENIERO CIVIL', 1, NULL, NULL),
(24, 'PER-24', 'JUAN JOSE GUANIRE', 'INGENIERO DE CAMPO', 1, NULL, NULL),
(25, 'PER-25', 'JESUS RAMIREZ', 'INGENIERO', 0, NULL, NULL),
(26, 'PER-26', 'Douglas Villarroel', 'INGENIERO CIVIL', 1, NULL, NULL),
(27, 'PER-27', 'Sami Souki', 'Gerente de Ventas', 1, NULL, NULL),
(28, 'PER-28', 'MAGDA RODRIGUEZ', 'GERENTE DE PROYECTO', 1, NULL, NULL),
(29, 'PER-29', 'ISMARLIN PUMERO', 'INGENIERO CIVIL', 1, NULL, NULL),
(30, 'PER-30', 'VILCY BRAVO', 'INGENIERO', 1, NULL, NULL),
(31, 'PER-31', 'DOMINGO ALBERTO ABREU ', 'INGENIERO ELECTRONICO', 1, NULL, NULL),
(32, 'PER-32', 'PIERRE SARCINELLI', 'PRESIDENTE', 1, NULL, NULL),
(33, 'PER-33', 'AMELIE ACOSTA', 'ARQUITECTO', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable` bigint(20) NOT NULL,
  `name` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo`
--

CREATE TABLE `tipo` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tipo_codigo` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo_nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo_estado` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tipo`
--

INSERT INTO `tipo` (`id`, `tipo_codigo`, `tipo_nombre`, `tipo_estado`, `created_at`, `updated_at`) VALUES
(1, 'TIP-1', 'Ingeniería de Detalle', 1, NULL, NULL),
(2, 'TIP-2', 'Factibilidad', 1, NULL, NULL),
(3, 'TIP-3', 'Mantenimiento', 1, NULL, NULL),
(4, 'TIP-4', 'Servicios', 1, NULL, NULL),
(5, 'TIP-5', 'Procura', 1, NULL, NULL),
(6, 'TIP-6', 'Instalaciones Sanitarias', 1, NULL, NULL),
(7, 'TIP-7', 'Instalación eléctrica', 1, NULL, NULL),
(8, 'TIP-8', 'Civil', 1, NULL, NULL),
(9, 'TIP-9', 'Supervisión', 1, NULL, NULL),
(10, 'TIP-10', 'Albañileria', 1, NULL, NULL),
(11, 'TIP-11', 'Telecomunicaciones', 1, NULL, NULL),
(12, 'TIP-12', 'Hidraulica', 1, NULL, NULL),
(13, 'TIP-13', 'Vialidad', 1, NULL, NULL),
(14, 'TIP-14', 'Herrería', 1, NULL, NULL),
(15, 'TIP-15', 'Ventas', 1, NULL, NULL),
(16, 'TIP-16', 'Suministros', 1, NULL, NULL),
(17, 'TIP-17', 'REEMBOLSO PRESTAMO', 1, NULL, NULL),
(18, 'TIP-18', 'FIANZAS', 1, NULL, NULL),
(19, 'TIP-19', 'Administración (Junta Directiva)', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_login` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_name` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(70) COLLATE utf8mb4_unicode_ci NOT NULL,
  `permiso_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `user_login`, `user_name`, `email`, `email_verified_at`, `password`, `permiso_id`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'vandaniel4', 'Daniel Antoyma', 'daniel.antoyma@jhcpconstruccion.com', NULL, '$2y$10$Em9yziu6/MijQegPYcjfDuyy6HeZLWOzsXlDbMs89sUcO8sIaJhVG', 1, 0, NULL, NULL, NULL),
(7, 'forne', 'Jesus Fornerino', 'jesus.fornerino@jhcpconstruccion.com', NULL, '$2y$10$Em9yziu6/MijQegPYcjfDuyy6HeZLWOzsXlDbMs89sUcO8sIaJhVG', 2, 1, NULL, NULL, NULL),
(8, 'piersar', 'Pierre Sarcinelli', 'pierre@jhcpconstruccion.com', NULL, '$2y$10$Em9yziu6/MijQegPYcjfDuyy6HeZLWOzsXlDbMs89sUcO8sIaJhVG', 3, 1, NULL, NULL, NULL),
(18, 'fredy.altuve', 'Fredy Altuve', 'fredy@jhcpconstruccion.com', NULL, '$2y$10$Em9yziu6/MijQegPYcjfDuyy6HeZLWOzsXlDbMs89sUcO8sIaJhVG', 1, 0, NULL, NULL, NULL),
(19, 'yeli.sanchez', 'Yelineth Sanchez', 'yeli.sanchez@jhcpconstruccion.com', NULL, '$2y$10$Em9yziu6/MijQegPYcjfDuyy6HeZLWOzsXlDbMs89sUcO8sIaJhVG', 1, 0, NULL, NULL, NULL),
(20, 'daniel.belisario', 'Daniel Belisario', 'daniel.belisario@jhcpconstruccion.com', NULL, '$2y$10$Em9yziu6/MijQegPYcjfDuyy6HeZLWOzsXlDbMs89sUcO8sIaJhVG', 1, 0, NULL, NULL, NULL),
(21, 'vgandica', 'Victor Gandica', 'victor.gandica@jhcpconstruccion.com', NULL, '$2y$10$Em9yziu6/MijQegPYcjfDuyy6HeZLWOzsXlDbMs89sUcO8sIaJhVG', 1, 1, NULL, NULL, NULL),
(22, 'mirna', 'Mirna Osuna', 'mirna.osuna@jhcpconstruccion.com', NULL, '123', 1, 0, NULL, NULL, NULL),
(23, 'mayer', 'Mayerling Paez', 'mayerling.paez@jhcpconstruccion.com', NULL, '123', 1, 0, NULL, NULL, NULL),
(24, 'andre', 'Antoine Yabichino', 'ayabichino@jhcpconstruccion.com', NULL, '123', 7, 0, NULL, NULL, NULL),
(25, 'eduardo.gomez', 'Eduardo Gomez', 'eduardo.gomez@jhcpconstruccion.com', NULL, '123', 1, 0, NULL, NULL, NULL),
(26, 'joe', 'Joelis Blanco', 'joelis.blanco@jhcpconstruccion.com', NULL, '123', 1, 0, NULL, NULL, NULL),
(27, 'anto', 'Antonella Gagliardi', 'antonella.gagliardi2@jhcpconstruccion.com', NULL, '123', 2, 0, NULL, NULL, NULL),
(28, 'antonella', 'Antonella Gagliardi', 'antonella.gagliardi@jhcpconstruccion.com', NULL, '123', 4, 0, NULL, NULL, NULL),
(29, 'anacas', 'Ana Castaño', 'ana.castano@jhcpconstruccion.com', NULL, '123', 1, 0, NULL, NULL, NULL),
(30, 'orle', 'Orleimny Sequini', 'orle.sequini@jhcpconstruccion.com', NULL, '123', 6, 0, NULL, NULL, NULL),
(31, 'francia.avila', 'Francia Aular', 'francia.aular@jhcpconstruccion.com', NULL, '123', 1, 0, NULL, NULL, NULL),
(32, 'jordy', 'Jordy Colmenares', 'jordy@jhcpconstruccion.com', NULL, 'jc13', 4, 0, NULL, NULL, NULL),
(33, 'carlitos.ayala', 'Carlos Ayala', 'carlos.ayala@jhcpconstruccion.com', NULL, '123', 1, 0, NULL, NULL, NULL),
(34, 'hector', 'Hector Rodriguez', 'hector@jhcpconstruccion.com', NULL, 'hector0811', 3, 1, NULL, NULL, NULL),
(35, 'mirian', 'Mirian Acuña', 'mirian@jhcpconstruccion.com', NULL, '123', 1, 0, NULL, NULL, NULL),
(36, 'edwin.blanco', 'Edwin Blanco', 'edwin.blanco@jhcpconstruccion.com', NULL, '123', 1, 0, NULL, NULL, NULL),
(37, 'alejandro.ojeda', 'Alejandro Ojeda', 'alejandro.ojeda@jhcpconstruccion.com', NULL, '123', 1, 0, NULL, NULL, NULL),
(38, 'lorena.arria', 'Lorena Arria', 'lorena.arria@jhcpconstruccion.com', NULL, '123', 1, 0, NULL, NULL, NULL),
(39, 'luis_rodriguez1', 'Luis Rodriguez', 'luis.rodriguez@jhcpconstruccion.com', NULL, '123', 1, 0, NULL, NULL, NULL),
(40, 'risales', 'Omar Risales', 'omar.risales@jhcpconstruccion.com', NULL, '123', 1, 0, NULL, NULL, NULL),
(41, 'dmardeni_1', 'Daniel Mardeni', 'daniel.mardeni@jhcpconstruccion.com', NULL, '123', 1, 0, NULL, NULL, NULL),
(42, 'jriobueno_1', 'Junior Riobueno', 'junior@jhcpconstruccion.com', NULL, '123', 1, 0, NULL, NULL, NULL),
(43, 'javier.moreno', 'Javier Moreno', 'javier.moreno@jhcpconstruccion.com', NULL, '123', 1, 0, NULL, NULL, NULL),
(44, 'abello', 'Arianna Bello', 'abello@jhcpconstruccion.com', NULL, '123', 1, 0, NULL, NULL, NULL),
(45, 'compras', 'Compras', 'compras@jhcpconstruccion.com', NULL, '123', 6, 0, NULL, NULL, NULL),
(46, 'oswa', 'Oswaldo Estevez', 'oswaldo.estevez@jhcpconstruccion.com', NULL, '123', 1, 0, NULL, NULL, NULL),
(47, 'joss', 'Josselyn Tovar', 'josselyn.tovar@jhcp.com', NULL, 'joss_16', 7, 0, NULL, NULL, NULL),
(48, 'roiz', 'Juan Roiz', 'juan.roiz@jhcp.com', NULL, '12345', 1, 0, NULL, NULL, NULL),
(49, 'niurka', 'Niurka Morales', 'niurka.morales@jhcp.com', NULL, '12345', 4, 0, NULL, NULL, NULL),
(50, 'fnunezan', 'Francisco Nunez', 'francisco.nunez@jhcpconstruccion.com', NULL, '123', 1, 0, NULL, NULL, NULL),
(51, 'murbaneja', 'miriusca urbaneja', 'mariuscar.urbaneja@jhcpconstruccion.com', NULL, '123', 1, 0, NULL, NULL, NULL),
(52, 'katiuska', 'katiuska antelo', 'katiuska.antelo@jhcpconstruccion.com', NULL, '123', 1, 0, NULL, NULL, NULL),
(53, 'rada', 'luis rada', 'luis.rada@jhcpconstruccion.com', NULL, '123', 4, 0, NULL, NULL, NULL),
(54, 'omaira', 'omaira quero', 'omaira.quero@jhcp.com', NULL, '123', 8, 0, NULL, NULL, NULL),
(55, 'melina', 'melina padilla', 'melina.padilla@jhcpconstruccion.com', NULL, 'Zulia.2017', 8, 0, NULL, NULL, NULL),
(56, 'randolf', 'randolf ramirez', 'randolf.ramirez@jhcpconstruccion.com', NULL, '123', 1, 0, NULL, NULL, NULL),
(57, 'Niorkys', 'Niorkys Moreno', 'niorkys.moreno@jhcpconstruccion.com', NULL, '123', 10, 0, NULL, NULL, NULL),
(58, 'jesus', 'jesus ramirez', 'jesus.ramirez@jhcp.com', NULL, '123', 7, 0, NULL, NULL, NULL),
(59, 'laura', 'laura ochoa', 'laura.ochoa@jhcpconstruccion.com', NULL, '123', 1, 0, NULL, NULL, NULL),
(60, 'acarrion', 'Andres Carrion', 'acarrion@jhcpconstruccion.com', NULL, 'Venezuela2016', 1, 0, NULL, NULL, NULL),
(61, 'douglas', 'douglas villarroel', 'douglas.villarroel@jhcpconstruccion.com', NULL, '123', 1, 0, NULL, NULL, NULL),
(62, 'marciel', 'Marciel Dasilva', 'marciel.dasilva@jhcpconstruccion.com', NULL, '123', 1, 0, NULL, NULL, NULL),
(63, 'emily', 'emilyjin gonzalez', 'emilyjin.gonzalez@jhcpconstruccion.com', NULL, '123', 11, 0, NULL, NULL, NULL),
(64, 'franklin', 'franklin fernandez', 'franklin.fernandez@jhcpconstruccion.com', NULL, '123', 1, 0, NULL, NULL, NULL),
(65, 'juan', 'Juan Borrego', 'juan.borrego@jhcpconstruccion.com', NULL, 'Venezuela2017', 6, 0, NULL, NULL, NULL),
(66, 'paola', 'paola diaz', 'paola.diaz@jhcp.com', NULL, '123', 1, 0, NULL, NULL, NULL),
(67, 'betzi', 'betzibeth balza', 'betzibeth.balza@jhcp.com', NULL, '123', 4, 0, NULL, NULL, NULL),
(68, 'ivan', 'Ivan Salas', 'ivan.salas@jhcpconstruccion.com', NULL, 'Venezuela2017', 10, 0, NULL, NULL, NULL),
(69, 'ana', 'Ana Lopez', 'ana.lopez@jhcpconstruccion.com', NULL, 'Ana21346829.', 1, 0, NULL, NULL, NULL),
(70, 'FVIELMA', 'FRANCISCO VIELMA', 'francisco.vielma@jhcpconstruccion.com', NULL, 'Fernando.2005', 1, 0, NULL, NULL, NULL),
(71, 'Isbella ', 'Isbella Cavalieri', 'isbella.cavalieri@jhcp.com', NULL, '1709', 1, 0, NULL, NULL, NULL),
(72, 'Johely', 'Johely Campos', 'johely.campos@jhcpconstruccion.com', NULL, '123', 1, 1, NULL, NULL, NULL),
(73, 'Abranny', 'Abranny Garcia', 'abranny.garcia@jhcpconstruccion.com', NULL, 'Ginas1405', 8, 0, NULL, NULL, NULL),
(74, 'Estefanny ', 'Estefanny Quintero ', 'estefanny.quintero@jhcpconstruccion.com', NULL, 'caracas.02', 6, 0, NULL, NULL, NULL),
(75, 'Alexa', 'Alexa Guzman', 'Alexa.guzman@jhcp.com', NULL, '0603', 1, 0, NULL, NULL, NULL),
(76, 'Ismarlin', 'Ismarlin Pumero', 'ismarlin.pumero@jhcpconstruccion.com', NULL, '2126', 1, 0, NULL, NULL, NULL),
(77, 'IPUMERO', 'ISMARLIN PUMERO', 'ismarlin.pumero2@jhcpconstruccion.com', NULL, 'IPUMERO2017', 1, 0, NULL, NULL, NULL),
(78, 'Andres', 'Norrito', 'andres.norrito@jhcpconstruccion.com', NULL, 'norrito.2017', 10, 1, NULL, NULL, NULL),
(79, 'Sami', 'Sami Souki', 'sami.souki@jhcp.com', NULL, 'souki.2017', 1, 0, NULL, NULL, NULL),
(80, 'Magda', 'Magda Rodriguez', 'magda.rodriguez@jhcpconstruccion.com', NULL, 'maocan19', 1, 0, NULL, NULL, NULL),
(81, 'IVES', 'IVES BASTIDAS', 'ives.bastidas@jhcpconstruccion.com', NULL, 'GRAT1121', 1, 0, NULL, NULL, NULL),
(82, 'JESUSS', 'JESUS SALAZAR', 'jesus.salazar@jhcpconstruccion.com', NULL, 'jesusesb33', 1, 0, NULL, NULL, NULL),
(83, 'VBRAVO', 'VILCY BRAVO', 'vilcy.bravo@jhcpconstruccion.com', NULL, 'VBJHCP', 1, 0, NULL, NULL, NULL),
(84, 'DENISSE', 'DENISSE ALEJANDRA CORRALES', 'DENISSE.CORRALES@JHCPCONSTRUCCION.COM', NULL, 'ALE17132115', 1, 0, NULL, NULL, NULL),
(85, 'Neilyn', 'Neilyn Mercie', 'neilyn.mercie@jhcpconstruccion.com', NULL, '123', 6, 0, NULL, NULL, NULL),
(86, 'Alexa G', 'ALEXA GUZMAN', 'alexa.guzman2@jhcp.com', NULL, '0603', 7, 0, NULL, NULL, NULL),
(87, 'Amelie', 'Amelie Acosta', 'amelie.acosta@jhcpconstruccion.com', NULL, 'LUIGIACOSTA', 7, 1, NULL, NULL, NULL),
(88, 'Avivas', 'Adrian Vivas', 'adrian.vivas@jhcpconstruccion.com', NULL, 'Avivas', 1, 1, NULL, NULL, NULL),
(90, 'administrador', 'administrador', 'admin@admin', '2021-10-20 16:00:00', '$2y$10$zVlULuwVzMCw8Y3pew6QXeW4M3NwbZz.XpcJWwjn0mc9/AhGniR7q', 1, 1, NULL, NULL, NULL),
(100, 'NombrUsuario', 'salu falso monsanto', 'admin@admin2', NULL, '$2y$10$fn6hU7g87ve9mGn7GId3FeK4uAYiCVXDNLnU7rvOZ6PMUSw/71TXG', 1, 1, NULL, '2021-10-28 22:42:16', '2021-10-28 22:42:16'),
(101, 'altamirana', 'altamirano anibal', 'admin@admin1111111', NULL, '$2y$10$eIPyhSJ2Pv8VgyhbETr1P.I50Dfn3ZlatsdvI2kXPdJJfEhlfwQNG', 14, 1, NULL, '2021-11-01 22:14:35', '2021-11-02 03:55:35'),
(102, 'arepa2', 'arepa', 'arepa@arepaarepa', NULL, '$2y$10$Gn65l5nzr2K6aRZ3p9MbH.lpofva0dpArfE7ukq4ff7MDoiDnrSSW', 14, 0, NULL, '2021-11-02 21:37:01', '2021-11-02 22:11:46');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `codventa`
--
ALTER TABLE `codventa`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `obra`
--
ALTER TABLE `obra`
  ADD PRIMARY KEY (`id`),
  ADD KEY `obra_cliente_id_foreign` (`cliente_id`),
  ADD KEY `obra_tipo_id_foreign` (`tipo_id`);

--
-- Indices de la tabla `obra_personal`
--
ALTER TABLE `obra_personal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `obra_personal_obra_id_foreign` (`obra_id`),
  ADD KEY `obra_personal_personal_id_foreign` (`personal_id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `personal`
--
ALTER TABLE `personal`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`);

--
-- Indices de la tabla `tipo`
--
ALTER TABLE `tipo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_permiso_id_foreign` (`permiso_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `codventa`
--
ALTER TABLE `codventa`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=207;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT de la tabla `obra`
--
ALTER TABLE `obra`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=291;

--
-- AUTO_INCREMENT de la tabla `obra_personal`
--
ALTER TABLE `obra_personal`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=269;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `personal`
--
ALTER TABLE `personal`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipo`
--
ALTER TABLE `tipo`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `obra`
--
ALTER TABLE `obra`
  ADD CONSTRAINT `obra_cliente_id_foreign` FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`id`),
  ADD CONSTRAINT `obra_tipo_id_foreign` FOREIGN KEY (`tipo_id`) REFERENCES `tipo` (`id`);

--
-- Filtros para la tabla `obra_personal`
--
ALTER TABLE `obra_personal`
  ADD CONSTRAINT `obra_personal_obra_id_foreign` FOREIGN KEY (`obra_id`) REFERENCES `obra` (`id`),
  ADD CONSTRAINT `obra_personal_personal_id_foreign` FOREIGN KEY (`personal_id`) REFERENCES `personal` (`id`);

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_permiso_id_foreign` FOREIGN KEY (`permiso_id`) REFERENCES `permisos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
