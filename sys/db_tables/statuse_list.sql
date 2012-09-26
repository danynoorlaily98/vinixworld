CREATE TABLE IF NOT EXISTS `statuse_list` (
`id` int(11) NOT NULL auto_increment,
`id_user` int(11) NOT NULL,
`name` varchar(50) NOT NULL,
`msg` varchar(5000) NOT NULL,
`time` int(11) NOT NULL,
`privat` int(11) NOT NULL,
`count` int(11) NOT NULL default '0',
`kategori` int(11) NOT NULL default '0',
`cat` int(11) NOT NULL default '0',
PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
