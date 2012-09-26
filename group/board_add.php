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
if ($_SESSION['g_board']+30 > $time){header("Location: index.php?antispam&".SID);exit;}
if (!isset($_GET['id']) || mysql_result(mysql_query("SELECT COUNT(id) FROM `group` WHERE `id` = '".intval($_GET['id'])."' LIMIT 1"),0)==0){header('Location: index.php?');exit;}

$id = intval($_GET['id']);
$g = mysql_fetch_array(mysql_query("SELECT * FROM `group` WHERE `id` = '$id'  LIMIT 1"));

$set['title'] = 'Chat community '.$g['name'];
include_once '../sys/inc/thead.php';
title();
//aut();

if (isset($_POST['msg']))
{
$msg = mysql_real_escape_string($_POST['msg']);
$msg = eregi_replace("((https?|ftp)://[[:alnum:]_=/-]+(\\.[[:alnum:]_=/-]+)*(/[[:alnum:]+&amp;._=/~%#]*(\\?[[:alnum:]?+&amp;_=/%#]*)?)?)", ' [advertising] ', $msg);

if ($_SESSION['g_board'] > $time-30){header("Location: index.php?antispam&".SID);exit;}
if (isset($_POST['translit']) && $_POST['translit']==1)$msg=translit($msg);
if (strlen2($msg) > 512){header("Location: board_add.php?id=$id&err=msg_max&".SID);exit;}
if (strlen2($msg) < 2){header("Location: board_add.php?id=$id&err=msg_min&".SID);exit;}

if (mysql_result(mysql_query("SELECT COUNT(*) FROM `group_board` WHERE `user` = '$user[id]' AND `msg` = '$msg' AND `time` > '".($time-300)."' LIMIT 1"),0) > 0){header("Location: board_add.php?id=$id&err=msg_exists&".SID);exit;}

mysql_query("INSERT INTO `group_board` SET `g`='$id', `user`='{$user[id]}', `time`='$time', `msg`='$msg';");
$_SESSION['g_board'] = $time;
header("Location: index.php?id=$id".SID);
exit;
}

echo '<div class="p_t">Chat community '.$g['name'].'</div>';
echo '<div class="p_m">Send message</div>';
echo '<form method="post" class="post" action="board_add.php?id='.$id.'">',
'Message:<br />',
'<textarea rows="2" cols="7" name="msg"></textarea><br />';
if ($set['translit']==1) echo '<input type="checkbox" name="translit" value="1"> Translit<br />';
echo '<input value="Kirim!" type="submit"></form>';

echo '<br /> :: <a href="group_board.php?id='.$id.'"> back</a>';
echo '<br /> :: <a href="index.php?id='.$id.'"> Group</a>';

include_once '../sys/inc/tfoot.php';
?>
