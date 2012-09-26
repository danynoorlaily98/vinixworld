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
if (mysql_result(mysql_query("SELECT COUNT(*) FROM `user` WHERE `id` = '$ank[id]' LIMIT 1"),0)==0){header("Location: /index.php?".SID);exit;}
$ank=mysql_fetch_array(mysql_query("SELECT * FROM `user` WHERE `id` = $ank[id] LIMIT 1"));
$set['title']=''.$ank['nick'].' - Profile Picture';
include_once 'sys/inc/thead.php';

if ((!isset($_SESSION['refer']) || $_SESSION['refer']==NULL)
&& isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER']!=NULL &&
!ereg('info\.php',$_SERVER['HTTP_REFERER']))
$_SESSION['refer']=str_replace('&','&amp;',ereg_replace('^http://[^/]*/','/', $_SERVER['HTTP_REFERER']));
//aut();

echo "<div class='async_like'><div class='acbk'><div style='text-align:center;'><a href='/sys/avatars/".$ank['id'].".jpg'>";
avatars($ank['id']);
echo "</a></div></div>";
echo '<div class="acbk aps">';
echo "<table cellspacing='0' cellpadding='0' class='lr'><tr><td valign='top'><a class='inv' href='/info.php?id=".$ank['id']."'>Back</a></td><td valign='top' class='r'>";
echo '<a class="inv" href="/foto/'.$ank['id'].'/">Album (';
echo mysql_result(mysql_query("SELECT COUNT(*) FROM `gallery` WHERE `id_user` = '$ank[id]'"),0);
echo ")</a>";
echo "</td></tr></table>";
echo "</div></div>";
echo "<div class='acw apl'><strong><a href='/info.php?id=".$ank['id']."'>$ank[nick]</a></strong></div>";


