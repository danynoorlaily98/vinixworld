<?
if (user_access('lib_stat_zip') && isset($_GET['act']) && $_GET['act']=='upload_zip')
{
echo "<form class='foot' enctype=\"multipart/form-data\" action='?act=upload_zip&amp;ok&amp;page=$page' method=\"post\">";
echo "ZIP архив:<br />\n";
echo "<input name='file' type='file' accept='application/zip' /><br />\n";

if (function_exists('iconv')){
echo "Кодировка файлов:<br />\n<select name=\"charset\">\n";
echo "<option value=\"utf-8\">UTF-8</option>\n";
echo "<option value=\"windows-1251\">WIN-1251</option>\n";
echo "<option value=\"cp866\">OEM/DOS</option>\n";
echo "<option value=\"KOI8-R\">KOI8-R</option>\n";
echo "</select><br />\n";
}

echo "Названия статей:<br />\n<select name=\"name_of\">\n";
echo "<option value=\"name\">Из имени файла</option>\n";
echo "<option value=\"string\">Из первой строки</option>\n";

echo "</select><br />\n";

echo "<input class=\"submit\" type=\"submit\" value=\"Выгрузить\" /><br />\n";
echo "&laquo;<a href='?'>Отмена</a><br />\n";
echo "</form>";
}

if (user_access('lib_stat_txt') && isset($_GET['act']) && $_GET['act']=='upload_txt')
{
echo "<form class='foot' enctype=\"multipart/form-data\" action='?act=upload_txt&amp;ok&amp;page=$page' method=\"post\">";
echo "TXT файл:<br />\n";
echo "<input name='file' type='file' accept='text/plain' /><br />\n";

if (function_exists('iconv')){
echo "Кодировка:<br />\n<select name=\"charset\">\n";
echo "<option value=\"utf-8\">UTF-8</option>\n";
echo "<option value=\"windows-1251\">WIN-1251</option>\n";
echo "<option value=\"cp866\">OEM/DOS</option>\n";
echo "<option value=\"KOI8-R\">KOI8-R</option>\n";
echo "</select><br />\n";
}


echo "<input class=\"submit\" type=\"submit\" value=\"Выгрузить\" /><br />\n";
echo "&laquo;<a href='?'>Отмена</a><br />\n";
echo "</form>";
}


if (user_access('lib_stat_create') && isset($_GET['act']) && $_GET['act']=='create_stat')
{
echo "<form class='foot' enctype=\"multipart/form-data\" action='?act=create_stat&amp;ok&amp;page=$page' method=\"post\">";
echo "Название статьи:<br />\n";
echo "<input name='name' type='text' maxlength='128' /><br />\n";
echo "Текст статьи:<br />\n";
echo "<textarea name='text'></textarea><br />\n";
echo "<input class=\"submit\" type=\"submit\" value=\"Создать\" /><br />\n";
echo "&laquo;<a href='?'>Отмена</a><br />\n";
echo "</form>";
}





if (user_access('lib_stat_create') || user_access('lib_stat_txt') || user_access('lib_stat_zip'))
{
echo "<div class=\"foot\">\n";
if (user_access('lib_stat_create'))
echo "&raquo;<b><a href='?act=create_stat&amp;page=$page'>Создать статью</a></b><br />\n";
if (user_access('lib_stat_txt'))
echo "&raquo;<b><a href='?act=upload_txt&amp;page=$page'>Выгрузить txt файл</a></b><br />\n";
if (user_access('lib_stat_zip'))
echo "&raquo;<b><a href='?act=upload_zip&amp;page=$page'>Выгрузить zip архив</a></b><br />\n";
echo "</div>\n";

}



?>