CREATE TABLE IF NOT EXISTS `smiles_grim` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(11) NOT NULL,
  `id_dir` int(50) NOT NULL,
  `sim` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;