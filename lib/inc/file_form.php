<?
if (user_access('lib_stat_delete')){
if (isset($_GET['act']) && $_GET['act']=='delete' && $l!='/')
{

echo "<div class=\"err\">";
echo "Удалить файл \"$file_id[name]\"?<br />\n";
echo "<a href='?act=delete&amp;ok'>Да</a> \n";
echo "<a href='?'>Нет</a><br />\n";
echo "</div>";
}


echo "<div class=\"foot\">\n";
echo "&raquo;<a href='?act=delete'>Удалить файл</a><br />\n";
echo "</div>\n";



}
?>