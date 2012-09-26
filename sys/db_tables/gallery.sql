CREATE TABLE `gallery` (
  `id` int(11) NOT NULL auto_increment,
  `id_user` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `time_create` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `opis` varchar(256) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `id_user` (`id_user`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;