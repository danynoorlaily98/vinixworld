CREATE TABLE `lib_dir` (
  `id` int(11) NOT NULL auto_increment,
  `num` int(11) NOT NULL default '0',
  `name` varchar(64) NOT NULL,
  `dir` varchar(512) NOT NULL default '/',
  `dir_osn` varchar(512) default '/',
  PRIMARY KEY  (`id`),
  KEY `num` (`num`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
