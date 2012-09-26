<?php

// remodified by noe
// http://nnetwork.tk
// loegue.info@gmail.com
// hargailah privasi orang

###############teman baru#####################
$q = mysql_query("SELECT * FROM `frends_new` WHERE `to` = '$user[id]' ORDER BY time DESC LIMIT 1");
while ($f = mysql_fetch_array($q))
{
$a = mysql_fetch_array(mysql_query("SELECT * FROM `user` WHERE `id` = '".$f['user']."' LIMIT 1"));
if($num==1){
echo "<div class='rowdown'>";
$num=0;
}else{

$num=1;}
echo "<div class='notif'>";
echo '<img src="/style/icon/f_n.png"> <a href="/info.php?id='.$a['id'].'">'.$a['nick'].'</a> wants to be your friend ';
echo '<a href="frend_new.php?ok='.$a['id'].'">Accept</a> or <a href="frend_new.php?no='.$a['id'].'">Reject</a>';
echo "</div>";

}

###############colek#####################

if (!isset($user) && !isset($_GET['id'])){header("Location: /index.php?".SID);exit;}
if (isset($user))$ank['id']=$user['id'];
if (isset($_GET['id']))$ank['id']=intval($_GET['id']);
if (mysql_result(mysql_query("SELECT COUNT(*) FROM `user` WHERE `id` = '$ank[id]' LIMIT 1"),0)==0){header("Location: /index.php?".SID);exit;}
$ank=mysql_fetch_array(mysql_query("SELECT * FROM `user` WHERE `id` = $ank[id] LIMIT 1"));
if (isset($_GET['id']))
{
mysql_query("INSERT INTO `poke_profil` (`id_user`, `id_poke`, `msg`, `time`) values('$user[id]', '$ank[id]', '[url=/info.php?id=$user[id]]$user[nick][/url] poke you', '$time')");
mysql_query("DELETE FROM `poke_profil` WHERE `id_user` = '$ank[id]' AND `id_poke` = '$user[id]' LIMIT 1");
msg('You have poke '.$ank['nick'].' back');
}
$k_poke=mysql_result(mysql_query("SELECT COUNT(*) FROM `poke_profil` WHERE `id_poke` = '$user[id]'"),0);
$k_page=k_page($k_poke,$set['p_str']);
$page=page($k_page);
$start=$set['p_str']*$page-$set['p_str'];
$k_sisa = $k_poke - 1;

$res = mysql_query("select * from `poke_profil` WHERE `id_poke` = '$user[id]' ORDER BY time LIMIT $start, 1");
while ($poke = mysql_fetch_array($res)){
$post=get_user($poke['id_user']);
echo "   <div class='notif'>\n";
echo "".output_text($poke['msg'])."";
echo "! <a href='?id=$post[id]'>Poke back</a>? <a href='/poke_del.php?id=$poke[id]'>Delete</a>";
echo "  </div>\n";
if($k_poke > 1)
{
echo "<div class='p_t'><a href='/poke_all.php'>$k_sisa more poke</a></div>";
}
}

###############pemberitahuan#####################
$q=mysql_query("SELECT * FROM `jurnal` WHERE `id_user` = '0' AND `id_kont` = '".$user['id']."' ORDER BY id DESC LIMIT $start, 1");
while ($post = mysql_fetch_array($q)){
$kmn=mysql_result(mysql_query("SELECT COUNT(*) FROM `jurnal` WHERE `id_kont` = '$user[id]' AND `read` = '0'"), 0);
$k_page = k_page($kmn);
$k_sis = $kmn - 1;

if ($kmn>0){
echo '<div class="p_m">'.output_text($post['msg']).'</div>';
echo "<div class='notif'><a href='/jurnal.php'>Clear Notifications...</a></div>";
}
}



?>
