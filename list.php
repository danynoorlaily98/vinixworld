<?php

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

/////////////////////////////
// Bila ditentukan TRUE maka komentar akan ditampilkan pada halaman yang sama di mana blog itu sendiri.
// Jika Anda menetapkan FALSE, maka komentar akan ditampilkan pada halaman terpisah
$komm_list=TRUE;
///////////////////////////

if(!isset($_GET['id']))
{
$set['title']='Status';
include_once 'sys/inc/thead.php';
//title();
echo "No status updated!";
echo"<div class='foot'>\n";
echo"<a href='index.php'>&raquo;Back</a><br />\n";
echo"</div>\n";
include_once 'sys/inc/tfoot.php';
exit();
}
$id = intval($_GET['id']);



if(mysql_result(mysql_query("SELECT COUNT(*) FROM `statuse_list` WHERE  `id` = '".intval($_GET['id'])."'"),0) ==0)
{
$set['title']='Status';
include_once 'sys/inc/thead.php';
//title();

echo "No status updated";
echo"<div class='foot'>\n";
echo"<a href='index.php'>&raquo;Back</a><br />\n";
echo"</div>\n";
include_once 'sys/inc/tfoot.php';
exit();
}
$statuse=mysql_fetch_array(mysql_query("select * from `statuse_list` where `id`='".intval($_GET['id'])."';"));


if($statuse['privat'] == 1)
{
if (($user['level'] < 4) && ($user['id'] !=$statuse['id_user']))
{
$set['title']=' Status';
include_once 'sys/inc/thead.php';
//title();

echo "Private articel<br\>Not for public!";
echo"<div class='foot'>\n";
echo"<a href='index.php'>&raquo;Back</a><br />\n";
echo"</div>\n";
include_once 'sys/inc/tfoot.php';
exit();
}
}
mysql_query("UPDATE `statuse_list` SET `count` = '".($statuse['count']+1)."' WHERE `id` = '$statuse[id]' LIMIT 1");
$ank=get_user($statuse['id_user']);
$set['title']=''.$ank['nick'].' - Status';
include_once 'sys/inc/thead.php';

err();
if (isset($_GET['tidak']) && isset($user))
{
mysql_query("DELETE FROM `statuse_like` WHERE `id_user` = '$user[id]' AND `id_statuse` = '".intval($_GET['id'])."' LIMIT 1");
}

if (isset($_GET['like']) && isset($user))
{
if (mysql_result(mysql_query("SELECT COUNT(*) FROM `statuse_like` WHERE `id_statuse` = '".intval($_GET['id'])."' AND `id_user` = '$user[id]' LIMIT 1"),0)!=0){}
else{
mysql_query("INSERT INTO `statuse_like` (`id_user`, `id_statuse`) values('$user[id]', '".intval($_GET['id'])."')");
if (isset($user) && $user['id']!=$ank['id'])
{
$msgn="[img]/status/suka.gif[/img] [url=/info.php?id=$user[id]]$user[nick][/url] like your [url=/list.php?id=$statuse[id]]status[/url]."; mysql_query("INSERT INTO `jurnal` (`id_user`, `id_kont`, `msg`, `time`) values('0', '$ank[id]', '$msgn', '$time')");}
$anu = mysql_query("SELECT * FROM `statuse_like` WHERE `id_statuse`='$statuse[id]' ORDER BY `id`");
while ($postlike = mysql_fetch_assoc($anu))
{
$userlike = get_user($postlike['id_user']);
if ($user[id]!=$userlike[id]) {
if ($user[id]==$ank[id]){
$pemberitahuan = '[img]/status/suka.gif[/img] '.$user['nick'].' like your [url=/list.php?id='.$statuse['id'].']status[/url].';
}
elseif ($user[id]!=$ank[id] && $userlike[id]!=$ank[id]){
$pemberitahuan = '[img]/status/suka.gif[/img] '.$user['nick'].' like '.$ank['nick'].' [url=/list.php?id='.$statuse['id'].']status[/url].';
}
if ($userlike[id]!=$user[id] && $userlike[id]!=$ank[id]) {
mysql_query("INSERT INTO `jurnal` (`id_user`, `id_kont`, `msg`, `time`) VALUES ('0', '$userlike[id]', '$pemberitahuan', '$time')");
}
}
}
}
}
$user_id = $ank['id'];
//echo "".online($ank['id'])." ";
echo "<a href='info.php?id=$ank[id]'><b>$ank[nick]</b></a>";

echo "".online($ank['id'])." ";
//echo "<a href='/info.php?id=$ank[id]'> <strong> $ank[nick]</strong></a> \n";

echo " ".output_text($statuse['msg'])." <br /><font color='#808080' size='2'> ".waktu($statuse['time'])." via $ank[ua]</font><br/>\n";

