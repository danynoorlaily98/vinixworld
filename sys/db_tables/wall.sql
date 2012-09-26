CREATE TABLE IF NOT EXISTS `wall` (
  `id` int(6) NOT NULL auto_increment,
  `user_id` int(6) NOT NULL,
  `who` int(6) NOT NULL,
  `time` int(11) NOT NULL,
  `message` text NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;