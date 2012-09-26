<?
global $user,$set;



$adm_add=NULL;
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


echo "<table><tr><td>";
$block = new Smarty_conf();
$content=null;
$q=mysql_query("SELECT * FROM `forum_t`$adm_add2 ORDER BY `time` DESC LIMIT 5");


while ($them = mysql_fetch_assoc($q))
{
$post1=mysql_fetch_assoc(mysql_query("SELECT `id_user` FROM `forum_p` WHERE `id_them` = '$them[id]' ORDER BY `time` ASC LIMIT 1"));
$ank1=get_user($post1['id_user']);
$post2=mysql_fetch_assoc(mysql_query("SELECT `id_user`,`time` FROM `forum_p` WHERE `id_them` = '$them[id]' ORDER BY `time` DESC LIMIT 1"));
$ank2=get_user($post2['id_user']);

$forum=mysql_fetch_assoc(mysql_query("SELECT * FROM `forum_f` WHERE `id` = '$them[id_forum]'"));
$razdel=mysql_fetch_assoc(mysql_query("SELECT * FROM `forum_r` WHERE `id` = '$them[id_razdel]'"));
$path="<a href='/forum/$them[id_forum]/'>$forum[name]</a> &gt; <a href='/forum/$them[id_forum]/$them[id_razdel]/'>$razdel[name]</a>";

$content.="<div class='index_block_item_title'><a href='/forum/$them[id_forum]/$them[id_razdel]/$them[id]/'>$them[name]</a> <a href='/forum/$them[id_forum]/$them[id_razdel]/$them[id]/?page=end'>(".mysql_result(mysql_query("SELECT COUNT(*) FROM `forum_p` WHERE `id_them` = '$them[id]'"),0).")</a></div>$path<br />Pembuat: <b>$ank1[nick]</b> ".vremja($them['time_create'])."<br />Posting terakhir: <b>$ank2[nick]</b> ".vremja($post2['time']);
}

$block->assign('content',$content);
$block->assign('title','Posting baru');
if($content)$block->display('inc.index.block.tpl');

echo "</td><td>";

$block = new Smarty_conf();
$content=null;
$q=mysql_query("SELECT * FROM `forum_t`$adm_add2 ORDER BY `time_create` DESC LIMIT 5");
while ($them = mysql_fetch_assoc($q))
{
$post1=mysql_fetch_assoc(mysql_query("SELECT `id_user` FROM `forum_p` WHERE `id_them` = '$them[id]' ORDER BY `time` ASC LIMIT 1"));
$ank1=get_user($post1['id_user']);
$post2=mysql_fetch_assoc(mysql_query("SELECT `id_user`,`time` FROM `forum_p` WHERE `id_them` = '$them[id]' ORDER BY `time` DESC LIMIT 1"));
$ank2=get_user($post2['id_user']);

$forum=mysql_fetch_assoc(mysql_query("SELECT * FROM `forum_f` WHERE `id` = '$them[id_forum]'"));
$razdel=mysql_fetch_assoc(mysql_query("SELECT * FROM `forum_r` WHERE `id` = '$them[id_razdel]'"));
$path="<a href='/forum/$them[id_forum]/'>$forum[name]</a> &gt; <a href='/forum/$them[id_forum]/$them[id_razdel]/'>$razdel[name]</a>";


$content.="<div class='index_block_item_title'><a href='/forum/$them[id_forum]/$them[id_razdel]/$them[id]/'>$them[name]</a> <a href='/forum/$them[id_forum]/$them[id_razdel]/$them[id]/?page=end'>(".mysql_result(mysql_query("SELECT COUNT(*) FROM `forum_p` WHERE `id_them` = '$them[id]'"),0).")</a></div>$path<br />Pembuat: <b>$ank1[nick]</b> ".vremja($them['time_create'])."<br />Posting terakhir: <b>$ank2[nick]</b> ".vremja($post2['time']);
}

$block->assign('content',$content);
$block->assign('title','Topik Baru');
if($content)$block->display('inc.index.block.tpl');
echo "</td></tr></table>";
?>
