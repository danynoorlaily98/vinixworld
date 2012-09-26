CREATE TABLE IF NOT EXISTS `ban` (
  `id` int(11) NOT NULL auto_increment,
  `time` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_ban` int(11) NOT NULL,
  `prich` varchar(1024) NOT NULL,
  `view` set('1','0') NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `id_user` (`id_user`,`id_ban`),
  KEY `time` (`time`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
