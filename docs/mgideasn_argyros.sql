-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-12-2017 a las 22:44:51
-- Versión del servidor: 5.7.11
-- Versión de PHP: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mgideasn_argyros`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin_configs`
--

CREATE TABLE `admin_configs` (
  `id` int(10) UNSIGNED NOT NULL,
  `orders_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `admin_configs`
--

INSERT INTO `admin_configs` (`id`, `orders_email`, `created_at`, `updated_at`) VALUES
(1, 'lacruzenrique@gmail.com', '2017-07-14 14:27:09', '2017-07-14 14:27:09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `uname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `categories`
--

INSERT INTO `categories` (`id`, `name`, `uname`, `created_at`, `updated_at`, `deleted_at`) VALUES
(0, 'none', '', '2017-01-01 18:48:13', NULL, NULL),
(1, 'Anillos', 'anillos', '2017-07-13 19:25:53', NULL, NULL),
(2, 'Zarcillos', 'zarcillos', '2017-07-13 19:25:53', NULL, NULL),
(3, 'Dijes', 'dijes', '2017-07-13 19:25:53', NULL, NULL),
(4, 'Pulseras', 'pulseras', '2017-07-13 19:25:53', NULL, NULL),
(5, 'Tobilleras', 'tobilleras', '2017-07-13 19:25:53', NULL, NULL),
(6, 'Gargantillas', 'gargantillas', '2017-07-13 19:25:53', NULL, NULL),
(7, 'Rosarios', 'rosarios', '2017-07-13 19:25:53', NULL, NULL),
(8, 'Cadenas', 'cadenas', '2017-07-13 19:25:53', NULL, NULL),
(9, 'Juegos', 'juegos', '2017-07-13 19:25:53', NULL, NULL),
(10, 'Semielaborado', 'semielaborado', '2017-07-13 19:25:53', NULL, NULL),
(11, 'Otras Joyas', 'otras_joyas', '2017-07-13 19:25:53', NULL, NULL),
(12, 'Complementarios', 'complementarios', '2017-07-13 19:25:53', '2017-09-12 18:13:01', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cities`
--

CREATE TABLE `cities` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `country_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `cities`
--

INSERT INTO `cities` (`id`, `name`, `country_id`, `created_at`, `updated_at`) VALUES
(1, 'Buenos Aires', 1, NULL, NULL),
(2, 'Catamarca', 1, NULL, NULL),
(3, 'Chaco', 1, NULL, NULL),
(4, 'Chubut', 1, NULL, NULL),
(5, 'Córdoba', 1, NULL, NULL),
(6, 'Corrientes', 1, NULL, NULL),
(7, 'Entre Ríos', 1, NULL, NULL),
(8, 'Formosa', 1, NULL, NULL),
(9, 'Jujuy', 1, NULL, NULL),
(10, 'La Pampa', 1, NULL, NULL),
(11, 'La Rioja', 1, NULL, NULL),
(12, 'Mendoza', 1, NULL, NULL),
(13, 'Misiones', 1, NULL, NULL),
(14, 'Neuquén', 1, NULL, NULL),
(15, 'Río Negro', 1, NULL, NULL),
(16, 'Salta', 1, NULL, NULL),
(17, 'San Juan', 1, NULL, NULL),
(18, 'San Luis', 1, NULL, NULL),
(19, 'Santa Cruz', 1, NULL, NULL),
(20, 'Santa Fe', 1, NULL, NULL),
(21, 'Santiago del Estero', 1, NULL, NULL),
(22, 'Tierra del Fuego, Antártida e Isla del Atlántico Sur', 1, NULL, NULL),
(23, 'Tucumán', 1, NULL, NULL),
(24, 'Beni', 2, NULL, NULL),
(25, 'Chuquisaca', 2, NULL, NULL),
(26, 'Cochabamba', 2, NULL, NULL),
(27, 'La Paz', 2, NULL, NULL),
(28, 'Oruro', 2, NULL, NULL),
(29, 'Pando', 2, NULL, NULL),
(30, 'Potosí', 2, NULL, NULL),
(31, 'Santa Cruz', 2, NULL, NULL),
(32, 'Tarija', 2, NULL, NULL),
(33, 'Acre', 3, NULL, NULL),
(34, 'Alagoas', 3, NULL, NULL),
(35, 'Amapá', 3, NULL, NULL),
(36, 'Amazonas', 3, NULL, NULL),
(37, 'Bahia', 3, NULL, NULL),
(38, 'Brasilia', 3, NULL, NULL),
(39, 'Ceará', 3, NULL, NULL),
(40, 'Espírito Santo', 3, NULL, NULL),
(41, 'Goiás', 3, NULL, NULL),
(42, 'Maranhão', 3, NULL, NULL),
(43, 'Mato Grosso', 3, NULL, NULL),
(44, 'Mato Grosso do Sul', 3, NULL, NULL),
(45, 'Minas Gerais', 3, NULL, NULL),
(46, 'Pará', 3, NULL, NULL),
(47, 'Paraíba', 3, NULL, NULL),
(48, 'Paraná', 3, NULL, NULL),
(49, 'Pernambuco', 3, NULL, NULL),
(50, 'Piauí', 3, NULL, NULL),
(51, 'Rio de Janeiro', 3, NULL, NULL),
(52, 'Rio Grande do Norte', 3, NULL, NULL),
(53, 'Rio Grande do Sul', 3, NULL, NULL),
(54, 'Rondônia', 3, NULL, NULL),
(55, 'Roraima', 3, NULL, NULL),
(56, 'Santa Catarina', 3, NULL, NULL),
(57, 'São Paulo', 3, NULL, NULL),
(58, 'Sergipe', 3, NULL, NULL),
(59, 'Tocantins', 3, NULL, NULL),
(60, 'Newfoundland and Labrador', 4, NULL, NULL),
(61, 'Nova Scotia', 4, NULL, NULL),
(62, 'Prince Edward Island', 4, NULL, NULL),
(63, 'New Brunswick', 4, NULL, NULL),
(64, 'Quebec', 4, NULL, NULL),
(65, 'Ontario', 4, NULL, NULL),
(66, 'Manitoba', 4, NULL, NULL),
(67, 'Saskatchewan', 4, NULL, NULL),
(68, 'Alberta', 4, NULL, NULL),
(69, 'British Columbia', 4, NULL, NULL),
(70, 'Nunavut', 4, NULL, NULL),
(71, 'Northwestern Territories', 4, NULL, NULL),
(72, 'Yukon', 4, NULL, NULL),
(73, 'Arica Parinacota', 5, NULL, NULL),
(74, 'Región de Tarapacá', 5, NULL, NULL),
(75, 'Región de Antofagasta', 5, NULL, NULL),
(76, 'Región de Atacama', 5, NULL, NULL),
(77, 'Región de Coquimbo', 5, NULL, NULL),
(78, 'Región de Valparaíso', 5, NULL, NULL),
(79, 'Región Metropolitana de Santiago', 5, NULL, NULL),
(80, 'Región del Libertador General Bernardo OHiggins', 5, NULL, NULL),
(81, 'Región del Maule', 5, NULL, NULL),
(82, 'Región del Bío bío', 5, NULL, NULL),
(83, 'Región de la Araucanía', 5, NULL, NULL),
(84, 'Región de Los Ríos', 5, NULL, NULL),
(85, 'Región de Los Lagos', 5, NULL, NULL),
(86, 'Región de Aysén del general Carlos Ibáñez del Campo', 5, NULL, NULL),
(87, 'Región de Magallanes y la Antártica Chilena', 5, NULL, NULL),
(88, 'Amazonas', 6, NULL, NULL),
(89, 'Antioquia', 6, NULL, NULL),
(90, 'Arauca', 6, NULL, NULL),
(91, 'Atlántico', 6, NULL, NULL),
(92, 'Bolívar', 6, NULL, NULL),
(93, 'Boyacá', 6, NULL, NULL),
(94, 'Caldas', 6, NULL, NULL),
(95, 'Caquetá', 6, NULL, NULL),
(96, 'Casanare', 6, NULL, NULL),
(97, 'Cauca', 6, NULL, NULL),
(98, 'Cesar', 6, NULL, NULL),
(99, 'Chocó', 6, NULL, NULL),
(100, 'Córdoba', 6, NULL, NULL),
(101, 'Cundinamarca', 6, NULL, NULL),
(102, 'Guainía', 6, NULL, NULL),
(103, 'Guaviare', 6, NULL, NULL),
(104, 'Huila', 6, NULL, NULL),
(105, 'La Guajira', 6, NULL, NULL),
(106, 'Magdalena', 6, NULL, NULL),
(107, 'Meta', 6, NULL, NULL),
(108, 'Nariño', 6, NULL, NULL),
(109, 'Norte de Santander', 6, NULL, NULL),
(110, 'Putumayo', 6, NULL, NULL),
(111, 'Quindio', 6, NULL, NULL),
(112, 'Risaralda', 6, NULL, NULL),
(113, 'San Andres y Providencia', 6, NULL, NULL),
(114, 'Santander', 6, NULL, NULL),
(115, 'Sucre', 6, NULL, NULL),
(116, 'Tolima', 6, NULL, NULL),
(117, 'Valle del Cauca', 6, NULL, NULL),
(118, 'Vaupés', 6, NULL, NULL),
(119, 'Vichada', 6, NULL, NULL),
(120, 'San José', 7, NULL, NULL),
(121, 'Alajuela', 7, NULL, NULL),
(122, 'Cartago', 7, NULL, NULL),
(123, 'Heredia', 7, NULL, NULL),
(124, 'Guanacaste', 7, NULL, NULL),
(125, 'Puntarenas', 7, NULL, NULL),
(126, 'Limón', 7, NULL, NULL),
(127, 'Willemstad', 8, NULL, NULL),
(128, 'Quito', 9, NULL, NULL),
(129, 'Machachi', 9, NULL, NULL),
(130, 'Latacunga', 9, NULL, NULL),
(131, 'Quijos', 9, NULL, NULL),
(132, 'Esmeraldas', 9, NULL, NULL),
(133, 'Ibarra', 9, NULL, NULL),
(134, 'Otavalo ', 9, NULL, NULL),
(135, 'Cotacachi', 9, NULL, NULL),
(136, 'Cayambe', 9, NULL, NULL),
(137, 'Riobamba', 9, NULL, NULL),
(138, 'Ambato', 9, NULL, NULL),
(139, 'Guano', 9, NULL, NULL),
(140, 'Guaranda', 9, NULL, NULL),
(141, 'Alausí', 9, NULL, NULL),
(142, 'Macas', 9, NULL, NULL),
(143, 'Ahuachapán', 10, NULL, NULL),
(144, 'Santa Ana', 10, NULL, NULL),
(145, 'Sonsonate', 10, NULL, NULL),
(146, 'Usulután', 10, NULL, NULL),
(147, 'San Miguel', 10, NULL, NULL),
(148, 'Morazán', 10, NULL, NULL),
(149, 'La Unión ', 10, NULL, NULL),
(150, 'La Libertad', 10, NULL, NULL),
(151, 'Chalatenango', 10, NULL, NULL),
(152, 'Cuscatlán', 10, NULL, NULL),
(153, 'San Salvador', 10, NULL, NULL),
(154, 'La Paz', 10, NULL, NULL),
(155, 'Cabañas', 10, NULL, NULL),
(156, 'San Vicente', 10, NULL, NULL),
(157, 'Alabama', 11, NULL, NULL),
(158, 'Alaska', 11, NULL, NULL),
(159, 'Arkansas', 11, NULL, NULL),
(160, 'Arizona', 11, NULL, NULL),
(161, 'California', 11, NULL, NULL),
(162, 'Colorado', 11, NULL, NULL),
(163, 'Connecticut', 11, NULL, NULL),
(164, 'Dakota del Sur', 11, NULL, NULL),
(165, 'Delaware', 11, NULL, NULL),
(166, 'Florida', 11, NULL, NULL),
(167, 'Georgia', 11, NULL, NULL),
(168, 'Hawaii', 11, NULL, NULL),
(169, 'Idaho', 11, NULL, NULL),
(170, 'Illinois', 11, NULL, NULL),
(171, 'Indiana', 11, NULL, NULL),
(172, 'Iowa', 11, NULL, NULL),
(173, 'Kansas', 11, NULL, NULL),
(174, 'Kentucky', 11, NULL, NULL),
(175, 'Louisiana', 11, NULL, NULL),
(176, 'Maine', 11, NULL, NULL),
(177, 'Maryland', 11, NULL, NULL),
(178, 'Massachussetts', 11, NULL, NULL),
(179, 'Michigan', 11, NULL, NULL),
(180, 'Minnesota', 11, NULL, NULL),
(181, 'Mississippi', 11, NULL, NULL),
(182, 'Missouri', 11, NULL, NULL),
(183, 'Montana', 11, NULL, NULL),
(184, 'Nebraska', 11, NULL, NULL),
(185, 'Nevada', 11, NULL, NULL),
(186, 'New Hampshire', 11, NULL, NULL),
(187, 'New Jersey', 11, NULL, NULL),
(188, 'New Mexico', 11, NULL, NULL),
(189, 'New York', 11, NULL, NULL),
(190, 'North Carolina', 11, NULL, NULL),
(191, 'North Dakota', 11, NULL, NULL),
(192, 'Ohio', 11, NULL, NULL),
(193, 'Oklahoma', 11, NULL, NULL),
(194, 'Oregon', 11, NULL, NULL),
(195, 'Pennsylvania', 11, NULL, NULL),
(196, 'Rhode Island', 11, NULL, NULL),
(197, 'South Carolina', 11, NULL, NULL),
(198, 'Tennessee', 11, NULL, NULL),
(199, 'Texas', 11, NULL, NULL),
(200, 'Utah', 11, NULL, NULL),
(201, 'Virginia', 11, NULL, NULL),
(202, 'Vermont', 11, NULL, NULL),
(203, 'Washington', 11, NULL, NULL),
(204, 'West Virginia', 11, NULL, NULL),
(205, 'Wisconsin', 11, NULL, NULL),
(206, 'Wyoming', 11, NULL, NULL),
(207, 'Alta Verapaz', 12, NULL, NULL),
(208, 'Baja Verapaz', 12, NULL, NULL),
(209, 'Chimaltenango', 12, NULL, NULL),
(210, 'Chiquimula', 12, NULL, NULL),
(211, 'Petén', 12, NULL, NULL),
(212, 'El Progreso', 12, NULL, NULL),
(213, 'Quiché', 12, NULL, NULL),
(214, 'Escuintla', 12, NULL, NULL),
(215, 'Guatemala', 12, NULL, NULL),
(216, 'Huehuetenango', 12, NULL, NULL),
(217, 'Izabal', 12, NULL, NULL),
(218, 'Jalapa', 12, NULL, NULL),
(219, 'Jutiapa', 12, NULL, NULL),
(220, 'Quetzaltenango', 12, NULL, NULL),
(221, 'Retalhuleu', 12, NULL, NULL),
(222, 'Sacatepéquez', 12, NULL, NULL),
(223, 'San Marcos', 12, NULL, NULL),
(224, 'Santa Rosa', 12, NULL, NULL),
(225, 'Sololá', 12, NULL, NULL),
(226, 'Suchitepéquez', 12, NULL, NULL),
(227, 'Totonicapán', 12, NULL, NULL),
(228, 'Zacapa', 12, NULL, NULL),
(229, 'Artibonito', 13, NULL, NULL),
(230, 'Centro', 13, NULL, NULL),
(231, 'Grand\'Anse', 13, NULL, NULL),
(232, 'Nippes', 13, NULL, NULL),
(233, 'Norte', 13, NULL, NULL),
(234, 'Noreste', 13, NULL, NULL),
(235, 'Noroeste', 13, NULL, NULL),
(236, 'Oeste', 13, NULL, NULL),
(237, 'Sudeste', 13, NULL, NULL),
(238, 'Sur', 13, NULL, NULL),
(239, 'Artibonito', 14, NULL, NULL),
(240, 'Centro', 14, NULL, NULL),
(241, 'Grand\'Anse', 14, NULL, NULL),
(242, 'Nippes', 14, NULL, NULL),
(243, 'Norte', 14, NULL, NULL),
(244, 'Noreste', 14, NULL, NULL),
(245, 'Noroeste', 14, NULL, NULL),
(246, 'Oeste', 14, NULL, NULL),
(247, 'Sudeste', 14, NULL, NULL),
(248, 'Sur', 14, NULL, NULL),
(249, 'Condado de Cornwall', 15, NULL, NULL),
(250, 'Condado de Middlesex', 15, NULL, NULL),
(251, 'Condado de Surrey', 15, NULL, NULL),
(252, 'Aguascalientes', 16, NULL, NULL),
(253, 'Baja California', 16, NULL, NULL),
(254, 'Baja California Sur', 16, NULL, NULL),
(255, 'Campeche', 16, NULL, NULL),
(256, 'Coahuila', 16, NULL, NULL),
(257, 'Colima', 16, NULL, NULL),
(258, 'Chiapas', 16, NULL, NULL),
(259, 'Chihuahua', 16, NULL, NULL),
(260, 'Distrito Federal', 16, NULL, NULL),
(261, 'Durango', 16, NULL, NULL),
(262, 'Guanajuato', 16, NULL, NULL),
(263, 'Guerrero', 16, NULL, NULL),
(264, 'Hidalgo', 16, NULL, NULL),
(265, 'Jalisco', 16, NULL, NULL),
(266, 'México', 16, NULL, NULL),
(267, 'Michoacán', 16, NULL, NULL),
(268, 'Morelos', 16, NULL, NULL),
(269, 'Nayarit', 16, NULL, NULL),
(270, 'Nuevo León', 16, NULL, NULL),
(271, 'Oaxaca', 16, NULL, NULL),
(272, 'Puebla', 16, NULL, NULL),
(273, 'Querétaro', 16, NULL, NULL),
(274, 'Quintana Roo', 16, NULL, NULL),
(275, 'San Luis Potosí', 16, NULL, NULL),
(276, 'Sinaloa', 16, NULL, NULL),
(277, 'Sonora', 16, NULL, NULL),
(278, 'Tabasco', 16, NULL, NULL),
(279, 'Tamaulipas', 16, NULL, NULL),
(280, 'Tlaxcala', 16, NULL, NULL),
(281, 'Veracruz', 16, NULL, NULL),
(282, 'Yucatán', 16, NULL, NULL),
(283, 'Zacatecas', 16, NULL, NULL),
(284, 'Boaco', 17, NULL, NULL),
(285, 'Carazo', 17, NULL, NULL),
(286, 'Chinandega', 17, NULL, NULL),
(287, 'Chontales', 17, NULL, NULL),
(288, 'Estelí', 17, NULL, NULL),
(289, 'Granada', 17, NULL, NULL),
(290, 'Jinotega', 17, NULL, NULL),
(291, 'León', 17, NULL, NULL),
(292, 'Madriz', 17, NULL, NULL),
(293, 'Managua', 17, NULL, NULL),
(294, 'Masaya', 17, NULL, NULL),
(295, 'Matagalpa', 17, NULL, NULL),
(296, 'Nueva Segovia', 17, NULL, NULL),
(297, 'Rivas', 17, NULL, NULL),
(298, 'Río San Juan', 17, NULL, NULL),
(299, 'Región Autónoma de la Costa Caribe Norte', 17, NULL, NULL),
(300, 'Región Autónoma de la Costa Caribe Sur', 17, NULL, NULL),
(301, 'Arraiján (corregimiento)', 18, NULL, NULL),
(302, 'Alcaldediaz', 18, NULL, NULL),
(303, 'Aguadulce (Sevilla)', 18, NULL, NULL),
(304, 'Colon', 18, NULL, NULL),
(305, 'Chitre', 18, NULL, NULL),
(306, 'Chilibre', 18, NULL, NULL),
(307, 'Chepo', 18, NULL, NULL),
(308, 'Changuinola (ciudad)', 18, NULL, NULL),
(309, 'Cativá', 18, NULL, NULL),
(310, 'David', 18, NULL, NULL),
(311, 'Las Cumbres (Panamá)', 18, NULL, NULL),
(312, 'La Concepción', 18, NULL, NULL),
(313, 'La Chorrera (Amazonas)', 18, NULL, NULL),
(314, 'La Cabima', 18, NULL, NULL),
(315, 'Nuevo Arraiján', 18, NULL, NULL),
(316, 'Puerto Armuelles', 18, NULL, NULL),
(317, 'Pedregal (Chiriquí)', 18, NULL, NULL),
(318, 'Panamá', 18, NULL, NULL),
(319, 'Pacora', 18, NULL, NULL),
(320, 'Santiago de Veraguas', 18, NULL, NULL),
(321, 'San Miguelito', 18, NULL, NULL),
(322, 'Tocumen', 18, NULL, NULL),
(323, 'Vista Alegre', 18, NULL, NULL),
(324, 'Veracruz de Ignacio de la Llave', 18, NULL, NULL),
(325, 'Asunción', 19, NULL, NULL),
(326, 'Concepción', 19, NULL, NULL),
(327, 'San Pedro', 19, NULL, NULL),
(328, 'Cordillera', 19, NULL, NULL),
(329, 'Guairá', 19, NULL, NULL),
(330, 'Caaguazú', 19, NULL, NULL),
(331, 'Caazapá', 19, NULL, NULL),
(332, 'Itapúa', 19, NULL, NULL),
(333, 'Misiones', 19, NULL, NULL),
(334, 'Paraguarí', 19, NULL, NULL),
(335, 'Alto Paraná', 19, NULL, NULL),
(336, 'Central', 19, NULL, NULL),
(337, 'Ñeembucú', 19, NULL, NULL),
(338, 'Amambay', 19, NULL, NULL),
(339, 'Canindeyú', 19, NULL, NULL),
(340, 'Presidente Hayes', 19, NULL, NULL),
(341, 'Boquerón', 19, NULL, NULL),
(342, 'Alto Paraguay', 19, NULL, NULL),
(343, 'Amazonas', 20, NULL, NULL),
(344, 'Áncash', 20, NULL, NULL),
(345, 'Apurímac', 20, NULL, NULL),
(346, 'Arequipa', 20, NULL, NULL),
(347, 'Ayacucho', 20, NULL, NULL),
(348, 'Cajamarca', 20, NULL, NULL),
(349, 'Callao', 20, NULL, NULL),
(350, 'Cuzco', 20, NULL, NULL),
(351, 'Huancavelica', 20, NULL, NULL),
(352, 'Huánuco', 20, NULL, NULL),
(353, 'Ica', 20, NULL, NULL),
(354, 'Junín', 20, NULL, NULL),
(355, 'La Libertad', 20, NULL, NULL),
(356, 'Lambayeque', 20, NULL, NULL),
(357, 'Lima', 20, NULL, NULL),
(358, 'Loreto', 20, NULL, NULL),
(359, 'Madre de Dios', 20, NULL, NULL),
(360, 'Moquegua', 20, NULL, NULL),
(361, 'Pasco', 20, NULL, NULL),
(362, 'Piura', 20, NULL, NULL),
(363, 'Puno', 20, NULL, NULL),
(364, 'San Martín', 20, NULL, NULL),
(365, 'Tacna', 20, NULL, NULL),
(366, 'Tumbes', 20, NULL, NULL),
(367, 'Ucayali', 20, NULL, NULL),
(368, 'Distrito Nacional', 21, NULL, NULL),
(369, 'Azua', 21, NULL, NULL),
(370, 'Baoruco', 21, NULL, NULL),
(371, 'Barahona', 21, NULL, NULL),
(372, 'Dajabón', 21, NULL, NULL),
(373, 'Duarte', 21, NULL, NULL),
(374, 'Elías Piña', 21, NULL, NULL),
(375, 'El Seibo', 21, NULL, NULL),
(376, 'Espaillat', 21, NULL, NULL),
(377, 'Hato Mayor', 21, NULL, NULL),
(378, 'Independencia', 21, NULL, NULL),
(379, 'La Altagracia', 21, NULL, NULL),
(380, 'La Romana', 21, NULL, NULL),
(381, 'La Vega', 21, NULL, NULL),
(382, 'María Trinidad Sánchez', 21, NULL, NULL),
(383, 'Monseñor Nouel', 21, NULL, NULL),
(384, 'Monte Cristi', 21, NULL, NULL),
(385, 'Monte Plata', 21, NULL, NULL),
(386, 'Pedernales', 21, NULL, NULL),
(387, 'Peravia', 21, NULL, NULL),
(388, 'Puerto Plata', 21, NULL, NULL),
(389, 'Salcedo', 21, NULL, NULL),
(390, 'Samaná', 21, NULL, NULL),
(391, 'Sánchez Ramírez', 21, NULL, NULL),
(392, 'San Cristóbal', 21, NULL, NULL),
(393, 'San José de Ocoa', 21, NULL, NULL),
(394, 'San Juan', 21, NULL, NULL),
(395, 'San Pedro de Macorís', 21, NULL, NULL),
(396, 'Santiago', 21, NULL, NULL),
(397, 'Santiago Rodríguez', 21, NULL, NULL),
(398, 'Santo Domingo', 21, NULL, NULL),
(399, 'Valverde', 21, NULL, NULL),
(400, 'Artigas', 22, NULL, NULL),
(401, 'Canelones', 22, NULL, NULL),
(402, 'Cerro Largo', 22, NULL, NULL),
(403, 'Colonia', 22, NULL, NULL),
(404, 'Durazno', 22, NULL, NULL),
(405, 'Flores', 22, NULL, NULL),
(406, 'Florida', 22, NULL, NULL),
(407, 'Lavalleja', 22, NULL, NULL),
(408, 'Maldonado', 22, NULL, NULL),
(409, 'Montevideo', 22, NULL, NULL),
(410, 'Paysandú', 22, NULL, NULL),
(411, 'Río Negro', 22, NULL, NULL),
(412, 'Rivera', 22, NULL, NULL),
(413, 'Rocha', 22, NULL, NULL),
(414, 'Salto', 22, NULL, NULL),
(415, 'San José', 22, NULL, NULL),
(416, 'Soriano', 22, NULL, NULL),
(417, 'Tacuarembó', 22, NULL, NULL),
(418, 'Treinta y Tres', 22, NULL, NULL),
(419, 'Amazonas', 23, NULL, NULL),
(420, 'Anzoátegui', 23, NULL, NULL),
(421, 'Apure', 23, NULL, NULL),
(422, 'Aragua', 23, NULL, NULL),
(423, 'Barinas', 23, NULL, NULL),
(424, 'Bolívar', 23, NULL, NULL),
(425, 'Carabobo', 23, NULL, NULL),
(426, 'Cojedes', 23, NULL, NULL),
(427, 'Delta Amacuro', 23, NULL, NULL),
(428, 'Distrito Capital', 23, NULL, NULL),
(429, 'Falcón', 23, NULL, NULL),
(430, 'Guárico', 23, NULL, NULL),
(431, 'Lara', 23, NULL, NULL),
(432, 'Mérida', 23, NULL, NULL),
(433, 'Miranda', 23, NULL, NULL),
(434, 'Monagas', 23, NULL, NULL),
(435, 'Nueva Esparta', 23, NULL, NULL),
(436, 'Portuguesa', 23, NULL, NULL),
(437, 'Sucre', 23, NULL, NULL),
(438, 'Táchira', 23, NULL, NULL),
(439, 'Trujillo', 23, NULL, NULL),
(440, 'Vargas', 23, NULL, NULL),
(441, 'Yaracuy', 23, NULL, NULL),
(442, 'Zulia', 23, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `colors`
--

CREATE TABLE `colors` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `color_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `colors`
--

INSERT INTO `colors` (`id`, `name`, `color_code`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Sin Color', NULL, '2017-07-13 19:25:53', NULL, NULL),
(2, 'Azul', NULL, '2017-07-13 19:25:53', NULL, NULL),
(3, 'Amarillo', NULL, '2017-07-13 19:25:53', '2017-09-19 14:25:34', NULL),
(4, 'Blanco', NULL, '2017-07-13 19:25:53', NULL, NULL),
(5, 'Rojo', NULL, '2017-07-13 19:25:53', NULL, NULL),
(6, 'Verde', NULL, '2017-09-19 14:25:41', '2017-09-19 15:54:28', NULL),
(7, 'turquesa', NULL, '2017-09-25 21:37:27', NULL, NULL),
(8, 'Negro ', NULL, '2017-10-27 13:27:48', NULL, NULL),
(9, 'Rojo ', NULL, '2017-10-27 13:27:54', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `countries`
--

CREATE TABLE `countries` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone_code` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `manufacture` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `countries`
--

INSERT INTO `countries` (`id`, `code`, `name`, `phone_code`, `created_at`, `updated_at`, `manufacture`) VALUES
(1, 'AR', 'Argentina', '54', NULL, NULL, 1),
(2, 'BO', 'Bolivia', '591', NULL, '2017-09-19 14:09:24', 1),
(3, 'BR', 'Brasil', '55', NULL, NULL, 0),
(4, 'CA', 'Canadá', '1', NULL, '2017-09-18 19:25:11', 0),
(5, 'CL', 'Chile', '56', NULL, NULL, 0),
(6, 'CO', 'Colombia', '57', NULL, '2017-10-13 17:11:34', 1),
(7, 'CR', 'Costa Rica', '506', NULL, NULL, 0),
(8, 'CW', 'Curaçao', '599', NULL, NULL, 0),
(9, 'EC', 'Ecuador', '593', NULL, '2017-09-19 14:00:48', 0),
(10, 'SV', 'El Salvador', '503', NULL, '2017-09-19 14:00:49', 1),
(11, 'US', 'Estados Unidos', '1', NULL, '2017-09-19 14:00:49', 1),
(12, 'GT', 'Guatemala', '502', NULL, '2017-09-19 14:00:50', 1),
(13, 'HT', 'Haití', '509', NULL, '2017-09-19 14:00:51', 1),
(14, 'HN', 'Honduras', '504', NULL, '2017-09-19 14:00:51', 1),
(15, 'JM', 'Jamaica', '1', NULL, '2017-09-19 14:00:53', 1),
(16, 'MX', 'México', '52', NULL, NULL, 0),
(17, 'NI', 'Nicaragua', '505', NULL, NULL, 0),
(18, 'PA', 'Panamá', '507', NULL, '2017-09-19 14:01:03', 1),
(19, 'PY', 'Paraguay', '595', NULL, NULL, 0),
(20, 'PE', 'Perú', '51', NULL, '2017-09-19 14:09:29', 1),
(21, 'DO', 'República Dominicana', '1', NULL, '2017-09-19 14:09:27', 1),
(22, 'UY', 'Uruguay', '598', NULL, NULL, 0),
(23, 'VE', 'Venezuela', '58', NULL, NULL, 0),
(24, 'CN', 'China', '86', NULL, NULL, 1),
(25, 'IT', 'Italia', '39', NULL, NULL, 1),
(26, 'PT', 'Portugal', '351', NULL, NULL, 1),
(27, 'TH', 'Tailandia', '66', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `images`
--

CREATE TABLE `images` (
  `id` int(10) UNSIGNED NOT NULL,
  `path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image_path_300x300` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `thumb_path_50x50` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `product_detail_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `images`
--

INSERT INTO `images` (`id`, `path`, `image_path_300x300`, `thumb_path_50x50`, `product_detail_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(28, 'catalog/strikehuge42bcb8cfdd8214b4aea92b63c0e570f7.jpg', '', '', 1, '2017-09-08 20:10:37', NULL, NULL),
(45, 'catalog/DSC03891367ddc1bfe2ea6f6318e75b468bcb14c.JPG', '', '', 33, '2017-09-26 18:14:40', NULL, NULL),
(46, 'catalog/DSC00214cbe75d2bcf0674c6a3f65873cd392bcb.JPG', '', '', 34, '2017-09-26 18:21:25', NULL, NULL),
(47, 'catalog/DSC00214a2cafd20cc94920a7e397270aa2d10fb.JPG', '', '', 35, '2017-09-26 18:34:30', NULL, NULL),
(48, 'catalog/DSC002146b7609df997a9ad8bf9b2fdf810dc0c9.JPG', '', '', 36, '2017-09-26 18:36:38', NULL, NULL),
(49, 'catalog/DSC09840e92ceef0be23bd0ed2dd7b3e8a27ea74.JPG', '', '', 37, '2017-09-26 18:49:01', NULL, NULL),
(50, 'catalog/DSC002149181470510628eb448d5bd27605c85cb.JPG', '', '', 38, '2017-09-26 18:53:00', NULL, NULL),
(51, 'catalog/DSC002148f8eeeb2d340ab56ad43a56760e6e290.JPG', '', '', 39, '2017-09-26 18:57:32', NULL, NULL),
(52, 'catalog/DSC04790c4b969da1b02c322cd89fe8835a7ec38.JPG', '', '', 40, '2017-10-05 21:44:15', NULL, NULL),
(53, 'catalog/DSC04790c4b969da1b02c322cd89fe8835a7ec38.JPG', '', '', 40, '2017-10-05 21:44:19', NULL, NULL),
(54, 'catalog/DSC048586c0bdb6de3bca6b7924f023923501e98.JPG', '', '', 41, '2017-10-06 15:49:51', NULL, NULL),
(55, 'catalog/DSC049136b9bfa55a3a92fe297fb17b803a10f22.JPG', '', '', 42, '2017-10-06 15:55:00', NULL, NULL),
(56, 'catalog/DSC049107ace46a759c71dab441a5df6630e3349.JPG', '', '', 42, '2017-10-06 15:55:00', NULL, NULL),
(57, 'catalog/DSC048597f0fe108c189a9775691c217a8931710.JPG', '', '', 43, '2017-10-06 15:57:00', NULL, NULL),
(58, 'catalog/DSC032779446e05188b47f40924624cf9db4e13c.JPG', '', '', 44, '2017-10-06 16:02:07', NULL, NULL),
(59, 'catalog/DSC04328884de0403d4b9306198e8d23b7e88177.JPG', '', '', 45, '2017-10-06 16:04:36', NULL, NULL),
(60, 'catalog/DSC04790e0f1467c26183b33885b6add86c94e2b.JPG', '', '', 52, '2017-10-23 13:15:47', NULL, NULL),
(63, 'catalog/DSC04803f687c72553848a3e966c46f4d8a2f544.JPG', '', '', 54, '2017-10-23 13:34:29', NULL, NULL),
(64, 'catalog/DSC0480622fdf3e0510e5bc0e9c4513f73fbe682.JPG', '', '', 55, '2017-10-23 13:55:08', NULL, NULL),
(67, 'catalog/DSC051497b8592a89243db25e2686d3789f0726e.JPG', '', '', 58, '2017-10-23 14:15:00', NULL, NULL),
(68, 'catalog/DSC051484b1e8e0887c93956b79aad15e2609bc2.JPG', '', '', 59, '2017-10-23 14:15:54', NULL, NULL),
(70, 'catalog/ae2a3dd0273250727252b3ece287de127bd.jpg', '', '', 60, '2017-10-25 18:55:16', NULL, NULL),
(71, 'catalog/ae36352061c4fddc39d1f75b9442be1ab92.jpg', '', '', 60, '2017-10-25 18:55:16', NULL, NULL),
(72, 'catalog/ar1ba9f70637d3595753101c858be47e64b.jpg', '', '', 61, '2017-10-25 18:56:05', NULL, NULL),
(73, 'catalog/ar2956a550ff8d6051923c760a17993bad0.jpg', '', '', 61, '2017-10-25 18:56:05', NULL, NULL),
(74, 'catalog/ar363fbf1b251ee4759d5f61ce2e1eb43ef.jpg', '', '', 61, '2017-10-25 18:56:05', NULL, NULL),
(75, 'catalog/ar4c1506b96a321c2b2c82bc0fcd0d90c10.jpg', '', '', 61, '2017-10-25 18:56:05', NULL, NULL),
(76, 'catalog/az161de6d89792ee2a6d79db0a7d1557eae.jpg', '', '', 62, '2017-10-25 19:04:19', NULL, NULL),
(77, 'catalog/az2d27f58241e3ed1d82921677dfbdd27db.jpg', '', '', 62, '2017-10-25 19:04:19', NULL, NULL),
(80, 'catalog/az32760754deb975f5235ec45d1d6ff1bcb.jpg', '', '', 62, '2017-10-25 19:06:45', NULL, NULL),
(81, 'catalog/az4f9c7cb5eed7b716604c6d82f85321566.jpg', '', '', 62, '2017-10-25 19:06:45', NULL, NULL),
(82, 'catalog/ae176cf13d7514d9d089eb5b96d9bc7efe5.jpg', '', '', 60, '2017-10-25 19:11:37', NULL, NULL),
(83, 'catalog/am1f5426eabd3a46119cab851e64bc07122.jpg', '', '', 63, '2017-10-25 19:13:30', NULL, NULL),
(84, 'catalog/am2091f214b0b6f8cb2d9abc2b6707a8436.jpg', '', '', 63, '2017-10-25 19:13:30', NULL, NULL),
(85, 'catalog/am31bf9668d95b74e2f9d9a8851aaf3e7bc.jpg', '', '', 64, '2017-10-25 19:14:28', NULL, NULL),
(86, 'catalog/am4116c6324a7964eb6998c138d79668f29.jpg', '', '', 64, '2017-10-25 19:14:28', NULL, NULL),
(91, 'catalog/descarga _1_64cf4c35a8e0538a45a5a742533600ff.jpg', '', '', 65, '2017-10-27 13:32:43', NULL, NULL),
(92, 'catalog/images _2_b65ff820a22bec7b47eb18f33cba5370.jpg', '', '', 65, '2017-10-27 13:32:43', NULL, NULL),
(93, 'catalog/descarga27e4dcbde75d4a53308bf24622d24628.jpg', '', '', 22, '2017-10-27 13:33:14', NULL, NULL),
(94, 'catalog/imagesf23a92594191cfec751c98d2738c25e1.jpg', '', '', 1, '2017-10-27 13:40:44', NULL, NULL),
(95, 'catalog/jpg_640x640785344efb98139e639e371f0f37e1c2e.jpg', '', '', 66, '2017-10-27 13:42:27', NULL, NULL),
(96, 'catalog/anillo_para_hombre_azul_cielo794cfd00df730e19b5d7eb4bb23a8009.jpg', '', '', 67, '2017-10-27 13:45:51', NULL, NULL),
(97, 'catalog/descarga _2_bcf3a027d2d67b067b4ea823dfc470ae.jpg', '', '', 67, '2017-10-27 13:45:51', NULL, NULL),
(98, 'catalog/jpg_220x2207c01fb8acff2c617719ef706c7c81354.jpg', '', '', 67, '2017-10-27 13:45:51', NULL, NULL),
(102, 'catalog/descarga705d521fd0ac982b5ce9749a35193e5f.jpg', '', '', 22, '2017-10-27 13:50:58', NULL, NULL),
(103, 'catalog/descarga69ca8b4099a5306b0bde7ca81ddcd398.jpg', '', '', 22, '2017-10-27 13:52:18', NULL, NULL),
(104, 'catalog/jpg_640x640c817616a39ada59243716b909fc8eaa6.jpg', '', '', 66, '2017-10-27 13:54:10', NULL, NULL),
(105, 'catalog/descarga _1_707157defc78f8ed73595a1d7986c62d.jpg', '', '', 65, '2017-10-27 13:55:11', NULL, NULL),
(106, 'catalog/compromiso_laterales7f848d8ca09bb7bac05e35da2e8477a5.jpg', '', '', 7, '2017-11-23 16:01:26', NULL, NULL),
(108, 'catalog/S_836516_MLM26255162963_102017_O0f024dd98337d077fdbbe1a524bee24a.jpg', '', '', 7, '2017-11-23 16:10:33', NULL, NULL),
(109, 'catalog/4ddf3940c8781cb2e91a52edea56f7372ee3b327c2225a2f1a8b7d3d220aaaae.jpg', '', '', 7, '2017-11-23 16:12:47', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `line_product`
--

CREATE TABLE `line_product` (
  `id` int(10) UNSIGNED NOT NULL,
  `line_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `line_product`
--

INSERT INTO `line_product` (`id`, `line_id`, `product_id`) VALUES
(23, 1, 21),
(24, 2, 21),
(26, 4, 6),
(27, 2, 6),
(36, 1, 22),
(41, 6, 2),
(42, 4, 2),
(65, 4, 24),
(66, 3, 24),
(67, 7, 24),
(68, 4, 25),
(69, 1, 25),
(70, 4, 26),
(71, 1, 26),
(72, 6, 23),
(73, 4, 23),
(74, 1, 23),
(75, 7, 23),
(76, 6, 27),
(77, 4, 27),
(78, 1, 27),
(79, 6, 28),
(80, 4, 28),
(81, 4, 29),
(82, 6, 30),
(83, 4, 30),
(84, 4, 31),
(85, 1, 31),
(86, 4, 32),
(87, 1, 32),
(88, 4, 33),
(89, 4, 34),
(90, 1, 34),
(91, 3, 35),
(92, 7, 35),
(93, 3, 36),
(94, 3, 37),
(95, 3, 38),
(96, 3, 39),
(97, 3, 40),
(98, 3, 41),
(99, 3, 42),
(101, 4, 43),
(102, 4, 44),
(103, 3, 44),
(104, 1, 45),
(105, 6, 46),
(106, 4, 46),
(107, 4, 47),
(108, 6, 48),
(109, 4, 48),
(110, 4, 49),
(111, 6, 50),
(112, 4, 50),
(113, 4, 51),
(114, 6, 52),
(115, 1, 53),
(116, 3, 54),
(117, 4, 55),
(118, 4, 56),
(119, 1, 56),
(139, 4, 57),
(140, 1, 57),
(141, 3, 57),
(190, 4, 58),
(191, 6, 59),
(192, 4, 59),
(193, 1, 60),
(194, 4, 61),
(195, 4, 62),
(196, 4, 63),
(197, 4, 64),
(198, 1, 65),
(199, 6, 66),
(200, 4, 66),
(201, 7, 66),
(202, 4, 67),
(203, 1, 67),
(204, 4, 68),
(205, 6, 69),
(206, 4, 69),
(207, 4, 70),
(208, 6, 71),
(209, 4, 71),
(210, 6, 72),
(211, 4, 72),
(212, 4, 73),
(213, 4, 74),
(214, 4, 75),
(215, 6, 76),
(216, 4, 77),
(217, 4, 78),
(218, 4, 79),
(219, 4, 80),
(221, 3, 82),
(222, 3, 83),
(223, 3, 84),
(224, 6, 85),
(225, 4, 85),
(226, 1, 85),
(227, 6, 86),
(228, 4, 86),
(229, 1, 86),
(230, 6, 87),
(231, 4, 87),
(232, 1, 87),
(233, 6, 88),
(234, 4, 88),
(235, 1, 88),
(236, 6, 89),
(237, 4, 89),
(238, 1, 89),
(239, 6, 90),
(240, 4, 90),
(241, 1, 90),
(242, 6, 91),
(243, 4, 91),
(244, 1, 91),
(245, 6, 92),
(246, 4, 92),
(247, 1, 92),
(248, 6, 93),
(249, 4, 93),
(250, 1, 93),
(251, 6, 94),
(252, 4, 94),
(253, 1, 94),
(254, 6, 95),
(255, 4, 95),
(256, 7, 95),
(257, 6, 96),
(258, 4, 96),
(259, 7, 96),
(260, 6, 97),
(261, 4, 97),
(262, 7, 97),
(265, 4, 99),
(266, 3, 99),
(267, 4, 98),
(268, 3, 98),
(272, 6, 101),
(273, 4, 101),
(274, 7, 101),
(275, 6, 102),
(276, 4, 102),
(277, 7, 102),
(278, 6, 103),
(279, 4, 103),
(280, 7, 103),
(281, 6, 100),
(282, 4, 100),
(283, 7, 100),
(284, 6, 104),
(285, 4, 104),
(286, 7, 104),
(287, 6, 105),
(288, 4, 105),
(289, 7, 105),
(290, 6, 106),
(291, 4, 106),
(292, 7, 106),
(293, 6, 107),
(294, 4, 107),
(295, 7, 107),
(296, 6, 108),
(297, 4, 108),
(298, 7, 108),
(299, 6, 109),
(300, 4, 109),
(301, 7, 109),
(302, 6, 110),
(303, 4, 110),
(304, 7, 110),
(305, 6, 111),
(306, 4, 111),
(307, 7, 111),
(308, 6, 112),
(309, 4, 112),
(310, 7, 112),
(311, 6, 113),
(312, 4, 113),
(313, 7, 113),
(314, 6, 114),
(315, 4, 114),
(316, 6, 115),
(317, 7, 114),
(318, 4, 115),
(319, 7, 115),
(320, 6, 116),
(321, 4, 116),
(322, 7, 116),
(323, 6, 117),
(324, 4, 117),
(325, 7, 117),
(326, 6, 118),
(327, 4, 118),
(328, 7, 118),
(329, 6, 119),
(330, 4, 119),
(331, 7, 119),
(332, 6, 120),
(333, 4, 120),
(334, 7, 120),
(335, 6, 121),
(336, 4, 121),
(337, 7, 121),
(338, 6, 122),
(339, 4, 122),
(340, 7, 122),
(341, 6, 123),
(342, 4, 123),
(343, 7, 123),
(344, 6, 124),
(345, 4, 124),
(346, 7, 124),
(347, 6, 125),
(348, 4, 125),
(349, 7, 125),
(350, 6, 126),
(351, 4, 126),
(352, 7, 126),
(353, 6, 127),
(354, 4, 127),
(355, 7, 127),
(356, 6, 128),
(357, 4, 128),
(358, 7, 128),
(359, 6, 129),
(360, 4, 129),
(361, 7, 129),
(362, 4, 130),
(363, 4, 131),
(370, 6, 132),
(371, 4, 132),
(372, 1, 132),
(373, 6, 133),
(374, 4, 133),
(375, 1, 133),
(376, 7, 133),
(387, 6, 134),
(388, 4, 134),
(389, 1, 134),
(390, 7, 134),
(391, 2, 134),
(395, 6, 135),
(396, 4, 135),
(397, 7, 135),
(402, 6, 136),
(403, 4, 136),
(404, 7, 136),
(555, 6, 137),
(556, 4, 137),
(557, 7, 137),
(558, 6, 138),
(559, 4, 138),
(560, 7, 138),
(561, 7, 81),
(562, 6, 1),
(563, 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `makings`
--

CREATE TABLE `makings` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `makings`
--

INSERT INTO `makings` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Electroformatura', '2017-07-13 19:25:53', NULL, NULL),
(2, 'Liso', '2017-07-13 19:25:53', NULL, NULL),
(3, 'Esmaltados', '2017-07-13 19:25:53', NULL, NULL),
(4, 'Circones', '2017-07-13 19:25:53', NULL, NULL),
(5, 'Perlas', '2017-07-13 19:25:53', NULL, NULL),
(6, 'Piedras', '2017-07-13 19:25:53', NULL, NULL),
(8, 'Corrugados', '2017-09-18 21:13:15', '2017-09-26 18:08:42', NULL),
(9, 'Marquesita  ', '2017-09-25 21:39:31', '2017-09-25 21:39:44', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `making_product`
--

CREATE TABLE `making_product` (
  `id` int(10) UNSIGNED NOT NULL,
  `making_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `making_product`
--

INSERT INTO `making_product` (`id`, `making_id`, `product_id`) VALUES
(29, 3, 21),
(31, 4, 6),
(32, 3, 6),
(33, 6, 6),
(42, 2, 22),
(47, 1, 2),
(48, 2, 2),
(56, 2, 24),
(57, 6, 25),
(58, 4, 26),
(59, 2, 26),
(60, 4, 23),
(61, 4, 27),
(62, 2, 27),
(63, 4, 28),
(64, 2, 28),
(65, 3, 29),
(66, 1, 30),
(67, 4, 31),
(68, 4, 32),
(69, 4, 34),
(70, 2, 35),
(71, 1, 36),
(72, 2, 37),
(73, 2, 38),
(74, 2, 39),
(75, 2, 40),
(76, 2, 41),
(77, 2, 42),
(79, 4, 43),
(80, 2, 44),
(81, 3, 45),
(82, 4, 46),
(83, 4, 47),
(84, 4, 48),
(85, 2, 49),
(86, 4, 50),
(87, 2, 51),
(88, 2, 53),
(89, 1, 54),
(90, 4, 55),
(91, 2, 56),
(111, 8, 57),
(160, 4, 58),
(161, 4, 59),
(162, 2, 59),
(163, 2, 60),
(164, 1, 61),
(165, 2, 62),
(166, 9, 63),
(167, 1, 64),
(168, 5, 65),
(169, 2, 66),
(170, 4, 67),
(171, 2, 67),
(172, 4, 68),
(173, 4, 69),
(174, 4, 70),
(175, 4, 71),
(176, 4, 72),
(177, 4, 73),
(178, 4, 74),
(179, 4, 75),
(180, 4, 76),
(181, 2, 77),
(182, 4, 78),
(183, 4, 79),
(184, 8, 80),
(186, 4, 82),
(187, 9, 83),
(188, 9, 84),
(189, 4, 85),
(190, 4, 86),
(191, 4, 87),
(192, 4, 88),
(193, 4, 89),
(194, 4, 90),
(195, 4, 91),
(196, 4, 92),
(197, 4, 93),
(198, 4, 94),
(199, 4, 95),
(200, 4, 96),
(201, 4, 97),
(203, 2, 99),
(204, 2, 98),
(206, 2, 101),
(207, 2, 102),
(208, 2, 103),
(209, 2, 100),
(210, 2, 104),
(211, 2, 105),
(212, 2, 106),
(213, 2, 107),
(214, 2, 108),
(215, 2, 109),
(216, 2, 110),
(217, 2, 111),
(218, 2, 112),
(219, 2, 113),
(220, 2, 114),
(221, 2, 115),
(222, 2, 116),
(223, 2, 117),
(224, 2, 118),
(225, 2, 119),
(226, 2, 120),
(227, 2, 121),
(228, 2, 122),
(229, 2, 123),
(230, 2, 124),
(231, 2, 125),
(232, 2, 126),
(233, 2, 127),
(234, 2, 128),
(235, 2, 129),
(236, 5, 130),
(237, 5, 131),
(242, 2, 132),
(243, 6, 132),
(244, 2, 133),
(247, 2, 134),
(249, 2, 135),
(252, 2, 136),
(303, 2, 137),
(304, 4, 138),
(305, 2, 138),
(306, 2, 81),
(307, 1, 1),
(308, 5, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materials`
--

CREATE TABLE `materials` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `materials`
--

INSERT INTO `materials` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Plata', '2017-07-13 19:25:53', NULL, NULL),
(2, 'Acero', '2017-07-13 19:25:53', '2017-09-19 13:44:26', NULL),
(3, 'Fantasía', '2017-07-13 19:25:53', NULL, NULL),
(4, 'Oro', '2017-09-18 15:34:13', NULL, NULL),
(5, 'Safiro', '2017-09-19 14:10:03', '2017-09-19 14:10:10', NULL),
(6, 'Rubí', '2017-09-19 14:10:17', '2017-09-25 14:50:38', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2012_10_30_152243_create_sessions_table', 1),
(2, '2012_10_31_120121_create_countries_table', 1),
(3, '2012_10_31_120122_create_cities_table', 1),
(4, '2013_11_01_134921_create_user_group_table', 1),
(5, '2013_11_01_134922_create_users_table', 1),
(6, '2013_11_01_134922_laratrust_setup_tables', 1),
(7, '2014_10_12_100000_create_password_resets_table', 1),
(8, '2014_11_07_000101_create_categories_table', 1),
(9, '2014_11_07_000101_create_subcategories_table', 1),
(10, '2016_02_09_154351_create_lines_table', 1),
(11, '2016_02_09_154351_create_makings_table', 1),
(12, '2016_02_09_155316_create_colors_table', 1),
(13, '2016_02_09_155316_create_materials_table', 1),
(14, '2016_02_09_155317_create_sizes_table', 1),
(15, '2016_02_09_155317_create_treatments_table', 1),
(16, '2016_11_07_000100_create_products_table', 1),
(17, '2016_11_07_000101_create_product_details_table', 1),
(18, '2016_11_07_000102_create_images_table', 1),
(19, '2016_11_07_000103_create_making_product_table', 1),
(20, '2016_11_07_000104_create_line_product_table', 1),
(21, '2016_11_07_000104_create_size_product_detail_table', 1),
(22, '2016_11_07_000105_create_orders_table', 1),
(23, '2016_11_07_000106_create_order_details_table', 1),
(24, '2017_04_08_205121_add_fields_to_product_table', 1),
(25, '2017_04_09_182900_add_fields_to_product_detail', 1),
(26, '2017_04_10_163739_add_fields_to_countries_table', 1),
(27, '2017_04_12_201238_add_soft_deletes_to_orders_table', 1),
(28, '2017_04_19_144415_create_suggestions_table', 1),
(29, '2017_04_19_221251_create_suggestion_detail_table', 1),
(30, '2017_05_10_041637_add_address_field_to_users_table', 1),
(31, '2017_06_04_093940_create_admin_configs_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `total_count` int(11) NOT NULL DEFAULT '0',
  `order_status` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `expiration_date` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `total_price`, `total_count`, `order_status`, `expiration_date`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 8, '375.36', 2, 'confirmado', NULL, '2017-12-19 22:28:43', '2017-12-20 15:47:55', NULL),
(2, 8, '36.47', 2, 'confirmado', NULL, '2017-12-20 14:09:28', '2017-12-20 15:41:06', NULL),
(3, 8, '76.45', 3, 'confirmado', NULL, '2017-12-20 21:59:53', '2017-12-20 23:01:38', NULL),
(4, 8, '29.37', 2, 'entregado', NULL, '2017-12-21 14:49:58', '2017-12-21 18:35:41', NULL),
(5, 8, '360.22', 3, 'revisado', NULL, '2017-12-21 18:42:19', '2017-12-21 18:57:11', NULL),
(6, 8, '22.80', 2, 'revisado', NULL, '2017-12-21 21:35:28', '2017-12-21 23:19:28', NULL),
(7, 8, '408.64', 8, 'revisado', NULL, '2017-12-22 15:53:14', '2017-12-22 16:01:11', NULL),
(8, 8, '593.23', 3, 'confirmado', NULL, '2017-12-22 19:32:51', '2017-12-22 21:35:14', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `order_details`
--

CREATE TABLE `order_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `product_detail_id` int(10) UNSIGNED NOT NULL,
  `size_id` int(10) UNSIGNED NOT NULL,
  `quantity` int(10) UNSIGNED NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `available` int(11) DEFAULT NULL,
  `check_revision` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `item_status` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `product_detail_id`, `size_id`, `quantity`, `price`, `available`, `check_revision`, `item_status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 13, 1, '3.22', 1, 'disp', '', '2017-12-19 22:28:43', '2017-12-19 22:36:55'),
(2, 1, 1, 22, 13, 2, '186.07', 1, 'modif', 'retirado', '2017-12-19 22:28:43', '2017-12-19 22:36:55'),
(3, 2, 80, 61, 29, 2, '16.51', 0, 'nodisp', 'retirado', '2017-12-20 14:09:28', '2017-12-20 15:41:06'),
(4, 2, 80, 60, 29, 1, '3.45', 1, 'disp', '', '2017-12-20 14:09:28', '2017-12-20 15:41:06'),
(7, 3, 81, 62, 29, 2, '14.49', 2, 'disp', '', '2017-12-20 21:59:53', '2017-12-20 23:01:38'),
(8, 3, 80, 61, 13, 1, '18.10', 1, 'disp', '', '2017-12-20 21:59:53', '2017-12-20 23:01:38'),
(9, 3, 1, 65, 14, 3, '9.79', 2, 'modif', '', '2017-12-20 21:59:53', '2017-12-20 23:01:38'),
(10, 4, 1, 66, 14, 1, '9.79', NULL, NULL, '', '2017-12-21 14:49:58', NULL),
(11, 4, 1, 67, 24, 2, '9.79', NULL, NULL, '', '2017-12-21 14:49:58', NULL),
(12, 5, 80, 61, 1, 6, '14.92', 6, 'disp', '', '2017-12-21 18:42:19', '2017-12-21 18:57:11'),
(13, 5, 80, 60, 29, 6, '3.45', 3, 'modif', '', '2017-12-21 18:42:19', '2017-12-21 18:57:11'),
(14, 5, 2, 7, 13, 1, '250.00', 0, 'nodisp', '', '2017-12-21 18:42:19', '2017-12-21 18:57:11'),
(15, 6, 1, 1, 13, 1, '3.22', 1, 'disp', '', '2017-12-21 21:35:28', '2017-12-21 23:19:28'),
(16, 6, 1, 65, 14, 2, '9.79', 1, 'modif', '', '2017-12-21 21:35:28', '2017-12-21 23:19:28'),
(17, 7, 81, 62, 29, 3, '14.49', 3, 'disp', '', '2017-12-22 15:53:14', '2017-12-22 16:01:11'),
(18, 7, 80, 60, 29, 2, '3.45', 2, 'disp', '', '2017-12-22 15:53:14', '2017-12-22 16:01:11'),
(19, 7, 80, 61, 13, 5, '18.10', 3, 'modif', '', '2017-12-22 15:53:14', '2017-12-22 16:01:11'),
(20, 7, 1, 1, 13, 3, '3.22', 0, 'modif', '', '2017-12-22 15:53:14', '2017-12-22 16:01:11'),
(21, 7, 1, 22, 26, 2, '75.21', 0, 'nodisp', '', '2017-12-22 15:53:14', '2017-12-22 16:01:11'),
(22, 7, 1, 67, 24, 6, '9.79', 3, 'modif', '', '2017-12-22 15:53:14', '2017-12-22 16:01:11'),
(23, 7, 1, 67, 25, 3, '9.79', 3, 'disp', '', '2017-12-22 15:53:14', '2017-12-22 16:01:11'),
(24, 7, 1, 67, 14, 2, '9.79', 0, 'nodisp', '', '2017-12-22 15:53:14', '2017-12-22 16:01:11'),
(25, 8, 81, 62, 24, 1, '15.44', 1, 'disp', '', '2017-12-22 19:32:51', '2017-12-22 21:35:14'),
(26, 8, 1, 66, 14, 2, '9.79', 2, 'disp', '', '2017-12-22 19:32:51', '2017-12-22 21:35:14'),
(27, 8, 1, 22, 13, 3, '186.07', 3, 'disp', '', '2017-12-22 19:32:51', '2017-12-22 21:35:14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permission_role`
--

CREATE TABLE `permission_role` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plines`
--

CREATE TABLE `plines` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `plines`
--

INSERT INTO `plines` (`id`, `name`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Infantil', 'Línea de productos para niños', '2017-07-13 19:25:53', NULL, NULL),
(2, 'Religioso', 'Artículos figuras santas', '2017-07-13 19:25:53', '2017-09-12 22:51:48', NULL),
(3, 'Masculino', 'Línea de productos para caballero', '2017-07-13 19:25:53', NULL, NULL),
(4, 'Femenino', 'Línea de productos para dama', '2017-07-13 19:25:53', NULL, NULL),
(6, 'Casual', 'Línea casual unisex', '2017-09-12 20:15:16', NULL, NULL),
(7, 'Moderno', 'Tendencias de actualidad', '2017-09-18 15:39:24', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `country_code` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `subcategory_id` int(10) UNSIGNED DEFAULT NULL,
  `material_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `visible` tinyint(1) NOT NULL DEFAULT '1',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `is_visible` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`id`, `code`, `name`, `description`, `country_code`, `category_id`, `subcategory_id`, `material_id`, `created_at`, `updated_at`, `visible`, `deleted_at`, `is_visible`) VALUES
(1, '56565', 'Anillo 2', 'Anillo numero 1', 'IT', 1, 2, 1, '2017-08-08 12:48:46', '2017-10-27 13:53:23', 1, NULL, 1),
(2, '900025E', 'Anillo 3', 'Anillo de plata', 'AR', 1, 1, 1, '2017-08-09 12:42:05', '2017-09-15 18:21:31', 1, NULL, 1),
(6, 'ER003', 'Anillo 6', 'Anillo número 6', 'IT', 8, 24, 3, NULL, '2017-09-14 22:44:11', 1, NULL, 1),
(21, 'UHN0005', 'Anillo 9', 'Anillo número 9', 'CN', 3, 10, 2, NULL, NULL, 1, NULL, 1),
(22, 'E000652', 'Cadena 5', 'Cadena de metal', 'IT', 12, 23, 2, NULL, '2017-09-15 16:16:37', 1, NULL, 1),
(23, '9000000108175', '9000000108175', 'Zarcillos con circones ', 'CN', 2, 6, 1, NULL, '2017-09-26 15:53:29', 1, NULL, 1),
(24, '900000025557', '002GRPB2L0080', 'Modelo Gucci ', 'IT', 8, 24, 1, NULL, '2017-09-26 15:07:12', 1, NULL, 1),
(25, '900000102647', '900000102647', 'Zarcillos con circones  ', 'CN', 2, 6, 1, NULL, NULL, 1, NULL, 1),
(26, '900000108069', 'YE1644', '', 'CN', 2, 6, 1, NULL, NULL, 1, NULL, 1),
(27, '90000010869', 'YE1644', '', 'CN', 2, 6, 1, NULL, NULL, 1, NULL, 1),
(28, '900000108069', 'YE1644', 'Zarcillos con circones  ', 'CN', 2, 6, 1, NULL, NULL, 1, NULL, 1),
(29, '9E0025455', 'ZARV-0052', 'Zarcillo ', 'CO', 2, 5, 3, NULL, NULL, 1, NULL, 1),
(30, 'CX0002', 'CADF5231', 'Cadena N 9', 'AR', 8, 24, 4, NULL, NULL, 1, NULL, 1),
(31, '9000000108175', '9000000108175', 'tamaño 4mm ', 'CN', 2, 6, 1, NULL, NULL, 1, NULL, 1),
(32, '9000000108175-2', '9000000108175-2', '', 'CN', 2, 6, 1, NULL, NULL, 1, NULL, 1),
(33, '900000102470', '900000102470', '', 'CN', 2, 5, 1, NULL, NULL, 1, NULL, 1),
(34, '900000108069', '900000108069', '', 'CN', 2, 6, 1, NULL, NULL, 1, NULL, 1),
(35, 'TDS0802L', 'TDS0802L', 'GUCCI ', 'IT', 8, 24, 1, NULL, NULL, 1, NULL, 1),
(36, 'P0201505', 'PULSM0002-9', 'Pulsera esclava', 'US', 4, 13, 2, NULL, NULL, 1, NULL, 1),
(37, 'TDS0802L', 'TDS0802L', 'GUCCI', 'IT', 8, 24, 1, NULL, NULL, 1, NULL, 1),
(38, 'TDS0802L', 'TDS0802L', 'GUCCI', 'IT', 8, 24, 1, NULL, NULL, 1, NULL, 1),
(39, 'TDS0802L', 'TDS0802L', 'GUCCI', 'IT', 8, 24, 1, NULL, NULL, 1, NULL, 1),
(40, 'TDS0802L', 'TDS0802L', 'GUCCI', 'IT', 8, 24, 1, NULL, NULL, 1, NULL, 1),
(41, 'TDS0802L', 'TDS0802L', 'GUCCI', 'IT', 8, 24, 1, NULL, NULL, 1, NULL, 1),
(42, 'TDS0802L', 'TDS0802L', 'GUCCI', 'IT', 8, 24, 1, NULL, NULL, 1, NULL, 1),
(43, '900000108175-2', '900000108175-2', '4 mm ', 'CN', 2, 6, 1, NULL, '2017-09-26 18:19:52', 1, NULL, 1),
(44, '9900000012345', 'Prueba', '', 'IT', 3, 8, 1, NULL, NULL, 1, NULL, 1),
(45, 'LL4V', '3R0S-005', 'Tobillera niños', 'AR', 11, 17, 2, NULL, NULL, 1, NULL, 1),
(46, '9900000108175001', 'Chip01.10g', 'Zarcillo', 'CN', 2, 6, 1, NULL, NULL, 1, NULL, 1),
(47, '9000000108175001', '9000000108175001', 'zarcillos  ', 'CN', 2, 6, 1, NULL, NULL, 1, NULL, 1),
(48, '990000108175', '990000108175', 'zarcillos ', 'CN', 2, 6, 1, NULL, NULL, 1, NULL, 1),
(49, '990000091668', 'ven00.25m', '1.8x40mm ', 'DO', 2, 4, 1, NULL, NULL, 1, NULL, 1),
(50, '990000108175002', 'chip1.10g ', '5mm ', 'CN', 2, 6, 1, NULL, NULL, 1, NULL, 1),
(51, '990000108175', 'chip01.10', 'zarcillos  ', 'CN', 2, 6, 1, NULL, NULL, 1, NULL, 1),
(52, '915541584', '35512', '41121', 'IT', 8, 24, 1, NULL, NULL, 1, NULL, 1),
(53, 'NM0009', 'B820001', 'Relojes niños', 'IT', 12, 23, 2, NULL, NULL, 1, NULL, 1),
(54, 'BHJ-0909', 'HUY-45643', 'Llaveros', 'IT', 11, 17, 1, NULL, NULL, 1, NULL, 1),
(55, '9900000105006', 'chip01.15', '', 'CN', 2, 5, 1, NULL, NULL, 1, NULL, 1),
(56, '900000108472', 'taip', 'zarcillos ', 'CN', 2, 6, 1, NULL, NULL, 1, NULL, 1),
(57, 'sdwsdsd', 'wsdqsqs', 'wdwsdwsd', 'AR', 3, 8, 2, NULL, NULL, 1, NULL, 1),
(58, '768iuyiuj', 'iiyityutuil', 'utyutyuytu', 'IT', 8, 24, 1, NULL, NULL, 1, NULL, 1),
(59, '9000000108175004', '9000000108175004', 'ghttyhtyjyjyjt', 'IT', 2, 6, 1, NULL, NULL, 1, NULL, 1),
(60, '900000108472', 'TAIP', 'HTTRRWSS', 'CN', 2, 6, 1, NULL, NULL, 1, NULL, 1),
(61, '9000000108472', '9000000108472', 'GHFHFGHFGHF', 'CN', 2, 6, 1, NULL, NULL, 1, NULL, 1),
(62, '99000009166801', 'VEN ', 'FFG', 'CN', 2, 6, 1, NULL, NULL, 1, NULL, 1),
(63, 'FGFGF', 'VCBFGBF', 'FG', 'AR', 2, 3, 1, NULL, NULL, 1, NULL, 1),
(64, '90000002667701', ' VCBFGBF', '', 'AR', 2, 6, 6, NULL, NULL, 1, NULL, 1),
(65, '900000026677', '900000003388', '', 'CN', 2, 6, 1, NULL, NULL, 1, NULL, 1),
(66, '9900000076535', '00214210R0065A', '1.5x63mm ', 'IT', 2, 4, 1, NULL, NULL, 1, NULL, 1),
(67, '99000000108175', 'CHIP01.10', '4MM', 'CN', 2, 6, 2, NULL, NULL, 1, NULL, 1),
(68, '99000000108175001', 'CHIP01.10', 'Zarcillos con circones  ', 'CN', 2, 5, 1, NULL, NULL, 1, NULL, 1),
(69, '9900000108175-1', 'CHIP01.10', '', 'CN', 2, 5, 1, NULL, NULL, 1, NULL, 1),
(70, '9900000108175-01', '9900000108175-01', '', 'CN', 2, 5, 1, NULL, NULL, 1, NULL, 1),
(71, '90000108175', 'CHIP01.10', '', 'CN', 2, 5, 1, NULL, NULL, 1, NULL, 1),
(72, '108175', 'CHIP1.10', 'ZARCILLOS ', 'CN', 2, 5, 1, NULL, NULL, 1, NULL, 1),
(73, '9000000108175', 'AFADD', 'CDDD', 'CN', 2, 5, 1, NULL, NULL, 1, NULL, 1),
(74, '108175', 'FGFGRR', 'GFGFGR', 'CN', 2, 6, 1, NULL, NULL, 1, NULL, 1),
(75, '786344', 'HELOKMV', 'GFRT', 'CN', 2, 6, 1, NULL, NULL, 1, NULL, 1),
(76, '1-1', 'ROJO ', 'DIJE ', 'CN', 3, 10, 1, NULL, NULL, 1, NULL, 1),
(77, '900000026677011', 'lfjkgnasfgkl ', '', 'CO', 8, 24, 1, NULL, NULL, 1, NULL, 1),
(78, '99000000108175001', 'CHIP01.10', '4MM', 'CN', 2, 5, 1, NULL, NULL, 1, NULL, 1),
(79, '99000108175123', 'CHIP01.10', '4MM', 'CN', 2, 5, 1, NULL, NULL, 1, NULL, 1),
(80, 'vwfqfg', 'Anillo 2', 'Anillo 2', 'BO', 1, 2, 3, NULL, NULL, 1, NULL, 1),
(81, '56565', 'Anillo 2', 'Anillo elegante con piedra de Zafiro fino', 'CN', 1, 2, 4, NULL, '2017-10-25 19:17:41', 1, NULL, 1),
(82, 'CHIP01.10PROD', 'CHIP01.10', 'Moon', 'AR', 1, 2, 1, NULL, NULL, 1, NULL, 1),
(83, '99000000108175', 'CHIP01.10', 'Linea M', 'AR', 2, 6, 2, NULL, NULL, 1, NULL, 1),
(84, '99000000108175', 'CHIP01.10', 'Linea M', 'AR', 2, 6, 2, NULL, NULL, 1, NULL, 1),
(85, '900000108175', 'CHIP1.10', '', 'CN', 2, 6, 1, NULL, NULL, 1, NULL, 1),
(86, '900000108175', 'CHIP1.10', '', 'CN', 2, 6, 1, NULL, NULL, 1, NULL, 1),
(87, '900000108175', 'CHIP1.10', '', 'CN', 2, 6, 1, NULL, NULL, 1, NULL, 1),
(88, '900000108175001', 'CHIP1.10', '', 'CN', 2, 6, 1, NULL, NULL, 1, NULL, 1),
(89, '900000108175001', 'CHIP1.10', '', 'CN', 2, 6, 1, NULL, NULL, 1, NULL, 1),
(90, '900000108175001', 'CHIP1.10', '', 'CN', 2, 6, 1, NULL, NULL, 1, NULL, 1),
(91, '900000108175001', 'CHIP1.10', '', 'CN', 2, 6, 1, NULL, NULL, 1, NULL, 1),
(92, '900000108175001', 'CHIP1.10', '', 'CN', 2, 6, 1, NULL, NULL, 1, NULL, 1),
(93, '900000108175001', 'CHIP1.10', 'Zarcillos ', 'CN', 2, 6, 1, NULL, NULL, 1, NULL, 1),
(94, '900000108175002', 'CHIP1.10G', '', 'CN', 2, 6, 1, NULL, NULL, 1, NULL, 1),
(95, '9900000108175', '9900000108175', 'Zarcillos con circones.  ', 'CN', 2, 6, 1, NULL, NULL, 1, NULL, 1),
(96, '9900000108175', '9900000108175', 'Zarcillos con circones.  ', 'CN', 2, 6, 1, NULL, NULL, 1, NULL, 1),
(97, '9900000108175', '9900000108175', 'Zarcillos con circones.  ', 'CN', 2, 6, 1, NULL, NULL, 1, NULL, 1),
(98, '99000000103637', '002A3P4006L21', '', 'IT', 8, 24, 1, NULL, '2017-10-03 19:30:56', 1, NULL, 1),
(99, '99000000103637', '002A3P4006L21', '', 'IT', 8, 24, 1, NULL, NULL, 1, NULL, 1),
(100, '9000000105440', 'CLK01446', 'Signo del OM  ', 'IT', 4, 13, 1, NULL, '2017-10-05 21:42:32', 1, NULL, 1),
(101, '9000000105440', 'CLK01446', 'Signo del OM  ', 'IT', 4, 13, 1, NULL, NULL, 1, NULL, 1),
(102, '9000000105440', 'CLK01446', 'Signo del OM  ', 'IT', 4, 13, 1, NULL, NULL, 1, NULL, 1),
(103, '9000000105440', 'CLK01446', 'Signo del OM  ', 'IT', 4, 13, 1, NULL, NULL, 1, NULL, 1),
(104, '900000097257', '0331HK4482', 'Pulsera ', 'IT', 4, 13, 1, NULL, NULL, 1, NULL, 1),
(105, '900000097257', '0331HK4482', 'Pulsera ', 'IT', 4, 13, 1, NULL, NULL, 1, NULL, 1),
(106, '900000097257', '0331HK4482', 'Pulsera ', 'IT', 4, 13, 1, NULL, NULL, 1, NULL, 1),
(107, '900000097257', '0331HK4482', 'Pulsera ', 'IT', 4, 13, 1, NULL, NULL, 1, NULL, 1),
(108, '900000097257', '0331HK4482', 'Pulsera ', 'IT', 4, 13, 1, NULL, NULL, 1, NULL, 1),
(109, '900000097257', '0331HK4482', 'Pulsera ', 'IT', 4, 13, 1, NULL, NULL, 1, NULL, 1),
(110, '900000097257', '0331HK4482', 'Pulsera ', 'IT', 4, 13, 1, NULL, NULL, 1, NULL, 1),
(111, '900000097257', '0331HK4482', 'Pulsera ', 'IT', 4, 13, 1, NULL, NULL, 1, NULL, 1),
(112, '900000097257', '0331HK4482', 'Pulsera ', 'IT', 4, 13, 1, NULL, NULL, 1, NULL, 1),
(113, '900000097257', '0331HK4482', 'Pulsera ', 'IT', 4, 13, 1, NULL, NULL, 1, NULL, 1),
(114, '900000097257', '0331HK4482', 'Pulsera ', 'IT', 4, 13, 1, NULL, NULL, 1, NULL, 1),
(115, '900000097257', '0331HK4482', 'Pulsera ', 'IT', 4, 13, 1, NULL, NULL, 1, NULL, 1),
(116, '900000097257', '0331HK4482', 'Pulsera ', 'IT', 4, 13, 1, NULL, NULL, 1, NULL, 1),
(117, '900000097257', '0331HK4482', 'Pulsera ', 'IT', 4, 13, 1, NULL, NULL, 1, NULL, 1),
(118, '900000097257', '0331HK4482', 'Pulsera ', 'IT', 4, 13, 1, NULL, NULL, 1, NULL, 1),
(119, '900000097257', '0331HK4482', 'Pulsera ', 'IT', 4, 13, 1, NULL, NULL, 1, NULL, 1),
(120, '900000097257', '0331HK4482', 'Pulsera ', 'IT', 4, 13, 1, NULL, NULL, 1, NULL, 1),
(121, '900000097257', '0331HK4482', 'Pulsera ', 'IT', 4, 13, 1, NULL, NULL, 1, NULL, 1),
(122, '900000097257', '0331HK4482', 'Pulsera ', 'IT', 4, 13, 1, NULL, NULL, 1, NULL, 1),
(123, '900000097257', '0331HK4482', 'Pulsera ', 'IT', 4, 13, 1, NULL, NULL, 1, NULL, 1),
(124, '900000097257', '0331HK4482', 'Pulsera ', 'IT', 4, 13, 1, NULL, NULL, 1, NULL, 1),
(125, '900000097257', '0331HK4482', 'Pulsera ', 'IT', 4, 13, 1, NULL, NULL, 1, NULL, 1),
(126, '900000097257', '0331HK4482', 'Pulsera ', 'IT', 4, 13, 1, NULL, NULL, 1, NULL, 1),
(127, '900000097257', '0331HK4482', 'Pulsera ', 'IT', 4, 13, 1, NULL, NULL, 1, NULL, 1),
(128, '900000097257', '0331HK4482', 'Pulsera ', 'IT', 4, 13, 1, NULL, NULL, 1, NULL, 1),
(129, '900000097257', '0331HK4482', 'Pulsera ', 'IT', 4, 13, 1, NULL, NULL, 1, NULL, 1),
(130, 'AHN00K1', 'Zarcillo 3', 'Fantasía fina', 'PA', 2, 4, 3, NULL, NULL, 1, NULL, 1),
(131, 'AHN00K1', 'Zarcillo 3', 'Fantasía fina', 'PA', 2, 4, 3, NULL, NULL, 1, NULL, 1),
(132, '900000092764', 'EE1891', 'Hugies  ', 'IT', 2, 7, 1, NULL, '2017-10-06 15:49:16', 1, NULL, 1),
(133, '900000010632', 'Q6406V ', '', 'CN', 2, 7, 1, NULL, NULL, 1, NULL, 1),
(134, '9000000001728', 'ROLOS000S', '', 'IT', 8, 24, 1, NULL, '2017-10-06 16:03:17', 1, NULL, 1),
(135, '9000000105440', 'CLK01446', 'Pulsera de signo om ', 'IT', 4, 26, 1, NULL, '2017-10-23 13:16:29', 1, NULL, 1),
(136, '900000096724', '0331bk6233', 'Pulsera de trébol ', 'IT', 4, 26, 1, NULL, NULL, 1, NULL, 1),
(137, '90000093709', '002garp02', 'trébol ', 'AR', 8, 24, 1, NULL, '2017-10-23 13:52:50', 1, NULL, 1),
(138, '90000098452', 'HGC621', '', 'IT', 2, 7, 1, NULL, NULL, 1, NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `product_details`
--

CREATE TABLE `product_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `color_id` int(10) UNSIGNED NOT NULL,
  `treatment_id` int(10) UNSIGNED NOT NULL,
  `visible` tinyint(1) NOT NULL DEFAULT '1',
  `price_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `weight` decimal(10,2) NOT NULL DEFAULT '0.00',
  `piece_price_value` decimal(10,2) NOT NULL DEFAULT '0.00',
  `manufacture_value` decimal(10,2) NOT NULL DEFAULT '0.00',
  `weight_price_value` decimal(10,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `is_visible` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `product_details`
--

INSERT INTO `product_details` (`id`, `product_id`, `color_id`, `treatment_id`, `visible`, `price_type`, `weight`, `piece_price_value`, `manufacture_value`, `weight_price_value`, `created_at`, `updated_at`, `deleted_at`, `is_visible`) VALUES
(1, 1, 1, 1, 1, 'p', '2.56', '3.22', '0.00', '0.00', NULL, '2017-09-11 21:01:41', NULL, 1),
(5, 6, 4, 1, 1, 'g', '0.00', '0.00', '0.00', '2.20', '2017-08-17 15:48:16', NULL, NULL, 1),
(7, 2, 3, 1, 1, 'p', '0.00', '250.00', '0.00', '0.00', '2017-08-23 15:59:38', NULL, NULL, 1),
(22, 1, 2, 3, 1, 'g', '0.00', '118.00', '0.00', '8.45', '2017-08-31 20:49:10', '2017-09-05 19:57:38', NULL, 1),
(24, 22, 4, 1, 1, 'p', '0.00', '25.36', '0.00', '0.00', '2017-09-22 19:59:02', NULL, NULL, 1),
(30, 22, 6, 10, 1, 'p', '0.00', '150.25', '0.00', '0.00', '2017-09-22 21:14:22', NULL, NULL, 1),
(31, 22, 5, 11, 1, 'g', '0.00', '0.00', '0.00', '2.82', '2017-09-22 21:17:32', '2017-09-22 21:18:34', NULL, 1),
(32, 24, 1, 12, 1, 'mo', '0.00', '0.00', '0.20', '0.00', '2017-09-26 13:15:55', '2017-09-26 13:26:54', NULL, 1),
(33, 41, 1, 12, 1, 'mo', '0.00', '0.00', '0.20', '0.00', '2017-09-26 18:14:40', NULL, NULL, 1),
(34, 43, 1, 12, 1, 'g', '0.00', '0.00', '0.00', '1.10', '2017-09-26 18:21:25', NULL, NULL, 1),
(35, 47, 1, 12, 1, 'g', '0.00', '0.00', '0.00', '1.10', '2017-09-26 18:34:30', NULL, NULL, 1),
(36, 48, 1, 12, 1, 'g', '0.00', '0.00', '0.00', '1.10', '2017-09-26 18:36:38', NULL, NULL, 1),
(37, 49, 1, 12, 1, 'g', '0.00', '0.00', '0.00', '0.25', '2017-09-26 18:49:01', '2017-09-26 18:49:34', NULL, 1),
(38, 50, 1, 12, 1, 'g', '0.00', '0.00', '0.00', '1.10', '2017-09-26 18:53:00', NULL, NULL, 1),
(39, 51, 1, 12, 1, 'g', '0.00', '0.00', '0.00', '1.10', '2017-09-26 18:57:32', '2017-09-26 18:57:50', NULL, 1),
(40, 100, 4, 12, 1, 'mo', '0.00', '0.00', '1.80', '0.00', '2017-10-05 21:43:38', '2017-10-05 21:44:26', NULL, 1),
(41, 132, 1, 12, 1, 'g', '0.00', '0.00', '0.00', '1.30', '2017-10-06 15:48:22', NULL, NULL, 1),
(42, 133, 1, 12, 1, 'g', '0.00', '0.00', '0.00', '1.25', '2017-10-06 15:55:00', NULL, NULL, 1),
(43, 133, 2, 1, 1, 'g', '0.00', '0.00', '0.00', '1.20', '2017-10-06 15:57:00', NULL, NULL, 1),
(44, 134, 1, 12, 1, 'mo', '0.00', '0.00', '0.55', '0.00', '2017-10-06 16:02:07', NULL, NULL, 1),
(45, 134, 3, 1, 1, 'mo', '0.00', '0.00', '0.25', '1.20', '2017-10-06 16:04:36', NULL, NULL, 1),
(46, 45, 3, 10, 1, '', '0.00', '0.00', '0.00', '0.00', '2017-10-09 21:44:34', NULL, NULL, 1),
(52, 135, 3, 12, 1, 'mo', '0.00', '0.00', '1.20', '0.00', '2017-10-23 13:15:47', NULL, NULL, 1),
(54, 136, 3, 12, 1, 'g', '0.00', '0.00', '0.00', '2.00', '2017-10-23 13:34:29', NULL, NULL, 1),
(55, 137, 1, 12, 1, 'g', '0.00', '0.00', '0.00', '2.00', '2017-10-23 13:55:08', NULL, NULL, 1),
(58, 138, 4, 1, 1, 'g', '0.00', '0.00', '0.00', '1.25', '2017-10-23 14:15:00', NULL, NULL, 1),
(59, 138, 4, 12, 1, 'g', '0.00', '0.00', '0.00', '1.25', '2017-10-23 14:15:54', NULL, NULL, 1),
(60, 80, 6, 10, 1, 'g', '0.00', '0.00', '0.00', '2.30', '2017-10-25 18:55:16', NULL, NULL, 1),
(61, 80, 5, 11, 1, 'g', '0.00', '0.00', '0.00', '6.35', '2017-10-25 18:56:05', NULL, NULL, 1),
(62, 81, 2, 9, 1, 'g', '0.00', '0.00', '0.00', '6.30', '2017-10-25 19:04:19', NULL, NULL, 1),
(63, 82, 3, 1, 1, 'g', '0.00', '0.00', '0.00', '2.36', '2017-10-25 19:13:30', NULL, NULL, 1),
(64, 82, 4, 12, 1, 'g', '0.00', '0.00', '0.00', '20.35', '2017-10-25 19:14:28', NULL, NULL, 1),
(65, 1, 2, 1, 1, 'g', '0.00', '0.00', '0.00', '1.10', '2017-10-27 13:32:43', NULL, NULL, 1),
(66, 1, 5, 1, 1, 'g', '0.00', '0.00', '0.00', '1.10', '2017-10-27 13:42:27', NULL, NULL, 1),
(67, 1, 2, 12, 1, 'g', '0.00', '0.00', '0.00', '1.10', '2017-10-27 13:45:51', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'super_admin', 'Super Administrador', 'Posée todos los permisos superiores', NULL, NULL),
(2, 'admin', 'Administrador', 'Posée todos los permisos', NULL, NULL),
(3, 'employee', 'Empleado', 'Empleado encargado de administrar pedidos y solicitudes.', NULL, NULL),
(4, 'client', 'Cliente', 'Rol de cliente registrado', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role_user`
--

CREATE TABLE `role_user` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `role_user`
--

INSERT INTO `role_user` (`user_id`, `role_id`) VALUES
(1, 2),
(2, 2),
(3, 2),
(4, 2),
(1, 4),
(4, 4),
(8, 4),
(9, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8_unicode_ci,
  `payload` text COLLATE utf8_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sizes`
--

CREATE TABLE `sizes` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` int(10) UNSIGNED NOT NULL,
  `unit` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `sizes`
--

INSERT INTO `sizes` (`id`, `name`, `unit`, `category_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 0, NULL, 0, '2017-01-01 18:49:19', NULL, NULL),
(2, 87, NULL, 2, NULL, NULL, NULL),
(3, 74, 'cm', 3, NULL, NULL, NULL),
(4, 72, NULL, 4, NULL, NULL, NULL),
(5, 33, NULL, 5, NULL, NULL, NULL),
(6, 36, NULL, 6, NULL, NULL, NULL),
(7, 91, NULL, 7, NULL, NULL, NULL),
(8, 82, NULL, 8, NULL, NULL, NULL),
(9, 20, NULL, 9, NULL, NULL, NULL),
(10, 26, NULL, 10, NULL, NULL, NULL),
(11, 25, NULL, 11, NULL, NULL, NULL),
(12, 37, NULL, 12, NULL, NULL, NULL),
(13, 6, NULL, 1, NULL, NULL, NULL),
(14, 7, NULL, 1, NULL, NULL, NULL),
(15, 40, 'cm', 8, '2017-09-25 21:46:55', NULL, NULL),
(16, 45, '', 1, '2017-09-25 21:50:58', NULL, NULL),
(17, 45, 'cm ', 8, '2017-09-25 21:51:06', NULL, NULL),
(18, 45, 'cm ', 7, '2017-09-25 21:51:32', NULL, NULL),
(19, 50, 'cm ', 7, '2017-09-25 21:51:43', NULL, NULL),
(20, 55, 'cm ', 7, '2017-09-25 21:51:53', NULL, NULL),
(21, 60, 'cm ', 7, '2017-09-25 21:52:07', NULL, NULL),
(22, 65, 'cm ', 7, '2017-09-25 21:52:47', NULL, NULL),
(23, 70, 'cm ', 7, '2017-09-25 21:52:58', NULL, NULL),
(24, 8, '', 1, '2017-09-25 21:53:07', NULL, NULL),
(25, 9, '', 1, '2017-09-25 21:53:11', NULL, NULL),
(26, 10, '', 1, '2017-09-25 21:53:14', NULL, NULL),
(27, 11, '', 1, '2017-09-25 21:53:17', NULL, NULL),
(28, 12, '', 1, '2017-09-25 21:53:20', NULL, NULL),
(29, 5, '', 1, '2017-09-25 21:53:25', NULL, NULL),
(30, 18, 'cm', 4, '2017-09-25 21:53:43', NULL, NULL),
(31, 19, 'cm ', 4, '2017-09-25 21:53:51', NULL, NULL),
(32, 21, 'cm ', 4, '2017-09-25 21:54:00', NULL, NULL),
(33, 3, 'mm', 12, '2017-09-25 21:54:40', NULL, NULL),
(34, 50, 'cm', 8, '2017-09-26 13:24:40', NULL, NULL),
(35, 55, 'cm', 8, '2017-09-26 13:24:49', NULL, NULL),
(36, 60, 'cm', 8, '2017-09-26 13:24:58', NULL, NULL),
(37, 65, 'cm', 8, '2017-09-26 13:31:00', NULL, NULL),
(38, 70, 'cm ', 8, '2017-09-26 13:31:14', NULL, NULL),
(39, 80, 'cm ', 8, '2017-09-26 13:31:27', NULL, NULL),
(40, 90, 'cm ', 8, '2017-09-26 13:31:43', NULL, NULL),
(41, 42, 'cm  ', 8, '2017-09-26 13:35:35', NULL, NULL),
(42, 90, 'cm ', 8, '2017-09-26 13:36:51', NULL, NULL),
(43, 5, '', 7, '2017-09-26 15:49:51', NULL, NULL),
(44, 2, 'mm ', 12, '2017-10-05 21:53:27', NULL, NULL),
(45, 45, 'cm;mm', 7, '2017-10-05 21:54:17', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `size_product_detail`
--

CREATE TABLE `size_product_detail` (
  `weight` decimal(10,2) NOT NULL DEFAULT '0.00',
  `size_id` int(10) UNSIGNED NOT NULL,
  `product_detail_id` int(10) UNSIGNED NOT NULL,
  `visible` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `size_product_detail`
--

INSERT INTO `size_product_detail` (`weight`, `size_id`, `product_detail_id`, `visible`) VALUES
('1.25', 1, 60, 1),
('2.35', 1, 61, 1),
('155.95', 12, 24, 1),
('150.25', 12, 30, 1),
('280.22', 12, 31, 1),
('120.98', 13, 1, 1),
('15.30', 13, 7, 1),
('22.02', 13, 22, 1),
('1.75', 13, 60, 1),
('2.85', 13, 61, 1),
('2.35', 13, 62, 1),
('8.90', 14, 1, 1),
('18.00', 14, 7, 1),
('8.90', 14, 22, 1),
('2.00', 14, 60, 1),
('2.40', 14, 62, 1),
('8.90', 14, 65, 1),
('8.90', 14, 66, 1),
('8.90', 14, 67, 1),
('1.00', 15, 32, 1),
('2.00', 15, 45, 1),
('1.20', 17, 32, 1),
('6.80', 17, 33, 1),
('1.40', 17, 44, 1),
('83.00', 17, 45, 1),
('8.90', 24, 1, 1),
('8.90', 24, 22, 1),
('2.45', 24, 62, 1),
('8.90', 24, 65, 1),
('8.90', 24, 66, 1),
('8.90', 24, 67, 1),
('8.90', 25, 1, 1),
('8.90', 25, 22, 1),
('8.90', 25, 65, 1),
('8.90', 25, 66, 1),
('8.90', 25, 67, 1),
('8.90', 26, 1, 1),
('8.90', 26, 22, 1),
('8.90', 26, 65, 1),
('8.90', 26, 66, 1),
('8.90', 26, 67, 1),
('8.90', 27, 1, 1),
('8.90', 27, 22, 1),
('8.90', 27, 65, 1),
('8.90', 27, 66, 1),
('8.90', 27, 67, 1),
('8.90', 28, 1, 1),
('8.90', 28, 22, 1),
('8.90', 28, 65, 1),
('8.90', 28, 66, 1),
('8.90', 28, 67, 1),
('12.50', 29, 7, 1),
('1.50', 29, 60, 1),
('2.60', 29, 61, 1),
('2.30', 29, 62, 1),
('85.00', 29, 64, 1),
('1.80', 30, 40, 1),
('1.40', 34, 32, 1),
('1.60', 34, 44, 1),
('1.60', 35, 32, 1),
('7.30', 35, 33, 1),
('1.70', 35, 44, 1),
('1.80', 36, 32, 1),
('8.50', 37, 33, 1),
('2.30', 41, 45, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subcategories`
--

CREATE TABLE `subcategories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `uname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `subcategories`
--

INSERT INTO `subcategories` (`id`, `name`, `uname`, `created_at`, `updated_at`, `category_id`, `deleted_at`) VALUES
(1, 'Compromiso', 'compromiso', '2017-07-13 19:25:53', NULL, 1, NULL),
(2, 'Matrimonio', 'matrimonio', '2017-07-13 19:25:53', NULL, 1, NULL),
(3, 'Abridores', 'abridores', '2017-07-13 19:25:53', NULL, 2, NULL),
(4, 'Argollas', 'argollas', '2017-07-13 19:25:53', NULL, 2, NULL),
(5, 'Largos', 'largos', '2017-07-13 19:25:53', NULL, 2, NULL),
(6, 'Cortos', 'cortos', '2017-07-13 19:25:53', NULL, 2, NULL),
(7, 'Hugies', 'hugies', '2017-07-13 19:25:53', NULL, 2, NULL),
(8, 'Cristos', 'cristos', '2017-07-13 19:25:53', '2017-09-15 13:59:50', 3, NULL),
(9, 'Inflados', 'inflados', '2017-07-13 19:25:53', NULL, 3, NULL),
(10, 'Medallas', 'medallas', '2017-07-13 19:25:53', NULL, 3, NULL),
(11, 'Esclavas', 'esclavas', '2017-07-13 19:25:53', NULL, 4, NULL),
(12, 'Rígidas', 'rigidas', '2017-07-13 19:25:53', NULL, 4, NULL),
(13, 'Multihilo', 'multihilo', '2017-07-13 19:25:53', NULL, 4, NULL),
(14, 'Pisacorbata', 'pisacorbata', '2017-07-13 19:25:53', NULL, 11, NULL),
(15, 'Pisabilletes', 'pisabilletes', '2017-07-13 19:25:53', NULL, 11, NULL),
(16, 'Juntass', 'juntas', '2017-07-13 19:25:53', '2017-09-12 19:48:45', 11, NULL),
(17, 'Llaveros', 'llaveros', '2017-07-13 19:25:53', NULL, 11, NULL),
(18, 'Balanzas', 'balanzas', '2017-07-13 19:25:53', NULL, 12, NULL),
(19, 'Paño', 'pano', '2017-07-13 19:25:53', NULL, 12, NULL),
(20, 'Liquidos', 'liquidos', '2017-07-13 19:25:53', NULL, 12, NULL),
(21, 'Wipes', 'wipes', '2017-07-13 19:25:53', NULL, 12, NULL),
(22, 'Exhibidores', 'exhibidores', '2017-07-13 19:25:53', NULL, 12, NULL),
(23, 'Relojes', 'relojes', '2017-07-13 19:25:53', NULL, 12, NULL),
(24, 'Cadenas', 'cadenas', '2017-09-14 20:57:00', '2017-09-26 15:08:58', 8, NULL),
(25, 'Pendientes', 'pendientes', '2017-09-15 13:35:31', NULL, 2, NULL),
(26, 'normales ', 'normales', '2017-10-05 21:56:11', NULL, 4, NULL),
(27, 'Marquesita  ', 'marquesita', '2017-10-05 21:56:33', NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `suggestions`
--

CREATE TABLE `suggestions` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `body` text COLLATE utf8_unicode_ci NOT NULL,
  `order_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `suggestion_detail`
--

CREATE TABLE `suggestion_detail` (
  `id` int(10) UNSIGNED NOT NULL,
  `suggestion_id` int(10) UNSIGNED NOT NULL,
  `product_detail_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `treatments`
--

CREATE TABLE `treatments` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `material_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `treatments`
--

INSERT INTO `treatments` (`id`, `name`, `updated_at`, `deleted_at`, `material_id`, `created_at`) VALUES
(1, 'Baño de oro amarillo', NULL, NULL, 1, '2017-07-13 19:25:53'),
(2, 'Baño de oro rosado', NULL, NULL, 1, '2017-07-13 19:25:53'),
(3, 'Baño de rodio', NULL, NULL, 1, '2017-07-13 19:25:53'),
(9, 'Baño de zafiro', NULL, NULL, 2, '2017-09-18 19:50:52'),
(10, 'Baño de Esmeralda', '2017-09-18 20:32:03', NULL, 3, '2017-09-18 19:51:03'),
(11, 'Baño de oro rojizo', '2017-09-19 14:10:57', NULL, 5, '2017-09-19 14:10:43'),
(12, 'Sin baño  ', NULL, NULL, 1, '2017-09-25 21:33:18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `provider_id` text COLLATE utf8_unicode_ci,
  `verified` tinyint(1) NOT NULL DEFAULT '0',
  `token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `company` tinyint(1) NOT NULL DEFAULT '0',
  `company_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `company_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Particular',
  `city` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reference` text COLLATE utf8_unicode_ci,
  `user_group_id` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `country_code` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `avatar`, `provider_id`, `verified`, `token`, `phone`, `password`, `company`, `company_name`, `company_type`, `city`, `reference`, `user_group_id`, `country_code`, `remember_token`, `created_at`, `updated_at`, `deleted_at`, `address`) VALUES
(1, 'Enrique', 'La Cruz', 'elacruz@mgideas.net', NULL, NULL, 1, '792de3420ca9652eb0cassssd312ecf86a', '(+58)412-5152243', '4697ee', 0, NULL, 'Particular', 'caracas', NULL, 2, 'VE', NULL, '2017-07-13 19:25:53', '2017-07-13 19:25:53', NULL, NULL),
(2, 'Elio', 'Acosta', 'eacosta@mgideas.net', NULL, NULL, 1, 'wuwFZUY97KHVzsMMm4AMFbZgjbaW8A', '(+58)416-2842873', '$2y$10$ZTjr6VmaCZ2Okdvbab2NIuGQ9gCdVkKjLEVf1T9quyJGHF9Mocjx.', 0, NULL, 'Particular', 'caracas', NULL, 1, 'VE', NULL, '2017-07-13 19:25:53', '2017-07-13 19:25:53', NULL, NULL),
(3, 'Miguel', 'Rangel', 'erangel@mgideas.net', NULL, NULL, 1, 'rst74SxiH45gffv6t9TsgnZKURj2yP', '(+58)212-4453918', '$2y$10$YdIoK5bSNtKGWBtxvGdR7uXZjeBdwEnTXttIH7Sj2jl7fS4K454.e', 0, NULL, 'Particular', 'caracas', NULL, 1, 'VE', NULL, '2017-07-13 19:25:53', '2017-07-13 19:25:53', NULL, NULL),
(4, 'Alejandro', 'Orvieto', 'aorvieto@argyros.com.pa', NULL, NULL, 1, '9jAMR4NyidO71a6bYgh5fXklD3wZeG', '(+58)333-4453918', '123456', 0, NULL, 'Particular', 'Panamá', NULL, 2, 'PA', NULL, '2017-07-13 19:25:53', '2017-07-13 19:25:53', NULL, NULL),
(8, 'Miguel Rangel', '', 'mikeven@gmail.com', NULL, NULL, 1, '9da4c3a9e6fb1c11c2033aea5dac243ed04ea522', NULL, '1515', 0, NULL, 'Particular', NULL, NULL, 2, 'VE', NULL, NULL, NULL, NULL, NULL),
(9, 'Ángel Rangel', '', 'mrangel@mgideas.net', NULL, NULL, 1, '792de3420ca9652eb0caf41af073d6d312ecf86a', NULL, '4646', 0, NULL, 'Particular', NULL, NULL, 1, 'VE', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_group`
--

CREATE TABLE `user_group` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `variable_a` decimal(10,2) NOT NULL DEFAULT '0.00',
  `variable_b` decimal(10,2) NOT NULL DEFAULT '0.00',
  `variable_c` decimal(10,2) NOT NULL DEFAULT '0.00',
  `variable_d` decimal(10,2) NOT NULL DEFAULT '0.00',
  `material` decimal(10,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `user_group`
--

INSERT INTO `user_group` (`id`, `name`, `description`, `variable_a`, `variable_b`, `variable_c`, `variable_d`, `material`, `created_at`, `updated_at`) VALUES
(1, 'Defecto', 'Tipo de usuario por defecto', '0.00', '0.00', '0.00', '0.00', '0.00', NULL, NULL),
(2, 'Perfil 1', 'Perfil 1', '1.00', '1.00', '1.00', '1.00', '0.84', NULL, NULL),
(3, 'Grupo', NULL, '1.00', '1.10', '1.20', '1.30', '1.40', '2017-09-19 22:02:45', NULL),
(4, 'Perfil 2', NULL, '1.20', '1.35', '1.45', '1.60', '2.50', '2017-09-19 22:09:32', NULL),
(5, 'Argyro\'s', NULL, '2.10', '2.25', '2.35', '2.45', '2.50', '2017-09-19 22:23:25', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `admin_configs`
--
ALTER TABLE `admin_configs`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cities_country_id_index` (`country_id`);

--
-- Indices de la tabla `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `countries_code_index` (`code`);

--
-- Indices de la tabla `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `images_product_detail_id_index` (`product_detail_id`);

--
-- Indices de la tabla `line_product`
--
ALTER TABLE `line_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `line_product_line_id_index` (`line_id`),
  ADD KEY `line_product_product_id_index` (`product_id`);

--
-- Indices de la tabla `makings`
--
ALTER TABLE `makings`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `making_product`
--
ALTER TABLE `making_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `making_product_making_id_index` (`making_id`),
  ADD KEY `making_product_product_id_index` (`product_id`);

--
-- Indices de la tabla `materials`
--
ALTER TABLE `materials`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_details_order_id_foreign` (`order_id`),
  ADD KEY `order_details_product_detail_id_foreign` (`product_detail_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `size_id` (`size_id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indices de la tabla `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_unique` (`name`);

--
-- Indices de la tabla `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `permission_role_role_id_foreign` (`role_id`);

--
-- Indices de la tabla `plines`
--
ALTER TABLE `plines`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_country_code_index` (`country_code`),
  ADD KEY `products_category_id_index` (`category_id`),
  ADD KEY `products_subcategory_id_index` (`subcategory_id`),
  ADD KEY `products_material_id_index` (`material_id`);

--
-- Indices de la tabla `product_details`
--
ALTER TABLE `product_details`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_details_product_id_color_id_treatment_id_unique` (`product_id`,`color_id`,`treatment_id`),
  ADD KEY `product_details_product_id_index` (`product_id`),
  ADD KEY `product_details_color_id_index` (`color_id`),
  ADD KEY `product_details_treatment_id_index` (`treatment_id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indices de la tabla `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`user_id`,`role_id`),
  ADD KEY `role_user_role_id_foreign` (`role_id`);

--
-- Indices de la tabla `sessions`
--
ALTER TABLE `sessions`
  ADD UNIQUE KEY `sessions_id_unique` (`id`);

--
-- Indices de la tabla `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sizes_category_id_index` (`category_id`);

--
-- Indices de la tabla `size_product_detail`
--
ALTER TABLE `size_product_detail`
  ADD PRIMARY KEY (`size_id`,`product_detail_id`),
  ADD KEY `size_product_detail_size_id_index` (`size_id`),
  ADD KEY `size_product_detail_product_detail_id_index` (`product_detail_id`);

--
-- Indices de la tabla `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subcategories_category_id_foreign` (`category_id`);

--
-- Indices de la tabla `suggestions`
--
ALTER TABLE `suggestions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `suggestions_order_id_foreign` (`order_id`),
  ADD KEY `suggestions_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `suggestion_detail`
--
ALTER TABLE `suggestion_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `suggestion_detail_suggestion_id_foreign` (`suggestion_id`),
  ADD KEY `suggestion_detail_product_detail_id_foreign` (`product_detail_id`);

--
-- Indices de la tabla `treatments`
--
ALTER TABLE `treatments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `treatments_material_id_foreign` (`material_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_user_group_id_index` (`user_group_id`),
  ADD KEY `users_country_code_index` (`country_code`);

--
-- Indices de la tabla `user_group`
--
ALTER TABLE `user_group`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `admin_configs`
--
ALTER TABLE `admin_configs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=443;
--
-- AUTO_INCREMENT de la tabla `colors`
--
ALTER TABLE `colors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT de la tabla `images`
--
ALTER TABLE `images`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;
--
-- AUTO_INCREMENT de la tabla `line_product`
--
ALTER TABLE `line_product`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=564;
--
-- AUTO_INCREMENT de la tabla `makings`
--
ALTER TABLE `makings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `making_product`
--
ALTER TABLE `making_product`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=309;
--
-- AUTO_INCREMENT de la tabla `materials`
--
ALTER TABLE `materials`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT de la tabla `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT de la tabla `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `plines`
--
ALTER TABLE `plines`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=139;
--
-- AUTO_INCREMENT de la tabla `product_details`
--
ALTER TABLE `product_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;
--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT de la tabla `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT de la tabla `suggestions`
--
ALTER TABLE `suggestions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `suggestion_detail`
--
ALTER TABLE `suggestion_detail`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `treatments`
--
ALTER TABLE `treatments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `user_group`
--
ALTER TABLE `user_group`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cities`
--
ALTER TABLE `cities`
  ADD CONSTRAINT `cities_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_product_detail_id_foreign` FOREIGN KEY (`product_detail_id`) REFERENCES `product_details` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `line_product`
--
ALTER TABLE `line_product`
  ADD CONSTRAINT `line_product_line_id_foreign` FOREIGN KEY (`line_id`) REFERENCES `plines` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `line_product_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `making_product`
--
ALTER TABLE `making_product`
  ADD CONSTRAINT `making_product_making_id_foreign` FOREIGN KEY (`making_id`) REFERENCES `makings` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `making_product_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`size_id`) REFERENCES `size_product_detail` (`size_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_details_ibfk_3` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_details_product_detail_id_foreign` FOREIGN KEY (`product_detail_id`) REFERENCES `product_details` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `products_country_code_foreign` FOREIGN KEY (`country_code`) REFERENCES `countries` (`code`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `products_material_id_foreign` FOREIGN KEY (`material_id`) REFERENCES `materials` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `products_subcategory_id_foreign` FOREIGN KEY (`subcategory_id`) REFERENCES `subcategories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `product_details`
--
ALTER TABLE `product_details`
  ADD CONSTRAINT `product_details_color_id_foreign` FOREIGN KEY (`color_id`) REFERENCES `colors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_details_treatment_id_foreign` FOREIGN KEY (`treatment_id`) REFERENCES `treatments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `sizes`
--
ALTER TABLE `sizes`
  ADD CONSTRAINT `sizes_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `size_product_detail`
--
ALTER TABLE `size_product_detail`
  ADD CONSTRAINT `size_product_detail_product_detail_id_foreign` FOREIGN KEY (`product_detail_id`) REFERENCES `product_details` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `size_product_detail_size_id_foreign` FOREIGN KEY (`size_id`) REFERENCES `sizes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `subcategories`
--
ALTER TABLE `subcategories`
  ADD CONSTRAINT `subcategories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `suggestions`
--
ALTER TABLE `suggestions`
  ADD CONSTRAINT `suggestions_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `suggestions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `suggestion_detail`
--
ALTER TABLE `suggestion_detail`
  ADD CONSTRAINT `suggestion_detail_product_detail_id_foreign` FOREIGN KEY (`product_detail_id`) REFERENCES `product_details` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `suggestion_detail_suggestion_id_foreign` FOREIGN KEY (`suggestion_id`) REFERENCES `suggestions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `treatments`
--
ALTER TABLE `treatments`
  ADD CONSTRAINT `treatments_material_id_foreign` FOREIGN KEY (`material_id`) REFERENCES `materials` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_country_code_foreign` FOREIGN KEY (`country_code`) REFERENCES `countries` (`code`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_user_group_id_foreign` FOREIGN KEY (`user_group_id`) REFERENCES `user_group` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
