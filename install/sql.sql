CREATE TABLE IF NOT EXISTS `ms_config` (
  `w_id` int(1) NOT NULL AUTO_INCREMENT,
  `w_titulo` varchar(180) NOT NULL,
  `w_slogan` varchar(180) NOT NULL,
  `w_url` varchar(180) NOT NULL,
  `w_tema` varchar(180) NOT NULL,
  `w_mail` varchar(180) NOT NULL,
  `w_offline` int(1) NOT NULL,
  `w_txtoff` varchar(180) NOT NULL,
  PRIMARY KEY (`w_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
--------------------------------------------------------
CREATE TABLE IF NOT EXISTS `ms_descargas` (
  `d_id` int(11) NOT NULL AUTO_INCREMENT,
  `p_id` int(11) NOT NULL,
  `d_links` text,
  `d_online` int(1) DEFAULT NULL,
  PRIMARY KEY (`d_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
--------------------------------------------------------
CREATE TABLE IF NOT EXISTS `ms_generos` (
  `g_id` int(11) NOT NULL AUTO_INCREMENT,
  `g_nombre` varchar(180) NOT NULL,
  `g_seo` varchar(180) NOT NULL,
  PRIMARY KEY (`g_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;
--------------------------------------------------------
INSERT INTO `ms_generos` (`g_id`, `g_nombre`, `g_seo`) VALUES
(1, 'Acción', 'accion'),
(2, 'Animación', 'animacion'),
(3, 'Aventura', 'aventura'),
(4, 'Ciencia ficción', 'ciencia-ficcion'),
(5, 'Comedia', 'comedia'),
(6, 'Crimen', 'crimen'),
(7, 'Documental', 'documental'),
(8, 'Drama', 'drama'),
(9, 'Familia', 'familia'),
(10, 'Fantasía', 'fantasia'),
(11, 'Guerra', 'guerra'),
(12, 'Historia', 'historia'),
(13, 'Misterio', 'misterio'),
(14, 'Música', 'musica'),
(15, 'Romance', 'romance'),
(16, 'Suspenso', 'suspenso'),
(17, 'Terror', 'terror'),
(18, 'Western', 'western');
--------------------------------------------------------
CREATE TABLE IF NOT EXISTS `ms_links` (
  `l_id` int(11) NOT NULL AUTO_INCREMENT,
  `l_nombre` varchar(180) NOT NULL,
  `l_url` varchar(200) NOT NULL,
  `l_online` int(1) NOT NULL,
  PRIMARY KEY (`l_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
--------------------------------------------------------
CREATE TABLE IF NOT EXISTS `ms_peliculas` (
  `p_id` int(11) NOT NULL AUTO_INCREMENT,
  `p_titulo` varchar(180) NOT NULL,
  `p_seo` varchar(180) NOT NULL,
  `p_sinopsis` text NOT NULL,
  `p_ano` int(4) NOT NULL,
  `p_genero` int(11) NOT NULL,
  `p_idioma` varchar(180) NOT NULL,
  `p_calidad` varchar(180) NOT NULL,
  `p_estreno` int(1) NOT NULL,
  `p_date` int(10) NOT NULL,
  `p_online` int(1) NOT NULL,
  `p_hits` int(11) NOT NULL DEFAULT '0',
  `p_votos` int(11) NOT NULL DEFAULT '0',
  `p_reports` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`p_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
--------------------------------------------------------
CREATE TABLE IF NOT EXISTS `ms_publicidad` (
  `ad_key` varchar(180) NOT NULL,
  `ad_code` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
--------------------------------------------------------
CREATE TABLE IF NOT EXISTS `ms_users` (
  `u_id` int(11) NOT NULL AUTO_INCREMENT,
  `u_name` varchar(180) NOT NULL,
  `u_password` varchar(180) NOT NULL,
  `u_email` varchar(180) NOT NULL,
  `u_rango` int(1) NOT NULL,
  `u_hash` varchar(180) NOT NULL,
  PRIMARY KEY (`u_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
--------------------------------------------------------
CREATE TABLE IF NOT EXISTS `ms_videos` (
  `v_id` int(11) NOT NULL AUTO_INCREMENT,
  `p_id` int(11) NOT NULL,
  `v_source` text NOT NULL,
  `v_titulo` varchar(180) NOT NULL,
  `v_online` int(1) NOT NULL,
  PRIMARY KEY (`v_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
