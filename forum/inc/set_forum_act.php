<?
if (user_access('forum_for_edit') && isset($_GET['act']) && isset($_GET['ok']) && $_GET['act']=='set' && isset($_POST['name']) && isset($_POST['opis']) && isset($_POST['pos']))
{

$name=esc(stripcslashes(htmlspecialchars($_POST['name'])));
if (isset($_POST['translit1']) && $_POST['translit1']==1)$name=translit($name);
//if (ereg("\{|\}|\^|\%|\\$|#|@|!|\~|'|\"|`|<|>",$name))$err='В названии форума присутствуют запрещенные символы';
if (strlen2($name)<3)$err='Слишком короткое название';
if (strlen2($name)>32)$err='Слишком днинное название';
$name=my_esc($name);


$opis=$_POST['opis'];
if (isset($_POST['translit2']) && $_POST['translit2']==1)$opis=translit($opis);
//if (strlen2($opis)<10)$err='Короткое описание';
if (strlen2($opis)>512)$err='Слишком длинное описание';
$opis=my_esc($opis);



$pos=intval($_POST['pos']);
if (!isset($err)){

if ($user['level']>=3)
{
if (isset($_POST['adm']) && $_POST['adm']==1)
{
admin_log('Форум','Подфорумы',"Подфорум '$forum[name]' только для администрации");
$adm=1;
}
else $adm=0;


mysql_query("UPDATE `forum_f` SET `adm` = '$adm' WHERE `id` = '$forum[id]' LIMIT 1");
}


if ($forum['name']!=$name)admin_log('Форум','Подфорумы',"Подфорум '$forum[name]' переименован в '$name'");
if ($forum['opis']!=$opis)admin_log('Форум','Подфорумы',"Изменено описание подфорума '$name'");

mysql_query("UPDATE `forum_f` SET `name` = '$name', `opis` = '$opis', `pos` = '$pos' WHERE `id` = '$forum[id]' LIMIT 1");
$forum=mysql_fetch_assoc(mysql_query("SELECT * FROM `forum_f` WHERE `id` = '$forum[id]' LIMIT 1"));
msg('Изменения успешно приняты');
}
}

if (isset($_GET['act']) && isset($_GET['ok']) && $_GET['act']=='delete' && user_access('forum_for_delete'))
{
mysql_query("DELETE FROM `forum_f` WHERE `id` = '$forum[id]'");
mysql_query("DELETE FROM `forum_r` WHERE `id_forum` = '$forum[id]'");
mysql_query("DELETE FROM `forum_t` WHERE `id_forum` = '$forum[id]'");
mysql_query("DELETE FROM `forum_p` WHERE `id_forum` = '$forum[id]'");
admin_log('Форум','Подфорумы',"Удаление подфорума '$forum[name]'");
msg('Подфорум успешно удален');
err();
aut();
echo "<a href=\"/forum/\">В форум</a><br />\n";
include_once '../sys/inc/tfoot.php';
}


if (user_access('forum_razd_create') && (isset($_GET['act']) && isset($_GET['ok']) && $_GET['act']=='new' && isset($_POST['name'])))
{

$name=esc(stripcslashes(htmlspecialchars($_POST['name'])));
if (isset($_POST['translit1']) && $_POST['translit1']==1)$name=translit($name);
//if (ereg("\{|\}|\^|\%|\\$|#|@|!|\~|'|\"|`|<|>",$name))$err='В названии раздела присутствуют запрещенные символы';
if (strlen2($name)<2)$err='Слишком короткое название';
if (strlen2($name)>32)$err='Слишком днинное название';

if (!isset($err)){
admin_log('Форум','Разделы',"Создание раздела '$name' в подфоруме '$forum[name]'");
mysql_query("INSERT INTO `forum_r` (`id_forum`, `name`, `time`) values('$forum[id]', '".my_esc($name)."', '$time')");
msg('Раздел успешно создан');
}
}
?>