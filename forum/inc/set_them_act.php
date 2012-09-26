<?


if (isset($_GET['act']) && isset($_GET['ok']) && $_GET['act']=='mesto' && isset($_POST['razdel']) && is_numeric($_POST['razdel'])
&& (mysql_result(mysql_query("SELECT COUNT(*) FROM `forum_r` WHERE `id` = '".intval($_POST['razdel'])."'"),0)==1 && user_access('forum_them_edit')
|| mysql_result(mysql_query("SELECT COUNT(*) FROM `forum_r` WHERE `id` = '".intval($_POST['razdel'])."' WHERE `id_forum` = '$forum[id]'"),0)==1 && $ank2['id']==$user['id']))
{
$razdel_new=mysql_fetch_assoc(mysql_query("SELECT * FROM `forum_r` WHERE `id` = '".intval($_POST['razdel'])."' LIMIT 1"));

mysql_query("UPDATE `forum_p` SET `id_forum` = '$razdel_new[id_forum]', `id_razdel` = '$razdel_new[id]' WHERE `id_forum` = '$forum[id]' AND `id_razdel` = '$razdel[id]' AND `id_them` = '$them[id]'");
mysql_query("UPDATE `forum_t` SET `id_forum` = '$razdel_new[id_forum]', `id_razdel` = '$razdel_new[id]' WHERE `id_forum` = '$forum[id]' AND `id_razdel` = '$razdel[id]' AND `id` = '$them[id]'");
$old_razdel=$razdel;
$forum=mysql_fetch_assoc(mysql_query("SELECT * FROM `forum_f` WHERE `id` = '$razdel_new[id_forum]' LIMIT 1"));
$razdel=mysql_fetch_assoc(mysql_query("SELECT * FROM `forum_r` WHERE `id` = '$razdel_new[id]' LIMIT 1"));
$them=mysql_fetch_assoc(mysql_query("SELECT * FROM `forum_t` WHERE `id_razdel` = '$razdel[id]' AND `id` = '$them[id]' LIMIT 1"));

msg('Тема успешно перемещена');

if ($ank2['id']!=$user['id'])
admin_log('Форум','Перемещение темы',"Перемещение темы '[url=/forum/$forum[id]/$razdel[id]/$them[id]/]$them[name][/url]' из раздела '[url=/forum/$forum[id]/$old_razdel[id]/]$old_razdel[name][/url]' в раздел '[url=/forum/$forum[id]/$old_razdel[id]/]$razdel[name][/url]'");

}





if (user_access('forum_them_del') && ($ank2['level']<$user['level'] || $ank2['id']==$user['id']) &&  isset($_GET['act']) && isset($_GET['ok']) && $_GET['act']=='delete')
{

mysql_query("DELETE FROM `forum_t` WHERE `id` = '$them[id]'");
mysql_query("DELETE FROM `forum_p` WHERE `id_them` = '$them[id]'");

if ($ank2['id']!=$user['id'])admin_log('Форум','Удаление темы',"Удаление темы '$them[name]' (автор '[url=/info.php?id=$ank2[id]]$ank2[nick][/url]')");



msg('Тема успешно удалена');
err();
aut();
echo "<div class='menu'>\n";
echo "<a href=\"/forum/$forum[id]/$razdel[id]/\">В раздел</a><br />\n";
echo "<a href=\"/forum/$forum[id]/\">В подфорум</a><br />\n";
echo "<a href=\"/forum/\">В форум</a><br />\n";
echo "</div>\n";
include_once '../sys/inc/tfoot.php';
}




