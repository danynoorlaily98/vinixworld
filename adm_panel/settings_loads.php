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
user_access('adm_set_loads',null,'index.php?'.SID);
adm_check();
$set['title']='Download Preferences';
include_once '../sys/inc/thead.php';
title();
if (isset($_POST['save']))
{
$temp_set['downloads_select']=intval($_POST['downloads_select']);
$temp_set['obmen_limit_up']=intval($_POST['obmen_limit_up']);
$temp_set['loads_new_file_hour']=intval($_POST['loads_new_file_hour']);

if ($_POST['echo_rassh']==1 || $_POST['echo_rassh']==0)
{
$temp_set['echo_rassh']=intval($_POST['echo_rassh']);
}

if (is_file(H.$_POST['copy_path']) || $_POST['copy_path']==null)
{
$temp_set['copy_path']=$_POST['copy_path'];
}

if (save_settings($temp_set))
{

admin_log('Settings','Downloads','Changing the App Center');
msg('Setting has been successfully added');
}
else
$err='No rights to change the settings';
}
err();
//aut();


echo "<form method=\"post\" action=\"?\">\n";

echo "Download Mode:<br />\n<select name=\"downloads_select\">\n";
echo "<option value=\"0\">Allow All</option>\n";
if ($temp_set['downloads_select']=='1')$sel=' selected="selected"';else $sel=NULL;
echo "<option value=\"1\"$sel>Member Only</option>\n";
if ($temp_set['downloads_select']=='2')$sel=' selected="selected"';else $sel=NULL;
echo "<option value=\"2\"$sel>Member with 100 points</option>\n";
echo "</select><br />\n";



echo "Display file extensions:<br />\n<select name=\"echo_rassh\">\n";
if ($temp_set['echo_rassh']==1)$sel=' selected="selected"';else $sel=NULL;
echo "<option value=\"1\"$sel>Show</option>\n";
if ($temp_set['echo_rassh']==0)$sel=' selected="selected"';else $sel=NULL;
echo "<option value=\"0\"$sel>Hide</option>\n";
echo "</select><br />\n";


echo "Time during wich the file is considered new (hours):<br />\n<input type='text' name='loads_new_file_hour' value='$temp_set[loads_new_file_hour]' /><br />\n";

echo "File copyright(pictured):<br />\n<input type='text' name='copy_path' value='$temp_set[copy_path]' /><br />\n";

echo "Exchanged (the restriction in number to upload files):<br />\n<input name=\"obmen_limit_up\" value=\"$temp_set[obmen_limit_up]\" type=\"text\" /><br />\n";

echo "<input value=\"Edit\" name='save' type=\"submit\" />\n";
echo "</form>\n";

echo "<div class='foot'>\n";
echo "&raquo;<a href='loads_recount.php'>Download Recount</a><br />\n";
echo "</div>\n";
if (user_access('adm_panel_show'))
{
echo "<div class='foot'>\n";
echo "&laquo;<a href='/adm_panel/'>Admin Panel</a><br />\n";
echo "</div>\n";
}
include_once '../sys/inc/tfoot.php';
?>
