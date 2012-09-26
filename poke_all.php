<?php
include_once 'sys/inc/start.php';
include_once 'sys/inc/compress.php';
include_once 'sys/inc/sess.php';
include_once 'sys/inc/home.php';
include_once 'sys/inc/settings.php';
include_once 'sys/inc/db_connect.php';
include_once 'sys/inc/ipua.php';
include_once 'sys/inc/fnc.php';
include_once 'sys/inc/user.php';


$set['title']='Poke Profil';
include_once 'sys/inc/thead.php';
title();
err();
//aut();

if (!isset($user) && !isset($_GET['id'])){header("Location: /index.php?".SID);exit;}
if (isset($user))$ank['id']=$user['id'];
if (isset($_GET['id']))$ank['id']=intval($_GET['id']);
if (mysql_result(mysql_query("SELECT COUNT(*) FROM `user` WHERE `id` = '$ank[id]' LIMIT 1"),0)==0){header("Location: /index.php?".SID);exit;}
$ank=mysql_fetch_array(mysql_query("SELECT * FROM `user` WHERE `id` = $ank[id] LIMIT 1"));
if (isset($_GET['id']))
{
mysql_query("INSERT INTO `poke_profil` (`id_user`, `id_poke`, `msg`, `time`) values('$user[id]', '$ank[id]', '[url=/info.php?id=$user[id]]$user[nick][/url] poke you', '$time')");
mysql_query("DELETE FROM `poke_profil` WHERE `id_user` = '$ank[id]' AND `id_poke` = '$user[id]' LIMIT 1");
msg('You have poke '.$ank['nick'].' back');
}
$k_post=mysql_result(mysql_query("SELECT COUNT(*) FROM `poke_profil` WHERE `id_poke` = '$user[id]'"),0);
$k_page=k_page($k_post,$set['p_str']);
$page=page($k_page);
$start=$set['p_str']*$page-$set['p_str'];
if($k_post==0)
{
echo "   <div class='rmenu'>\n";
echo "No results<br />";
echo "  </div>\n";
}

$res = mysql_query("select * from `poke_profil` WHERE `id_poke` = '$user[id]' ORDER BY id LIMIT $start, $set[p_str];");
while ($poke = mysql_fetch_array($res)){
$post=get_user($poke['id_user']);
echo "   <div class='post'>\n";
echo "<img src='/style/poke.png'> ".output_text($poke['msg'])."";
echo " Ð’· <a href='?id=$post[id]'>Poke back</a>";
echo "  </div>\n";
}

include_once 'sys/inc/tfoot.php';
?>
