<?
$set['title']='Форум - '.$forum['name'].' - '.$razdel['name'].' - Новая тема'; // заголовок страницы
include_once '../sys/inc/thead.php';
title();

if (isset($_POST['name']) && isset($_POST['msg']))
{

if (isset($_SESSION['time_c_t_forum']) && $_SESSION['time_c_t_forum']>$time-600 && $user['level']==0)$err='Нельзя так часто создавать темы';

$name=esc(stripcslashes(htmlspecialchars($_POST['name'])));
if (isset($_POST['translit1']) && $_POST['translit1']==1)$name=translit($name);
//if (ereg("\{|\}|\^|\%|\\$|#|@|!|\~|'|\"|`|<|>",$name))$err='В названии темы присутствуют запрещенные символы';
if (strlen2($name)<3)$err[]='Короткое название для темы';
if (strlen2($name)>32)$err[]='Название темы не должно быть длиннее 32-х символов';
$mat=antimat($name);
if ($mat)$err[]='В названии темы обнаружен мат: '.$mat;


$name=my_esc($name);


$msg=$_POST['msg'];
if (isset($_POST['translit2']) && $_POST['translit2']==1)$msg=translit($msg);
if (strlen2($msg)<10)$err[]='Короткое сообщение';
if (strlen2($msg)>1024)$err[]='Длина сообщения превышает предел в 1024 символа';

$mat=antimat($msg);
if ($mat)$err[]='В тексте сообщения обнаружен мат: '.$mat;

$msg=my_esc($msg);

if (!isset($err))
{
$_SESSION['time_c_t_forum']=$time;
mysql_query("INSERT INTO `forum_t` (`id_forum`, `id_razdel`, `time_create`, `id_user`, `name`, `time`) values('$forum[id]', '$razdel[id]', '$time', '$user[id]', '$name', '$time')");
$them['id']=mysql_insert_id();
mysql_query("INSERT INTO `forum_p` (`id_forum`, `id_razdel`, `id_them`, `id_user`, `msg`, `time`) values('$forum[id]', '$razdel[id]', '$them[id]', '$user[id]', '$msg', '$time')");
mysql_query("UPDATE `forum_r` SET `time` = '$time' WHERE `id` = '$razdel[id]' LIMIT 1");
msg('Тема успешно создана');
aut();


echo "<div class='menu'>\n";
echo "<a href=\"/forum/$forum[id]/$razdel[id]/$them[id]/\" title='Перейти в тему'>Перейти в тему</a><br />\n";
echo "<a href=\"/forum/$forum[id]/$razdel[id]/\" title='Вернуться в раздел'>Назад</a><br />\n";
echo "<a href=\"/forum/$forum[id]/\">$forum[name]</a><br />\n";
echo "<a href=\"/forum/\">Форум</a><br />\n";
echo "</div>\n";
include_once '../sys/inc/tfoot.php';
}

}

err();
aut();








echo "<form method=\"post\" action=\"/forum/$forum[id]/$razdel[id]/?act=new\">";
echo "Название темы:<br />\n";
echo "<input name=\"name\" type=\"text\" maxlength='32' value='' /><br />\n";
if ($user['set_translit']==1)echo "<label><input type=\"checkbox\" name=\"translit1\" value=\"1\" /> Транслит</label><br />\n";
echo "Сообщение:<br />\n";
echo "<textarea name=\"msg\"></textarea><br />\n";
if ($user['set_translit']==1)echo "<label><input type=\"checkbox\" name=\"translit2\" value=\"1\" /> Транслит</label><br />\n";
echo "<input value=\"Создать\" type=\"submit\" /><br />\n";
echo "</form>\n";

echo "<div class=\"foot\">\n";
echo "<a href=\"/forum/$forum[id]/$razdel[id]/\" title='Вернуться в раздел'>Назад</a><br />\n";
echo "<a href=\"/forum/$forum[id]/\">$forum[name]</a><br />\n";
echo "<a href=\"/forum/\">Форум</a><br />\n";
echo "</div>\n";
?>