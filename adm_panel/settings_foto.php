<?
include_once '../sys/inc/start.php';
include_once '../sys/inc/compress.php';
include_once '../sys/inc/sess.php';
include_once '../sys/inc/home.php';
include_once '../sys/inc/settings.php';
$temp_set=$set;
include_once '../sys/inc/db_connect.php';
include_once '../sys/inc/ipua.php';
include_once '../sys/inc/fnc.php';
include_once '../sys/inc/adm_check.php';
include_once '../sys/inc/user.php';
user_access('adm_set_foto',null,'index.php?'.SID);
adm_check();
$set['title']='Galleries Preference';
include_once '../sys/inc/thead.php';
title();
if (isset($_POST['save']))
{
$temp_set['max_upload_foto_x']=intval($_POST['max_upload_foto_x']);
$temp_set['max_upload_foto_y']=intval($_POST['max_upload_foto_y']);

if (save_settings($temp_set))
{
admin_log('Settings','Gallery','Changing photo gallery');
msg('Settings successfully adopted');
}
else
$err='No rights to change the settings';
}
err();
//aut();



echo "<form method=\"post\" action=\"?\">\n";

echo "Widht (max):<br />\n<input type='text' name='max_upload_foto_x' value='$temp_set[max_upload_foto_x]' /><br />\n";
echo "Height (max):<br />\n<input type='text' name='max_upload_foto_y' value='$temp_set[max_upload_foto_y]' /><br />\n";

echo "<input value=\"Edit\" name='save' type=\"submit\" />\n";
echo "</form>\n";

if (user_access('adm_panel_show')){
echo "<div class='foot'>\n";
echo "&laquo;<a href='/adm_panel/'>Admin Panel</a><br />\n";
echo "</div>\n";
}
include_once '../sys/inc/tfoot.php';
?>
