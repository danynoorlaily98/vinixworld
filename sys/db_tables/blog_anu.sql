CREATE TABLE IF NOT EXISTS `blog_anu` (
`id` int(11) NOT NULL auto_increment,
`id_user` int(11) NOT NULL,
`id_blog` varchar(50) NOT NULL,
PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
