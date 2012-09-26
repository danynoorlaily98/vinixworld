--
-- ????????? ??????? `blog`
--

CREATE TABLE IF NOT EXISTS `blog` (
  `blog_id` int(11) NOT NULL auto_increment,
  `user` text,
  `blog_title` text,
  `blog_content` text,
  PRIMARY KEY  (`blog_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- ????????? ??????? `blog_files`
--

CREATE TABLE IF NOT EXISTS `blog_files` (
  `id` int(11) NOT NULL auto_increment,
  `id_blog` int(11) NOT NULL,
  `name` varchar(64) default NULL,
  `ras` varchar(32) NOT NULL,
  `size` int(11) NOT NULL,
  `type` varchar(32) NOT NULL,
  `count` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `id_post` (`id_blog`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- ????????? ??????? `blog_img`
--

CREATE TABLE IF NOT EXISTS `blog_img` (
  `id` int(11) NOT NULL auto_increment,
  `id_blog` int(11) NOT NULL,
  `name` varchar(64) default NULL,
  `ras` varchar(32) NOT NULL,
  `size` int(11) NOT NULL,
  `type` varchar(32) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `id_post` (`id_blog`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- ????????? ??????? `blog_komm`
--

CREATE TABLE IF NOT EXISTS `blog_komm` (
  `id` int(11) NOT NULL auto_increment,
  `id_user` int(11) NOT NULL,
  `id_blog` varchar(50) NOT NULL,
  `msg` varchar(1024) NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- ????????? ??????? `blog_list`
--

CREATE TABLE IF NOT EXISTS `blog_list` (
  `id` int(11) NOT NULL auto_increment,
  `id_user` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `msg` varchar(5000) NOT NULL,
  `time` int(11) NOT NULL,
  `privat` int(11) NOT NULL,
  `count` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------