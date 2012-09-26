CREATE TABLE IF NOT EXISTS `gifts` (
  `id_user` int(11) NOT NULL,
  `ot_id` int(11) NOT NULL,
  `time` varchar(50) NOT NULL,
  `id_gifts` int(11) NOT NULL,
  `text` varchar(120) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;