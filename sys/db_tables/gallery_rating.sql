CREATE TABLE `gallery_rating` (
  `id_foto` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  KEY `id_foto` (`id_foto`,`id_user`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;