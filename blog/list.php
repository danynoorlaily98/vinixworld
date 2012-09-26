<?php

// remodified by noe
// http://nnetwork.tk
// loegue.info@gmail.com


include_once '../sys/inc/start.php';
include_once '../sys/inc/compress.php';
include_once '../sys/inc/sess.php';
include_once '../sys/inc/home.php';
include_once '../sys/inc/settings.php';
include_once '../sys/inc/db_connect.php';
include_once '../sys/inc/ipua.php';
include_once '../sys/inc/fnc.php';
include_once '../sys/inc/user.php';

/////////////////////////////
// Bila ditentukan TRUE maka komentar akan ditampilkan pada halaman yang sama di mana blog itu sendiri.
// Jika Anda menetapkan FALSE, maka komentar akan ditampilkan pada halaman terpisah
$komm_list=TRUE;
///////////////////////////

if(!isset($_GET['id']))
{
$set['title']='Notes';
include_once '../sys/inc/thead.php';
title();
//aut();
echo "No newest note!";
echo"<div class='foot'>\n";
echo"<a href='index.php'>&nbsp;Back</a><br />\n";
echo"</div>\n";
include_once '../sys/inc/tfoot.php';
exit();
}
$id = intval($_GET['id']);



if(mysql_result(mysql_query("SELECT COUNT(*) FROM `blog_list` WHERE  `id` = '".intval($_GET['id'])."'"),0) ==0)
{
$set['title']='Notes';
include_once '../sys/inc/thead.php';
title();
//aut();
echo "No newest note";
echo"<div class='foot'>\n";
echo"<a href='index.php'>&nbsp;Back</a><br />\n";
echo"</div>\n";
include_once '../sys/inc/tfoot.php';
exit();
}
$blog=mysql_fetch_array(mysql_query("select * from `blog_list` where `id`='".intval($_GET['id'])."';"));


if($blog['privat'] == 1)
{
if (($user['level'] < 4) && ($user['id'] !=$blog['id_user']))
{
$set['title']='Notes';
include_once '../sys/inc/thead.php';
title();
//aut();
echo "Private note<br \>";
echo"<div class='foot'>\n";
echo"<a href='index.php'>&nbsp;Back</a><br />\n";
echo"</div>\n";
include_once '../sys/inc/tfoot.php';
exit();
}
}
mysql_query("UPDATE `blog_list` SET `count` = '".($blog['count']+1)."' WHERE `id` = '$blog[id]' LIMIT 1");
$ank=get_user($blog['id_user']);
$set['title']='Notes - '.$ank['nick'].'';
include_once '../sys/inc/thead.php';
//title();
//aut();
err();
echo"<div>";
echo"<a href='user.php?id=$ank[id]'>$ank[nick]'s notes</a><br/>";
echo"</div>";
echo "<div class='list2'>";
echo "<table class='post' width='100%'>";
echo "<tr><td class='icon14'>";
avatar($ank['id']);
echo "</td>";
echo "<td class='status' width='80%' valign='top'><font color='#808080'>".output_text($blog['name'])."</font><br/><font color='#808080'>by</font> <a href='/info.php?id=$ank[id]'>$ank[nick]</a>".online($ank['id'])."";
echo "</td>";
echo " </tr>";
echo "</table>";
echo "</div>";

//$q_f=mysql_query("SELECT * FROM `blog_img` WHERE `id_blog` = '".intval($_GET['id'])."'");
//while ($file = mysql_fetch_assoc($q_f))
//{
//echo "<img src='img/$file[id].jpg' alt='$file[name]' />\n";
//echo "<br />\n";
//}
echo "".output_text($blog['msg'])."<br/>";
echo "<font class='time'>".vremja($blog['time'])."</font><br/>";

echo"<div>";
if (($user['level'] >= 4) || ($user['id'] ==$blog['id_user']))
{
// echo"<a href='file.php?id=$blog[id]'>&raquo;Manage File</a><br \>";
// echo"<a href='img.php?id=$blog[id]'>&raquo;Add/Edit Image</a><br />";
echo"&nbsp;<a href='edit.php?id=$blog[id]'>Edit</a>";
echo"&nbsp;<a href='edit.php?id=$blog[id]&amp;del'>Delete</a><br/>";
}
//WAPSORT.ORG//
if (!isset($_GET['id']) && !is_numeric($_GET['id'])){header("Location: index.php?".SID);exit;}
if (mysql_result(mysql_query("SELECT COUNT(*) FROM `blog_list` WHERE `id` = '".intval($_GET['id'])."' LIMIT 1",$db), 0)==0){header("Location: index.php?".SID);exit;}
$blog=mysql_fetch_array(mysql_query("select * from `blog_list` where `id`='".intval($_GET['id'])."';"));

