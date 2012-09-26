CREATE TABLE IF NOT EXISTS `us_guest_reply` (
  `id` int(11) NOT NULL auto_increment,
  `id_post` int(11) NOT NULL,
  `id_user` int(11) NOT NULL default '0',
  `id_autor` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `reply` varchar(1024) character set utf8 collate utf8_unicode_ci default NULL,
  PRIMARY KEY  (`id`),
  KEY `time` (`time`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
