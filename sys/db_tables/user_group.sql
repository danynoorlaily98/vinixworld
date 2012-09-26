CREATE TABLE IF NOT EXISTS `user_group` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(32) NOT NULL,
  `level` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;

INSERT INTO `user_group` (`id`, `name`, `level`) VALUES
(1, 'User', 0),
(2, 'Chat Moderator', 1),
(3, 'Forum Moderator', 1),
(4, 'Moderator Download', 1),
(5, 'Libraries Moderator', 1),
(6, 'Galleries Moderator', 1),
(7, 'Super Moderator', 2),
(8, 'Administrator', 3),
(9, 'Chief Administrator', 9),
(15, 'Owner', 10);
