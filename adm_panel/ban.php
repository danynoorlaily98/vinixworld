<?
include_once '../sys/inc/start.php';
include_once '../sys/inc/compress.php';
include_once '../sys/inc/sess.php';
include_once '../sys/inc/home.php';
include_once '../sys/inc/settings.php';
include_once '../sys/inc/db_connect.php';
include_once '../sys/inc/ipua.php';
include_once '../sys/inc/fnc.php';
include_once '../sys/inc/adm_check.php';
include_once '../sys/inc/user.php';

if (!user_access('user_ban_set') && !user_access('user_ban_set_h') && !user_access('user_ban_unset')){header("Location: /index.php?".SID);exit;}


adm_check();
if (isset($_GET['id']))$ank['id']=intval($_GET['id']);
else {header("Location: /index.php?".SID);exit;}


if (mysql_result(mysql_query("SELECT COUNT(*) FROM `user` WHERE `id` = '$ank[id]' LIMIT 1"),0)==0){header("Location: /index.php?".SID);exit;}
$ank=get_user($ank['id']);
if ($user['level']<=$ank['level']){header("Location: /index.php?".SID);exit;}

$set['title']='Ban User '.$ank['nick'];
include_once '../sys/inc/thead.php';
title();

if (isset($_GET['unset']) && mysql_result(mysql_query("SELECT COUNT(*) FROM `ban` WHERE `id_user` = '$ank[id]' AND `id` = '".intval($_GET['unset'])."'"),0) && user_access('user_ban_unset'))
{
$ban_info=mysql_fetch_assoc(mysql_query("SELECT * FROM `ban` WHERE `id_user` = '$ank[id]' AND `id` = '".intval($_GET['unset'])."'"));
$ank2=mysql_fetch_assoc(mysql_query("SELECT * FROM `user` WHERE `id` = '$ban_info[id_ban]' LIMIT 1"));
if (($user['level']>$ank2['level'] || $user['id']==$ank2['id']) || $user['level']==4)
{
mysql_query("UPDATE `ban` SET `time` = '$time' WHERE `id` = '".intval($_GET['unset'])."' LIMIT 1");
admin_log('Users','Ban',"Removing the ban user '[url=/amd_panel/ban.php?id=$ank[id]]$ank[nick][/url]'");
msg('Ban successfully reset');
}
else
$err[]='No Human';
}

if (isset($_POST['ban_pr']) && isset($_POST['time']) && isset($_POST['vremja']) && (user_access('user_ban_set') || user_access('user_ban_set_h')))
{
$timeban=$time;
if ($_POST['vremja']=='min')$timeban+=intval($_POST['time'])*60;
if ($_POST['vremja']=='chas')$timeban+=intval($_POST['time'])*60*60;
if ($_POST['vremja']=='sut')$timeban+=intval($_POST['time'])*60*60*24;
if ($_POST['vremja']=='mes')$timeban+=intval($_POST['time'])*60*60*24*30;
if ($timeban<$time)$err[]='Time Error';

if (!user_access('user_ban_set'))$timeban=min($timeban, $time+3600*24);

$prich=$_POST['ban_pr'];
if (strlen2($prich)>1024){$err[]='Message too long, max. 1024 characters';}
if (strlen2($prich)<10){$err[]='Shpuld indicate in detail the reason';}
$prich=my_esc($prich);
if (!isset($err)){
mysql_query("INSERT INTO `ban` (`id_user`, `id_ban`, `prich`, `time`) VALUES ('$ank[id]', '$user[id]', '$prich', '$timeban')");
admin_log('Users','Ban',"Ban Users '[url=/adm_panel/ban.php?id=$ank[id]]$ank[nick][/url]' to ".vremja($timeban)." because '$prich'");
msg('You have successfully banned');
}
}

err();
//aut();

$k_post=mysql_result(mysql_query("SELECT COUNT(*) FROM `ban` WHERE `id_user` = '$ank[id]'"),0);
$k_page=k_page($k_post,$set['p_str']);
$page=page($k_page);
$start=$set['p_str']*$page-$set['p_str'];
echo "<table class='post'>\n";


if ($k_post==0)
{
echo "   <tr>\n";
echo "  <td class='p_t'>\n";
echo "No violations\n";
echo "  </td>\n";
echo "   </tr>\n";
}


$q=mysql_query("SELECT * FROM `ban` WHERE `id_user` = '$ank[id]' ORDER BY `time` DESC LIMIT $start, $set[p_str]");
while ($post = mysql_fetch_assoc($q))
{

$ank2=mysql_fetch_assoc(mysql_query("SELECT * FROM `user` WHERE `id` = $post[id_ban] LIMIT 1"));
echo "   <tr>\n";
if ($set['set_show_icon']==2){
echo "  <td class='icon48' rowspan='2'>\n";
avatar($ank2['id']);
echo "  </td>\n";
}
elseif ($set['set_show_icon']==1)
{
echo "  <td class='icon14'>\n";
echo "<img src='/style/themes/$set[set_them]/user/$ank2[pol].png' alt='' />";
echo "  </td>\n";
}
echo "  <td class='p_t'>\n";
echo "<a href='/info.php?id=$ank2[id]'>$ank2[nick]</a>".online($ank2['id']).": до ".vremja($post['time'])."\n";

echo "  </td>\n";
echo "   </tr>\n";
echo "   <tr>\n";
if ($set['set_show_icon']==1)echo "  <td class='p_m' colspan='2'>\n"; else echo "  <td class='p_m'>\n";
echo esc(trim(br(bbcode(smiles(links(stripcslashes(htmlspecialchars($post['prich']))))))))."<br />\n";
if ($post['time']>$time && user_access('user_ban_unset'))
echo "<a href='?id=$ank[id]&amp;unset=$post[id]'>Remove Ban</a><br />\n";
echo "  </td>\n";
echo "   </tr>\n";
}



echo "</table>\n";
if ($k_page>1)str('?id='.$ank['id'].'&amp;',$k_page,$page); // Вывод страниц



if (user_access('user_ban_set') || user_access('user_ban_set_h'))
{
echo "<form action=\"ban.php?id=$ank[id]&amp;$passgen\" method=\"post\">\n";
echo "Reason:<br />\n";
echo "<textarea name=\"ban_pr\"></textarea><br />\n";
echo "Banlenght ".(user_access('user_ban_set')?null:'(max 1 day)').":<br />\n";
echo "<input type='text' name='time' title='Banlenght' value='10' maxlength='11' size='3' />\n";
echo "<select class='form' name=\"vremja\">\n";
echo "<option value='min'>Minutes</option>\n";
echo "<option ".(($k_post>1)?'selected="selected" ':null)."value='chas'>Hours</option>\n";
echo "<option value='sut'>Days</option>\n";
echo "<option value='mes'".(user_access('user_ban_set')?null:' disabled="disabled"').">Months</option>\n";
echo "</select><br />\n";
echo "<input type='submit' value='Kick' />\n";
echo "</form>\n";
}
else
{
echo "<div class='err'>No right in order to ban a user</div>\n";
}

echo "<div class='foot'>\n";
echo "&raquo;<a href=\"/mail.php?id=$ank[id]\">Send Message</a><br />\n";
echo "&laquo;<a href=\"/info.php?id=$ank[id]\">$ank[name]info</a><br />\n";
if (user_access('adm_panel_show'))
echo "&laquo;<a href='/adm_panel/'>Admin Panel</a><br />\n";
echo "</div>\n";



include_once '../sys/inc/tfoot.php';
?>
