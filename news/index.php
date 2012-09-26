<?
include_once '../sys/inc/start.php';
include_once '../sys/inc/compress.php';
include_once '../sys/inc/sess.php';
include_once '../sys/inc/home.php';
include_once '../sys/inc/settings.php';
include_once '../sys/inc/db_connect.php';
include_once '../sys/inc/ipua.php';
include_once '../sys/inc/fnc.php';
include_once '../sys/inc/user.php';
$set['title']='News';
include_once '../sys/inc/thead.php';
title();
//aut(); // форма авторизации
//if (mysql_result(mysql_query("SELECT COUNT(*) FROM `news` LIMIT 1",$db), 0)==0){header("Location: /index.php?".SID);exit;}
$k_post=mysql_result(mysql_query("SELECT COUNT(*) FROM `news`"),0);
$k_page=k_page($k_post,$set['p_str']);
$page=page($k_page);
$start=$set['p_str']*$page-$set['p_str'];
$q=mysql_query("SELECT * FROM `news` ORDER BY `id` DESC LIMIT $start, $set[p_str]");
echo "<table class='post'>\n";
if ($k_post==0)
{
echo "   <tr>\n";
echo "  <td class='p_t'>\n";
echo "News Empty\n";
echo "  </td>\n";
echo "   </tr>\n";

}
while ($post = mysql_fetch_assoc($q))
{
echo "   <tr>\n";
echo "  <td class='p_t'>\n";
echo "$post[title]\n";
echo "(".vremja($post['time']).")\n";
echo "  </td>\n";
echo "   </tr>\n";
echo "   <tr>\n";
echo "  <td class='p_m'>\n";
echo output_text($post['msg'])."<br />\n";
if ($post['link']!=NULL)echo "<a href='".htmlentities($post['link'], ENT_QUOTES, 'UTF-8')."'>Details</a><br />\n";
echo "<a href='komm.php?id=$post[id]'>Comments</a> (".mysql_result(mysql_query("SELECT COUNT(*) FROM `news_komm` WHERE `id_news` = '$post[id]'"),0).")<br />\n";
echo "  </td>\n";
echo "   </tr>\n";
}
echo "</table>\n";

if ($k_page>1)str('index.php?',$k_page,$page); // Вывод страниц
include_once '../sys/inc/tfoot.php';
?>
