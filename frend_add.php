<?php

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
include_once 'sys/inc/thead.php';
only_reg();

if (!isset($user) && !isset($_GET['id'])){header("Location: /index.php?".SID);exit;}
if (isset($user))$ank['id']=$user['id'];
if (isset($_GET['id']))$ank['id']=intval($_GET['id']);
if (mysql_result(mysql_query("SELECT COUNT(*) FROM `user` WHERE `id` = '$ank[id]' LIMIT 1"),0)==0){header("Location: /index.php?".SID);exit;}
$ank=mysql_fetch_array(mysql_query("SELECT * FROM `user` WHERE `id` = $ank[id] LIMIT 1"));

if (isset($_GET['id'])){
$d1sql = mysql_query("SELECT COUNT(*) FROM `frends_new` WHERE (`user` = '$user[id]' AND `to` = '$ank[id]') OR (`user` = '$ank[id]' AND `to` = '$user[id]') LIMIT 1");

$d2sql = mysql_query("SELECT COUNT(*) FROM `frends` WHERE (`user` = '$ank[id]' AND `frend` = '$user[id]') OR (`user` = '$user[id]' AND `frend` = '$ank[id]') LIMIT 1");

if (isset($user) && $user['id']!=$ank['id'] && mysql_result($d1sql, 0)==0 && mysql_result($d2sql, 0)==0)
{
echo "<table class='post'>";
echo "<tr><td class='icon48'>";
avatars($ank['id']);
echo "</td><td class='p_m' valign='top'>";
echo 'Are you sure want to add';
echo " $ank[nick] as a friend?";
echo "<br/>";
echo '<br/><form method="get" class="btnF" action="/add_frend.php?id='.$ank['id'].'"><input type="hidden" name="id" value="'.$ank['id'].'" /><input type="submit" value="Add as Friend" class="btn" /></form>  <form method="get" class="btnF" action="/"><input type="hidden" name="id" value="/" /><input type="submit" value="Cancel" class="btn" /></form>';
echo "</td></tr></table>";
}
}

include_once 'sys/inc/tfoot.php';
?>
