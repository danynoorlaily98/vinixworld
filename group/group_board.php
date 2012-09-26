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

if (isset($_GET['id']) && mysql_result(mysql_query("SELECT COUNT(*) FROM `group` WHERE `id` = '".intval($_GET['id'])."' LIMIT 1"),0)==1)
{
$id = intval($_GET['id']);
$g = mysql_fetch_array(mysql_query("SELECT * FROM `group` WHERE `id` = '$id'  LIMIT 1"));
$ank = mysql_fetch_array(mysql_query("SELECT * FROM `user` WHERE `id` = $g[user] LIMIT 1"));

if (isset($_GET['del']) && isset($user))
{
$p = mysql_fetch_array(mysql_query("SELECT * FROM `group_board` WHERE `id` = '".intval($_GET['del'])."' LIMIT 1"));
$a = mysql_fetch_array(mysql_query("SELECT `level` FROM `user` WHERE `id` = '$p[user]' LIMIT 1"));
if ($user['level']>$a['level'] || $user['id']==$ank['id'])mysql_query("DELETE FROM `group_board` WHERE `id` = '".intval($_GET['del'])."' LIMIT 1");
else {header("Location: index.php?");exit;}

header("Location: group_board.php?id=$id");exit;
}
$set['title'] = 'Group '.$g['name'];
include_once '../sys/inc/thead.php';
title();
//aut();

$k_m=mysql_result(mysql_query("SELECT COUNT(*) FROM `group_board` WHERE `g` = '$id'"), 0);
$k_page=k_page($k_m,$set['p_str']);
$page=page($k_page);
$start=$set['p_str']*$page-$set['p_str'];

echo '<table>'."\n";
if ($k_m == '0')echo '<div class="p_m"> Kosong</div>';

$q = mysql_query("SELECT * FROM `group_board` WHERE `g` = '$id' ORDER BY time DESC LIMIT $start, $set[p_str]");
while ($p = mysql_fetch_array($q))
{

$a = mysql_fetch_array(mysql_query("SELECT * FROM `user` WHERE `id` = $p[user] LIMIT 1"));

$inf = '';
if (mysql_result(mysql_query("SELECT COUNT(*) FROM `group_u` WHERE `id` = '$id' AND `user` = '$a[id]' LIMIT 1"),0)==0)$inf = 'Aocou ';
elseif ($a['id']==$ank['id'])$inf = '<img src="m.png"alt="">  ';

echo "   <tr>\n";
echo "  <td class='p_t'>\n";
echo ' <a href="/info.php?id='.$a['id'].'">'.$a['nick'].'</a> '.$inf.online($p['user']).' ('.vremja($p['time']).')';
echo "  </td>\n";
echo "   </tr>\n";
echo "   <tr>\n";
echo "  <td class='p_m'>\n";
echo esc(trim(br(bbcode(smiles(links(stripcslashes(htmlspecialchars($p['msg']))))))))."\n";

if (isset($user) && ($user['level']>$a['level'] || $user['id']==$ank['id']))echo ' <a href="group_board.php?id='.$id.'&amp;del='.$p['id'].'"><b>x</b></a>';

echo "  </td>\n";
echo "   </tr>\n";

}
echo '</table>'."\n";

if ($k_page>1)str("?id=$id&",$k_page,$page);
if (isset($user) && $_SESSION['g_board']+30 < $time)echo '<div class="p_t"> :: <a href="board_add.php?id='.$id.'">Add group</a></div>';

echo '<br /> :: <a href="index.php?id='.$id.'">Back</a><br>';

include_once '../sys/inc/tfoot.php';
}
header('Location: index.php?');
?>
