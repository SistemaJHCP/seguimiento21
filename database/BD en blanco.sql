-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-04-2022 a las 21:39:36
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
-- Estructura de tabla para la tabla `banco`
--

CREATE TABLE `banco` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `banco_rif` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `banco_nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `banco_estado` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `banco_proveedor`
--

CREATE TABLE `banco_proveedor` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `banco_id` bigint(20) UNSIGNED NOT NULL,
  `proveedor_id` bigint(20) UNSIGNED NOT NULL,
  `tipodecuenta` int(11) NOT NULL,
  `numero` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caja`
--

CREATE TABLE `caja` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `caja_nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `caja_monto` decimal(20,2) DEFAULT NULL,
  `caja_observaciones` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `caja_estado` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `codventa_correo` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `codventa_estado` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuenta`
--

CREATE TABLE `cuenta` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cuenta_tipo` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cuenta_numero` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cuenta_montoinicial` decimal(20,2) DEFAULT NULL,
  `cuenta_estado` tinyint(1) NOT NULL DEFAULT '1',
  `banco_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Estructura de tabla para la tabla `material`
--

CREATE TABLE `material` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `material_codigo` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `material_nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `material_estado` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
(296, '2014_10_12_000000_create_users_table', 1),
(297, '2014_10_12_100000_create_password_resets_table', 1),
(298, '2019_08_19_000000_create_failed_jobs_table', 1),
(299, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(300, '2021_10_13_161651_cliente', 1),
(301, '2021_10_13_161950_codventa', 1),
(302, '2021_10_13_162020_tipo', 1),
(303, '2021_10_13_162114_personal', 1),
(304, '2021_10_13_162146_obra', 1),
(305, '2021_11_24_201606_materiales', 1),
(306, '2021_11_24_202344_proveedor', 1),
(307, '2021_11_29_150359_banco', 1),
(308, '2021_12_03_145349_requisicion', 1),
(309, '2021_12_08_181503_servicio', 1),
(310, '2021_12_08_181724_viatico', 1),
(311, '2021_12_16_180315_solicitud_detalle', 1),
(312, '2022_01_14_133629_profesion', 1),
(313, '2022_01_27_134750_solicitud', 1),
(314, '2022_02_03_134740_nomina', 1),
(315, '2022_02_14_181804_caja', 1),
(316, '2022_03_08_200238_pago', 1),
(317, '2022_03_09_135958_cuenta', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nomina`
--

CREATE TABLE `nomina` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nomina_codigo` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nomina_nombre` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nomina_estado` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago`
--

