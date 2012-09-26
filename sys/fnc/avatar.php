<?

// remodified by noe
// http://nnetwork.tk
// loegue.info@gmail.com
// hargailah privasi orang

function avatar($id)
{
global $set;
if (is_file(H."sys/avatar/$id.jpg"))
echo "<img src='/sys/avatar/$id.jpg' alt='' width='24' height='27'/>";
elseif ($_SERVER['PHP_SELF']!='/info.php')
echo "<img src='/style/themes/$set[set_them]/user.png' alt='' width='24' height='27'/>";
if ($_SERVER['PHP_SELF']=='/info.php' && (is_file(H."sys/avatar/$id.jpg")))echo "<br/>";
}
?>
