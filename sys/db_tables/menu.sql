CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(11) NOT NULL auto_increment,
  `type` enum('link','razd') NOT NULL default 'link',
  `name` varchar(32) NOT NULL,
  `url` varchar(32) NOT NULL,
  `counter` varchar(32) NOT NULL,
  `pos` int(11) NOT NULL,
  `icon` varchar(32) default NULL,
  PRIMARY KEY  (`id`),
  KEY `pos` (`pos`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Main Menu';

INSERT INTO `menu` (`id`, `type`, `name`, `url`, `counter`, `pos`, `icon`) VALUES
(1, 'link', 'News', '/news/', 'news/count.php', 1, 'news.png'),
(2, 'link', 'ChatBox', '/chat/', 'chat/count.php', 3, 'chat.png'),
(3, 'link', 'Downloads', '/loads/', 'loads/count.php', 7, 'loads.png'),
(4, 'link', 'GuestBook', '/guest/', 'guest/count.php', 5, 'guest.png'),
(5, 'link', 'Exchange', '/obmen/', 'obmen/count.php', 9, 'obmen.png'),
(6, 'link', 'Forum', '/forum/', 'forum/count.php', 4, 'forum.png'),
(7, 'link', 'Gallery', '/foto/', 'foto/count.php', 11, 'foto.png'),
(8, 'link', 'Polling', '/votes/', 'votes/count.php', 12, 'votes.png'),
(9, 'link', 'Library', '/lib/', 'lib/count.php', 13, 'lib.png'),
(10, 'razd', 'Communicate', '', '', 2, 'default.png'),
(11, 'razd', 'Download Area', '', '', 6, 'default.png'),
(12, 'razd', 'Miscellaneous', '', '', 10, 'default.png');
