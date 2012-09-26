CREATE TABLE IF NOT EXISTS `loads_list` (
  `name` varchar(256) NOT NULL,
  `size` int(11) NOT NULL,
  `path` varchar(1000) NOT NULL DEFAULT '/',
  `time` int(11) NOT NULL,
  `loads` int(11) NOT NULL DEFAULT '0',
  KEY `time` (`time`),
  KEY `size` (`size`),
  KEY `name` (`name`),
  KEY `loads` (`loads`),
  FULLTEXT KEY `path_2` (`path`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;