CREATE TABLE `pago` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pago_fecha` date NOT NULL,
  `pago_formapago` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pago_numerocomprobante` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pago_monto` decimal(20,2) DEFAULT NULL,
  `pago_descripcion` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `pago_estado` tinyint(1) NOT NULL DEFAULT '1',
  `orden_compra_id` bigint(20) DEFAULT NULL,
  `solicitud_id` bigint(20) NOT NULL,
  `cuenta_id` bigint(20) DEFAULT NULL,
  `cheque_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `materiales` tinyint(1) NOT NULL DEFAULT '0',
  `crear_materiales` tinyint(1) NOT NULL DEFAULT '0',
  `ver_botones_materiales` tinyint(1) NOT NULL DEFAULT '0',
  `desactivar_materiales` tinyint(1) NOT NULL DEFAULT '0',
  `proveedores` tinyint(1) NOT NULL DEFAULT '0',
  `crear_proveedores` tinyint(1) NOT NULL DEFAULT '0',
  `modificar_proveedores` tinyint(1) NOT NULL DEFAULT '0',
  `ver_botones_proveedores` tinyint(1) NOT NULL DEFAULT '0',
  `desactivar_proveedores` tinyint(1) NOT NULL DEFAULT '0',
  `reactivar_proveedores` tinyint(1) NOT NULL DEFAULT '0',
  `tipo` tinyint(1) NOT NULL DEFAULT '0',
  `crear_tipo` tinyint(1) NOT NULL DEFAULT '0',
  `modificar_tipo` tinyint(1) NOT NULL DEFAULT '0',
  `ver_botones_tipo` tinyint(1) NOT NULL DEFAULT '0',
  `desactivar_tipo` tinyint(1) NOT NULL DEFAULT '0',
  `personal` tinyint(1) NOT NULL DEFAULT '0',
  `crear_personal` tinyint(1) NOT NULL DEFAULT '0',
  `modificar_personal` tinyint(1) NOT NULL DEFAULT '0',
  `ver_botones_personal` tinyint(1) NOT NULL DEFAULT '0',
  `desactivar_personal` tinyint(1) NOT NULL DEFAULT '0',
  `reactivar_personal` tinyint(1) NOT NULL DEFAULT '0',
  `suministros` tinyint(1) NOT NULL DEFAULT '0',
  `crear_suministros` tinyint(1) NOT NULL DEFAULT '0',
  `modificar_suministros` tinyint(1) NOT NULL DEFAULT '0',
  `ver_botones_suministros` tinyint(1) NOT NULL DEFAULT '0',
  `desactivar_suministros` tinyint(1) NOT NULL DEFAULT '0',
  `reactivar_suministros` tinyint(1) NOT NULL DEFAULT '0',
  `banco` tinyint(1) NOT NULL DEFAULT '0',
  `crear_banco` tinyint(1) NOT NULL DEFAULT '0',
  `desactivar_banco` tinyint(1) NOT NULL DEFAULT '0',
  `requisicion` tinyint(1) NOT NULL DEFAULT '0',
  `crear_requisicion` tinyint(1) NOT NULL DEFAULT '0',
  `modificar_requisicion` tinyint(1) NOT NULL DEFAULT '0',
  `ver_botones_requisicion` tinyint(1) NOT NULL DEFAULT '0',
  `anular_requisicion` tinyint(1) NOT NULL DEFAULT '0',
  `solicitud` tinyint(1) NOT NULL DEFAULT '0',
  `crear_solicitud` tinyint(1) NOT NULL DEFAULT '0',
  `modificar_solicitud` tinyint(1) NOT NULL DEFAULT '0',
  `ver_botones_solicitud` tinyint(1) NOT NULL DEFAULT '0',
  `anular_solicitud` tinyint(1) NOT NULL DEFAULT '0',
  `nomina_solicitud_opcion` tinyint(1) NOT NULL DEFAULT '0',
  `material_solicitud_opcion` tinyint(1) NOT NULL DEFAULT '0',
  `servicio_solicitud_opcion` tinyint(1) NOT NULL DEFAULT '0',
  `viatico_solicitud_opcion` tinyint(1) NOT NULL DEFAULT '0',
  `caja_chica_solicitud_opcion` tinyint(1) NOT NULL DEFAULT '0',
  `nomina_solicitud` tinyint(1) NOT NULL DEFAULT '0',
  `materiales_solicitud` tinyint(1) NOT NULL DEFAULT '0',
  `servicio_solicitud` tinyint(1) NOT NULL DEFAULT '0',
  `viatico_solicitud` tinyint(1) NOT NULL DEFAULT '0',
  `solicitud_pago` tinyint(1) NOT NULL DEFAULT '0',
  `ver_solicitud_pago` tinyint(1) NOT NULL DEFAULT '0',
  `aprobacion_solicitud_pago` tinyint(1) NOT NULL DEFAULT '0',
  `servicio` tinyint(1) NOT NULL DEFAULT '0',
  `crear_servicio` tinyint(1) NOT NULL DEFAULT '0',
  `ver_botones_servicio` tinyint(1) NOT NULL DEFAULT '0',
  `desactivar_servicio` tinyint(1) NOT NULL DEFAULT '0',
  `viatico` tinyint(1) NOT NULL DEFAULT '0',
  `crear_viatico` tinyint(1) NOT NULL DEFAULT '0',
  `ver_botones_viatico` tinyint(1) NOT NULL DEFAULT '0',
  `desactivar_viatico` tinyint(1) NOT NULL DEFAULT '0',
  `compra_cuentas_x_pagar` tinyint(1) NOT NULL DEFAULT '0',
  `aproRepro_compra_cuentas_x_pagar` tinyint(1) NOT NULL DEFAULT '0',
  `ver_botones_compra_cuentas_x_pagar` tinyint(1) NOT NULL DEFAULT '0',
  `reactivar_compra_cuentas_x_pagar` tinyint(1) NOT NULL DEFAULT '0',
  `conciliacion` tinyint(1) NOT NULL DEFAULT '0',
  `crear_conciliacion` tinyint(1) NOT NULL DEFAULT '0',
  `configuracion_btn` tinyint(1) NOT NULL DEFAULT '0',
  `maestro_btn` tinyint(1) NOT NULL DEFAULT '0',
  `control_de_obras_btn` tinyint(1) NOT NULL DEFAULT '0',
  `cuentas_por_pagar_btn` tinyint(1) NOT NULL DEFAULT '0',
  `bitacora` tinyint(1) NOT NULL DEFAULT '0',
  `estadistica` tinyint(1) NOT NULL DEFAULT '0',
  `permisos_btn` tinyint(1) NOT NULL DEFAULT '0',
  `crear_permisos` tinyint(1) NOT NULL DEFAULT '0',
  `ver_boton_permisos` tinyint(1) NOT NULL DEFAULT '0',
  `modificar_permisos` tinyint(1) NOT NULL DEFAULT '0',
  `desactivar_permisos` tinyint(1) NOT NULL DEFAULT '0',
  `reactivar_permisos` tinyint(1) NOT NULL DEFAULT '0',
  `estado_permisos` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`id`, `nombre_permiso`, `usuario`, `crear_usuario`, `modificar_usuario`, `ver_botones_usuario`, `desactivar_usuario`, `reactivar_usuario`, `cliente`, `crear_cliente`, `modificar_cliente`, `ver_botones_cliente`, `desactivar_cliente`, `reactivar_cliente`, `ptc`, `crear_ptc`, `modificar_ptc`, `ver_botones_ptc`, `desactivar_ptc`, `reactivar_ptc`, `obra`, `crear_obra`, `modificar_obra`, `ver_botones_obra`, `desactivar_obra`, `reactivar_obra`, `materiales`, `crear_materiales`, `ver_botones_materiales`, `desactivar_materiales`, `proveedores`, `crear_proveedores`, `modificar_proveedores`, `ver_botones_proveedores`, `desactivar_proveedores`, `reactivar_proveedores`, `tipo`, `crear_tipo`, `modificar_tipo`, `ver_botones_tipo`, `desactivar_tipo`, `personal`, `crear_personal`, `modificar_personal`, `ver_botones_personal`, `desactivar_personal`, `reactivar_personal`, `suministros`, `crear_suministros`, `modificar_suministros`, `ver_botones_suministros`, `desactivar_suministros`, `reactivar_suministros`, `banco`, `crear_banco`, `desactivar_banco`, `requisicion`, `crear_requisicion`, `modificar_requisicion`, `ver_botones_requisicion`, `anular_requisicion`, `solicitud`, `crear_solicitud`, `modificar_solicitud`, `ver_botones_solicitud`, `anular_solicitud`, `nomina_solicitud_opcion`, `material_solicitud_opcion`, `servicio_solicitud_opcion`, `viatico_solicitud_opcion`, `caja_chica_solicitud_opcion`, `nomina_solicitud`, `materiales_solicitud`, `servicio_solicitud`, `viatico_solicitud`, `solicitud_pago`, `ver_solicitud_pago`, `aprobacion_solicitud_pago`, `servicio`, `crear_servicio`, `ver_botones_servicio`, `desactivar_servicio`, `viatico`, `crear_viatico`, `ver_botones_viatico`, `desactivar_viatico`, `compra_cuentas_x_pagar`, `aproRepro_compra_cuentas_x_pagar`, `ver_botones_compra_cuentas_x_pagar`, `reactivar_compra_cuentas_x_pagar`, `conciliacion`, `crear_conciliacion`, `configuracion_btn`, `maestro_btn`, `control_de_obras_btn`, `cuentas_por_pagar_btn`, `bitacora`, `estadistica`, `permisos_btn`, `crear_permisos`, `ver_boton_permisos`, `modificar_permisos`, `desactivar_permisos`, `reactivar_permisos`, `estado_permisos`, `created_at`, `updated_at`) VALUES
