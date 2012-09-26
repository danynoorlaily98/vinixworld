CREATE TABLE `group_u` (
  `user` int(11) NOT NULL default '0',
  `id` int(11) default NULL,
  `time` int(11) NOT NULL,
  KEY `time` (`time`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=FIXED;