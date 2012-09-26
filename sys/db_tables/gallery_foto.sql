CREATE TABLE `gallery_foto` (
  `id` int(11) NOT NULL auto_increment,
  `id_gallery` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `ras` varchar(4) NOT NULL,
  `type` varchar(64) NOT NULL,
  `opis` varchar(1024) NOT NULL,
  `rating` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `id_gallery` (`id_gallery`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;