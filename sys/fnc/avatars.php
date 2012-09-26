<?

// remodified by noe
// http://nnetwork.tk
// loegue.info@gmail.com
// hargailah privasi orang

function avatars($id)
{
global $set;
if (is_file(H."sys/avatars/$id.jpg"))
echo "<img src='/sys/avatars/$id.jpg' alt='' width='64' height='90' />\n";
elseif ($_SERVER['PHP_SELF']!='/.php')
echo "<img src='/style/themes/$set[set_them]/info.png' alt='' width='64' height='90' />\n";
if ($_SERVER['PHP_SELF']!='/info.php' && (is_file(H."sys/avatars/$id.jpg")))
echo "<br/>\n";

}
?>
