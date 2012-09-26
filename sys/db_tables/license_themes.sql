CREATE TABLE IF NOT EXISTS `license_themes` (
  `id` int(10) unsigned NOT NULL,
  `autor` varchar(64) NOT NULL,
  `name` varchar(64) NOT NULL,
  `opis` text NOT NULL,
  `tr_name` varchar(64) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
