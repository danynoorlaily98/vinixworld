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

if (mysql_result(mysql_query("SELECT COUNT(*) FROM `user` WHERE `id` = '$ank[id]' LIMIT 1"),0)==0){header("Location: /info.php?".SID);exit;}
$ank=mysql_fetch_array(mysql_query("SELECT * FROM `user` WHERE `id` = $ank[id] LIMIT 1"));


$set['title']=$ank['nick'].'';
include_once 'sys/inc/thead.php';

if (isset($_GET['poke']) && isset($user))
{
if (mysql_result(mysql_query("SELECT COUNT(*) FROM `poke_profil` WHERE `id_poke` = '".intval($_GET['id'])."' AND `id_user` = '$user[id]' LIMIT 1"),0)!=0){$err='You have already poke '.$ank['nick'].'';}
else{
mysql_query("INSERT INTO `poke_profil` (`id_user`, `id_poke`, `msg`, `time`) values('$user[id]', '".intval($_GET['id'])."', '[url=/info.php?id=$user[id]]$user[nick][/url] poke you', '$time')");
msg('Your poked has been sent '.$ank['nick'].'');
}
}

if ((!isset($_SESSION['refer']) || $_SESSION['refer']==NULL)
&& isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER']!=NULL &&
!ereg('info\.php',$_SERVER['HTTP_REFERER']))
$_SESSION['refer']=str_replace('&','&amp;',ereg_replace('^http://[^/]*/','/', $_SERVER['HTTP_REFERER']));

if (isset($_POST['msg']) && isset($user))
{
$msg=$_POST['msg'];
if (isset($_POST['translit']) && $_POST['translit']==1)$msg=translit($msg);
if (strlen2($msg)>5000){$err='Message is too long, max 5000 characters';}
elseif (strlen2($msg)<2){$err='Message is too short';}
elseif(mysql_result(mysql_query("SELECT COUNT(*) FROM `statuse_list` WHERE `id_user` = '$user[id]' AND `msg` = '".mysql_real_escape_string($msg)."' AND `time` > '".($time - 900)."' LIMIT 1"), 0)!= 0){$err='';}
else{
$msg=mysql_real_escape_string($msg);
mysql_query("INSERT INTO `statuse_list` (`id_user`, `name`, `msg`, `time`, `privat`) values('$user[id]', '$name', '$msg', '$time', '$privat')");
mysql_query("UPDATE `user` SET `balls` = '".($user['balls']+1)."' WHERE `id` = '$user[id]' LIMIT 1");
msg('<b>Your status has been updated</b>');
}
}
err();

