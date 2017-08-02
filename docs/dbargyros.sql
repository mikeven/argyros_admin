-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-08-2017 a las 00:40:11
-- Versión del servidor: 5.7.11
-- Versión de PHP: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dbargyros`
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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Anillos', '2017-07-13 19:25:53', NULL, NULL),
(2, 'Zarcillos', '2017-07-13 19:25:53', NULL, NULL),
(3, 'Dijes', '2017-07-13 19:25:53', NULL, NULL),
(4, 'Pulseras', '2017-07-13 19:25:53', NULL, NULL),
(5, 'Tobilleras', '2017-07-13 19:25:53', NULL, NULL),
(6, 'Gargantillas', '2017-07-13 19:25:53', NULL, NULL),
(7, 'Rosarios', '2017-07-13 19:25:53', NULL, NULL),
(8, 'Cadenas', '2017-07-13 19:25:53', NULL, NULL),
(9, 'Juegos', '2017-07-13 19:25:53', NULL, NULL),
(10, 'Semielaborado', '2017-07-13 19:25:53', NULL, NULL),
(11, 'Otras Joyas', '2017-07-13 19:25:53', NULL, NULL),
(12, 'Complementarios', '2017-07-13 19:25:53', NULL, NULL);

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
(3, 'Amarillo', NULL, '2017-07-13 19:25:53', NULL, NULL),
(4, 'Blanco', NULL, '2017-07-13 19:25:53', NULL, NULL),
(5, 'Rojo', NULL, '2017-07-13 19:25:53', NULL, NULL);

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
(1, 'AR', 'Argentina', '54', NULL, NULL, 0),
(2, 'BO', 'Bolivia', '591', NULL, NULL, 0),
(3, 'BR', 'Brasil', '55', NULL, NULL, 0),
(4, 'CA', 'Canadá', '1', NULL, NULL, 0),
(5, 'CL', 'Chile', '56', NULL, NULL, 0),
(6, 'CO', 'Colombia', '57', NULL, NULL, 0),
(7, 'CR', 'Costa Rica', '506', NULL, NULL, 0),
(8, 'CW', 'Curaçao', '599', NULL, NULL, 0),
(9, 'EC', 'Ecuador', '593', NULL, NULL, 0),
(10, 'SV', 'El Salvador', '503', NULL, NULL, 0),
(11, 'US', 'Estados Unidos', '1', NULL, NULL, 0),
(12, 'GT', 'Guatemala', '502', NULL, NULL, 0),
(13, 'HT', 'Haití', '509', NULL, NULL, 0),
(14, 'HN', 'Honduras', '504', NULL, NULL, 0),
(15, 'JM', 'Jamaica', '1', NULL, NULL, 0),
(16, 'MX', 'México', '52', NULL, NULL, 0),
(17, 'NI', 'Nicaragua', '505', NULL, NULL, 0),
(18, 'PA', 'Panamá', '507', NULL, NULL, 0),
(19, 'PY', 'Paraguay', '595', NULL, NULL, 0),
(20, 'PE', 'Perú', '51', NULL, NULL, 0),
(21, 'DO', 'República Dominicana', '1', NULL, NULL, 0),
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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `line_product`
--

CREATE TABLE `line_product` (
  `id` int(10) UNSIGNED NOT NULL,
  `line_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