$teman2 = mysql_query("SELECT COUNT(*) FROM `frends` WHERE (`user` = '$ank[id]' AND `frend` = '$user[id]') OR (`user` = '$user[id]' AND `frend` = '$ank[id]') LIMIT 1");
if (isset($user) && $user['id']!=$ank['id'] && mysql_result($teman2, 0)==0)
{
}
else
{

if (mysql_result(mysql_query("SELECT COUNT(*) FROM `statuse_like` WHERE `id_statuse` = '$statuse[id]' AND `id_user` = '$user[id]' LIMIT 1"),0)==0){
echo "&#183; <a href='list.php?id=".$statuse['id']."&amp;like'>Like</a>";
} else {
echo "&#183; <a href='list.php?id=".$statuse['id']."&amp;tidak'>Unlike</a>";
}
}
if (($user['level'] >= 4) || ($user['id'] ==$statuse['id_user']))
{
//echo "<a href='edit.php?id=$statuse[id]'>Edit </a>";
echo " &#183; <a href='edit.php?id=$statuse[id]&amp;del'>Delete</a>";
}
//if ($k_page>1)str("?id=".intval($_GET['id']).'&amp;',$k_page,$page);
if (!isset($_GET['id']) && !is_numeric($_GET['id'])){header("Location: index.php?".SID);exit;}
if (mysql_result(mysql_query("SELECT COUNT(*) FROM `statuse_list` WHERE `id` = '".intval($_GET['id'])."' LIMIT 1",$db), 0)==0){header("Location: index.php?".SID);exit;}
$statuse=mysql_fetch_array(mysql_query("select * from `statuse_list` where `id`='".intval($_GET['id'])."';"));

if (isset($_POST['msg']) && isset($user))
{
$msg=$_POST['msg'];
if (isset($_POST['translit']) && $_POST['translit']==1)$msg=translit($msg);
if (strlen2($msg)>1024){$err='Message to long';}
elseif (strlen2($msg)<2){$err='Message to short';}
elseif (mysql_result(mysql_query("SELECT COUNT(*) FROM `statuse_komm` WHERE `id_statuse` = '".intval($_GET['id'])."' AND `id_user` = '$user[id]' AND `msg` = '".mysql_real_escape_string($msg)."' LIMIT 1"),0)!=0){$err='Message saved before';}
else{
mysql_query("INSERT INTO `statuse_komm` (`id_user`, `time`, `msg`, `id_statuse`) values('$user[id]', '$time', '".mysql_real_escape_string($msg)."', '".intval($_GET['id'])."')");
mysql_query("UPDATE `user` SET `balls` = '".($user['balls']+1)."' WHERE `id` = '$user[id]' LIMIT 1");
if(mysql_result(mysql_query("SELECT COUNT(*) FROM `statuse_anu` WHERE `id_statuse` = '".intval($_GET['id'])."' AND `id_user` = '$user[id]' LIMIT 1"),0)==0){
mysql_query("INSERT INTO `statuse_anu` (`id_user`, `id_statuse`) values('$user[id]', '".intval($_GET['id'])."')");
}

msg('Comment added');
//Pemberitahuan//
//$towall="comment on status";
//mysql_query("INSERT INTO `wall` (`user_id`, `who`, `time`, `$towall`) values('$user_id', '".$user['id']."', '".time()."', '$message')");
//mysql_query("UPDATE `user` SET `msg_on_wall` = `msg_on_wall` + 1 WHERE `id` = '".$user['id']."' LIMIT 1");
if (isset($user) && $user['id']!=$ank['id'])
{
$msgn="[img]/style/icon/jurnal.png[/img] [url=/info.php?id=$user[id]]$user[nick][/url] comments on your [url=/list.php?id=$statuse[id]&page=end][b]status[/b][/url]. "; mysql_query("INSERT INTO `jurnal` (`id_user`, `id_kont`, `msg`, `time`) values('0', '$ank[id]', '$msgn', '$time')");}
$anu = mysql_query("SELECT * FROM `statuse_anu` WHERE `id_statuse`='$statuse[id]' ORDER BY `id`");
while ($postanu = mysql_fetch_assoc($anu))
{
$useranu = get_user($postanu['id_user']);
if ($user[id]!=$useranu[id]) {
if ($user[id]==$ank[id]){
$pemberitahuan = '[img]/style/icon/jurnal.png[/img] '.$user['nick'].' comments on his [url=/list.php?id='.$statuse['id'].'&page=end][b]status[/b][/url]. ';
}
elseif ($user[id]!=$ank[id] && $useranu[id]!=$ank[id]){
$pemberitahuan = '[img]/style/icon/jurnal.png[/img] '.$user['nick'].' also comment on '.$ank['nick'].' [url=/list.php?id='.$statuse['id'].'&page=end][b]status[/b][/url].';
}
if ($useranu[id]!=$user[id] && $useranu[id]!=$ank[id]) {
mysql_query("INSERT INTO `jurnal` (`id_user`, `id_kont`, `msg`, `time`) VALUES ('0', '$useranu[id]', '$pemberitahuan', '$time')");
}
}
}



}
}
elseif (isset($_GET['del']) && mysql_result(mysql_query("SELECT COUNT(*) FROM `statuse_komm` WHERE `id` = '".intval($_GET['del'])."' && `id_statuse` = '".intval($_GET['id'])."'"),0))
{
if (isset($user) && ($user['level']>=4) || isset($user) && ($user['id']=$statuse['id_user']))
{
mysql_query("DELETE FROM `statuse_komm` WHERE `id` = '".intval($_GET['del'])."' LIMIT 1");
}
}