/*$user_id = $ank['id'];
if(isset($_GET['delete']) AND !empty($_GET['delete'])){
$delete = intval($_GET['delete']);
$delete = intval($_GET['delete']);
$delete = intval($_GET['delete']);
if($user['level']>3 OR $ank['id']==$user['id']){
$query = @mysql_query("SELECT `id` FROM `photo_komm` WHERE `user_id` = '".$user_id."' AND `id` = '".$delete."';");

if(@mysql_affected_rows()>0){
@mysql_query("DELETE FROM `photo_komm` WHERE `user_id` = '".$user_id."' AND `id` = '".$delete."' LIMIT 1;");
mysql_query("OPTIMIZE TABLE `photo_komm`");
echo '<div class="msg">Comment deleted!</div>';
}else
echo '<div class="err">Comment not found!</div>';
}else
echo '<div class="err">You are not allowed!</div>';
}

if(isset($_POST['message']) AND isset($user)){
$message = htmlspecialchars($_POST['message']);
if(isset($_POST['translit']) AND $_POST['translit']){
$message = translit($message);
}
$err = '';
if(strlen2($message)>512){
$err .= '&nbsp;&nbsp;Too long!;<br/>';
}

if(strlen2($message)<2){
$err .= '&nbsp;&nbsp;Too short!;<br/>';
}

if(@mysql_result(@mysql_query("SELECT COUNT(*) FROM `photo_komm` WHERE `user_id` = '".$user_id."' AND `message` = '".@mysql_escape_string($message)."' AND `time` > '".($time - 300)."' LIMIT 1"), 0)!= 0){
$err .= 'ANTI flood<br/>';
}

if(time() - @mysql_result(@mysql_query("SELECT `time` FROM `photo_komm` WHERE `user_id` = '$user_id' ORDER BY `id` DESC LIMIT 1;"),0)<30){
$err .= 'You must wait a few seconds<br/>';
}
if($err!=''){
echo '<div class="err">Error:<br/>'.$err.'!</div>';
}else{
$message = @mysql_escape_string($message);
@mysql_query("INSERT INTO `photo_komm` (`user_id`, `who`, `time`, `message`) values('".$user_id."', '".$user['id']."', '".$time."', '".$message."')");
@mysql_query("UPDATE `user` SET `balls` = '".($user['balls']+1)."' WHERE `id` = '$user[id]' LIMIT 1");



if (isset($user) && $user['id']!=$ank['id'])
{
$msgn="[url=/info.php?id=$user[id]]$user[nick][/url] comment on your profile [url=/primary.php?id=$ank[id]]picture[/url]"; mysql_query("INSERT INTO `jurnal` (`id_user`, `id_kont`, `msg`, `time`) values('0', '$ank[id]', '$msgn', '$time')");}

$userfoto = get_user($postfoto['id_user']);
if ($user[id]!=$userfoto[id] && $user[id]==$ank[id]){
$pemberitahuan = ''.$user['nick'].' also comments on his profile [url=/primary.php?id='.$ank['id'].']picture[/url]';
}
elseif ($user[id]!=$ank[id] && $userfoto[id]!=$ank[id]){
$pemberitahuan = ''.$user['nick'].' also comments on '.$ank['nick'].' profile [url=/primary.php?id='.$ank['id'].']picture[/url]';
}
if ($userfoto[id]!=$user[id] && $userfoto[id]!=$ank[id]) {
mysql_query("INSERT INTO `jurnal` (`id_user`, `id_kont`, `msg`, `time`) VALUES ('0', '$userfoto[id]', '$pemberitahuan', '$time')");
}
}
}
mysql_query("OPTIMIZE TABLE `photo_komm`, `user`, `jurnal`");
echo '<div class="message"><b>Your comment has been added</b></div>';
}
$k_post = @mysql_result(@mysql_query("SELECT COUNT(*) FROM `photo_komm` WHERE `user_id` = '".$user_id."'"),0);
$k_page = k_page($k_post, $set['p_str']);
$page = page($k_page);
$start = $set['p_str'] * $page - $set['p_str'];
$teman2 = mysql_query("SELECT COUNT(*) FROM `frends` WHERE (`user` = '$ank[id]' AND `frend` = '$user[id]') OR (`user` = '$user[id]' AND `frend` = '$ank[id]') LIMIT 1");
if (isset($user) && $user['id']!=$ank['id'] && mysql_result($teman2, 0)==0)
{
}
else
{
if (isset($user)){
echo '<div class="gmenu"><form method="post" action="primary.php?id='.$user_id.'">';
echo 'Add comment:<br/><textarea name="message"></textarea><br/>';
echo '<input type="submit" class="button" name="post" value="Send"/></form></div>';
}
}
echo '<table class="post">';
if(!$k_post){
echo '<tr><td class="err">No comments</td></tr>';
}
$query = @mysql_query("SELECT * FROM `photo_komm` WHERE `user_id` = '".$user_id."' ORDER BY `time` ASC LIMIT $start, $set[p_str];");
while ($array = mysql_fetch_array($query)){
$user_nick = @mysql_fetch_array(@mysql_query("SELECT * FROM `user` WHERE `id` = '".$array['who']."'"));
echo '<table width="100%"><td class="icon14">';
echo avatar($array['who']);
echo'</td><td class="p_t"><a href="info.php?id='.$array['who'].'"><span style="color:'.$user_nick['ncolor'].'">'.$user_nick['nick'].'</span></a>&nbsp;'.online($array['who']).'<br>'.vremja($array['time']).'</td></table>';
echo '<div class="p_m">'.output_text($array['message']).'<br/>';

if($user['level']>3 OR $ank['id']==$user['id']){
echo '<a href="primary.php?id='.$user_id.'&amp;komm&amp;delete='.$array['id'].'">Delete</a>';
}
echo '</div></td></tr>';}
echo '</table>';
if($k_page>1){
str('primary.php?id='.$user_id.'&amp;komm&amp;', $k_page, $page);
}
if (isset($user) && $user['id']==$ank['id'])
{
$jn=mysql_result(mysql_query("SELECT COUNT(*) FROM `jurnal` WHERE `id_kont` = '$user[id]' AND `read` = '0'"), 0);
}
echo "</div>";
echo "<div class='phdr'>";
if (isset($user) && $user['id']==$ank['id']){
echo " My profile picture";} else {
echo " $ank[nick]'s profile picture";}
echo "</div>";*/
include_once 'sys/inc/tfoot.php';
?>
