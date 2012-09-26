<?php
/////   WIZART   /////
include_once '../sys/inc/start.php';
include_once '../sys/inc/compress.php';
include_once '../sys/inc/sess.php';
include_once '../sys/inc/home.php';
include_once '../sys/inc/settings.php';
include_once '../sys/inc/db_connect.php';
include_once '../sys/inc/ipua.php';
include_once '../sys/inc/fnc.php';
include_once '../sys/inc/user.php';
user_access('adm_panel_show',null,'/index.php?'.SID);


$set['title']='Админ-чат'; // заголовок страницы

include_once '../sys/inc/thead.php';
title();


if (isset($_POST['msg']) && isset($user))
{
$msg=$_POST['msg'];
if (isset($_POST['translit']) && $_POST['translit']==1)$msg=translit($msg);
if (strlen2($msg)>1024){$err='Сообщение слишком длинное';}
elseif (strlen2($msg)<2){$err='Короткое сообщение';}
elseif (mysql_result(mysql_query("SELECT COUNT(*) FROM `private_chat` WHERE `id_user` = '$user[id]' AND `msg` = '".mysql_escape_string($msg)."' LIMIT 1"),0)!=0){$err='Ваше сообщение повторяет предыдущее';}
else{
$msg=mysql_escape_string($msg);


mysql_query("INSERT INTO `private_chat` (id_user, time, msg) values('$user[id]', '$time', '$msg')");
mysql_query("UPDATE `user` SET `rating` = '".($user['rating']+2)."' WHERE `id` = '$user[id]' LIMIT 1");
msg('Сообщение успешно добавлено');
}
}

err();
aut(); // форма авторизации
$k_post=mysql_result(mysql_query("SELECT COUNT(*) FROM `private_chat`"),0);


if ($k_page>1)str('?',$k_page,$page); // Вывод страниц

if (isset($user))
{
echo "<form method=\"post\" action=\"?\">\n";
echo "Сообщение:<br />\n<textarea name=\"msg\">$otvet</textarea><br />\n";
//if ($user['set_translit']==1)echo "<label><input type=\"checkbox\" name=\"translit\" value=\"1\" /> Транслит</label><br />\n";
echo "<input value=\"Отправить\" type=\"submit\" />\n";
echo "</form>\n";
}

$k_page=k_page($k_post,$set['p_str']);
$page=page($k_page);
$start=$set['p_str']*$page-$set['p_str'];
echo "<table class='post'>\n";
if ($k_post==0)
{
echo "   <tr>\n";
echo "  <td class='p_t'>\n";
echo "Нет сообщений\n";
echo "  </td>\n";
echo "   </tr>\n";

}

$q=mysql_query("SELECT * FROM `private_chat` ORDER BY id DESC LIMIT $start, $set[p_str]");
while ($post = mysql_fetch_array($q))
{

$ank=mysql_fetch_array(mysql_query("SELECT * FROM `user` WHERE `id` = $post[id_user] LIMIT 1"));


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
echo "<a href='/info.php?id=$ank[id]'>$ank[nick]</a>".online($ank['id'])." (".vremja($post['time']).")\n";
echo "  </td>\n";
echo "   </tr>\n";
echo "   <tr>\n";
if ($set['set_show_icon']==1)echo "  <td class='p_m' colspan='2'>\n"; else echo "  <td class='p_m'>\n";
echo esc(trim(br(bbcode(smiles(links(stripcslashes(htmlspecialchars($post['msg']))))))))."<br />\n";
if (isset($user) && ($user['level']>$ank['level'] || $user['level']==4))
echo "<a href='delete.php?id=$post[id]'>Удалить</a>\n";
if (isset($user))echo " <a href='index.php?id=$post[id]&amp;response=$ank[id]'>[ответ]</a>";
echo "  </td>\n";
echo "   </tr>\n";

}
echo "</table>\n";





if (isset($user) && $user['level']>2)include 'inc/admin_form.php';
include_once '../sys/inc/tfoot.php';
?>
