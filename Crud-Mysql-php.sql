CREATE DATABASE bodega;
use bodega;
CREATE TABLE bodegas (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `estatus` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


INSERT INTO `bodegas` (`id`, `nombre`, `direccion`, `estatus`) VALUES
(1, 'RECURSOS HUMANOS', 'SAN CRISTOBAL', '1'),
(2, 'CONTROL DE ESTUDO', 'IUT SAN CRISTOBAL', '1'),
(3, 'ADMINISTRACION2', 'SAN CRISTOBAL', '1'),
(4, 'DIRECCION', 'SAN CRISTOBAL', '1'),
(5, 'CAJA DE AHORRO', 'SAN CRISTOBAL', '1'),
(6, 'RELACIONES CORPORATIVAS', 'SAN CRISTOBAL', '1'),

ALTER TABLE `bodegas`
  ADD PRIMARY KEY (`id`);
