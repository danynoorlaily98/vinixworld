<?php

// Blog For Dcms
// Script by : Lex
// Homepage : http://playm.ru
// Translated by : insanity
// Homepage : http://www.invinitife.com

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


$set['title']='Notes';
include_once '../sys/inc/thead.php';
//title();
err();
//aut();


if (isset($_GET['sort']) && $_GET['sort'] =='t')$order='order by `time` desc';
elseif (isset($_GET['sort']) && $_GET['sort'] =='c') $order='order by `count` desc';
else $order='order by `time` desc';
echo'<div >';
echo"&nbsp;<a href='?sort=t'>New</a>&nbsp;<a href='?sort=c'>Top</a><br/>";
echo '</div>';

$k_post=mysql_result(mysql_query("SELECT COUNT(*) FROM `blog_list` WHERE `privat` = 0"),0);
$k_page=k_page($k_post,$set['p_str']);
$page=page($k_page);
$start=$set['p_str']*$page-$set['p_str'];
echo "<table class='post' width='100%'>";


if($k_post==0)
{
echo "   <tr>";
echo "  <td class='p_t'>";
echo "No note !!!<br/>";
echo "  </td>";
echo "   </tr>";
}

$res = mysql_query("select * from `blog_list` WHERE `privat` = 0 $order LIMIT $start, $set[p_str];");
while ($blog = mysql_fetch_array($res)){


$ank=get_user($blog['id_user']);
echo "   <tr>";
echo "<td class='icon14'>";
avatar($ank['id']);
echo "</td>";
echo "<td class='status' valing='top'>";
echo "<a href='/info.php?id=$ank[id]'>$ank[nick]</a>".online($ank['id'])."<br/>";
if (isset($user)){
$teman2 = mysql_query("SELECT COUNT(*) FROM `frends` WHERE (`user` = '$ank[id]' AND `frend` = '$user[id]') OR (`user` = '$user[id]' AND `frend` = '$ank[id]') LIMIT 1");
if (isset($user) && $user['id']!=$ank['id'] && mysql_result($teman2, 0)==0)
{
echo "<font class='ank_d'>".output_text($blog['name'])."</font><br/>";
}
else
{
echo "<a href='list.php?id=".$blog['id']."'>".output_text($blog['name'])."</a><br/>";
}
}
echo "<font class='time' size='2'>".vremja($blog['time'])."</font><br/>";
echo"<font color='#808080'>View: ".$blog['count']." time</font><br/>";
echo "<font color='#808080'>Comment: ".mysql_result(mysql_query("SELECT COUNT(*) FROM `blog_komm` WHERE `id_blog` = '$blog[id]'"),0)."</font><br/>";

echo "  </td>";
echo "   </tr>";
}
echo "</table>";

if (isset($_GET['sort'])) $dop="sort=$_GET[sort]&amp;";
else $dop='';
if ($k_page>1)str('?'.$dop.'',$k_page,$page);
if(isset($user))
{
echo'<div class="foot">';

echo "&nbsp;<a href=\"user.php\">My notes</a><br />";
echo "&nbsp;<a href=\"add.php\">Add new note</a><br/>";
echo '</div>';
}




include_once '../sys/inc/tfoot.php';

?>
