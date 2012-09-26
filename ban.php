<?
include_once 'sys/inc/start.php';
include_once 'sys/inc/compress.php';
include_once 'sys/inc/sess.php';
include_once 'sys/inc/home.php';
include_once 'sys/inc/settings.php';
include_once 'sys/inc/db_connect.php';
include_once 'sys/inc/ipua.php';
include_once 'sys/inc/fnc.php';
$banpage=true;
include_once 'sys/inc/user.php';
only_reg();
$set['title']='Violations';
include_once 'sys/inc/thead.php';
title();
err();
//aut();


if (!isset($user)){header("Location: /index.php?".SID);exit;}
if (mysql_result(mysql_query("SELECT COUNT(*) FROM `ban` WHERE `id_user` = '$user[id]' AND (`time` > '$time' OR `view` = '0')"), 0)==0)
{
header('Location: /index.php?'.SID);exit;
}


mysql_query("UPDATE `ban` SET `view` = '1' WHERE `id_user` = '$user[id]'"); // увидел причину бана

$k_post=mysql_result(mysql_query("SELECT COUNT(*) FROM `ban` WHERE `id_user` = '$user[id]'"),0);
$k_page=k_page($k_post,$set['p_str']);
$page=page($k_page);
$start=$set['p_str']*$page-$set['p_str'];
echo "<table class='post'>\n";





$q=mysql_query("SELECT * FROM `ban` WHERE `id_user` = '$user[id]' ORDER BY `time` DESC LIMIT $start, $set[p_str]");
while ($post = mysql_fetch_assoc($q))
{
$ank=get_user($post['id_ban']);
echo "   <tr>\n";
if ($set['set_show_icon']==2){
echo "  <td class='icon48' rowspan='2'>\n";
avatar($ank['id']);
echo "  </td>\n";
}
elseif ($set['set_show_icon']==1)
{
echo "  <td class='icon14'>\n";
echo "<img src='/style/themes/$set[set_them]/user/$ank[pol].png' alt='' />";
echo "  </td>\n";
}
echo "  <td class='p_t'>\n";
echo "$ank[nick]: to ".vremja($post['time'])."\n";

echo "  </td>\n";
echo "   </tr>\n";
echo "   <tr>\n";
if ($set['set_show_icon']==1)echo "  <td class='p_m' colspan='2'>\n"; else echo "  <td class='p_m'>\n";
echo esc(trim(br(bbcode(smiles(links(stripcslashes(htmlspecialchars($post['prich']))))))))."<br />\n";
echo "  </td>\n";
echo "   </tr>\n";
}



echo "</table>\n";
if ($k_page>1)str('?',$k_page,$page); // Вывод страниц



echo "To stop such situation arise, we encourage you to explore <a href=\"/rules.php\">the rules</a> of my website<br />\n";


include_once 'sys/inc/tfoot.php';
?>
