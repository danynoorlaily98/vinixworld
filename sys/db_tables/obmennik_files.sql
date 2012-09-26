CREATE TABLE `obmennik_files` (
  `id` int(11) NOT NULL auto_increment,
  `id_user` int(11) NOT NULL,
  `id_dir` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `ras` varchar(36) NOT NULL,
  `type` varchar(64) NOT NULL,
  `time` int(11) NOT NULL,
  `time_last` int(11) NOT NULL,
  `size` int(11) NOT NULL,
  `k_loads` int(11) default '0',
  `opis` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;