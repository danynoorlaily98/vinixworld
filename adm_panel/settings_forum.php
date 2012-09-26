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
user_access('adm_set_forum',null,'index.php?'.SID);
adm_check();

$set['title']='Forum Preferences';
include_once '../sys/inc/thead.php';
title();
if (isset($_POST['save']))
{
if ($_POST['show_num_post']==1 || $_POST['show_num_post']==0)
{
$temp_set['show_num_post']=intval($_POST['show_num_post']);
}

if ($_POST['echo_rassh_forum']==1 || $_POST['echo_rassh_forum']==0)
{
$temp_set['echo_rassh_forum']=intval($_POST['echo_rassh_forum']);
}

if ($_POST['forum_counter']==1 || $_POST['forum_counter']==0)
{
$temp_set['forum_counter']=intval($_POST['forum_counter']);
}
if (save_settings($temp_set))
{
admin_log('Settings','Forum','Changing forum');
msg('Settings successfully adopted');
}
else
$err='No rights to change the settings';
}
err();
//aut();


echo "<form method=\"post\" action=\"?\">\n";

echo "The numbering of the posts in the forum:<br />\n<select name=\"show_num_post\">\n";
if ($temp_set['show_num_post']==1)$sel=' selected="selected"';else $sel=NULL;
echo "<option value=\"1\"$sel>Show</option>\n";
if ($temp_set['show_num_post']==0)$sel=' selected="selected"';else $sel=NULL;
echo "<option value=\"0\"$sel>Hide</option>\n";
echo "</select><br />\n";

echo "Counter Forum:<br />\n<select name=\"forum_counter\">\n";
if ($temp_set['forum_counter']==1)$sel=' selected="selected"';else $sel=NULL;
echo "<option value=\"1\"$sel>Users</option>\n";
if ($temp_set['forum_counter']==0)$sel=' selected="selected"';else $sel=NULL;
echo "<option value=\"0\"$sel>Posts/Topics</option>\n";
echo "</select><br />\n";



echo "Display file extensions:<br />\n<select name=\"echo_rassh_forum\">\n";
if ($temp_set['echo_rassh_forum']==1)$sel=' selected="selected"';else $sel=NULL;
echo "<option value=\"1\"$sel>Show</option>\n";
if ($temp_set['echo_rassh_forum']==0)$sel=' selected="selected"';else $sel=NULL;
echo "<option value=\"0\"$sel>Hide*</option>\n";
echo "</select><br />\n";
echo "*Remains only if there is a suitable icon<br />\n";



echo "<input value=\"Edit\" name='save' type=\"submit\" />\n";
echo "</form>\n";

if (user_access('adm_panel_show')){
echo "<div class='foot'>\n";
if (user_access('adm_forum_sinc'))
echo "&raquo;<a href='/adm_panel/forum_sinc.php'>Tables Forum Sync</a><br />\n";
echo "&laquo;<a href='/adm_panel/'>Admin Panel</a><br />\n";
echo "</div>\n";
}
include_once '../sys/inc/tfoot.php';
?>
