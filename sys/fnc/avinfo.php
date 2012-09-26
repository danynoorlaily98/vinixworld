<?
/*silahkan rubah angka di width dan height sesuai selera anda*/

function avinfo($id)
{
global $set;
if (is_file(H."sys/avatar/$id.gif"))
echo "<img src='/sys/avatar/$id.gif' width='98' height='85' alt='avatar' />\n";
else
if (is_file(H."sys/avatar/$id.jpg"))
echo "<img src='/sys/avatar/$id.jpg' width='98' height='85' alt='avatar' />\n";
else
if (is_file(H."sys/avatar/$id.png"))
echo "<img src='/sys/avatar/$id.png' width='98' height='85' alt='avatar' />\n";
else
if ($_SERVER['PHP_SELF']!='/inf.php')
echo "<img src='/style/themes/$set[set_them]/user.png' width='98' height='85' alt='avatar' />\n";


if ($_SERVER['PHP_SELF']=='/info.php' && (is_file(H."sys/avatar/$id.gif") || is_file(H."sys/avatar/$id.jpg") || is_file(H."sys/avatar/$id.png")))
echo "<br />\n";
}
?>
