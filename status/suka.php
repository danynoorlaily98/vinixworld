<?php

// remodified by noe
// http://nnetwork.tk
// loegue.info@gmail.com
// hargailah privasi orang

include_once '../sys/inc/start.php';
include_once '../sys/inc/compress.php';
include_once '../sys/inc/sess.php';
include_once '../sys/inc/home.php';
include_once '../sys/inc/settings.php';
include_once '../sys/inc/db_connect.php';
include_once '../sys/inc/ipua.php';
include_once '../sys/inc/fnc.php';
include_once '../sys/inc/user.php';

$statuse=mysql_fetch_array(mysql_query("select * from `statuse_list` where `id`='".intval($_GET['id'])."';"));


$ank=get_user($statuse['id_user']);
$set['title']='Suka status - '.$ank['nick'].'';
include_once '../sys/inc/thead.php';
aut();
err();


if (isset($_GET['like']) && isset($user))
{
if (mysql_result(mysql_query("SELECT COUNT(*) FROM `statuse_like` WHERE `id_statuse` = '".intval($_GET['id'])."' AND `id_user` = '$user[id]' LIMIT 1"),0)!=0){} else {
mysql_query("INSERT INTO `statuse_like` (`id_user`, `id_statuse`) values('$user[id]', '".intval($_GET['id'])."')");}
//if (mysql_result(mysql_query("SELECT COUNT(*) FROM `statuse_who_komm` WHERE `id_statuse` = '".intval($_GET['id'])."' AND `id_user` = '$user[id]' LIMIT 1"),0)!=0){} else {
//mysql_query("INSERT INTO `statuse_who_komm` (`id_user`, `id_statuse`) values('$user[id]', '".intval($_GET['id'])."')");}
if(isset($user) && $user['id']!=$ank['id']){
$msgok="[img]/status/suka.gif[/img] [url=/info.php?id=$user[id]]$user[nick][/url] like on your [url=/list.php?id=$statuse[id]]status[/url].";
mysql_query("INSERT INTO `jurnal` (`id_user`, `id_kont`, `msg`, `time`) values('0', '$ank[id]', '$msgok', '$time')");}
header("Location: /list.php?id=$statuse[id]");
}
if (isset($_GET['tidak']) && isset($user))
{
mysql_query("DELETE FROM `statuse_like` WHERE `id_user` = '$user[id]' AND `id_statuse` = '".intval($_GET['id'])."' LIMIT 1");
msg('Anda tidak menyukai status ini');
header("Location: /home.php?".SID);
}
include_once '../sys/inc/tfoot.php';

?>
