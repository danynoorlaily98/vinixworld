CREATE TABLE `obmennik_dir` (
  `id` int(11) NOT NULL auto_increment,
  `num` int(11) default '0',
  `name` varchar(64) NOT NULL,
  `ras` varchar(128) NOT NULL,
  `maxfilesize` int(11) NOT NULL,
  `dir` varchar(512) NOT NULL default '/',
  `dir_osn` varchar(512) default '/',
  `upload` set('1','0') NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `num` (`num`),
  KEY `dir` (`dir`(333))
) ENGINE=MyISAM DEFAULT CHARSET=utf8;