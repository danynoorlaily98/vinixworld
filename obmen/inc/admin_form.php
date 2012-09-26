<?

if (user_access('obmen_dir_edit') && isset($_GET['act']) && $_GET['act']=='set')
{
echo "<form class=\"foot\" action='?act=set&amp;ok&amp;page=$page' method=\"post\">";
echo "Nombre de la Carpeta:<br />\n";
echo "<input type='text' name='name' value='$dir_id[name]' /><br />\n";

if ($dir_id['upload']==1)$check=' checked="checked"'; else $check=NULL;
echo "<label><input type=\"checkbox\"$check name=\"upload\" value=\"1\" /> Subir</label><br />\n";
echo "Tipos Permitidos \";\":<br />\n";
echo "<input type='text' name='ras' value='$dir_id[ras]' /><br />\n";
echo "Tama&ntilde;o maximo:<br />\n";
if ($dir_id['maxfilesize']<1024)$size=$dir_id['maxfilesize'];
elseif($dir_id['maxfilesize']>=1024 && $dir_id['maxfilesize']<1048576)$size=intval($dir_id['maxfilesize']/1024);
elseif($dir_id['maxfilesize']>=1048576)$size=intval($dir_id['maxfilesize']/1048576);

echo "<input type='text' name='size' size='4' value='$size' />\n";
echo "<select name='mn'>\n";
if ($dir_id['maxfilesize']<1024)$sel=' selected="selected"';else $sel=NULL;
echo "<option value='1'$sel>B</option>\n";
if ($dir_id['maxfilesize']>=1024 && $dir_id['maxfilesize']<1048576)$sel=' selected="selected"';else $sel=NULL;
echo "<option value='1024'$sel>KB</option>\n";
if ($dir_id['maxfilesize']>=1048576)$sel=' selected="selected"';else $sel=NULL;
echo "<option value='1048576'$sel>MB</option>\n";
echo "</select><br />\n";
echo "*El servidor no admite archivos mayores a: ".size_file($upload_max_filesize)."<br />\n";
echo "<input class='submit' type='submit' value='Aceptar Cambios' /><br />\n";
echo "&laquo;<a href='?'>Cancelar</a><br />\n";
echo "</form>";
}








if (user_access('obmen_dir_create') && isset($_GET['act']) && $_GET['act']=='mkdir')
{
echo "<form class=\"foot\" action='?act=mkdir&amp;ok&amp;page=$page' method=\"post\">";
echo "Nombre de la Carpeta:<br />\n";
echo "<input type='text' name='name' value='' /><br />\n";
echo "<label><input type=\"checkbox\" name=\"upload\" value=\"1\" /> Subir</label><br />\n";
echo "Tipos Permitidos \";\":<br />\n";
echo "<input type='text' name='ras' value='' /><br />\n";
echo "Tama&ntilde;o Max permitido:<br />\n";
echo "<input type='text' name='size' size='4' value='500' />\n";
echo "<select name='mn'>\n";
echo "<option value='1'>B</option>\n";
echo "<option value='1024' selected='selected'>KB</option>\n";
echo "<option value='1048576'>MB</option>\n";
echo "</select><br />\n";
echo "*El servidor no acepta archivos mayores a: ".size_file($upload_max_filesize)."<br />\n";
echo "<input class='submit' type='submit' value='Aceptar Cambios' /><br />\n";
echo "&laquo;<a href='?'>Cancelar</a><br />\n";
echo "</form>";
}

if (user_access('obmen_dir_edit') && isset($_GET['act']) && $_GET['act']=='rename' && $l!='/')
{
echo "<form class='foot' action='?act=rename&amp;ok&amp;page=$page' method=\"post\">";
echo "Nombre de la Carpeta:<br />\n";
echo "<input type=\"text\" name=\"name\" value=\"$dir_id[name]\"/><br />\n";
echo "<input class=\"submit\" type=\"submit\" value=\"Aceptar Cambios\" /><br />\n";
echo "&laquo;<a href='?'>Cancelar</a><br />\n";
echo "</form>";
}


if (user_access('obmen_dir_edit') && isset($_GET['act']) && $_GET['act']=='mesto' && $l!='/')
{
echo "<form class=\"foot\" action='?act=mesto&amp;ok&amp;page=$page' method=\"post\">";
echo "Nueva ruta:<br />\n";
echo "<select class=\"submit\" name=\"dir_osn\">";
echo "<option value='/'>[a la raiz]</option>\n";
$q=mysql_query("SELECT DISTINCT `dir` FROM `obmennik_dir` WHERE `dir` not like '$l%' ORDER BY 'dir' ASC");
while ($post = mysql_fetch_assoc($q))
{
echo "<option value='$post[dir]'>$post[dir]</option>\n";
}


echo "</select><br />\n";
echo "<input class=\"submit\" type=\"submit\" value=\"Mover\" /><br />\n";
echo "&laquo;<a href='?page=$page'>Cancelar</a><br />\n";
echo "</form>";
}

if (user_access('obmen_dir_delete') && isset($_GET['act']) && $_GET['act']=='delete' && $l!='/')
{

echo "<div class=\"err\">";
echo "Eliminar esta Carpeta ($dir_id[name])?<br />\n";
echo "<a href='?act=delete&amp;ok&amp;page=$page'>Si</a> \n";
echo "<a href='?page=$page'>No</a><br />\n";
echo "</div>";
}


if (user_access('obmen_dir_edit') || user_access('obmen_dir_delete') || user_access('obmen_dir_create'))
{
echo "<div class=\"foot\">\n";

if (user_access('obmen_dir_create'))
echo "&raquo;<a href='?act=mkdir&amp;page=$page'>Crear Carpeta</a><br />\n";

if ($l!='/'){

if (user_access('obmen_dir_edit')){
echo "&raquo;<a href='?act=rename&amp;page=$page'>Renombrar Carpeta</a><br />\n";
echo "&raquo;<a href='?act=set&amp;page=$page'>Opciones de Carpeta</a><br />\n";
echo "&raquo;<a href='?act=mesto&amp;page=$page'>Mover Carpeta</a><br />\n";
}

if (user_access('obmen_dir_delete'))
echo "&raquo;<a href='?act=delete&amp;page=$page'>Eliminar Carpeta</a><br />\n";
}


echo "</div>\n";
}


?>