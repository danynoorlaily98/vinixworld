CREATE TABLE `poke_profil` (
  `id` int(11) NOT NULL auto_increment,
  `id_user` int(11) NOT NULL,
  `id_poke` int(11) NOT NULL,
  `msg` varchar(300) NOT NULL,
  `time` int(11) NOT NULL,
  `read` set('0','1') NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;