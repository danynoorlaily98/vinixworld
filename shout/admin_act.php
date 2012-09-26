<?

// remodified by noe
// http://nnetwork.tk
// loegue.info@gmail.com
// hargailah privasi orang

/*/ Translated and modified by Deff www.airgears.kilu.de /*/
if (user_access('guest_clear')){
if (isset($_POST['write']) && isset($_POST['write2']))
{
$timeclear1=0;
if ($_POST['write2']=='sut')$timeclear1=$time-intval($_POST['write'])*60*60*24;
if ($_POST['write2']=='mes')$timeclear1=$time-intval($_POST['write'])*60*60*24*30;
$q = mysql_query("SELECT * FROM `shout` WHERE `time` < '$timeclear1'",$db);
$del_th=0;
while ($post = mysql_fetch_assoc($q))
{
mysql_query("DELETE FROM `shout` WHERE `id` = '$post[id]'",$db);
$del_th++;
}
mysql_query("OPTIMIZE TABLE `shout`",$db);
msg ("Posting $del_th terhapus");
}
}
?>