if (isset($_GET['act']) && isset($_GET['ok']) && $_GET['act']=='set' && isset($_POST['name']) && (user_access('forum_them_edit') && $ank2['level']<$user['level'] || $ank2['id']==$user['id']))
{

$name=esc(stripcslashes(htmlspecialchars($_POST['name'])));
if (isset($_POST['translit1']) && $_POST['translit1']==1)$name=translit($name);
if (strlen2($name)<3)$err='Слишком короткое название';
if (strlen2($name)>32)$err='Слишком длинное название';
$name=my_esc($name);


if ($user['level']>0){
if (isset($_POST['up']) && $_POST['up']==1)
{
if ($ank2['id']!=$user['id'])admin_log('Форум','Параметры темы',"Закрепление темы '[url=/forum/$forum[id]/$razdel[id]/$them[id]/]$them[name][/url]' (автор '[url=/info.php?id=$ank2[id]]$ank2[nick][/url]', раздел '$razd[name]')");
$up=1;
}
else $up=0;
$add_q=" `up` = '$up',";
}else $add_q=NULL;



if (isset($_POST['close']) && $_POST['close']==1 && $them['close']==0){
$close=1;
if ($ank2['id']!=$user['id'])admin_log('Форум','Параметры темы',"Закрытие темы '[url=/forum/$forum[id]/$razdel[id]/$them[id]]$them[name][/url]' (автор '[url=/info.php?id=$ank2[id]]$ank2[nick][/url]')");
}
elseif ($them['close']==1 && (!isset($_POST['close']) || $_POST['close']==0))
{
$close=0;
if ($ank2['id']!=$user['id'])admin_log('Форум','Параметры темы',"Открытие темы '[url=/forum/$forum[id]/$razdel[id]/$them[id]]$them[name][/url]' (автор '[url=/info.php?id=$ank2[id]]$ank2[nick][/url]')");
}

else $close=$them['close'];


if (isset($_POST['autor']) && $_POST['autor']==1)$autor=$user['id'];else $autor=$ank2['id'];


if (!isset($err)){
mysql_query("UPDATE `forum_t` SET `name` = '$name', `id_user` = '$autor',$add_q `close` = '$close' WHERE `id` = '$them[id]' LIMIT 1");
$them=mysql_fetch_assoc(mysql_query("SELECT * FROM `forum_t` WHERE `id` = '$them[id]' LIMIT 1"));
$ank2=mysql_fetch_assoc(mysql_query("SELECT * FROM `user` WHERE `id` = '$them[id_user]' LIMIT 1"));
msg('Изменения успешно приняты');
}
}



if ((user_access('forum_post_ed') || isset($user) && $ank2['id']==$user['id']) && isset($_GET['act']) && $_GET['act']=='post_delete' && isset($_GET['ok']))
{
foreach ($_POST as $key => $value)
{
if (ereg('^post_([0-9]*)$',$key,$postnum) && $value='1')
{
$delpost[]=$postnum[1];
}
}
if (isset($delpost) && is_array($delpost) && mysql_result(mysql_query("SELECT COUNT(*) FROM `forum_p` WHERE `id_them` = '$them[id]' AND `id_forum` = '$forum[id]' AND `id_razdel` = '$razdel[id]'"),0)>count($delpost))
{
mysql_query("DELETE FROM `forum_p` WHERE `id_them` = '$them[id]' AND (`id` = '".implode("'".' OR `id` = '."'", $delpost)."') LIMIT ".count($delpost));
if ($ank2['id']!=$user['id'])
admin_log('Форум','Очистка темы',"Очистка темы '[url=/forum/$forum[id]/$razdel[id]/$them[id]/]$them[name][/url]' (автор '[url=/info.php?id=$ank2[id]]$ank2[nick][/url]', удалено '".count($delpost)."' постов)");

msg('Успешно удалено '.count($delpost).' постов');
err();
aut();
echo "<div class='menu'>\n";
echo "<a href=\"/forum/$forum[id]/$razdel[id]/$them[id]/\">Вернуться в тему</a><br />\n";
echo "<a href=\"/forum/$forum[id]/$razdel[id]/\">В раздел</a><br />\n";
echo "<a href=\"/forum/$forum[id]/\">В подфорум</a><br />\n";
echo "<a href=\"/forum/\">В форум</a><br />\n";
echo "</div>\n";
include_once '../sys/inc/tfoot.php';
}
else
$err='Нельзя удалить 0 или все посты из темы';
}




if (isset($_GET['act']) && $_GET['act']=='post_delete' && (user_access('forum_post_ed') || isset($user) && $ank2['id']==$user['id']))
{
echo "<form method='post' action='/forum/$forum[id]/$razdel[id]/$them[id]/?act=post_delete&amp;ok'>\n";
}

?>