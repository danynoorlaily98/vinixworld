CREATE TABLE IF NOT EXISTS `smiles_zanger` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(30) default 'NULL',
  `pos` int(11) default '0',
  `level` int(11) default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

INSERT INTO `smiles_zanger` (`id`, `name`, `pos`) VALUES
(2, 'Monkey style', 2),
(3, 'Union', 1),
(4, 'Big Emotion', 1),
(5, 'Others', 3),
(6, 'frendzmobile.co.cc style', 5);