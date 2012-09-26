<?php

// Blog For Dcms
// Script by : Lex
// Homepage : http://playm.ru
// Translated by : insanity
// Homepage : http://www.invinitife.com

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

$set['title']='Status - Edit';
include_once 'sys/inc/thead.php';
//title();
//aut();

if (!isset($_GET['id']) && !is_numeric($_GET['id'])){header("Location: index.php?".SID);exit;}
if (mysql_result(mysql_query("SELECT COUNT(*) FROM `statuse_list` WHERE `id` = '".intval($_GET['id'])."' LIMIT 1",$db), 0)==0){header("Location: index.php?".SID);exit;}
$statuse=mysql_fetch_array(mysql_query("select * from `statuse_list` where `id`='".intval($_GET['id'])."';"));

if (($user['level'] < 4) && ($user['id'] !=$statuse['id_user']))
{
$set['title']='Oops!!';
include_once 'sys/inc/thead.php';
//title();
aut();
echo "Kamu tidak diperbolehkan akses halaman ini!";
echo"<div class='foot'>\n";
echo"<a href='index.php'>&raquo;Kembali ke status</a><br />\n";
echo"</div>\n";
include_once 'sys/inc/tfoot.php';
exit();
}


if (isset($_GET['edit']) && isset($_POST['msg']))
{
$msg=mysql_real_escape_string($_POST['msg']);

if (strlen2($msg)<3)$err='Terlalu pendek, harus lebih dari 3 karakter';
if (strlen2($msg)>3000)$err='Tidak boleh lebih dari 3000 karakter';

if(isset($_POST['privat']))
{
if($_POST['privat'] == 1) $privat='1';
else $privat='0';
}
else $privat='0';


if (!isset($err))
{
mysql_query("UPDATE `statuse_list` SET `name` = '$name', `msg` = '$msg', `time` = '$time', `privat` = '$privat' WHERE `id`='".intval($_GET['id'])."'");
echo"".mysql_error()."";
msg('Berhasil di ubah !!!');
}
}
if (isset($_GET['del']))
{

if (isset($_GET['ok']))
{
$q_f=mysql_query("SELECT * FROM `statuse_files` WHERE `id_statuse` = '".$statuse['id']."'");
while ($file = mysql_fetch_assoc($q_f))
{
mysql_query("DELETE FROM `statuse_files` WHERE `id` = '$file[id]' LIMIT 1");
unlink(H.'status/files/'.$file['id'].'.frf');
}
mysql_query("DELETE FROM `statuse_komm` WHERE `id_statuse` = '".$statuse['id']."' LIMIT 1");

$q_i=mysql_query("SELECT * FROM `statuse_img` WHERE `id_statuse` = '".$statuse['id']."'");
while ($img = mysql_fetch_assoc($q_i))
{
mysql_query("DELETE FROM `statuse_img` WHERE `id` = '$img[id]' LIMIT 1");
unlink(H.'status/img/'.$img['id'].'.jpg');
}
mysql_query("DELETE FROM `statuse_list` WHERE `id` = '".intval($_GET['id'])."' LIMIT 1");
msg('Status berhasil dihapus');
echo"<div class='foot'>\n";
echo"<a href='index.php'>&raquo;Kembali ke Status</a><br />\n";
echo"</div>\n";
include_once 'sys/inc/tfoot.php';
exit();
}
else
{
echo"Are you sure want to delete? <a href='?id=".intval($_GET['id'])."&amp;del&amp;ok'>Delete</a> / <a href='list.php?id=".intval($_GET['id'])."'>Cancel</a><br />";
}
}
err();

if($user['level']>3)
{
$statuse=mysql_fetch_array(mysql_query("select * from `statuse_list` where `id`='".intval($_GET['id'])."';"));
echo "<form method='post' action='?id=".intval($_GET['id'])."&amp;edit'>\n";
//echo "Judul Artikel:<br />\n<input type=\"text\" name=\"name\" value=\"$blog[name]\" /><br />\n";
echo "Status: <br />";
echo "<textarea name=\"msg\">$statuse[msg]</textarea><br />";
//echo "<label><input type=\"checkbox\" name=\"privat\" value=\"1\" />Jadikan Sebagai Catatan Pribadi</label><br />\n";
echo "<input value=\"Save\" class=\"btn btnC\" type=\"submit\" />\n";
echo "</form>\n";
}
echo"<div class='foot'><a href='list.php?id=".intval($_GET['id'])."'>Back</a></div>";

include_once 'sys/inc/tfoot.php';
?>
