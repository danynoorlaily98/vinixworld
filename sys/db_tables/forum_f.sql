CREATE TABLE `forum_f` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(32) NOT NULL,
  `pos` int(11) NOT NULL,
  `opis` varchar(512) NOT NULL,
  `adm` set('0','1') NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;