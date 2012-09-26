CREATE TABLE `chat_vopros` (
  `id` int(11) NOT NULL auto_increment,
  `vopros` varchar(1024) NOT NULL,
  `otvet` varchar(32) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
INSERT INTO `chat_vopros` VALUES (2, 'Strong heat.', 'Heat'),
(3, 'Belt, a territory with any common features.', 'Zone'),
(4, 'Medical device for studying the innards of the body.', 'Probe'),
(5, 'Meteorological ballon.', 'Probe'),
(6, 'Large wild forest ox.', 'Bison'),
(7, 'Light ripples on the surface of water.', 'Sweel'),
(8, 'The south wind, south', 'South'),
(9, 'Field, plowed the fall for spring planting.', 'Plowland'),
(10, 'Thougt, intention, plan.', 'Idea'),