<?php
if (isset($_POST['msg']) && isset($user))
{
$msg=$_POST['msg'];
if (strlen2($msg)>500){$err='Pesan terlalu panjang, max 500 karakter';
}
elseif (strlen2($msg)<5){$err='Pesan terlalu pendek min 5';
}
elseif (mysql_result(mysql_query("SELECT COUNT(*) FROM `statuse` WHERE `id_user` = '$user[id]' AND `msg` = '".mysql_real_escape_string($msg)."' LIMIT 1"),0)!=0)
{
$err='Pesan telah terkirim sebelumnya';
}
else
{
$msg=mysql_real_escape_string($msg);
mysql_query("INSERT INTO `statuse_list` (`id_user`, `name`, `msg`, `time`, `privat`) values('$user[id]', '$name', '$msg', '$time', '$privat')");

msg('Status anda berhasil di perbaharui.');
//http://okbook.co.de//
mysql_query("UPDATE `user` SET `rating` = '".($user['rating']+1)."' WHERE `id` = '$user[id]' LIMIT 1");
}
}
if (isset($_GET['sort']) && $_GET['sort'] =='t')$order='order by `time` desc';
elseif (isset($_GET['sort']) && $_GET['sort'] =='c') $order='order by `count` desc';
else $order='order by `time` desc';


if (isset($user))
{
echo "<table><tr><td>";
echo "<form method=\"post\" name='message' action=\"?\">\n";
echo "<b><font class='off'>Apa yang anda pikirkan?</b></font><br />\n<textarea name=\"msg\"></textarea><br />\n";


echo "<input class='button' value=\"Bagikan\" type=\"submit\" />\n";
echo "</form>\n";

echo "<li><span class='off'>Status teman</span></li>";

$query = " select `frends`.*, `statuse_list`.*, ( select `nick` from `user` where `id`=`statuse_list`.`id_user` limit 1 ) `nick` from `frends`, `statuse_list` where `frends`.`user`='".$user['id']."' and `statuse_list`.`id_user`=`frends`.`frend` order by `statuse_list`.`id` desc";


$k_post = mysql_num_rows(mysql_query($query));

$k_page=k_page($k_post,$set['p_str']);
$page=page($k_page);$start=$set['p_str']*$page-$set['p_str'];


if($k_post==0)
{
echo "<div class='post1'>Tidak ada status teman, tambahkan beberapa teman.</div>";
}else{

//echo "&raquo; <a onclick='fun();' href=\"/allstatus.php\"> <span class='off'>Semua status teman</span></a>";

}

$query = mysql_query($query." limit ".$start.", ".$set['p_str'].";"); while ( $statuse = mysql_fetch_assoc($query)) 

{

$ank=get_user($statuse['id_user']);
echo"<div class='post1'>\n";
echo"<a href='/info.php?id=$ank[id]'><span style=\"color:$ank[color_nick]\">$ank[nick]</span></a>".online($ank['id'])."\n";
echo"</div>\n";

echo "<table>";
echo "<tr>";
echo "<td rowspan='2'>";

if ($set['set_show_icon']==2){
avatar($ank['id']);}
elseif ($set['set_show_icon']==1){
echo "<img src='/style/icons_user/pol_$ank[pol].png' width='35' height='45' alt='icon' />";}
elseif ($set['set_show_icon']==0){
echo "";}

echo"</tr>";
echo"</td>";

echo"<tr>";
echo"<td>";

echo "<a rel='kom_status.php?id=".$statuse['id']."'>".output_text($statuse['msg'])."</a> (".vremja($statuse['time']).")<br> <a href='kom_status.php?id=".$statuse['id']."'>".mysql_result(mysql_query("SELECT COUNT(*) FROM `statuse_komm` WHERE `id_statuse` = '$statuse[id]'"),0)." komentar</a><br />\n";

if (($user['level'] >= 4) || ($user['id'] ==$statuse['id_user']))
{

echo"[<a href='edit_status.php?id=$statuse[id]'>Edit</a>]";
echo"[<a href='edit_status.php?id=$statuse[id]&amp;del?id=".intval($_GET['id'])."&amp;del&amp;ok'>Hapus</a>]<br/>";
}
echo "  </td>\n";
echo "   </tr>\n";
echo "</table>\n";
echo "</td><td>";
}

}


?>