(1, 'Desarrollador', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, NULL, NULL),
(2, 'Inhabilitados', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal`
--

CREATE TABLE `personal` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `personal_codigo` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_profesion` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_estado` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Estructura de tabla para la tabla `profesion`
--

CREATE TABLE `profesion` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `profesion` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profesion_estado` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `proveedor_codigo` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `proveedor_tipo` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `proveedor_rif` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `proveedor_nombre` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `proveedor_telefono` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `proveedor_direccion` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `proveedor_correo` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `proveedor_contacto` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `proveedor_estado` tinyint(1) NOT NULL DEFAULT '1',
  `suministro_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `requisicion`
--

CREATE TABLE `requisicion` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `requisicion_codigo` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `requisicion_tipo` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `requisicion_fecha` date NOT NULL,
  `requisicion_fechae` date NOT NULL,
  `requisicion_motivo` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `requisicion_direccion` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `requisicion_observaciones` longtext COLLATE utf8mb4_unicode_ci,
  `requisicion_estado` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'No Vista',
  `requisicion_comentario` text COLLATE utf8mb4_unicode_ci,
  `requisicion_solicitud` bigint(20) DEFAULT NULL,
  `usuario_id` bigint(20) UNSIGNED NOT NULL,
  `usuario_view_id` bigint(20) DEFAULT NULL,
  `obra_id` bigint(20) UNSIGNED NOT NULL,
  `proveedor_id` bigint(20) DEFAULT NULL,
  `aprobador_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio`
--

CREATE TABLE `servicio` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `servicio_codigo` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `servicio_nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `servicio_estado` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud`
--

CREATE TABLE `solicitud` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `solicitud_numerocontrol` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `solicitud_fecha` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `solicitud_tipo` int(11) NOT NULL,
  `solicitud_tiposolicitud` int(11) NOT NULL,
  `solicitud_iva` int(11) NOT NULL,
  `solicitud_factura` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `solicitud_motivo` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `solicitud_observaciones` text COLLATE utf8mb4_unicode_ci,
  `solicitud_formapago` int(11) NOT NULL,
  `solicitud_aprobacion` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Sin Respuesta',
  `solicitud_comentario` text COLLATE utf8mb4_unicode_ci,
  `solicitud_comentarior` text COLLATE utf8mb4_unicode_ci,
  `solicitud_contador` int(11) NOT NULL DEFAULT '1',
  `solicitud_estadopago` int(11) NOT NULL DEFAULT '1',
  `solicitud_comentariopago` text COLLATE utf8mb4_unicode_ci,
  `usuario_id` bigint(20) UNSIGNED NOT NULL,
  `obra_id` bigint(20) UNSIGNED NOT NULL,
  `proveedor_id` int(11) DEFAULT NULL,
  `banco_proveedor_id` int(11) DEFAULT NULL,
  `aprobador_id` int(11) DEFAULT NULL,
  `cotizacion_id` int(11) DEFAULT NULL,
  `requisicion_id` int(11) DEFAULT NULL,
  `moneda` enum('Bs','$') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Bs',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud_detalle`
--

CREATE TABLE `solicitud_detalle` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sd_cantidad` decimal(20,2) NOT NULL,
  `sd_preciounitario` decimal(20,2) DEFAULT NULL,
  `sd_caracteristicas` text COLLATE utf8mb4_unicode_ci,
  `solicitud_id` int(11) DEFAULT NULL,
  `requisicion_id` int(11) DEFAULT NULL,
  `caja_id` int(11) DEFAULT NULL,
  `nomina_id` int(11) DEFAULT NULL,
  `material_id` int(11) DEFAULT NULL,
  `servicio_id` int(11) DEFAULT NULL,
  `viatico_id` int(11) DEFAULT NULL,
  `moneda` enum('Bs','$') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Bs',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `suministro`
--

CREATE TABLE `suministro` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `suministro_codigo` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `suministro_nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `suministro_estado` tinyint(1) NOT NULL DEFAULT '1',
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
  `tipo_estado` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_login` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_name` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sexo` enum('m','f') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'm',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(70) COLLATE utf8mb4_unicode_ci NOT NULL,
  `permiso_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `user_login`, `user_name`, `email`, `sexo`, `email_verified_at`, `password`, `permiso_id`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Desarrollador', 'Rosman Gonzalez', 'it@jhcp.com', 'm', '2022-04-27 20:32:25', '$2y$10$v2vfiAEg.dqjTL9PIYA/dOOKt73butQx3EDqw00qjWwqQWo7gA7tu', 1, 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viatico`
--

CREATE TABLE `viatico` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `viatico_codigo` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `viatico_nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `viatico_estado` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `banco`
--
ALTER TABLE `banco`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `banco_proveedor`
--
ALTER TABLE `banco_proveedor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `banco_proveedor_banco_id_foreign` (`banco_id`),
  ADD KEY `banco_proveedor_proveedor_id_foreign` (`proveedor_id`);

--
-- Indices de la tabla `caja`
--
ALTER TABLE `caja`
  ADD PRIMARY KEY (`id`);

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
-- Indices de la tabla `cuenta`
--
ALTER TABLE `cuenta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cuenta_banco_id_foreign` (`banco_id`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `material`
--
ALTER TABLE `material`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `nomina`
--
ALTER TABLE `nomina`
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
-- Indices de la tabla `pago`
--
ALTER TABLE `pago`
  ADD PRIMARY KEY (`id`);

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
-- Indices de la tabla `profesion`
--
ALTER TABLE `profesion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `proveedor_suministro_id_foreign` (`suministro_id`);

--
-- Indices de la tabla `requisicion`
--
ALTER TABLE `requisicion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `requisicion_usuario_id_foreign` (`usuario_id`),
  ADD KEY `requisicion_obra_id_foreign` (`obra_id`);

--
-- Indices de la tabla `servicio`
--
ALTER TABLE `servicio`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `solicitud`
--
ALTER TABLE `solicitud`
  ADD PRIMARY KEY (`id`),
  ADD KEY `solicitud_usuario_id_foreign` (`usuario_id`),
  ADD KEY `solicitud_obra_id_foreign` (`obra_id`);

--
-- Indices de la tabla `solicitud_detalle`
--
ALTER TABLE `solicitud_detalle`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `suministro`
--
ALTER TABLE `suministro`
  ADD PRIMARY KEY (`id`);

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
-- Indices de la tabla `viatico`
--
ALTER TABLE `viatico`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `banco`
--
ALTER TABLE `banco`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `banco_proveedor`
--
ALTER TABLE `banco_proveedor`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `caja`
--
ALTER TABLE `caja`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `codventa`
--
ALTER TABLE `codventa`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cuenta`
--
ALTER TABLE `cuenta`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `material`
--
ALTER TABLE `material`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=318;

--
-- AUTO_INCREMENT de la tabla `nomina`
--
ALTER TABLE `nomina`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `obra`
--
ALTER TABLE `obra`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `obra_personal`
--
ALTER TABLE `obra_personal`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pago`
--
ALTER TABLE `pago`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `personal`
--
ALTER TABLE `personal`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `profesion`
--
ALTER TABLE `profesion`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `requisicion`
--
ALTER TABLE `requisicion`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `servicio`
--
ALTER TABLE `servicio`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `solicitud`
--
ALTER TABLE `solicitud`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `solicitud_detalle`
--
ALTER TABLE `solicitud_detalle`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `suministro`
--
ALTER TABLE `suministro`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipo`
--
ALTER TABLE `tipo`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `viatico`
--
ALTER TABLE `viatico`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `banco_proveedor`
--
ALTER TABLE `banco_proveedor`
  ADD CONSTRAINT `banco_proveedor_banco_id_foreign` FOREIGN KEY (`banco_id`) REFERENCES `banco` (`id`),
  ADD CONSTRAINT `banco_proveedor_proveedor_id_foreign` FOREIGN KEY (`proveedor_id`) REFERENCES `proveedor` (`id`);

--
-- Filtros para la tabla `cuenta`
--
ALTER TABLE `cuenta`
  ADD CONSTRAINT `cuenta_banco_id_foreign` FOREIGN KEY (`banco_id`) REFERENCES `banco` (`id`);

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
-- Filtros para la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD CONSTRAINT `proveedor_suministro_id_foreign` FOREIGN KEY (`suministro_id`) REFERENCES `suministro` (`id`);

--
-- Filtros para la tabla `requisicion`
--
ALTER TABLE `requisicion`
  ADD CONSTRAINT `requisicion_obra_id_foreign` FOREIGN KEY (`obra_id`) REFERENCES `obra` (`id`),
  ADD CONSTRAINT `requisicion_usuario_id_foreign` FOREIGN KEY (`usuario_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `solicitud`
--
ALTER TABLE `solicitud`
  ADD CONSTRAINT `solicitud_obra_id_foreign` FOREIGN KEY (`obra_id`) REFERENCES `obra` (`id`),
  ADD CONSTRAINT `solicitud_usuario_id_foreign` FOREIGN KEY (`usuario_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_permiso_id_foreign` FOREIGN KEY (`permiso_id`) REFERENCES `permisos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
