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

if (isset($_GET['id']))
{
$id = intval($_GET['id']);
if (mysql_result(mysql_query("SELECT COUNT(id) FROM `group` where `id` = '$id' LIMIT 1"),0)==1)
{
$g = mysql_fetch_array(mysql_query("SELECT * FROM `group` WHERE `id` = '$id'  LIMIT 1"));
$ank = mysql_fetch_array(mysql_query("SELECT * FROM `user` WHERE `id` = $g[user] LIMIT 1"));

$set['title'] = 'Group '.$g['name'];
include_once '../sys/inc/thead.php';
//title();
//aut();

echo '<table class="post">'."\n";
if ($g['logo']!=NULL)
{
echo "   <tr>\n";
echo "  <td class='p_m'>\n";
echo '<img src="logo/'.$g['logo'].'" alt="logo">';
echo "  </td>\n";
echo "   </tr>\n";
}

echo "   <tr>\n";
echo "  <td class='p_t'>\n";
echo $g['name'];
echo "  </td>\n";
echo "   </tr>\n";

echo "   <tr>\n";
echo "  <td class='p_m'>\n";
echo esc(trim(br(bbcode(smiles(links(stripcslashes(htmlspecialchars($g['about']))))))))."\n";
echo "  </td>\n";
echo "   </tr>\n";

echo '</table>'."\n";
# ieie-:ao

echo '<table class="post">'."\n";

echo '<tr><td class="p_t"> isi pesan:</td></tr>'."\n";
$k_m = mysql_result(mysql_query("SELECT COUNT(*) FROM `group_board` WHERE `g` = '$id' LIMIT ".($set['p_str']+1)), 0);
if ($k_m == '0')echo '<tr><td class="p_m"> No post </td></tr>';
$q = mysql_query("SELECT * FROM `group_board` WHERE `g` = '$id' ORDER BY time DESC LIMIT $set[p_str]");
while ($p = mysql_fetch_array($q))
{
$a = mysql_fetch_array(mysql_query("SELECT * FROM `user` WHERE `id` = $p[user] LIMIT 1"));

$inf = '';
if (mysql_result(mysql_query("SELECT COUNT(*) FROM `group_u` WHERE `id` = '$id' AND `user` = '$a[id]' LIMIT 1"),0)==0)$inf = 'user ';
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
if ($k_m > $set['p_str'])echo '<div class="str"> <a href="group_board.php?id='.$id.'">more...</a> </div>';

if (isset($user))
{
if ($_SESSION['g_board']+1 < $time)
if(mysql_result(mysql_query("SELECT COUNT(user) FROM `group_u` WHERE `id` = '$id' AND `user` = '$user[id]' LIMIT 1"),0)==1){
echo '<form method="post" class="post" action="board_add.php?id='.$id.'">',
'Message:<br />',
'<textarea rows="2" cols="7" name="msg"></textarea><br />';
if ($set['translit']==1) echo '<input type="checkbox" name="translit" value="1"> Translit<br />';
echo '<input value="Post" type="submit"></form>';
}
//echo '<div class="p_t"> <a href="board_add.php?id='.$id.'">Tulis pesan</a> </div>';
# iei
if ($user['id']==$ank['id'])echo '<div class="p_t"> (!) <a href="setup.php?id='.$id.'"> Setup</a> </div>';
else
{
if(mysql_result(mysql_query("SELECT COUNT(user) FROM `group_u` WHERE `id` = '$id' AND `user` = '$user[id]' LIMIT 1"),0)==1)
echo ' <img src="l.png" alt="" height="10" width="10"> <a href="enter.php?id='.$id.'">Leave</a><br />'."\n";
else
echo ' <img src="r.png" alt="" height="10" width="10"> <a href="enter.php?id='.$id.'">Join</a><br />';
}
}
# ioeucoaaoeee
echo '<div class="p_m"> :: <a href="users.php?id='.$id.'">Member group</a> ('.$g['all'].')</div>';

echo '<small>Moderator: <a href="/info.php?id='.$ank['id'].'">'.$ank['nick'].'</a></small>';
echo '<br /> :: <a href="index.php">Group</a></div>';

include_once '../sys/inc/tfoot.php';
}
}



$set['mesto'] = 'Group';
include_once '../sys/inc/thead.php';
//title();
//aut(); // oopia aaoopecaoee

$s = (isset($_GET['sort']) &&  $_GET['sort']=='top') ? 'top' : 'new';

$k_post = mysql_result(mysql_query("SELECT COUNT(id) FROM `group` LIMIT 1"),0);
$k_page=k_page($k_post,$set['p_str']);
$page=page($k_page);
$start=$set['p_str']*$page-$set['p_str'];

if (isset($user))echo '<div class="p_t"> :: <a href="group_my.php?id='.$user['id'].'">My group</a> </div>';
if ($s=='top')
{
echo '<div class="post"> <b>Populer</b> / <a href="index.php?sort=new">New!</a> </div>'."\n";
$q = mysql_query("SELECT * FROM `group` ORDER BY `all` DESC LIMIT $start, $set[p_str]");
}
else
{
echo '<div class="post"> <b>New!</b> / <a href="index.php?sort=top">Populer</a> </div>'."\n";
$q = mysql_query("SELECT * FROM `group` ORDER BY `id` DESC LIMIT $start, $set[p_str]");
}

echo '<table class="post">'."\n";
if ($k_post == 0)
{
echo "   <tr>\n";
echo "  <td class='p_t'>\n";
echo "No order\n";
echo "  </td>\n";
echo "   </tr>\n";
}

while ($p = mysql_fetch_array($q))
{
echo '   <tr>'."\n";
if ($set['set_show_icon']==2){
echo ' <td class="icon48" rowspan="2">'."\n";
echo '<center> <img src="g48.png" alt=""> </center>';
echo '  </td>'."\n";
}
elseif ($set['set_show_icon']==1)
{
echo '  <td class="icon14">'."\n";
echo ' <img src="g14.png" alt=""> ';
echo '  </td>'."\n";
}

echo '  <td class="p_t">'."\n";
echo '  <a href="index.php?id='.$p['id'].'">'.$p['name'].'</a> '."\n";
echo '  </td>'."\n";
echo '   </tr>'."\n";

echo "   <tr>\n";
if ($set['set_show_icon']==1)echo "  <td class='p_m' colspan='2'>\n"; else echo "  <td class='p_m'>\n";

echo 'Members: '.$p['all'].'<br />'."\n";

echo esc(trim(br(bbcode(smiles(links(stripcslashes(htmlspecialchars($p['about']))))))))."\n";
echo "  </td>\n";
echo "   </tr>\n";
}

echo "</table>\n";
if ($k_page > 1)str('?sort='.$s.'&amp;', $k_page, $page);

if ($user['balls']>50 && mysql_result(mysql_query("SELECT COUNT(id) FROM `group` where `user` = '$user[id]' LIMIT 1"),0)==0)
{
echo '<div class="p_m"> :: <a href="group_new.php">Create group</a> </div>';
}

include_once '../sys/inc/tfoot.php';
?>
