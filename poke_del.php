<?php

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

$set['title']='Delete poke';
include_once 'sys/inc/thead.php';
title();
//aut();

if (!isset($_GET['id']) && !is_numeric($_GET['id'])){header("Location: index.php?".SID);exit;}
if (mysql_result(mysql_query("SELECT COUNT(*) FROM `poke_profil` WHERE `id` = '".intval($_GET['id'])."' LIMIT 1",$db), 0)==0){header("Location: index.php?".SID);exit;}
$poke=mysql_fetch_array(mysql_query("select * from `poke_profil` where `id`='".intval($_GET['id'])."';"));

if (isset($_GET['del']))
{

if (isset($_GET['ok']))
{
mysql_query("DELETE FROM `poke_profil` WHERE `id` = '".intval($_GET['id'])."' LIMIT 1");
msg('Deleted');
echo"<div class='foot'>\n";
echo"<a href='/index.php'>Back</a><br />\n";
echo"</div>\n";

include_once 'sys/inc/tfoot.php';
exit();
}
}
else
{
echo"<div class='p_t'><a href='?id=".intval($_GET['id'])."&amp;del&amp;ok'>Delete</a> / <a href='/'>Back</a></div>";
}



include_once 'sys/inc/tfoot.php';

?>
