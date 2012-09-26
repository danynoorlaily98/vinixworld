CREATE TABLE IF NOT EXISTS `all_accesses` (
  `type` varchar(32) NOT NULL,
  `name` varchar(64) NOT NULL,
  KEY `type` (`type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `all_accesses` (`type`, `name`) VALUES
('adm_panel_show', 'Admin - access to the admin section'),
('loads_file_upload', 'Downloads - Upload files'),
('loads_dir_mesto', 'Downloads - Moving folder'),
('loads_dir_delete', 'Downloads - Deleting folder'),
('loads_dir_rename', 'Downloads - Rename folder'),
('loads_dir_create', 'Downloads - Create folder'),
('loads_file_edit', 'Downloads - Edit files'),
('loads_file_delete', 'Downloads - Delete files'),
('lib_stat_zip', 'Library - Uploading articles in ZIP'),
('lib_stat_txt', 'Library - Uploading articles in txt'),
('lib_stat_create', 'Library - Create articles'),
('lib_dir_delete', 'Library - Deleting folder'),
('lib_dir_mesto', 'Library - Moving folder'),
('lib_dir_edit', 'Library - Edit folder'),
('lib_dir_create', 'Library - Create folder'),
('lib_stat_delete', 'Library - Delete articles'),
('votes_settings', 'Polls - Closing/Remove'),
('votes_create', 'Polls - Creating'),
('guest_clear', 'Guestbook - Clean'),
('guest_delete', 'Guestbook - Delete posts'),
('obmen_dir_delete', 'Shared - Delete folder'),
('obmen_dir_edit', 'Shared - Edit folder'),
('obmen_dir_create', 'Shared - Create folder'),
('obmen_file_delete', 'Shared - Delete files'),
('obmen_komm_del', 'Shared - Delete comments'),
('foto_foto_edit', 'Photo Gallery - Edit/delete photo'),
('foto_alb_del', 'Photo Gallery - Delete albums'),
('forum_razd_create', 'Forum - Partitioning'),
('forum_for_delete', 'Forum - Removing Subforum'),
('forum_for_edit', 'Forum - Editing Subforum'),
('forum_for_create', 'Forum - Create Subforum'),
('forum_razd_edit', 'Forum - Management section'),
('adm_info', 'Admin - General Information'),
('adm_license_support', 'License - Support'),
('forum_them_edit', 'Forum - Edit topic'),
('forum_them_del', 'Forum - Delete topic'),
('forum_post_ed', 'Forum - Editing posts'),
('chat_clear', 'Chat - Clean'),
('chat_room', 'Chat - Control rooms'),
('adm_statistic', 'Admin - Statistics'),
('adm_banlist', 'Admin - List of banned'),
('adm_menu', 'Admin - Main Menu'),
('adm_news', 'Admin - News'),
('adm_rekl', 'Admin - Advertising'),
('adm_set_sys', 'Admin - System Configuration'),
('adm_set_loads', 'Admin - Download settings'),
('adm_set_user', 'Admin - Custom settings'),
('adm_set_chat', 'Admin - Chat configuration'),
('adm_set_forum', 'Admin - Forum settings'),
('adm_set_foto', 'Admin - Galleries settings'),
('adm_forum_sinc', 'Admin - Tables forum sync'),
('adm_themes', 'Admin - Themes configuration'),
('adm_mysql', 'Admin - MySQL queries !!!'),
('adm_ref', 'Admin - Referrals'),
('adm_show_adm', 'Admin - List of Admin'),
('adm_ip_edit', 'Admin - Edit IP'),
('adm_ban_ip', 'Admin - Ban by IP'),
('adm_accesses', 'Privileges users group !!!'),
('user_delete', 'Users - Delete'),
('user_mass_delete', 'Users - Mass delete'),
('user_ban_set', 'Users - Ban'),
('user_ban_unset', 'Users - Unban'),
('user_prof_edit', 'Users - Edit profile'),
('user_collisions', 'Users - Collisions'),
('user_show_ip', 'Users - Show IP'),
('user_show_ua', 'Users - Show USER-AGENT'),
('user_show_add_info', 'Show extra informations'),
('guest_show_ip', 'Users -  Show IP'),
('user_change_group', 'Users - Changing group privileges'),
('user_ban_set_h', 'Users - ban (max 1 day)'),
('forum_post_close', 'Forum - Close forum'),
('user_change_nick', 'Users - Change nickname'),
('loads_file_import', 'Downloads - Import file'),
('lic_themes', 'License - with the dcms.su theme'),
('lic_update', 'Updata engine'),
('lic_info', 'License Information'),
('adm_lib_repair', 'Restore the library');
