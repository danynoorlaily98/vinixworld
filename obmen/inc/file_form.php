<?
if (user_access('obmen_file_delete'))
{
if (isset($_GET['act']) && $_GET['act']=='delete' && $l!='/')
{
echo "<div class=\"err\">";
echo "Eliminar \"$file_id[name]\"?<br />\n";
echo "<a href='?showinfo&amp;act=delete&amp;ok'>Si</a> \n";
echo "<a href='?showinfo'>No</a><br />\n";
echo "</div>";
}
else
{
echo "<div class=\"foot\">\n";
echo "&raquo;<a href='?showinfo&amp;act=delete'>Eliminar Archivo</a><br />\n";
echo "</div>\n";
}
}
?>