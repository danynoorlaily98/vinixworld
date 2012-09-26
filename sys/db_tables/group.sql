CREATE TABLE `group` (
  `id` int(11) NOT NULL auto_increment,
  `logo` varchar(128) collate utf8_unicode_ci default NULL,
  `name` varchar(128) collate utf8_unicode_ci default NULL,
  `deviz` varchar(128) collate utf8_unicode_ci default NULL,
  `about` varchar(250) collate utf8_unicode_ci default NULL,
  `all` int(11) NOT NULL default '1',
  `user` int(11) NOT NULL default '0',
  `time` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `user_id` (`user`,`time`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
