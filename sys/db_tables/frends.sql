CREATE TABLE `frends` (
  `user` int(11) NOT NULL default '0',
  `frend` int(11) NOT NULL default '0',
  `time` int(11) NOT NULL,
  `i` int(1) default '0',
  PRIMARY KEY  (`user`,`frend`),
  KEY `time` (`time`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;