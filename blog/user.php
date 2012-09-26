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



if (isset($user))$user_blog=$user['id'];
if (isset($_GET['id']))$user_blog=intval($_GET['id']);

if (!isset($user_blog))
{
$set['title']='Error';
include_once '../sys/inc/thead.php';
title();
//aut();
echo "No user!";
echo"<div class='foot'>\n";
echo"&nbsp;<a href='index.php'>Back</a><br />\n";
echo"</div>\n";
include_once '../sys/inc/tfoot.php';
exit();
}

$ank_user=get_user($user_blog);
if(!$ank_user)
{
$set['title']='Error';
include_once '../sys/inc/thead.php';
title();
//aut();
echo "No user!";
echo"<div class='foot'>\n";
echo"&nbsp;<a href='index.php'>Back</a><br />\n";
echo"</div>\n";
include_once '../sys/inc/tfoot.php';
exit();
}



$set['title']=''.$ank_user['nick'].' - Notes';
include_once '../sys/inc/thead.php';
//title();
err();
//aut();
echo"<div>&nbsp;<a href='index.php'>All notes</a><br/><div>";
if($user['id'] == $user_blog) $where="WHERE `id_user` = '$user_blog'";
else $where="WHERE `privat` = '0' && `id_user` = '$user_blog'";


$k_post=mysql_result(mysql_query("SELECT COUNT(*) FROM `blog_list` $where"),0);
$k_page=k_page($k_post,$set['p_str']);
$page=page($k_page);
$start=$set['p_str']*$page-$set['p_str'];
echo "<table class='post'>\n";


if($k_post==0)
{
echo "   <tr>\n";
echo "  <td class='p_t'>\n";
echo "No note!<br/>";
echo "  </td>\n";
echo "   </tr>\n";
}

$res = mysql_query("select * from `blog_list` $where order by `time` desc LIMIT $start, $set[p_str];");
while ($blog = mysql_fetch_array($res)){


$ank=get_user($blog['id_user']);
echo "   <tr>\n";
echo "  <td class='status'>\n";
echo "<a href='list.php?id=".$blog['id']."'>".output_text($blog['name'])."</a><br/>\n";
echo "<font color='#808080'>by $ank[nick]</font><br/>";
echo "<font class='time' size='2'>".vremja($blog['time'])."</font><br/>";
echo"<font color='#808080'>View: ".$blog['count']." time</font><br/>\n";
echo "<font color='#808080'>Comment: ".mysql_result(mysql_query("SELECT COUNT(*) FROM `blog_komm` WHERE `id_blog` = '$blog[id]'"),0)."</font><br/>";
echo "  </td>\n";
echo "   </tr>\n";
}
echo "</table>\n";

if (isset($user_blog)) $dop="id=$user_blog&amp;";
else $dop='';
if ($k_page>1)str('?'.$dop.'',$k_page,$page); // halaman


if(isset($user))
{
echo'<div class="foot">';
//echo"<a href='index.php'>&raquo;Back</a><br/>\n";
echo "&nbsp;<a href=\"add.php\">Add new note</a><br/>";
echo '</div>';
}




include_once '../sys/inc/tfoot.php';

?>
