<?php

// Blog For Dcms
// Script by : Lex
// Homepage : http://playm.ru
// Translated by : insanity
// Homepage : http://www.invinitife.com

// remodified by noe
// http://nnetwork.tk
// loegue.info@gmail.com

include_once '../sys/inc/start.php';
include_once '../sys/inc/compress.php';
include_once '../sys/inc/sess.php';
include_once '../sys/inc/home.php';
include_once '../sys/inc/settings.php';
include_once '../sys/inc/db_connect.php';
include_once '../sys/inc/ipua.php';
include_once '../sys/inc/fnc.php';
include_once '../sys/inc/user.php';

only_reg();

$set['title']='Notes - Add Note';
include_once '../sys/inc/thead.php';
//title();
//aut();


if (isset($_GET['add']) && isset($_POST['name']) && $_POST['name']!=NULL && isset($_POST['msg']))
{
$msg=mysql_real_escape_string($_POST['msg']);
$name=mysql_real_escape_string($_POST['name']);
if (strlen2($name)<3)$err='Title is too short';
if (strlen2($name)>50)$err='Error! Title max 50 characters';
if (strlen2($msg)<3)$err='Error! Title min 3 characters';
if (strlen2($msg)>30000)$err='Error! Post max 1024 characters';

if(isset($_POST['privat']))
{
if($_POST['privat'] == 1) $privat='1';
else $privat='0';
}
else $privat='0';


if (!isset($err))
{
mysql_query("INSERT INTO `blog_list` (`id_user`, `name`, `msg`, `time`, `privat`) values('$user[id]', '$name', '$msg', '$time', '$privat')");
msg('Note has been added !!!');
mysql_query("UPDATE `blog_list` SET `count` = '".($blog['count']+1)."' WHERE `id` = '$blog[id]' LIMIT 1");

$res = mysql_query("SELECT `id` FROM `blog_list` ORDER BY time DESC LIMIT 1");
while ($blog = mysql_fetch_array($res)){
$blg=' [time]write a new[/time] [url=/blog/]note[/url]
[nome][url=/blog/list.php?id='.$blog['id'].']'.htmlspecialchars($_POST['name']).'[/url][/nome]';
mysql_query("INSERT INTO `statuse_list` (`id_user`, `msg`, `time`, `kategori`) values('$user[id]', '$blg', '$time', '1')");
mysql_query("UPDATE `user` SET `balls` = '".($user['balls']+1)."' WHERE `id` = '$user[id]' LIMIT 1");
}
}
}
err();
echo "<form class='foot' method='post' action='?add'>\n";
echo "Title:<br />\n<input type=\"text\" name=\"name\" value=\"\" /><br />\n";
echo "Note: <br />";
echo "<textarea name=\"msg\"></textarea><br />";

echo "<label><input type=\"checkbox\" name=\"privat\" value=\"1\" />Private Note</label><br />\n";

echo "<input value=\"Save\" type=\"submit\" />\n";
echo "</form>\n";

echo"<div class='foot'>\n";
echo"&nbsp;<a href='user.php'>Back</a><br />\n";
echo"</div>\n";

include_once '../sys/inc/tfoot.php';
?>
