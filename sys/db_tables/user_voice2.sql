CREATE TABLE IF NOT EXISTS `user_voice2` (
  `id_user` int(11) NOT NULL,
  `id_kont` int(11) NOT NULL,
  `rating` int(11) NOT NULL default '0',
  KEY `id_user` (`id_user`,`id_kont`),
  KEY `rating` (`rating`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
