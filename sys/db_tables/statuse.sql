CREATE TABLE IF NOT EXISTS `statuse` (
`statuse_id` int(11) NOT NULL auto_increment,
`user` text,
`statuse_title` text,
`statuse_content` text,
PRIMARY KEY  (`statuse_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;