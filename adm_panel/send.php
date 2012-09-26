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
include_once '../sys/inc/user.php';
only_level(1);

$set['title']='Newsletter Mail';
include_once '../sys/inc/thead.php';
//title();

if (isset($_POST['save']) && isset($_POST['msg']))
{
if($_POST['to'] == 'mod')
{
$filter =  "AND `group_access`>'1'";
}
else
$filter = '';

$msg=$_POST['msg'];
if (isset($_POST['translit']) && $_POST['translit']==1)
$msg=translit($msg);
if (strlen2($msg)>1024)
$err='Pesan terlalu panjang. Max 1024 karakter';
if (strlen2($msg)<2)
$err='Pesan terlalu singkat';
if (!isset($err))
{
$q=mysql_query("SELECT `id` FROM `user` WHERE `id` != $user[id] $filter");
$msg=mysql_escape_string($msg);
while ($us = mysql_fetch_array($q))
{


if (mysql_result(mysql_query("SELECT COUNT(*) FROM `konts` WHERE `id_user` = '$us[id]' AND `id_kont` = '$user[id]'"), 0)==0)
{
mysql_query("INSERT INTO `konts` (`id_kont`, `id_user`, `time`) values('$user[id]', '$us[id]', '$time')");

}



mysql_query("INSERT INTO `mail` (`id_user`, `id_kont`, `msg`, `time`) values('$user[id]', '$us[id]', '$msg', '$time')");
mysql_query("UPDATE `konts` SET `time` = '$time' WHERE `id_user` = '$user[id]' AND `id_kont` = '$ank[id]' OR `id_user` = '$ank[id]' AND `id_kont` = '$user[id]'");
}
msg('Berhasil dikirim');
}
}
err();
//aut();


$count=mysql_result(mysql_query("SELECT COUNT(*) FROM `user`"),0);

$adm=mysql_result(mysql_query("SELECT COUNT(*) FROM `user` WHERE `group_access` > '1'"),0);

echo'Jumlah Member: <b>'.$count.'</b><br/>';
echo'Jumlah Administrator: <b>'.$adm.'</b><br/>';

echo "<form method=\"post\" action=\"?\">\n";
echo "Pesan:<br />\n<textarea name=\"msg\"></textarea><br />\n";
if ($user['set_translit']==1)
echo "<input type=\"checkbox\" name=\"translit\" value=\"1\" /> Translate<br />\n";
echo 'TO: <select name="to">
<option value="">All Member</option>
<option value="mod">Only Administrator</option>
</select><br/>';
echo "<input value=\"Send\" name='save' type=\"submit\" />\n";
echo "</form>\n";

echo "<div class='foot'>\n";

echo "&laquo;<a href='/adm_panel/'>Admin Panel</a><br />\n";
echo "</div>\n";

include_once '../sys/inc/tfoot.php';
?>
