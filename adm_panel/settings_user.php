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
user_access('adm_set_user',null,'index.php?'.SID);
adm_check();

$set['title']='Users Costumization';
include_once '../sys/inc/thead.php';
title();
if (isset($_POST['save']))
{
if ($_POST['write_guest']==1 || $_POST['write_guest']==0)
{
$temp_set['write_guest']=intval($_POST['write_guest']);
}

if ($_POST['show_away']==1 || $_POST['show_away']==0)
{
$temp_set['show_away']=intval($_POST['show_away']);
}
if ($_POST['guest_select']==1 || $_POST['guest_select']==0)
{
$temp_set['guest_select']=intval($_POST['guest_select']);
}

$temp_set['reg_select']=esc($_POST['reg_select']);
if (save_settings($temp_set))
{
admin_log('Settings','Users',"Changing users settings");
msg('Settings successfully adopted');
}
else
$err='No right to change the settings';
}
err();
//aut();



echo "<form method=\"post\" action=\"?\">\n";

echo "Mode of registration:<br />\n<select name=\"reg_select\">\n";
echo "<option value=\"close\">Closed</option>\n";
if ($temp_set['reg_select']=='open')$sel=' selected="selected"';else $sel=NULL;
echo "<option value=\"open\"$sel>Open</option>\n";
if ($temp_set['reg_select']=='open_mail')$sel=' selected="selected"';else $sel=NULL;
echo "<option value=\"open_mail\"$sel>Open with Email</option>\n";
echo "</select><br />\n";

echo "Guest mode:<br />\n<select name=\"guest_select\">\n";
echo "<option value=\"0\">Open all</option>\n";
if ($temp_set['guest_select']=='1')$sel=' selected="selected"';else $sel=NULL;
echo "<option value=\"1\"$sel>Close all*</option>\n";
echo "</select><br />\n";
echo " *Remain open registration and authorization<br />\n";



echo "Display away:<br />\n<select name=\"show_away\">\n";
if ($temp_set['show_away']==1)$sel=' selected="selected"';else $sel=NULL;
echo "<option value=\"1\"$sel>Show</option>\n";
if ($temp_set['show_away']==0)$sel=' selected="selected"';else $sel=NULL;
echo "<option value=\"0\"$sel>Hide</option>\n";
echo "</select><br />\n";


echo "Write in Guestbook:<br />\n<select name=\"write_guest\">\n";
if ($temp_set['write_guest']==1)$sel=' selected="selected"';else $sel=NULL;
echo "<option value=\"1\"$sel>All</option>\n";
if ($temp_set['write_guest']==0)$sel=' selected="selected"';else $sel=NULL;
echo "<option value=\"0\"$sel>Member only</option>\n";
echo "</select><br />\n";


echo "<input value=\"Save\" name='save' type=\"submit\" />\n";
echo "</form>\n";

if (user_access('user_mass_delete')){
echo "<div class='foot'>\n";
echo "&raquo;<a href='/adm_panel/delete_users.php'>Deleting Users</a><br />\n";
echo "</div>\n";
}
if (user_access('adm_panel_show')){
echo "<div class='foot'>\n";
echo "&laquo;<a href='/adm_panel/'>Admin Panel</a><br />\n";
echo "</div>\n";
}
include_once '../sys/inc/tfoot.php';
?>
