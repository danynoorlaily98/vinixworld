<?

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
$set['title'] = 'Daftar group '.$g['name'];

include_once '../sys/inc/thead.php';
title();
//aut();

if (isset($_GET['u']) && isset($user) && $g['user']==$user['id'] && $user['id']!=intval($_GET['u']))
{
mysql_query("DELETE FROM `group_u` WHERE `id` = '$id' AND `user` = '".intval($_GET['u'])."' LIMIT 1");
mysql_query("UPDATE `group` SET `all`=`all`-1 WHERE `id` = '$id' LIMIT 1");
header("Location: users.php?id=$id&u_d".SID);
}

$k_u = mysql_result(mysql_query("SELECT COUNT(*) FROM `group_u` WHERE `id` = '$id'"), 0);
$k_page=k_page($k_u,$set['p_str']);
$page=page($k_page);
$start=$set['p_str']*$page-$set['p_str'];

if (isset($_GET['u_d']))msg('Delete member');
echo '<div class="p_t">Group list "'.$g['name'].'" ('.$k_u.')</div>';
echo "<table class='post'>\n";
$q = mysql_query("SELECT * FROM `group_u` WHERE `id` = '$id' ORDER BY time DESC LIMIT $start, $set[p_str]");
while ($u = mysql_fetch_array($q))
{
$a = mysql_fetch_array(mysql_query("SELECT * FROM `user` WHERE `id` = '$u[user]' LIMIT 1"));

echo "   <tr>\n";

if ($set['set_show_icon']==2){
echo "  <td class='icon48' rowspan='2'>\n";
avatar($a['id']);
echo "  </td>\n";
}
elseif ($set['set_show_icon']==1)
{
echo "  <td class='icon14'>\n";
avatar($a['id']);
echo "  </td>\n";
}
echo "  <td class='p_t'>\n";
echo "<a href='/info.php?id=$a[id]'>$a[nick]</a>".online($a['id'])."\n";
echo "  </td>\n";
echo "   </tr>\n";
echo "   <tr>\n";
if ($set['set_show_icon']==1)echo "  <td class='p_m' colspan='2'>\n"; else echo "  <td class='p_m'>\n";
if (isset($user) && $g['user']==$user['id'] && $user['id']!=$a['id'])echo ' <a href="users.php?id='.$id.'&u='.$a['id'].'"> View </a> ';
if ($g['user']==$a['id'])echo 'Moderator community';
}

echo "</table>\n";
if ($k_page>1)str("users.php?",$k_page,$page); // Buaoa copaieo

if (isset($user) && $user['id']!=$g['user'])
{
if(mysql_result(mysql_query("SELECT COUNT(user) FROM `group_u` WHERE `id` = '$id' AND `user` = '$user[id]' LIMIT 1"),0)==1)
echo ' <img src="l.png" alt=""> <a href="enter.php?id='.$id.'">Leave</a><br />'."\n";
else
echo ' <img src="r.png" alt=""> <a href="enter.php?id='.$id.'">Masuk</a><br />';
}
echo ' :: <a href="index.php?id='.$id.'">Back</a><br />';

include_once '../sys/inc/tfoot.php';
}
}
?>
