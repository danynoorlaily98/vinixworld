<?php
echo "<li><span class='off'>Forum last post</span></li>";
global $user,$set;$adm_add=NULL;
$adm_add2=NULL;

if (!isset($user) || !$user['level']){
$q222=mysql_query("SELECT * FROM `forum_f` WHERE `adm` = '1'");
while ($adm_f = mysql_fetch_assoc($q222))
{
$adm_add[]="`id_forum` <> '$adm_f[id]'";
}
if (sizeof($adm_add)!=0)
$adm_add2=' WHERE'.implode(' AND ', $adm_add);
}

if (isset($user)){
$content=null;

$k_post=mysql_result(mysql_query("SELECT COUNT(*) FROM `forum_t`$adm_add"),0);

$q=mysql_query("SELECT * FROM `forum_t`$adm_add2 ORDER BY `time` DESC LIMIT 4");

while ($them = mysql_fetch_assoc($q))
{
$post1=mysql_fetch_assoc(mysql_query("SELECT `id_user` FROM `forum_p` WHERE `id_them` = '$them[id]' ORDER BY `time` ASC LIMIT 1"));
$post2=mysql_fetch_assoc(mysql_query("SELECT `id_user`,`time` FROM `forum_p` WHERE `id_them` = '$them[id]' ORDER BY `time` DESC LIMIT 1"));
$ank2=get_user($post2['id_user']);

$forum=mysql_fetch_assoc(mysql_query("SELECT * FROM `forum_f` WHERE `id` = '$them[id_forum]'"));
$razdel=mysql_fetch_assoc(mysql_query("SELECT * FROM `forum_r` WHERE `id` = '$them[id_razdel]'"));



$path="<img src='/style/themes/$set[set_them]/icons_forum/razdel.png' alt='icon' /> <a href='/forum/$them[id_forum]/$them[id_razdel]/$them[id]/?page=end'>$them[name]</a>(".mysql_result(mysql_query("SELECT COUNT(*) FROM `forum_p` WHERE `id_them` = '$them[id]'"),0).")\n";

$post=mysql_fetch_array(mysql_query("SELECT * FROM `forum_p` WHERE `id_them` = '$them[id]' AND `id_razdel` = '$razdel[id]' AND `id_forum` = '$forum[id]' ORDER BY `time` DESC LIMIT 1"));

$post_post= output_text($post['msg']);


$content.="<div class='post1'>$path</div><div class='news'>Post: <a href='/info.php'><span style=\"color:$ank2[color_nick]\">$ank2[nick]</span></a> <br/> Time: ".vremja($post2['time'])."<br>$post_post</div>\n";
}

echo $content;
}
?>
