<?
if (is_file(H."sys/obmen/screens/128/$file_id[id].gif"))
{
echo "<img src='/sys/obmen/screens/128/$file_id[id].gif' alt='Pantalla..' /><br />\n";
}

if ($file_id['opis']!=NULL)
{
echo "Descripcion: ";
echo output_text($file_id['opis']);
//echo trim(br(links($file_id['opis'])));

echo "<br />\n";
}


echo "Subido: ".vremja($file_id['time'])."<br />\n";





echo "Tama&ntilde;o: ".size_file($file_id['size'])."<br />\n";

?>