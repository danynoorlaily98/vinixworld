<?



if (function_exists('getimagesize'))
{
$img_size=getimagesize($file);
echo "Разрешение: $img_size[0]*$img_size[1] пикс.<br />\n";

}

echo 'Размер: '.size_file($size)."<br />\n";
echo 'Загружен: '.vremja($post['time'])."<br />\n";
?>