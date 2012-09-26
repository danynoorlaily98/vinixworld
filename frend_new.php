<?

// Translated by : zanger
// Site : http://www.frendzmobile.co.cc

// remodified by noe
// http://nnetwork.tk
// loegue.info@gmail.com
// hargailah privasi orang

include_once 'sys/inc/start.php';
include_once 'sys/inc/compress.php';
include_once 'sys/inc/sess.php';
include_once 'sys/inc/home.php';
include_once 'sys/inc/settings.php';
include_once 'sys/inc/db_connect.php';
include_once 'sys/inc/ipua.php';
include_once 'sys/inc/fnc.php';
include_once 'sys/inc/user.php';
only_reg();

$ank['id']=$user['id'];

if (isset($_GET['ok']))
{
$ok = intval($_GET['ok']);
if (mysql_result(mysql_query("SELECT COUNT(*) FROM `user` WHERE `id` = '$ok' LIMIT 1"),0)==0){header("Location: index.php?");exit;}
mysql_query("INSERT INTO `frends` (`user`, `frend`, `time`, `i`) values('$ank[id]', '$ok', '$time', '1')");
mysql_query("INSERT INTO `frends` (`user`, `frend`, `time`, `i`) values('$ok', '$ank[id]', '$time', '1')");
mysql_query("DELETE FROM `frends_new` WHERE `user` = '$ok' AND `to` = '$user[id]' LIMIT 1");
mysql_query("DELETE FROM `frends_new` WHERE `user` = '$user[id]' AND `to` = '$ok' LIMIT 1");
mysql_query("OPTIMIZE TABLE `frends`");
mysql_query("OPTIMIZE TABLE `frends_new`");

$ind=mysql_result(mysql_query("SELECT `id` FROM `user` WHERE `id`='$ok' LIMIT 1"),0);
$adds=mysql_result(mysql_query("SELECT `nick` FROM `user` WHERE `id`='$ok' LIMIT 1"),0);
$teman='[url=/info.php?id='.$ind.'][b]'.$adds.'[/b][/url] [img]/sys/avatar/'.$ind.'.jpg[/img]';

mysql_query("INSERT INTO `statuse_list` (`id_user`, `msg`, `time`, `kategori`) VALUES('$user[id]', '[time]now friends with[/time] $teman', '$time', '1')");

$msgok="[img]/style/icon/f_n.png[/img][url=/info.php?id=$user[id]][b]$user[nick][/b][/url] receive your request";
mysql_query("INSERT INTO `jurnal` (`id_user`, `id_kont`, `msg`, `time`) values('0', '$ok', '$msgok', '$time')");

header("Location: frend.php?".SID);
exit;
}
if (isset($_GET['no']))
{
$no = intval($_GET['no']);
if (mysql_result(mysql_query("SELECT COUNT(*) FROM `user` WHERE `id` = '$no' LIMIT 1"),0)==0){header("Location: index.php?");exit;}
mysql_query("DELETE FROM `frends` WHERE `user` = '$user[id]' AND `frend` = '$no' LIMIT 1");
mysql_query("DELETE FROM `frends` WHERE `user` = '$no' AND `frend` = '$user[id]' LIMIT 1");
mysql_query("DELETE FROM `frends_new` WHERE `user` = '$no' AND `to` = '$user[id]' LIMIT 1");
mysql_query("DELETE FROM `frends_new` WHERE `user` = '$user[id]' AND `to` = '$no' LIMIT 1");
mysql_query("OPTIMIZE TABLE `frends`");
mysql_query("OPTIMIZE TABLE `frends_new`");

$msgno="Error ! [url=/info.php?id=$user[id]][b]$user[nick][/b][/url] Refused friend request";
mysql_query("INSERT INTO `jurnal` (`id_user`, `id_kont`, `msg`, `time`) values('0', '$no', '$msgno', '$time')");


header("Location: frend_new.php?".SID);
exit;
}
if (isset($_GET['del']))
{
$no = intval($_GET['del']);
if (mysql_result(mysql_query("SELECT COUNT(*) FROM `user` WHERE `id` = '$no' LIMIT 1"),0)==0){header("Location: index.php?");exit;}
mysql_query("DELETE FROM `frends` WHERE `user` = '$user[id]' AND `frend` = '$no' LIMIT 1");
mysql_query("DELETE FROM `frends` WHERE `user` = '$no' AND `frend` = '$user[id]' LIMIT 1");
mysql_query("DELETE FROM `frends_new` WHERE `user` = '$no' AND `to` = '$user[id]' LIMIT 1");
mysql_query("DELETE FROM `frends_new` WHERE `user` = '$user[id]' AND `to` = '$no' LIMIT 1");
mysql_query("OPTIMIZE TABLE `frends`");
mysql_query("OPTIMIZE TABLE `frends_new`");

$msgno="Error ! [url=/info.php?id=$user[id]][b]$user[nick][/b][/url] Remove friend from your friend list!";
mysql_query("INSERT INTO `jurnal` (`id_user`, `id_kont`, `msg`, `time`) values('0', '$no', '$msgno', '$time')");

header("Location: frend.php?".SID);
exit;
}


$set['title'] = 'List friends';
include_once 'sys/inc/thead.php';
//title();


if ($ank['id']==$user['id'])
{
echo "<div class='penanda'>";
echo '<a href="frend.php">Friends</a>';
echo "</div>";
}
$m = date('m', $time);
if (substr($m, 0, 1) == 0)$m = str_replace('0', '', $m);
$d = date('d', $time);
$k_f = mysql_result(mysql_query("SELECT COUNT(id) FROM `frends_new` WHERE `to` = '$user[id]' LIMIT 1"), 0);

if ($k_f==0)echo '<div class="p_m">No friends request</div>';

$q = mysql_query("SELECT * FROM `frends_new` WHERE `to` = '$user[id]' ORDER BY time DESC");
while ($f = mysql_fetch_array($q))
{
$a = mysql_fetch_array(mysql_query("SELECT * FROM `user` WHERE `id` = '".$f['user']."' LIMIT 1"));
if($num==1){
echo "<div class='rowdown'>";
$num=0;
}else{
echo "<div class='rowup'>";
$num=1;}
echo "<table class='post'>\n";
echo "<tr><td class='icon14' rowspan='2'><a href='/info.php?id=$ank[id]'>";
avatar($a['id']);
echo "</a></td></tr>";
echo "<tr><td class='footer' valign='top'>";
echo '<a href="/info.php?id='.$a['id'].'">'.$a['nick'].'</a> ('.vremja($f['time']).')';
echo '<br /><a href="frend_new.php?ok='.$a['id'].'">Confirm</a> or <a href="frend_new.php?no='.$a['id'].'">Ignore</a>';
echo '</td></tr></table>';
echo "</div>";

}

include_once 'sys/inc/tfoot.php';
?>
