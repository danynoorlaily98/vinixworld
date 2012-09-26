<?


if (user_access('forum_razd_create') && (isset($_GET['act']) && $_GET['act']=='new' || !isset($_GET['act']) && mysql_result(mysql_query("SELECT COUNT(*) FROM `forum_r` WHERE `id_forum` = '$forum[id]'"),0)==0))
{
echo "<form method=\"post\" action=\"/forum/$forum[id]/?act=new&amp;ok\">\n";
echo "Название раздела:<br />\n";
echo "<input name=\"name\" type=\"text\" maxlength='32' value='' /><br />\n";
if ($user['set_translit']==1)echo "<label><input type=\"checkbox\" name=\"translit1\" value=\"1\" /> Транслит</label><br />\n";
echo "<input value=\"Создать\" type=\"submit\" /><br />\n";
echo "&laquo;<a href=\"/forum/$forum[id]/\">Отмена</a><br />\n";
echo "</form>\n";
}


if (user_access('forum_for_edit') && (isset($_GET['act']) && $_GET['act']=='set'))
{
echo "<form method=\"post\" action=\"/forum/$forum[id]/?act=set&amp;ok\">\n";
echo "Название форума:<br />\n";
echo "<input name=\"name\" type=\"text\" maxlength='32' value='$forum[name]' /><br />\n";
if ($user['set_translit']==1)echo "<label><input type=\"checkbox\" name=\"translit1\" value=\"1\" /> Транслит</label><br />\n";
echo "Описание:<br />\n";
echo "<textarea name=\"opis\">".esc(trim(stripcslashes(htmlspecialchars($forum['opis']))))."</textarea><br />\n";
if ($user['set_translit']==1)echo "<label><input type=\"checkbox\" name=\"translit2\" value=\"1\" /> Транслит</label><br />\n";
echo "Позиция:<br />\n";
echo "<input name=\"pos\" type=\"text\" maxlength='3' value='$forum[pos]' /><br />\n";

if ($user['level']>=3){
if ($forum['adm']==1)$check=' checked="checked"';else $check=NULL;
echo "<label><input type=\"checkbox\"$check name=\"adm\" value=\"1\" /> Только для администрации</label><br />\n";
}

echo "<input value=\"Изменить\" type=\"submit\" /><br />\n";
echo "&laquo;<a href=\"/forum/$forum[id]/\">Отмена</a><br />\n";
echo "</form>\n";
}

if (isset($_GET['act']) && $_GET['act']=='del' && user_access('forum_for_delete'))
{
echo "<div class=\"err\">\n";
echo "Подтвердите удаление форума<br />\n";
echo "<a href=\"/forum/$forum[id]/?act=delete&amp;ok\">Да</a> <a href=\"/forum/$forum[id]/\">Нет</a><br />\n";
echo "</div>\n";
}

if (user_access('forum_razd_create') || user_access('forum_for_edit') || user_access('forum_for_delete'))
{
echo "<div class=\"foot\">\n";

if(user_access('forum_razd_create'))
echo "&raquo;<a href=\"/forum/$forum[id]/?act=new\">Новый раздел</a><br />\n";

if(user_access('forum_for_edit'))
echo "&raquo;<a href=\"/forum/$forum[id]/?act=set\">Параметры форума</a><br />\n";

if(user_access('forum_for_delete'))
echo "&raquo;<a href=\"/forum/$forum[id]/?act=del\">Удалить форум</a><br />\n";

echo "</div>\n";
}

?>