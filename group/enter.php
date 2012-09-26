<?php

// Translated by : zanger
// Site : http://www.frendzmobile.co.cc

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

if (isset($_GET['id']))
{
$id = intval($_GET['id']);
$g = mysql_fetch_array(mysql_query("SELECT * FROM `group` WHERE `id` = '$id'  LIMIT 1"));
if (mysql_result(mysql_query("SELECT COUNT(*) FROM `group` where `id` = '$id' LIMIT 1"),0)==0)exit;
if (mysql_result(mysql_query("SELECT COUNT(*) FROM `group_u` where `id` = '$id' AND `user` = '$user[id]' LIMIT 1"),0)==0)
{
$set['title'] = 'Join group '.$g['name'];

if (isset($_GET['yes']))
{
mysql_query("INSERT INTO `group_u` (`user`, `id`, `time`) VALUES ('$user[id]', '$id', '$time')");
mysql_query("UPDATE `group` SET `all`=`all`+1 WHERE `id` = '$id' LIMIT 1");
header("Location: index.php?id=$id&".SID);
}

include_once '../sys/inc/thead.php';
//title();
//aut();

echo '<div class="post"> <a href="index.php?id='.$cid.'">'.$clan['name'].'</a> </div>';
echo '<div class="post">';
echo '<div class="p_t">Join group '.$clan['name'].'</div>';
echo '<div class="p_m">Yakin mau gabung? ^^ '.$clan['name'].'?</div>';
echo '</div>';

echo '<table><td>';
echo '<form action="enter.php?id='.$id.'&amp;yes" method="post">';
echo '<input class="button" value="join" type="submit">';
echo '</form>';
echo '</td><td>';
echo '<form action="index.php?id='.$id.'" method="post">';
echo '<input class="button" value="Gak jadi" type="submit"></form>';
echo '</td></table>';

include_once '../sys/inc/tfoot.php';
}
else
{
$set['title'] = 'Leave group '.$g['name'];


if (isset($_GET['yes']))
{
mysql_query("DELETE FROM `group_u` WHERE `id` = '$id' AND `user` = '$user[id]' LIMIT 1");
mysql_query("UPDATE `group` SET `all`=`all`-1 WHERE `id` = '$id' LIMIT 1");
header("Location: index.php?id=$id&".SID);
}
include_once '../sys/inc/thead.php';
//title();
//aut();

echo '<div class="post"><a href="index.php?id='.$id.'">'.$g['name'].'</a></div>';
echo '<div class="post">';
echo '<div class="p_t">Leave group '.$g['name'].'</div>';
echo '<div class="p_m">Yakin mau keluar? :-D '.$g['name'].'?</div>';
echo '</div>';
echo '<table><td>';
echo '<form action="enter.php?id='.$id.'&amp;yes" method="post">';
echo '<input class="button" value="Yakin!" type="submit">';
echo '</form>';
echo '</td><td>';
echo '<form action="index.php?id='.$id.'" method="post">';
echo '<input class="button" value="Gak jadi" type="submit"></form>';
echo '</td></table>';

include_once '../sys/inc/tfoot.php';
}
}
?>
