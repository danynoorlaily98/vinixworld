CREATE TABLE `forum_thank` (
  `id_post` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `rating` int(11) default '0',
  KEY `id_post` (`id_post`),
  KEY `id_user` (`id_user`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;