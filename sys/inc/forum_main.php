<?
if (isset($user)){
echo "<div class='penanda'><span class='lgn'>Last Forum</span></div>";
$adm_add=NULL;
$adm_add2=NULL;
if (!isset($user) || $user['level']==0){
$adm_add2=' WHERE';
$q222=mysql_query("SELECT * FROM `forum_f` WHERE `adm` = '1'");
while ($adm_f = mysql_fetch_array($q222)) {
$adm_add[]="`id_forum` <> '$adm_f[id]'";
}
$adm_add2.=implode(' AND ', $adm_add);
}
$k_post=mysql_result(mysql_query("SELECT COUNT(*) FROM `forum_t`$adm_add"),0);
$q=mysql_query("SELECT * FROM `forum_t`$adm_add ORDER BY `time` DESC  LIMIT 3");
echo '<div class="beranda">';
while ($them = mysql_fetch_array($q)) {
$forum=mysql_fetch_array(mysql_query("SELECT * FROM `forum_f` WHERE `id` = '$them[id_forum]' LIMIT 1"));
$razdel=mysql_fetch_array(mysql_query("SELECT * FROM `forum_r` WHERE `id` = '$them[id_razdel]' LIMIT 1"));
echo "<div class='penanda1'><span class='bkm'>>><u>$razdel[name]</u></span></div>";
$post=mysql_fetch_array(mysql_query("SELECT * FROM `forum_p` WHERE `id_them` = '$them[id]' AND `id_razdel` = '$razdel[id]' AND `id_forum` = '$forum[id]' ORDER BY `time` DESC LIMIT 1"));
$ank=mysql_fetch_array(mysql_query("SELECT * FROM `user` WHERE `id` = $post[id_user] LIMIT 1"));
echo"<a href='/info.php?id=$ank[id]' title='\"$ank[nick]\"'>$ank[nick]</a>".online($ank['id'])."\n";
echo "<a href='/forum/$forum[id]/$razdel[id]/$them[id]/?page=end'>$them[name]</a>\n";
}
echo "</div>\n";
}
?>