if (isset($_POST['msg']) && isset($user))
{
$msg=$_POST['msg'];
if (isset($_POST['translit']) && $_POST['translit']==1)$msg=translit($msg);
if (strlen2($msg)>1024){$err='Message is too long!';}
elseif (strlen2($msg)<2){$err='Message is too shoort!';}
elseif (mysql_result(mysql_query("SELECT COUNT(*) FROM `blog_komm` WHERE `id_blog` = '".intval($_GET['id'])."' AND `id_user` = '$user[id]' AND `msg` = '".mysql_real_escape_string($msg)."' LIMIT 1"),0)!=0){$err='Message saved before';}
else{
mysql_query("INSERT INTO `blog_komm` (`id_user`, `time`, `msg`, `id_blog`) values('$user[id]', '$time', '".mysql_real_escape_string($msg)."', '".intval($_GET['id'])."')");
mysql_query("UPDATE `user` SET `balls` = '".($user['balls']+1)."' WHERE `id` = '$user[id]' LIMIT 1");
if(mysql_result(mysql_query("SELECT COUNT(*) FROM `blog_anu` WHERE `id_blog` = '".intval($_GET['id'])."' AND `id_user` = '$user[id]' LIMIT 1"),0)==0){
mysql_query("INSERT INTO `blog_anu` (`id_user`, `id_blog`) values('$user[id]', '".intval($_GET['id'])."')");
}
msg('Comment added');
// Pemberitahuan //



if (isset($user) && $user['id']!=$ank['id'])
{
$msgn="[img]/style/icon/blog.gif[/img] [url=/info.php?id=$user[id]]$user[nick][/url] commented on your [url=/blog/list.php?id=$blog[id]][b]blog[/b][/url]. "; mysql_query("INSERT INTO `jurnal` (`id_user`, `id_kont`, `msg`, `time`) values('0', '$ank[id]', '$msgn', '$time')");}
$anu = mysql_query("SELECT * FROM `blog_anu` WHERE `id_blog`='$blog[id]' ORDER BY `id`");
while ($postanu = mysql_fetch_assoc($anu))
{
$useranu = get_user($postanu['id_user']);
if ($user[id]!=$useranu[id]) {
if ($user[id]==$ank[id]){
$pemberitahuan = '[img]/style/icon/blog.gif[/img] '.$user['nick'].' also commented on his [url=/blog/list.php?id='.$blog['id'].'][b]blog[/b][/url]. ';
}
elseif ($user[id]!=$ank[id] && $useranu[id]!=$ank[id]){
$pemberitahuan = '[img]/style/icon/blog.gif[/img] '.$user['nick'].' also commented on '.$ank['nick'].' [url=/blog/list.php?id='.$blog['id'].'][b]blog[/b][/url]. ';
}
if ($useranu[id]!=$user[id] && $useranu[id]!=$ank[id]) {
mysql_query("INSERT INTO `jurnal` (`id_user`, `id_kont`, `msg`, `time`) VALUES ('0', '$useranu[id]', '$pemberitahuan', '$time')");
}
}
}

//Pemberitahuan//
}
}
elseif (isset($_GET['del']) && mysql_result(mysql_query("SELECT COUNT(*) FROM `blog_komm` WHERE `id` = '".intval($_GET['del'])."' && `id_blog` = '".intval($_GET['id'])."'"),0))
{
if (isset($user) && ($user['level']>=4) || isset($user) && ($user['id']=$blog['id_user']))
{
mysql_query("DELETE FROM `blog_komm` WHERE `id` = '".intval($_GET['del'])."' LIMIT 1");
}
}


if($komm_list)
{
$k_post=mysql_result(mysql_query("SELECT COUNT(*) FROM `blog_komm` WHERE `id_blog` = '".intval($_GET['id'])."'"),0);
$k_page=k_page($k_post,$set['p_str']);
$page=page($k_page);
$start=$set['p_str']*$page-$set['p_str'];
$q=mysql_query("SELECT * FROM `blog_komm` WHERE `id_blog` = '".intval($_GET['id'])."' ORDER BY `time` ASC LIMIT $start, $set[p_str]");

if ($k_post==0){

echo "  <div class='p_m'>\n";
echo "No Comment !!!\n";
echo "  </div>";
}else{
while ($post = mysql_fetch_assoc($q))
{
//$ank=mysql_fetch_assoc(mysql_query("SELECT * FROM `user` WHERE `id` = $post[id_user] LIMIT 1"));
$ank=get_user($post['id_user']);
echo "<div class='comment'>";
echo "<b><a href='/info.php?id=$ank[id]'>$ank[nick]</a>".online($ank['id'])."</b> ".output_text($post['msg'])."<br/><font color='#808080' size='2'>".vremja($post['time'])."</font>";
if (isset($user) && ($user['level']>=4) || isset($user) && ($user['id'] == $blog['id_user']))
echo "<a href='?id=".intval($_GET['id'])."&amp;del=$post[id]'>&nbsp;Delete</a><br />\n";
echo "</div>";
}
}

if ($k_page>1)str("?id=".intval($_GET['id']).'&amp;',$k_page,$page);
}
$teman2 = mysql_query("SELECT COUNT(*) FROM `frends` WHERE (`user` = '$ank[id]' AND `frend` = '$user[id]') OR (`user` = '$user[id]' AND `frend` = '$ank[id]') LIMIT 1");
if (isset($user) && $user['id']!=$ank['id'] && mysql_result($teman2, 0)==0)
{
}
else
{
if (isset($user))
{
echo "<form method=\"post\" name='message' action=\"?id=".intval($_GET['id'])."&amp;page=$page\">\n";
echo "Add Comment:<br />\n<textarea name=\"msg\"></textarea><br />\n";
echo "<input value=\"Send\" type=\"submit\" />\n";
echo "</form>\n";
}
}

//echo"<a href='index.php'>&raquo;Go to Notes</a><br />\n";
echo"</div>\n";

include_once '../sys/inc/tfoot.php';

?>
