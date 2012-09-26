ALTER TABLE `forum_p` ADD FULLTEXT (`msg`);
ALTER TABLE `forum_t` ADD FULLTEXT (`name`);
ALTER TABLE `user` ADD INDEX ( `set_them` , `set_them2` );
ALTER TABLE `menu` CHANGE `url` `url` VARCHAR( 1024 ) CHARACTER SET utf8 COLLATE utf8_general_ci;
ALTER TABLE `all_accesses` DROP INDEX `type` , ADD UNIQUE (`type`);


INSERT INTO `all_accesses` ( `type` , `name` ) VALUES ('loads_unzip', 'Загрузки - Распаковка ZIP');
INSERT INTO `all_accesses` ( `type` , `name` ) VALUES ('adm_log_read', 'Админка - лог действий администрации');
INSERT INTO `all_accesses` ( `type` , `name` ) VALUES ('adm_log_delete', 'Админка - удаление лога');


INSERT INTO `user_group_access` ( `id_group` , `id_access` ) VALUES
('4', 'loads_unzip'),
('8', 'loads_unzip'),
('9', 'loads_unzip'),
('15', 'loads_unzip'),
('15', 'adm_log_delete'),
('15', 'adm_log_read'),
('9', 'adm_log_read');
DROP TABLE IF EXISTS `users_konts`;
ALTER TABLE `konts` RENAME  `users_konts` ;
ALTER TABLE `users_konts` ADD  `new_msg` INT DEFAULT  '0' NOT NULL , ADD  `type` ENUM(  'common',  'ignor',  'favorite',  'deleted' ) DEFAULT  'common' NOT NULL , ADD  `name` VARCHAR( 64 ) default NULL ;
ALTER TABLE `users_konts` ADD UNIQUE (`id_user` ,`id_kont`);
