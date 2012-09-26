<?

if (isset($_POST['write']) && isset($_POST['write2']))
{
$timeclear1=0;
if ($_POST['write2']=='sut')$timeclear1=$time-intval($_POST['write'])*60*60*24;
if ($_POST['write2']=='mes')$timeclear1=$time-intval($_POST['write'])*60*60*24*30;
$q = mysql_query("SELECT * FROM `private_chat` WHERE `time` < '$timeclear1'",$db);
$del_th=0;
while ($post = mysql_fetch_array($q))
{
mysql_query("DELETE FROM `private_chat` WHERE `id` = '$post[id]'",$db);
$del_th++;
}
mysql_query("OPTIMIZE TABLE `private_chat`",$db);
msg ("Удалено $del_th постов");
}
?>