$user_id = $ank['id'];
echo '<div class="acw apm"><div id="profile_header"><div class="ib"><table><tr><td><a href="/primary.php?id='.$ank['id'].'">';
avatars($ank['id']);
echo '</a></td><td><div class="c"><div class="right_column"><div class="profile_name"><strong>';
echo "$ank[nick]";
echo '</strong></div></div></div></td></tr></table>';
echo '<div class="clear"></div></div>';
echo '<table><tr>';
$teman2 = mysql_query("SELECT COUNT(*) FROM `frends` WHERE (`user` = '$ank[id]' AND `frend` = '$user[id]') OR (`user` = '$user[id]' AND `frend` = '$ank[id]') LIMIT 1");
if (isset($user) && $user['id']!=$ank['id'] && mysql_result($teman2, 0)==0)
{

$d1sql = mysql_query("SELECT COUNT(*) FROM `frends_new` WHERE (`user` = '$user[id]' AND `to` = '$ank[id]') OR (`user` = '$ank[id]' AND `to` = '$user[id]') LIMIT 1");
$d2sql = mysql_query("SELECT COUNT(*) FROM `frends` WHERE (`user` = '$ank[id]' AND `frend` = '$user[id]') OR (`user` = '$user[id]' AND `frend` = '$ank[id]') LIMIT 1");
if (isset($user) && $user['id']!=$ank['id'] && mysql_result($d1sql, 0)==0 && mysql_result($d2sql, 0)==0)
{
echo '<td><form method="get" class="btnF" action="/frend_add.php?id='.$ank['id'].'"><input type="hidden" name="id" value="'.$ank['id'].'" /><input type="submit" value="Add as Friend" class="btn" /></form></td>';
}
else
{
echo'<td><input type="submit" value="Not Confirmed" class="btn disabled" disabled="1" /></td>';
}
}
if (isset($user)){
$teman2 = mysql_query("SELECT COUNT(*) FROM `frends` WHERE (`user` = '$ank[id]' AND `frend` = '$user[id]') OR (`user` = '$user[id]' AND `frend` = '$ank[id]') LIMIT 1");
if (isset($user) && $user['id']!=$ank['id'] && mysql_result($teman2, 0)==0)
{
}
else
{
if (isset($user) && $user['id']!=$ank['id']){
if($ank['ank_n_tel']!=NULL){
echo '<td><a href="sms:'.$ank['ank_n_tel'].'"><button type="button" class="btn">Sms</button></a></td>';
echo '<td><a href="wtai://wpmc;'.$ank['ank_n_tel'].'"><button type="button" class="btn">Call</button></a></td>';
}
else
{
echo'<td><input type="submit" value="Sms" class="btn disabled" disabled="1" /></td>';
echo'<td><input type="submit" value="Call" class="btn disabled" disabled="1" /></td>';
}
}
}
if (isset($user) && $user['id']!=$ank['id']){
echo '<td><form method="get" class="btnF" action="/mail.php?id='.$ank['id'].'"><input type="hidden" name="id" value="'.$ank['id'].'" /><input type="submit" value="Message" class="btn" /></form></td>';
}
}
echo '</tr></table></div></div>';

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
if (!isset($_GET['info'])){
echo "<div class='acw apm'><strong><span class='mfsm fcb'><b>Wall</b> &#183; <a href='?id=$ank[id]&amp;info'>Info</a>";

if (isset($user))
{
echo ' &#183; <a href="/foto/'.$ank['id'].'/">Foto</a>';
}
echo "</span></strong></div>";
if (isset($user)&& $user['id']==$ank['id']){
echo "<div class=\"penanda\"><div id=\"body\" class=\"kolom\"><form method=\"post\" id=\"composer_form\" name=\"message\" action=\"?\"><table class=\"comboInput\" cellpadding=\"0\" cellspacing=\"0\"><tbody><tr><td class=\"inputCell\"><textarea class=\"input composerInput\" name=\"msg\" rows=\"2\" cols=\"13\"></textarea></td><td><input value=\"Share\" class=\"btn btnC\" type=\"submit\"><a href='/smiles/'>Smiles</a><br/><a href='/bb-code.php'>BB-Code</a></td></tr></tbody></table></div></form></div></div>";
}

###wall###
$teman2 = mysql_query("SELECT COUNT(*) FROM `frends` WHERE (`user` = '$ank[id]' AND `frend` = '$user[id]') OR (`user` = '$user[id]' AND `frend` = '$ank[id]') LIMIT 1");
if (isset($user) && $user['id']!=$ank['id'] && mysql_result($teman2, 0)==0)
{
}
else
{
if (isset($user) && $user['id']!=$ank['id'])
{
echo "<div class=\"penanda\"><div id=\"body\ class=\"acw apm\">Write something...";
echo '<form method="post" id="composer_form" name="message" action="info.php?id='.$user_id.'">';
echo "<table class=\"comboInput\" cellpadding=\"0\" cellspacing=\"0\"><tbody><tr><td class=\"inputCell\"><textarea class=\"input composerInput\" name=\"message\" rows=\"2\" cols=\"15\"></textarea></td><td><input value=\"Send\" class=\"btn btnC\" type=\"submit\"></td></tr></tbody></table></div></form></div></div>";
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

$query = @mysql_query("SELECT * FROM `wall` WHERE `user_id` = '$user_id' ORDER BY `time` DESC LIMIT 3");

while ($array = mysql_fetch_array($query))
{
$user_nick = @mysql_result(@mysql_query("SELECT `nick` FROM `user` WHERE `id` = '".$array['who']."';"), 0);
echo ceil(ceil($i / 2) - ($i / 2)) == 0 ? '<div class="list1">' : '<div class="list2">';
echo '<table class="post" width="100%">';
echo '<tr>';

echo '<td class="status" width="80%" valign="top">';
echo '<a href="/info.php?id='.$array['who'].'">'.$user_nick.'</a> '.online($array['who']).'';
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
echo ' &#183; <a href="info.php?id='.$user_id.'&amp;wall&amp;delete='.$array['id'].'"><span class="post">Delete</span></a>';
}
echo'</td>';
echo'</tr>';
echo '</table>';
echo '</div>';
++$i;
}
if($k_post > 3)
{
echo '<div class="status"><a href="/wall.php?id='.$user_id.'">See more</a></div>';
} else {
echo '<div class="status"></div>';
}
echo '<div class="acw apm">';
if (isset($user) && $user['id']!=$ank['id']){
echo '<a href="?id='.$ank['id'].'&poke">Poke</a><br/>';
}
if (isset($user))
{
echo "<a href='/gifts.php?id=".$ank['id']."'>Gifts (".mysql_result(mysql_query("SELECT COUNT(*) FROM `gifts` WHERE `id_user` = '".$ank[id]. "'",$db),0).")</a><br />";

echo "<a href='/blog/user.php?id=".$ank['id']."'>Notes (".mysql_result(mysql_query("SELECT COUNT(*) FROM `blog_list` WHERE `id_user` = '".$ank[id]. "'",$db),0).")</a><br />";

echo '<a href="/foto/'.$ank['id'].'/">Album (';
echo mysql_result(mysql_query("SELECT COUNT(*) FROM `gallery` WHERE `id_user` = '$ank[id]'"),0);
echo ")</a><br/>";
echo '<a href="status.php?id='.$ank['id'].'">Status</a><br/>';
}
if (isset($user) && $user['id']!=$ank['id']){
echo '<a href="podarki/gifts.php?id='.$ank['id'].'&pod=1">Send Gift</a><br/>';
}
$teman2 = mysql_query("SELECT COUNT(*) FROM `frends` WHERE (`user` = '$ank[id]' AND `frend` = '$user[id]') OR (`user` = '$user[id]' AND `frend` = '$ank[id]') LIMIT 1");
if (isset($user) && $user['id']!=$ank['id'] && mysql_result($teman2, 0)==0)
{
}
else
{
if (isset($user) && $user['id']!=$ank['id']){
echo'<a href="/frend_new.php?del='.$ank['id'].'">Unfriend</a><br/>';
}
}

if($ank[id]==$user[id]){
echo "<a href='avatar.php'>Change Photo</a><br/>";
}

$k_post = mysql_result(mysql_query("SELECT COUNT(*) FROM `gifts` WHERE `id_user` = '$ank[id]' LIMIT 1"), 0);
if ($k_post==0)
{

}
$q = mysql_query("SELECT * FROM `gifts` WHERE `id_user` = '$ank[id]' ORDER BY time DESC LIMIT 1");
while ($f = mysql_fetch_array($q))
{
$a = mysql_fetch_array(mysql_query("SELECT * FROM `user` WHERE `id` = '$f[ot_id]' LIMIT 1"));
echo"<img src='/gifts/".$f['id_gifts'].".png' width='32' height='32'  alt='' class='icon'/></hr>";
}
echo "</div>";
}
else {
echo "<div class='acw apm'><strong><span class='mfsm fcb'><a href='?id=$ank[id]'>Wall</a> &#183; <b>Info</b>";
if (isset($user))
{
echo '<a href="/foto/'.$ank['id'].'/"> &#183; Foto</a>';
}
echo "</span></strong></div>";
include_once 'ank.php';
}


include_once 'sys/inc/tfoot.php';
?>