if($komm_list)
{
$k_post=mysql_result(mysql_query("SELECT COUNT(*) FROM `statuse_komm` WHERE `id_statuse` = '".intval($_GET['id'])."'"),0);
$k_page=k_page($k_post,$set['p_str']);
$page=page($k_page);
$start=$set['p_str']*$page-$set['p_str'];
$q=mysql_query("SELECT * FROM `statuse_komm` WHERE `id_statuse` = '".intval($_GET['id'])."' ORDER BY `time` ASC LIMIT $start, $set[p_str]");

$kim=mysql_result(mysql_query("SELECT COUNT(*) FROM `statuse_like` WHERE `id_statuse` = '".intval($_GET['id'])."'"),0);

if($kim==1){
$kum=mysql_result(mysql_query("SELECT `id_user` FROM `statuse_like` WHERE `id_statuse` = '".intval($_GET['id'])."'"),0);
$kom=mysql_result(mysql_query("SELECT `nick` FROM `user` WHERE `id`='$kum' LIMIT 1"),0);

echo "<div class='comment'>\n";
echo "<img src='status/suka.gif'> <a href='/info.php?id=$kum'>$kom</a> like this.";
echo "</div>";
}
elseif($kim>=2){
$kum=mysql_result(mysql_query("SELECT `id_user` FROM `statuse_like` WHERE `id_statuse` = '".intval($_GET['id'])."'"),0);
$kom=mysql_result(mysql_query("SELECT `nick` FROM `user` WHERE `id`='$kum' LIMIT 1"),0);
$kem=$kim-1;
echo "<div class='comment'>\n";
echo "<img src='status/suka.gif'> <a href='/info.php?id=$kum'>$kom</a> and <a href='status/like_all.php?id=".$statuse['id']."'>$kem peoples</a> like this.";
echo "</div>";
}
echo "</div>";
while ($post = mysql_fetch_assoc($q))
{
//$ank=mysql_fetch_assoc(mysql_query("SELECT * FROM `user` WHERE `id` = $post[id_user] LIMIT 1"));
$ank=get_user($post['id_user']);

echo "<div class='comment'>\n";
//echo "<a href='/info.php?id=$ank[id]'>$ank[nick]</a>\n";

echo "<a href='info.php?id=$ank[id]'><b>$ank[nick] </b></a>";
echo output_text($post['msg'])."<br /><font color='#808080'>".waktu($post['time'])."</font></span>\n";

if (isset($user) && ($user['level']>=4) || isset($user) && ($user['id'] == $statuse['id_user']))
echo "&#183; <a href='?id=".intval($_GET['id'])."&amp;del=$post[id]'> Delete</a><br />\n";
echo "</div>";
}

if ($k_page>1)str("?id=".intval($_GET['id']).'&amp;',$k_page,$page);

//Form komentar
$teman2 = mysql_query("SELECT COUNT(*) FROM `frends` WHERE (`user` = '$ank[id]' AND `frend` = '$user[id]') OR (`user` = '$user[id]' AND `frend` = '$ank[id]') LIMIT 1");
if (isset($user) && $user['id']!=$ank['id'] && mysql_result($teman2, 0)==0)
{
}
else
{
echo"<div class='comment'>\n";
if (isset($user))
{
echo "<form method=\"post\" name='message' action=\"?id=".intval($_GET['id'])."&amp;page=$page\">\n";
if ($set['web'] && is_file(H.'style/themes/'.$set['set_them'].'/altername_post_form.php'))
include_once H.'style/themes/'.$set['set_them'].'/altername_post_form.php';
else
/*echo "<div>";
echo "<form method=\"post\" name='message' action=\"?\">\n";
echo "<table cellspacing=\"0\" cellpadding=\"0\" class=\"comboInput\"><tr><td class=\"inputCell\">";
echo "Add a comment";
echo "<br />\n<textarea name=\"msg\" rows=\"3\" cols=\"13\"></textarea></td><td>\n";
echo "<input class=\"btn btnC\" value=\"Komentari\" type=\"submit\"/></td></tr></table></div>\n";
echo "</form></div>\n";*/
echo "<div id=\"body\"><form method=\"post\" id=\"composer_form\" name=\"message\" action=\"?\"><table class=\"comboInput\" cellpadding=\"0\" cellspacing=\"0\"><tbody><tr><td class=\"inputCell\"><textarea class=\"input composerInput\" name=\"msg\" rows=\"2\" cols=\"13\"></textarea></td><td><input value=\"Comment\" class=\"btn btnC\" type=\"submit\"></td></tr></tbody></table></div></form></div>";
}
}
echo "</div>\n";
}
include_once 'sys/inc/tfoot.php';
?>
