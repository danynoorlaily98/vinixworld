<?
include_once '../sys/inc/start.php';
include_once '../sys/inc/compress.php';
include_once '../sys/inc/sess.php';
include_once '../sys/inc/home.php';
include_once '../sys/inc/settings.php';
include_once '../sys/inc/db_connect.php';
include_once '../sys/inc/ipua.php';
include_once '../sys/inc/fnc.php';
include_once '../sys/inc/loads.php';
include_once '../sys/inc/adm_check.php';
include_once '../sys/inc/user.php';
user_access('adm_set_loads',null,'index.php?'.SID);
adm_check();

$set['title']='Downloads ReCount';
include_once '../sys/inc/thead.php';
title();

if (isset($_POST['go']) && isset($_POST['path']))
{
if (function_exists('set_time_limit'))@set_time_limit(600); // Ставим ограничение на 10 минут
$deleted=0; // количество удаленных файлов

if (isset($_POST['clear']) && $_POST['clear']==1)
{
$path=urldecode($_POST['path']);
$path=str_replace(H.'sys/loads/files', null, $path);
$path=(function_exists('iconv'))?iconv('windows-1251', 'utf-8', $path):$path;
$path='/'.eregi_replace('^/+|/+$', null, $path).'/';
mysql_query("DELETE FROM `loads_list` WHERE `path` LIKE '".my_esc($path)."%'");
}
else
{
$q=mysql_query("SELECT * FROM `loads_list`");
while ($list=mysql_fetch_array($q))
{
$file=(function_exists('iconv'))?iconv('utf-8', 'windows-1251', $list['path'].$list['name']):$list['path'].$list['name'];
if (!file_exists(H.'sys/loads/files'.$file))
{
mysql_query("DELETE FROM `loads_list` WHERE `path` = '".my_esc($list['path'])."' AND `name` = '".my_esc($list['name'])."' LIMIT 1");
$deleted++;
}
}
}


function recount_loads($dir)
{
global $added;
$opendir=opendir($dir);
while ($readdir=readdir($opendir)) {
if (!eregi("^\.|\.php|\.name$|\.txt$|\.opis$|\.html?$|\.sql$|\.ini$|\.db$|\.dat$|\.jad$",$readdir) && !ereg("\.JPG$|\.PNG$|\.GIF$",$readdir))
{
if (is_dir($dir.'/'.$readdir))
recount_loads($dir.'/'.$readdir);
elseif (is_file($dir.'/'.$readdir))
{
$path=str_replace(H.'sys/loads/files', null, $dir);
$path=(function_exists('iconv'))?iconv('windows-1251', 'utf-8', $path):$path;
$path='/'.eregi_replace('^/+|/+$', null, $path).'/';
$name=(function_exists('iconv'))?iconv('windows-1251', 'utf-8', $readdir):$readdir;
$size=filesize($dir.'/'.$readdir);
$file_time=filectime($dir.'/'.$readdir);

if (mysql_result(mysql_query("SELECT COUNT(*) FROM `loads_list` WHERE `name` = '".my_esc($name)."' AND `path` = '".my_esc($path)."' LIMIT 1"),0)==0)
{
mysql_query("INSERT INTO `loads_list` (`name`, `size`,  `path`, `time`) values('".my_esc($name)."', '$size', '".my_esc($path)."', '$file_time')");

$added++;
}
}
}
}
closedir($opendir);
}
$added=0; // Добавлено


recount_loads(urldecode($_POST['path']));
admin_log('Downloads','Loads recount',"Deleted $deleted / Added $added entries");
msg("Deleted $deleted / Added $added entries");
}
err();
//aut();


echo "<form method='post' action='?gen=$passgen'>\n";
echo "Directory:<br />\n";
echo "<select class=\"submit\" name=\"path\">";
echo "<option value='..%2Fsys%2Floads%2Ffiles'>Root</option>\n";
dirrs('../sys/loads/files','../sys/loads/files');
echo "</select><br />\n";
echo "<label><input type='checkbox' name='clear' value='1' /> Strip before recount</label><br />\n";
echo "<input type='submit' name='go' value='Start' />";
echo "</form>\n";

echo "* Part conversion of large number of file can be very load server, so if possible try to specific folder.<br />\n";

if (user_access('adm_set_loads') || user_access('adm_panel_show')){
echo "<div class='foot'>\n";
if (user_access('adm_set_loads'))
echo "&laquo;<a href='settings_loads.php'>Back</a><br />\n";
if (user_access('adm_panel_show'))
echo "&laquo;<a href='/adm_panel/'>Admin Panel</a><br />\n";
echo "</div>\n";
}
include_once '../sys/inc/tfoot.php';
?>
