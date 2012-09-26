<?


if (is_file("inc/icon48/$ras.php"))
include "inc/icon48/$ras.php";
elseif (is_file(H.'style/themes/'.$set['set_them'].'/loads/48/'.$ras.'.png'))
echo "<img src='/style/themes/$set[set_them]/loads/48/$ras.png' alt='$ras' />\n";
else echo "<img src='/style/themes/$set[set_them]/loads/48/file.png' alt='file' />\n";



?>