
CREATE TABLE `institucion` (
`idinstitucion` int(10) unsigned zerofill NOT NULL AUTO_INCREMENT,
`nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
PRIMARY KEY (`idinstitucion`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
CREATE TABLE `usuarios` (
`idusuarios` int(10) unsigned NOT NULL AUTO_INCREMENT,
`institucion_idinstitucion` int(10) unsigned NOT NULL,
`usuario` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
`descripcion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
`muestreo` int(10) unsigned NOT NULL,
`psw_usr` int(10) unsigned NOT NULL,
`mail` varchar(40) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'raymundoc.vela@hotmail.com',
`restriccion` longtext COLLATE utf8_unicode_ci,
PRIMARY KEY (`idusuarios`),
KEY `usuarios_FKIndex1` (`institucion_idinstitucion`)
) ENGINE=MyISAM AUTO_INCREMENT=62 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
CREATE TABLE `puntos` (
`idpuntos` int(10) unsigned NOT NULL AUTO_INCREMENT,
`usuarios_idUsuarios` int(10) unsigned NOT NULL,
`latitud` double NOT NULL,
`longitud` double NOT NULL,
`fecha` datetime NOT NULL,
`provider` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
PRIMARY KEY (`idpuntos`),
KEY `Posiciones_FKIndex1` (`usuarios_idUsuarios`)
) ENGINE=MyISAM AUTO_INCREMENT=4191 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci