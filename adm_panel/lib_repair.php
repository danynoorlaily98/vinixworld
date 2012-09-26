<?
include_once '../sys/inc/start.php';
include_once '../sys/inc/compress.php';
include_once '../sys/inc/sess.php';
include_once '../sys/inc/home.php';
include_once '../sys/inc/settings.php';
include_once '../sys/inc/db_connect.php';
include_once '../sys/inc/ipua.php';
include_once '../sys/inc/fnc.php';
include_once '../sys/inc/adm_check.php';
include_once '../sys/inc/user.php';
user_access('adm_lib_repair',null,'index.php?'.SID);
adm_check();
$set['title']='Восстановление библиотеки';
include_once '../sys/inc/thead.php';
title();


if (isset($_GET['ok']) && isset($_POST['accept']))
{
$rep=array();
$del=array();
$k_dir=0;
$cicle=0;
// правка путей
$q=mysql_query("SELECT * FROM `lib_dir`");
while($directory=mysql_fetch_assoc($q))
{
$k_dir++;
$dir=ereg_replace('/+','/','/'.$directory['dir'].'/');
$dir_osn=ereg_replace('/+','/','/'.$directory['dir_osn'].'/');
$name=preg_replace('#[^A-zА-я0-9\(\)\-\_\ \.\?]#ui', null, $directory['name']);
mysql_query("UPDATE `lib_dir` SET `name`='$name', `dir`='$dir', `dir_osn` = '$dir_osn' WHERE `id` = '$directory[id]' LIMIT 1");
}

function rep_lib(){
global $del,$rep,$cicle;
$cicle++;
// проверка оснований
$q=mysql_query("SELECT * FROM `lib_dir` WHERE `dir_osn` != '/'");
while($directory=mysql_fetch_assoc($q))
{
if (mysql_result(mysql_query("SELECT COUNT(*) FROM `lib_dir` WHERE `dir` = '$directory[dir_osn]' AND `id` != '$directory[id]'"),0)==0)
{
if (mysql_result(mysql_query("SELECT COUNT(*) FROM `lib_dir` WHERE `dir_osn` = '$directory[dir]' AND `id` != '$directory[id]'"),0)==0
&& mysql_result(mysql_query("SELECT COUNT(*) FROM `lib_files` WHERE `id_dir` = '$directory[id]'"),0)==0)
{
$new=true;
$del[$directory['id']]=true;
mysql_query("DELETE FROM `lib_dir` WHERE `id` = '$directory[id]' LIMIT 1");
}
else
{
$name=preg_replace('#[^A-zА-я0-9\(\)\-\_\ \.\?]#ui', null, $directory['name']);
if ($name==null)$name='repair-'.passgen(); // случайное название
mysql_query("UPDATE `lib_dir` SET `name`='$name', `dir`='/".tr_loads(retranslit($name))."/', `dir_osn` = '/' WHERE `id` = '$directory[id]' LIMIT 1");
$new=true;
$rep[$directory['id']]=true;
}
}
}

if (isset($new) && $cicle<10)rep_lib(); // повторяем до тех пор, пока не будут исправлены все папки
}

rep_lib();

if ($k_dir==mysql_result(mysql_query("SELECT COUNT(*) FROM `lib_dir`"),0) && $cicle==1 && count($del)==0 && count($rep)==0)
{
admin_log('Библиотека','Диагностика',"Неполадок не обнаружено. Папок: $k_dir");
msg("Неполадок не обнаружено. Папок: $k_dir");
}
else
{
admin_log('Библиотека','Ремонт',"Исправление структуры");
msg("Найдено папок: $k_dir");
msg("Сканирований: ".$cicle);
msg("Удалено папок: ".count($del));
msg("Восстановлено папок: ".count($rep));
msg("Осталось папок: ".mysql_result(mysql_query("SELECT COUNT(*) FROM `lib_dir`"),0));
}



}
err();
//aut();

echo "<form method='post' action='?ok&amp;$passgen'>\n";
echo "<input value='Начать' name='accept' type='submit' />\n";
echo "</form>\n";


echo "* Рекомендуется использовать только в случах расхождений счетчиков с реальными данными<br />\n";

if (user_access('adm_panel_show')){
echo "<div class='foot'>\n";
echo "&laquo;<a href='/adm_panel/'>В админку</a><br />\n";
echo "</div>\n";
}

include_once '../sys/inc/tfoot.php';
?>
