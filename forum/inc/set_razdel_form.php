<?
if (isset($_GET['act']) && $_GET['act']=='mesto')
{
echo "<form method=\"post\" action=\"/forum/$forum[id]/$razdel[id]/?act=mesto&amp;ok\">\n";
echo "Подфорум:<br />\n";

echo "<select name=\"forum\">\n";
$q2 = mysql_query("SELECT * FROM `forum_f` ORDER BY `pos` ASC");
while ($forums = mysql_fetch_assoc($q2))
{
if ($forum['id']==$forums['id'])$check=' selected="selected"';else $check=NULL;
echo "<option$check value=\"$forums[id]\">$forums[name]</option>\n";
}
echo "</select><br />\n";

echo "<input value=\"Переместить\" type=\"submit\" /><br />\n";
echo "&laquo;<a href='/forum/$forum[id]/$razdel[id]/'>Отмена</a><br />\n";
echo "</form>\n";
}

if (isset($_GET['act']) && $_GET['act']=='set')
{
echo "<form method=\"post\" action=\"/forum/$forum[id]/$razdel[id]/?act=set&amp;ok\">\n";
echo "Название раздела:<br />\n";
echo "<input name='name' type='text' maxlength='32' value='$razdel[name]' /><br />\n";
if ($user['set_translit']==1)echo "<label><input type=\"checkbox\" name=\"translit1\" value=\"1\" /> Транслит</label><br />\n";
echo "<input value=\"Изменить\" type=\"submit\" /><br />\n";
echo "&laquo;<a href='/forum/$forum[id]/$razdel[id]/'>Отмена</a><br />\n";
echo "</form>\n";
}

if (isset($_GET['act']) && $_GET['act']=='del')
{
echo "<div class=\"err\">\n";
echo "Подтвердите удаление раздела<br />\n";
echo "<a href=\"/forum/$forum[id]/$razdel[id]/?act=delete&amp;ok\">Да</a> <a href=\"/forum/$forum[id]/$razdel[id]/\">Нет</a><br />\n";
echo "</div>\n";
}


echo "<div class=\"foot\">\n";
echo "&raquo;<a href='/forum/$forum[id]/$razdel[id]/?act=mesto'>Переместить раздел</a><br />\n";
echo "&raquo;<a href='/forum/$forum[id]/$razdel[id]/?act=del'>Удалить раздел</a><br />\n";
echo "&raquo;<a href='/forum/$forum[id]/$razdel[id]/?act=set'>Параметры раздела</a><br />\n";
echo "</div>\n";


?>