<?

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


if (!isset($user) && !isset($_GET['id'])){header("Location: /index.php?".SID);exit;}
if (isset($user))$ank['id']=$user['id'];
if (isset($_GET['id']))$ank['id']=intval($_GET['id']);
if (mysql_result(mysql_query("SELECT COUNT(*) FROM `user` WHERE `id` = '$ank[id]' LIMIT 1"),0)==0){header("Location: /wall.php?".SID);exit;}
$ank=mysql_fetch_array(mysql_query("SELECT * FROM `user` WHERE `id` = $ank[id] LIMIT 1"));
$set['title']=''.$ank['nick'].' - Wall';

include_once 'sys/inc/thead.php';

if ((!isset($_SESSION['refer']) || $_SESSION['refer']==NULL)
&& isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER']!=NULL &&
!ereg('info\.php',$_SERVER['HTTP_REFERER']))
$_SESSION['refer']=str_replace('&','&amp;',ereg_replace('^http://[^/]*/','/', $_SERVER['HTTP_REFERER']));

err();

echo '<div class="acw apm"><div id="profile_header"><div class="ib"><table><tr><td><a href="/primary.php?id='.$ank['id'].'">';
avatar($ank['id']);
echo '</a></td><td><div class="c"><div class="right_column"><div class="profile_name"><strong>';
echo "<a href='/info.php?id=$ank[id]'>$ank[nick]</a>";
echo ''.online($ank['id']).'</strong></div></div></div></td></tr></table>';
echo '<div class="clear"></div></div>';
echo '</div></div>';
$user_id = $ank['id'];
if(isset($_GET['delete']) AND !empty($_GET['delete']))
{
$delete = (int)$_GET['delete'];
if($user['level'] > 3 OR $ank['id'] == $user['id'])
{
$query = @mysql_query("SELECT `id` FROM `wall` WHERE `user_id` = '$user_id' AND `id` = '$delete';");
if(@mysql_affected_rows() > 0)
{
@mysql_query("DELETE FROM `wall` WHERE `user_id` = '$user_id' AND `id` = '$delete' LIMIT 1;");

echo '<div class="msg">Message successfully delete!</div>';
}
else
echo '<div class="news">Not found!</div>';
}
else
echo '<div class="news">You are not allowed to delete this message!</div>';
}
# Add message:
if(isset($_POST['message']) AND isset($user))
{
$message = $_POST['message'];

if(isset($_POST['translit']) AND $_POST['translit']) $message = translit($message);

$err = '';

if(strlen2($message) > 512) $err .= 'Message is too long!!<br />';
if(strlen2($message) < 2) $err .= 'Message is too short!!<br />';
if(@mysql_result(@mysql_query("SELECT COUNT(*) FROM `wall` WHERE `user_id` = '$user_id' AND `message` = '".@mysql_escape_string($message)."' AND `time` > '".($time - 300)."' LIMIT 1"), 0) != 0) $err .= 'You are repeat the previous message!!<br />';
if(time() - @mysql_result(@mysql_query("SELECT `time` FROM `wall` WHERE `user_id` = '$user_id' ORDER BY `id` DESC LIMIT 1;"), 0) < 30) $err .= 'Not too often write message!!<br />';

if($err != '')
{
echo '<div class="msg">'.$err.'</div>';
}
else
{
$message = @mysql_escape_string($message);
@mysql_query("INSERT INTO `wall` (`user_id`, `who`, `time`, `message`) values('$user_id', '".$user['id']."', '".time()."', '$message')");
@mysql_query("UPDATE `user` SET `msg_on_wall` = `msg_on_wall` + 1 WHERE `id` = '".$user['id']."' LIMIT 1");

$msg = @mysql_escape_string($msg);
@mysql_query("insert into `statuse_list` (`id_user`, `msg`, `time`, `kategori`) values('$user[id]', ' [time]write on[/time] [url=/info.php?id=$ank[id]][b]$ank[nick][/b][/url] [url=/wall.php?id=$ank[id]]wall[/url]', '$time', '1')");

if($user['id']!=$user_id){
$msg = '[img]/style/icon/wall.png[/img] [url=/info.php?id='.$user['id'].'] '.$user['nick'].'[/url] Posted message on your [url=/info.php]wall[/url].';
mysql_query("INSERT INTO `jurnal` (`id_user`, `id_kont`, `msg`, `time`) values('0', '".$user_id."', '".$msg."', '".$time."')");
}
mysql_query("OPTIMIZE TABLE `wall`, `user`, `jurnal`, `statuse_list`");
}
}
###wall###
$teman2 = mysql_query("SELECT COUNT(*) FROM `frends` WHERE (`user` = '$ank[id]' AND `frend` = '$user[id]') OR (`user` = '$user[id]' AND `frend` = '$ank[id]') LIMIT 1");
if (isset($user) && $user['id']!=$ank['id'] && mysql_result($teman2, 0)==0)
{
echo "<div class='status'></div>";
}
else
{
{if (isset($user) && $user['id']!=$ank['id'])
{
echo "<div class=\"penanda\"><div id=\"body\ class=\"acw apm\">Write something...";
echo '<form method="post" id="composer_form" name="message" action="wall.php?id='.$user_id.'">';
echo "<table class=\"comboInput\" cellpadding=\"0\" cellspacing=\"0\"><tbody><tr><td class=\"inputCell\"><textarea class=\"input composerInput\" name=\"message\" rows=\"2\" cols=\"15\"></textarea></td><td><input value=\"Send\" class=\"btn btnC\" type=\"submit\"></td></tr></tbody></table></div></form></div></div>";
}else{ echo "<div class='status'></div>";
}
}
}
# Display message:
$k_post = @mysql_result(@mysql_query("SELECT COUNT(*) FROM `wall` WHERE `user_id` = '$user_id'"), 0);
$k_page = k_page($k_post, $set['p_str']);
$page = page($k_page);
$start = $set['p_str'] * $page - $set['p_str'];
if(!$k_post)
{
echo '<div class="p_t">No message!!</div>';
}

