CREATE TABLE `loads_komm` (
  `id` int(11) NOT NULL auto_increment,
  `file` varchar(64) NOT NULL,
  `size` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `msg` varchar(512) NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `file` (`file`),
  KEY `size` (`size`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;