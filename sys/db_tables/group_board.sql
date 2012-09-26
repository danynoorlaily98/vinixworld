CREATE TABLE `group_board` (
  `id` int(11) NOT NULL auto_increment,
  `g` int(11) NOT NULL,
  `user` int(11) NOT NULL default '0',
  `time` int(11) NOT NULL,
  `msg` varchar(512) collate utf8_unicode_ci default NULL,
  PRIMARY KEY  (`id`),
  KEY `time` (`time`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
