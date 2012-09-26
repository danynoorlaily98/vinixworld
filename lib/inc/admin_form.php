<?

if (user_access('lib_dir_create') && isset($_GET['act']) && $_GET['act']=='mkdir')
{
echo "<form class=\"foot\" action='?act=mkdir&amp;ok&amp;page=$page' method=\"post\">";
echo "Название папки:<br />\n";
echo "<input type='text' name='name' value='' /><br />\n";
echo "<input class='submit' type='submit' value='Создать папку' /><br />\n";
echo "&laquo;<a href='?'>Отмена</a><br />\n";
echo "</form>";
}

if (user_access('lib_dir_edit') && isset($_GET['act']) && $_GET['act']=='rename' && $l!='/')
{
echo "<form class='foot' action='?act=rename&amp;ok&amp;page=$page' method=\"post\">";
echo "Название папки:<br />\n";
echo "<input type=\"text\" name=\"name\" value=\"$dir_id[name]\"/><br />\n";
echo "<input class=\"submit\" type=\"submit\" value=\"Переименовать\" /><br />\n";
echo "&laquo;<a href='?'>Отмена</a><br />\n";
echo "</form>";
}


if (user_access('lib_dir_mesto') && isset($_GET['act']) && $_GET['act']=='mesto' && $l!='/')
{
echo "<form class=\"foot\" action='?act=mesto&amp;ok&amp;page=$page' method=\"post\">";
echo "Новый путь:<br />\n";
echo "<select class='submit' name='new_dir'>";
echo "<option value='/'>[в корень]</option>\n";
$q=mysql_query("SELECT * FROM `lib_dir` WHERE `dir` not like '$l/%' ORDER BY 'dir' ASC");
while ($post = mysql_fetch_assoc($q))
{
echo "<option value='$post[dir]'>$post[name] ($post[dir])</option>\n";
}


echo "</select><br />\n";
echo "<input class='submit' type='submit' value='Переместить' /><br />\n";
echo "&laquo;<a href='?page=$page'>Отмена</a><br />\n";
echo "</form>";
}

if (user_access('lib_dir_delete') && isset($_GET['act']) && $_GET['act']=='delete' && $l!='/')
{

echo "<div class=\"err\">";
echo "Удалить текущую папку ($dir_id[name])?<br />\n";
echo "<a href='?act=delete&amp;ok&amp;page=$page'>Да</a> \n";
echo "<a href='?page=$page'>Нет</a><br />\n";
echo "</div>";
}


if (user_access('lib_dir_delete') || user_access('lib_dir_edit') || user_access('lib_dir_mesto') || user_access('lib_dir_create'))
{
echo "<div class=\"foot\">\n";

if (user_access('lib_dir_create'))
echo "&raquo;<a href='?act=mkdir&amp;page=$page'>Создать папку</a><br />\n";

if ($l!='/'){
if (user_access('lib_dir_edit'))
echo "&raquo;<a href='?act=rename&amp;page=$page'>Переименовать папку</a><br />\n";
if (user_access('lib_dir_mesto'))
echo "&raquo;<a href='?act=mesto&amp;page=$page'>Переместить папку</a><br />\n";
if (user_access('lib_dir_delete'))
echo "&raquo;<a href='?act=delete&amp;page=$page'>Удалить папку</a><br />\n";
}

echo "</div>\n";
}



?>