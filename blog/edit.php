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

$set['title']='Notes - Files';
include_once '../sys/inc/thead.php';
//title();
//aut();

if (!isset($_GET['id']) && !is_numeric($_GET['id'])){header("Location: index.php?".SID);exit;}
if (mysql_result(mysql_query("SELECT COUNT(*) FROM `blog_list` WHERE `id` = '".intval($_GET['id'])."' LIMIT 1",$db), 0)==0){header("Location: index.php?".SID);exit;}
$blog=mysql_fetch_array(mysql_query("select * from `blog_list` where `id`='".intval($_GET['id'])."';"));

if (($user['level'] < 4) && ($user['id'] !=$blog['id_user']))
{
$set['title']='Error !!';
include_once '../sys/inc/thead.php';
//title();
//aut();
echo "You cant access this page!";
echo"<div class='foot'>\n";
echo"&nbsp;<a href='index.php'>Back to Notes</a><br />\n";
echo"</div>\n";
include_once '../sys/inc/tfoot.php';
exit();
}


if (isset($_GET['edit']) && isset($_POST['name']) && $_POST['name']!=NULL && isset($_POST['msg']))
{
$msg=mysql_real_escape_string($_POST['msg']);
$name=mysql_real_escape_string($_POST['name']);

if (strlen2($name)<3)$err='Min 3 characters';
if (strlen2($name)>50)$err='Max 50 characters';
if (strlen2($msg)<3)$err='Min 3 characters';
if (strlen2($msg)>3000)$err='Min 3000 characters';

if(isset($_POST['privat']))
{
if($_POST['privat'] == 1) $privat='1';
else $privat='0';
}
else $privat='0';
if (!isset($err))
{
mysql_query("UPDATE `blog_list` SET `name` = '$name', `msg` = '$msg', `time` = '$time', `privat` = '$privat' WHERE `id`='".intval($_GET['id'])."'");
echo"".mysql_error()."";
msg('Success changed !!!');
}
}



if (isset($_GET['del']))
{
if (isset($_GET['ok']))
{
$q_f=mysql_query("SELECT * FROM `blog_files` WHERE `id_blog` = '".$blog['id']."'");
while ($file = mysql_fetch_assoc($q_f))
{
mysql_query("DELETE FROM `blog_files` WHERE `id` = '$file[id]' LIMIT 1");
unlink(H.'blog/files/'.$file['id'].'.frf');
}
mysql_query("DELETE FROM `blog_komm` WHERE `id_blog` = '".$blog['id']."' LIMIT 1");

$q_i=mysql_query("SELECT * FROM `blog_img` WHERE `id_blog` = '".$blog['id']."'");
while ($img = mysql_fetch_assoc($q_i))
{
mysql_query("DELETE FROM `blog_img` WHERE `id` = '$img[id]' LIMIT 1");
unlink(H.'blog/img/'.$img['id'].'.jpg');
}
mysql_query("DELETE FROM `blog_list` WHERE `id` = '".intval($_GET['id'])."' LIMIT 1");
msg('Deleted !!!');
echo"<div class='foot'>\n";
echo"&nbsp<a href='user.php'>Back to Note</a><br />\n";
echo"</div>\n";

include_once '../sys/inc/tfoot.php';
exit();
}
else
{
echo"Do you want to delete Note? <a href='?id=".intval($_GET['id'])."&amp;del&amp;ok'>OK</a> / <a href='list.php?id=".intval($_GET['id'])."'>Cancel</a><br />";
}
}

err();
$blog=mysql_fetch_array(mysql_query("select * from `blog_list` where `id`='".intval($_GET['id'])."';"));
echo "<form method='post' action='?id=".intval($_GET['id'])."&amp;edit'>\n";
echo "Title:<br />\n<input type=\"text\" name=\"name\" value=\"$blog[name]\" /><br />\n";

echo "Note: <br />";
echo "<textarea name=\"msg\">$blog[msg]</textarea><br />";
echo "<label><input type=\"checkbox\" name=\"privat\" value=\"1\" />Private Note</label><br />\n";
echo "<input value=\"Save\" type=\"submit\" />\n";
echo "</form>\n";
echo"<div class='foot'>\n";
echo"&nbsp<a href='list.php?id=".intval($_GET['id'])."'>Back</a><br />\n";
echo"&nbsp<a href='user.php'>Notes</a><br />\n";
echo"</div>\n";

include_once '../sys/inc/tfoot.php';
?>
