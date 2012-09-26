CREATE TABLE `forum_t` (
  `id` int(11) NOT NULL auto_increment,
  `id_forum` int(11) NOT NULL,
  `id_razdel` int(11) default NULL,
  `name` varchar(32) NOT NULL,
  `id_user` int(11) default NULL,
  `time_create` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `up` set('0','1') NOT NULL default '0',
  `close` set('0','1') NOT NULL default '0',
  PRIMARY KEY  (`id`),
  FULLTEXT KEY `name` (`name`),
  KEY `id_forum` (`id_forum`,`id_razdel`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;