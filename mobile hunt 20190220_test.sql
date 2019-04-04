CREATE TABLE `institucion` (
`idinstitucion` int unsigned zerofill NOT NULL AUTO_INCREMENT,
`nombre` varchar COLLATE utf8_unicode_ci NOT NULL,
PRIMARY KEY (`idinstitucion`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
CREATE TABLE `usuarios` (
`idusuarios` int unsigned NOT NULL AUTO_INCREMENT,
`institucion_idinstitucion` int unsigned NOT NULL,
`usuario` varchar COLLATE utf8_unicode_ci NOT NULL,
`descripcion` varchar COLLATE utf8_unicode_ci NOT NULL,
`muestreo` int unsigned NOT NULL,
`psw_usr` int unsigned NOT NULL,
`mail` varchar COLLATE utf8_unicode_ci NOT NULL DEFAULT 'raymundoc.vela@hotmail.com',
`restriccion` longtext COLLATE utf8_unicode_ci,
PRIMARY KEY (`idusuarios`),
KEY `usuarios_FKIndex1` (`institucion_idinstitucion`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
CREATE TABLE `puntos` (
`idpuntos` int unsigned NOT NULL AUTO_INCREMENT,
`usuarios_idUsuarios` int unsigned NOT NULL,
`latitud` double NOT NULL,
`longitud` double NOT NULL,
`fecha` datetime NOT NULL,
`provider` varchar COLLATE utf8_unicode_ci NOT NULL,
PRIMARY KEY (`idpuntos`),
KEY `Posiciones_FKIndex1` (`usuarios_idUsuarios`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci