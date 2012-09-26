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

only_reg();

$set['title']='News Feed';
include_once 'sys/inc/thead.php';
if (isset($_GET['sort']) && $_GET['sort'] =='t')$order='order by `time` desc';
elseif (isset($_GET['sort']) && $_GET['sort'] =='c') $order='order by `count` desc';
else $order='order by `time` desc';


echo '<div class="penanda">';
echo "All Stories";
echo '</div>';
$k_post=mysql_result(mysql_query("SELECT COUNT(*) FROM `statuse_list` WHERE `privat` = 0"),0);
$k_page=k_page($k_post,$set['p_str']);
$page=page($k_page);
$start=$set['p_str']*$page-$set['p_str'];
echo "<table class='post'>\n";
if($k_post==0)
{
echo "   <tr>\n";
echo "  <td class='p_t'>\n";
echo "No Status !!!<br />";
echo "  </td>\n";
echo "   </tr>\n";
}

$res = mysql_query("select * from `statuse_list` WHERE `privat` = 0 $order LIMIT $start, $set[p_str];");
while ($statuse = mysql_fetch_array($res)){


if (isset($_GET['tidak']) && isset($user))
{
mysql_query("DELETE FROM `statuse_like` WHERE `id_user` = '$user[id]' AND `id_statuse` = '".intval($_GET['id'])."' LIMIT 1");
}
$ank=get_user($statuse['id_user']);
echo "<tr>";
echo " <td class='icon14'>";echo avatar($ank['id']);
echo "</td><td class='status'>";
echo "<a href='info.php?id=$ank[id]'><b>$ank[nick]</b/></a>";
echo " ".output_text($statuse['msg'])." ";
echo "<br/>";
echo "<font class='time' size='2'>".waktu($statuse['time'])."</font>";
if($statuse['kategori']!=1){
if ($ank['ank_city']!=NULL){echo "<font class='time' size='2'> near $ank[ank_city]</font><br/>\n";}

$teman2 = mysql_query("SELECT COUNT(*) FROM `frends` WHERE (`user` = '$ank[id]' AND `frend` = '$user[id]') OR (`user` = '$user[id]' AND `frend` = '$ank[id]') LIMIT 1");
if (isset($user) && $user['id']!=$ank['id'] && mysql_result($teman2, 0)==0)
{
$d1sql = mysql_query("SELECT COUNT(*) FROM `frends_new` WHERE (`user` = '$user[id]' AND `to` = '$ank[id]') OR (`user` = '$ank[id]' AND `to` = '$user[id]') LIMIT 1");
$d2sql = mysql_query("SELECT COUNT(*) FROM `frends` WHERE (`user` = '$ank[id]' AND `frend` = '$user[id]') OR (`user` = '$user[id]' AND `frend` = '$ank[id]') LIMIT 1");
if (isset($user) && $user['id']!=$ank['id'] && mysql_result($d1sql, 0)==0 && mysql_result($d2sql, 0)==0)
{
echo " &#183; <a href='/frend_add.php?id=$ank[id]'>Agregar como Amigo</a>";}else{
echo " &#183; <font class='time'>Esperando Confirmacion</font>";
}
}
else
{
if (isset($user)){
$anu = mysql_result(mysql_query("SELECT COUNT(*) FROM `statuse_like` WHERE `id_statuse` = '$statuse[id]'"),0);
if (mysql_result(mysql_query("SELECT COUNT(*) FROM `statuse_like` WHERE `id_statuse` = '$statuse[id]' AND `id_user` = '$user[id]' LIMIT 1"),0)==0){
if($anu==0){
echo " &#183; <a href='status/suka.php?id=".$statuse['id']."&amp;like'>Me gusta</a>";} else {
echo " &#183; <a href='status/like_all.php?id=".$statuse['id']."'><img src='status/suka.gif' width='12' height='13'> $anu</a> &#183; <a href='status/suka.php?id=".$statuse['id']."&amp;like'>Me Gusta</a>";
}
}
else
{
if($anu==0){
echo " &#183; <a href='status/suka.php?id=".$statuse['id']."&amp;tidak'>Unlike</a>";} else {
echo " &#183; <a href='/status/like_all.php?id=".$statuse['id']."'><img src='status/suka.gif' width='12' height='13'> $anu</a> &#183; <a href='/status/suka.php?id=".$statuse['id']."&amp;tidak'>Unlike</a>";
}
}

$cmn=mysql_result(mysql_query("SELECT COUNT(*) FROM `statuse_komm` WHERE `id_statuse` = '$statuse[id]'"),0);
if(mysql_result(mysql_query("SELECT COUNT(*) FROM `statuse_komm` WHERE `id_statuse` = '$statuse[id]'"),0)==0){
echo " &#183; <a href='list.php?id=".$statuse['id']."'>Comentart</a>\n";
}else{
if(mysql_result(mysql_query("SELECT COUNT(*) FROM `statuse_komm` WHERE `id_statuse` = '$statuse[id]'"),0)==1){
echo " &#183; <a href='list.php?id=".$statuse['id']."'>1 Comentario</a>\n";
}
else
{
echo " &#183; <a href='list.php?id=".$statuse['id']."'>$cmn Comentarios</a>\n";
}
}
}
}
}
echo "  </td>";
echo "   </tr>";
}
echo "</table>";
if (isset($_GET['sort'])) $dop="sort=$_GET[sort]&amp;";
else $dop='';
if ($k_page>1)str('?'.$dop.'',$k_page,$page);
echo "<div class='acw apm'><a href='home.php'>Recientes</a><br/> <a href='index.php?top'>Destacadas</a><br/></div>";

include_once 'sys/inc/tfoot.php';
?>