$query = @mysql_query("SELECT * FROM `wall` WHERE `user_id` = '$user_id' ORDER BY `time` DESC LIMIT $start, $set[p_str];");

while ($array = mysql_fetch_array($query))
{
$user_nick = @mysql_result(@mysql_query("SELECT `nick` FROM `user` WHERE `id` = '".$array['who']."';"), 0);
echo ceil(ceil($i / 2) - ($i / 2)) == 0 ? '<div class="list1">' : '<div class="list2">';
echo '<table class="post" width="100%">';
echo '<tr><td class="icon14">';
echo avatar($array['who']);
echo'</td>';
echo '<td class="status" width="80%" valign="top">';
echo '<a href="/info.php?id='.$array['who'].'">'.$user_nick.'</a> '.online($array['who']).'<br/>';
echo ' '.output_text($array['message']).'<br/>';
if(isset($_GET['com']) AND !empty($_GET['com']))
{
$com = (int)$_GET['com'];
}
echo '<span class="post"><font class="time" size="2">'.waktu($array['time']).'</font></span>';
if (isset($user) && $user['id']==$ank['id'])
{
echo ' &#183; <a href="/wall.php?id='.$array['who'].'"><span class="post">Reply</span></a> ';
}
if($user['level'] > 3 OR $ank['id'] == $user['id'])
{
echo ' &#183; <a href="wall.php?id='.$user_id.'&amp;wall&amp;delete='.$array['id'].'"><span class="post">Delete</span></a>';
}




echo'</td>';
echo'</tr>';
echo '</table>';
echo '</div>';
++$i;
}
if($k_page > 1) str('wall.php?id='.$user_id.'&amp;wall&amp;'.rand(1000, 9999).'&amp;', $k_page, $page);
echo '<div class="acw apm">';
$teman = mysql_query("SELECT COUNT(*) FROM `frends` WHERE (`user` = '$ank[id]' AND `frend` = '$user[id]') OR (`user` = '$user[id]' AND `frend` = '$ank[id]') LIMIT 1");
if (isset($user) && $user['id']!=$ank['id'] && mysql_result($teman, 0)==0)
{

$d1sql = mysql_query("SELECT COUNT(*) FROM `frends_new` WHERE (`user` = '$user[id]' AND `to` = '$ank[id]') OR (`user` = '$ank[id]' AND `to` = '$user[id]') LIMIT 1");
$d2sql = mysql_query("SELECT COUNT(*) FROM `frends` WHERE (`user` = '$ank[id]' AND `frend` = '$user[id]') OR (`user` = '$user[id]' AND `frend` = '$ank[id]') LIMIT 1");
if (isset($user) && $user['id']!=$ank['id'] && mysql_result($d1sql, 0)==0 && mysql_result($d2sql, 0)==0)
{
echo "<a href='/frend_add.php?id=$ank[id]'>Add as Friend</a>";}else{
echo "<div class='acw apm'>Waiting Confirmation</div>";
}
}
echo "</div>";
include_once 'sys/inc/tfoot.php';
?>
