CREATE TABLE `survey_r` (
  `id` int(11) NOT NULL auto_increment,
  `id_sur` int(11) NOT NULL,
  `msg` varchar(1024) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `id_sur` (`id_sur`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
