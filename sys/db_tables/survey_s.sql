CREATE TABLE `survey_s` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `surv` varchar(1024) NOT NULL,
  `time` int(11) NOT NULL,
  `time_close` int(11) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `time_close` (`time_close`),
  KEY `time` (`time`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
