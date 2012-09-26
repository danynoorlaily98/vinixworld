<?php

// remodified by noe
// http://nnetwork.tk
// loegue.info@gmail.com
// hargailah privasi orang

include_once '../sys/inc/start.php';
include_once '../sys/inc/compress.php';
include_once '../sys/inc/sess.php';
include_once '../sys/inc/home.php';
include_once '../sys/inc/settings.php';
include_once '../sys/inc/db_connect.php';
include_once '../sys/inc/ipua.php';
include_once '../sys/inc/fnc.php';
include_once '../sys/inc/user.php';

$statuse=mysql_fetch_array(mysql_query("select * from `statuse_list` where `id`='".intval($_GET['id'])."';"));

mysql_query("UPDATE `statuse_list` SET `count` = '".($statuse['count']+1)."' WHERE `id` = '$statuse[id]' LIMIT 1");
$ank=get_user($statuse['id_user']);

$set['title']='All people who like '.$ank['nick'].' status';
include_once '../sys/inc/thead.php';
//title();
aut();
err();


$k_post=mysql_result(mysql_query("SELECT COUNT(*) FROM `statuse_like` WHERE `id_statuse` = '".intval($_GET['id'])."'"),0);
$k_page=k_page($k_post,$set['p_str']);
$page=page($k_page);
$start=$set['p_str']*$page-$set['p_str'];
$k_sisa=$k_post - 1;
$q=mysql_query("SELECT * FROM `statuse_like` WHERE `id_statuse` = '".intval($_GET['id'])."' ORDER BY `id` DESC LIMIT $start, $set[p_str]");
echo "<table width='100%' class='postform'>\n";
if ($k_post==0)
{
echo "   <tr>\n";
echo "  <td class='p_t'>\n";
echo "No one like this yet\n";
echo "  </td>\n";
echo "   </tr>\n";
}
while ($post = mysql_fetch_assoc($q))
{
//$ank=mysql_fetch_assoc(mysql_query("SELECT * FROM `user` WHERE `id` = $post[id_user] LIMIT 1"));
$ank=get_user($post['id_user']);

echo "   <tr>\n";
echo "  <td class='icon48'>\n";
avatar($ank['id']);
echo "  </td>\n";
echo "  <td class='p_t' valign='top'>\n";
echo "<a href='/info.php?id=$ank[id]'>$ank[nick]</a>".online($ank['id'])."\n";
echo "  </td>\n";
echo "   </tr>\n";
}
echo "</table>\n";
/*$kim=mysql_result(mysql_query("SELECT COUNT(*) FROM `statuse_like` WHERE `id_statuse` = '".intval($_GET['id'])."'"),0);
$kum=mysql_result(mysql_query("SELECT `id_user` FROM `statuse_like` WHERE `id_statuse` = '".intval($_GET['id'])."'"),0);
$kom=mysql_result(mysql_query("SELECT `nick` FROM `user` WHERE `id`='$kum' LIMIT 1"),0);
$kem=$kim-1;
while ($post = mysql_fetch_assoc($q))
{
$ank=get_user($post['id_user']);
echo "<div class='comment'>\n";
echo "<img src='status/suka.gif'> <a href='/info.php?id=$ank[id]'>$ank[nick]</a> menyukai ini";
echo "</div>";
}
if($kim==1){
while ($post = mysql_fetch_assoc($q))
{
$ank=get_user($post['id_user']);
echo "<div class='comment'>\n";
echo "<img src='status/suka.gif'> <a href='/info.php?id=$ank[id]'>$ank[nick]</a> menyukai ini";
echo "</div>";
}
}
elseif($kim>=2){
echo "<div class='comment'>\n";
echo "<img src='status/suka.gif'> <a href='/info.php?id=$kum'>$kom</a> dan <a href='status/like_all.php?id=".$statuse['id']."'>$kem</a> menyukai ini";
echo "</div>";
}
*/
if ($k_page>1){
echo " $k_sisa menyukai ini ";
}

include_once '../sys/inc/tfoot.php';

?>
