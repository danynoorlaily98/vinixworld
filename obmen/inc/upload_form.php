<?
if ($dir_id['upload']==1){




if (isset($_GET['act']) && $_GET['act']=='upload' && $l!='/')
{
if (!isset($set['obmen_limit_up']) || $set['obmen_limit_up']<=$user['balls']){
echo "<form class='foot' enctype=\"multipart/form-data\" action='?act=upload&amp;ok&amp;page=$page' method=\"post\">";
echo "Archivo:<br />\n";
echo "<input name='file' type='file' maxlength='$dir_id[maxfilesize]' /><br />\n";
echo "Imagen:<br />\n";
echo "<input name='screen' type='file' accept='image/*' /><br />\n";
echo "Descripcion:<br />\n";
echo "<textarea name='opis'></textarea><br />\n";
echo "<input class=\"submit\" type=\"submit\" value=\"Subir\" /><br />\n";
echo "*Formatos de Archivo Permitidos: $dir_id[ras]<br />\n";
echo "Tama&ntilde;o max: ".size_file($dir_id['maxfilesize'])."<br />\n";
echo "&laquo;<a href='?'>Cancelar</a><br />\n";
echo "</form>";
}
else
{
echo "Al subir el archivo al archivo compartido solo recibes puntos $set[obmen_limit_up] por los usuarios que lo descargan<br />\n";
}
}



echo "<div class=\"foot\">\n";
echo "&raquo;<b><a href='?act=upload&amp;page=$page'>Subir Archivo</a></b><br />\n";
echo "</div>\n";
}
?>