(6, 'Piedras', '2017-07-13 19:25:53', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `making_product`
--

CREATE TABLE `making_product` (
  `id` int(10) UNSIGNED NOT NULL,
  `making_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
(2, 'Acero', '2017-07-13 19:25:53', NULL, NULL),
(3, 'Fantasía', '2017-07-13 19:25:53', NULL, NULL);

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
  `expiration_date` datetime NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `total_count` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `order_details`
--

CREATE TABLE `order_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `quantity` int(10) UNSIGNED NOT NULL,
  `available` int(11) DEFAULT NULL,
  `size` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `color` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `treatment` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `order_id` int(10) UNSIGNED NOT NULL,
  `product_detail_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `plines`
--

INSERT INTO `plines` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Infantil', '2017-07-13 19:25:53', NULL, NULL),
(2, 'Religioso', '2017-07-13 19:25:53', NULL, NULL),
(3, 'Masculino', '2017-07-13 19:25:53', NULL, NULL),
(4, 'Femenino', '2017-07-13 19:25:53', NULL, NULL);

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
(4, 4);

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `unit` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `sizes`
--

INSERT INTO `sizes` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`, `category_id`, `unit`) VALUES
(1, 42, NULL, NULL, NULL, 1, NULL),
(2, 87, NULL, NULL, NULL, 2, NULL),
(3, 74, NULL, NULL, NULL, 3, NULL),
(4, 72, NULL, NULL, NULL, 4, NULL),
(5, 33, NULL, NULL, NULL, 5, NULL),
(6, 36, NULL, NULL, NULL, 6, NULL),
(7, 91, NULL, NULL, NULL, 7, NULL),
(8, 82, NULL, NULL, NULL, 8, NULL),
(9, 20, NULL, NULL, NULL, 9, NULL),
(10, 26, NULL, NULL, NULL, 10, NULL),
(11, 25, NULL, NULL, NULL, 11, NULL),
(12, 37, NULL, NULL, NULL, 12, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `size_product_detail`
--

CREATE TABLE `size_product_detail` (
  `weight` decimal(10,2) NOT NULL DEFAULT '0.00',
  `size_id` int(10) UNSIGNED NOT NULL,
  `product_detail_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subcategories`
--

CREATE TABLE `subcategories` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `subcategories`
--

INSERT INTO `subcategories` (`id`, `created_at`, `updated_at`, `name`, `category_id`, `deleted_at`) VALUES
(1, '2017-07-13 19:25:53', NULL, 'Compromiso', 1, NULL),
(2, '2017-07-13 19:25:53', NULL, 'Matrimonio', 1, NULL),
(3, '2017-07-13 19:25:53', NULL, 'Abridores', 2, NULL),
(4, '2017-07-13 19:25:53', NULL, 'Argollas', 2, NULL),
(5, '2017-07-13 19:25:53', NULL, 'Largos', 2, NULL),
(6, '2017-07-13 19:25:53', NULL, 'Cortos', 2, NULL),
(7, '2017-07-13 19:25:53', NULL, 'Hugies', 2, NULL),
(8, '2017-07-13 19:25:53', NULL, 'Cristos', 3, NULL),
(9, '2017-07-13 19:25:53', NULL, 'Inflados', 3, NULL),
(10, '2017-07-13 19:25:53', NULL, 'Medallas', 3, NULL),
(11, '2017-07-13 19:25:53', NULL, 'Esclavas', 4, NULL),
(12, '2017-07-13 19:25:53', NULL, 'Rígidas', 4, NULL),
(13, '2017-07-13 19:25:53', NULL, 'Multihilo', 4, NULL),
(14, '2017-07-13 19:25:53', NULL, 'Pisacorbata', 11, NULL),
(15, '2017-07-13 19:25:53', NULL, 'Pisabilletes', 11, NULL),
(16, '2017-07-13 19:25:53', NULL, 'Yuntas', 11, NULL),
(17, '2017-07-13 19:25:53', NULL, 'Llaveros', 11, NULL),
(18, '2017-07-13 19:25:53', NULL, 'Balanzas', 12, NULL),
(19, '2017-07-13 19:25:53', NULL, 'Paño', 12, NULL),
(20, '2017-07-13 19:25:53', NULL, 'Liquidos', 12, NULL),
(21, '2017-07-13 19:25:53', NULL, 'Wipes', 12, NULL),
(22, '2017-07-13 19:25:53', NULL, 'Exhibidores', 12, NULL),
(23, '2017-07-13 19:25:53', NULL, 'Relojes', 12, NULL);

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `material_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `treatments`
--

INSERT INTO `treatments` (`id`, `created_at`, `updated_at`, `deleted_at`, `name`, `material_id`) VALUES
(1, '2017-07-13 19:25:53', NULL, NULL, 'Baño de oro amarillo', 1),
(2, '2017-07-13 19:25:53', NULL, NULL, 'Baño de oro rosado', 1),
(3, '2017-07-13 19:25:53', NULL, NULL, 'Baño de rodio', 1),
(4, '2017-07-13 19:25:53', NULL, NULL, 'Baño de oro amarillo', 2),
(5, '2017-07-13 19:25:53', NULL, NULL, 'Baño de oro rosado', 2),
(6, '2017-07-13 19:25:53', NULL, NULL, 'Baño de rodio', 2),
(7, '2017-07-13 19:25:53', NULL, NULL, 'Baño de oro amarillo', 3),
(8, '2017-07-13 19:25:53', NULL, NULL, 'Baño de oro rosado', 3);

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
(1, 'Enrique', 'La Cruz', 'elacruz@mgideas.net', NULL, NULL, 1, 'VEQe8QP2YJQhexpsWWo01tQnJtSs8i', '(+58)412-5152243', '$2y$10$UN9pLSZfXyzdbBJzA6VaPuWY0R2RPFRJ2HDs/RHfZNsEQsY9GBYhW', 0, NULL, 'Particular', 'caracas', NULL, 2, 'VE', NULL, '2017-07-13 19:25:53', '2017-07-13 19:25:53', NULL, NULL),
(2, 'Elio', 'Acosta', 'eacosta@mgideas.net', NULL, NULL, 1, 'wuwFZUY97KHVzsMMm4AMFbZgjbaW8A', '(+58)416-2842873', '$2y$10$ZTjr6VmaCZ2Okdvbab2NIuGQ9gCdVkKjLEVf1T9quyJGHF9Mocjx.', 0, NULL, 'Particular', 'caracas', NULL, 1, 'VE', NULL, '2017-07-13 19:25:53', '2017-07-13 19:25:53', NULL, NULL),
(3, 'Miguel', 'Rangel', 'erangel@mgideas.net', NULL, NULL, 1, 'rst74SxiH45gffv6t9TsgnZKURj2yP', '(+58)212-4453918', '$2y$10$YdIoK5bSNtKGWBtxvGdR7uXZjeBdwEnTXttIH7Sj2jl7fS4K454.e', 0, NULL, 'Particular', 'caracas', NULL, 1, 'VE', NULL, '2017-07-13 19:25:53', '2017-07-13 19:25:53', NULL, NULL),
(4, 'Alejandro', 'Orvieto', 'aorvieto@argyros.com.pa', NULL, NULL, 1, '9jAMR4NyidO71a6bYgh5fXklD3wZeG', '(+58)333-4453918', '123456', 0, NULL, 'Particular', 'Panamá', NULL, 1, 'PA', NULL, '2017-07-13 19:25:53', '2017-07-13 19:25:53', NULL, NULL);

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
(2, 'Perfil 1', 'Perfil 1', '1.00', '1.00', '1.00', '1.00', '0.84', NULL, NULL);

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
  ADD KEY `order_details_product_detail_id_foreign` (`product_detail_id`);

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT de la tabla `images`
--
ALTER TABLE `images`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `line_product`
--
ALTER TABLE `line_product`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `makings`
--
ALTER TABLE `makings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `making_product`
--
ALTER TABLE `making_product`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `materials`
--
ALTER TABLE `materials`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT de la tabla `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `plines`
--
ALTER TABLE `plines`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `product_details`
--
ALTER TABLE `product_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `user_group`
--
ALTER TABLE `user_group`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
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
  ADD CONSTRAINT `order_details_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
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
  ADD CONSTRAINT `suggestions_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
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
