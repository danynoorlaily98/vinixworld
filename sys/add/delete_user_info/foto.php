<?

$gallery_q=mysql_query("SELECT * FROM `gallery` WHERE `id_user` = '$ank[id]'");
$foto=0;

while ($gallery = mysql_fetch_assoc($gallery_q))

{
$foto+=mysql_result(mysql_query("SELECT COUNT(*) FROM `gallery_foto` WHERE `id_gallery` = '$gallery[id]'"),0);
}


if (count($collisions)>1 && isset($_GET['all']))
{
$foto_coll=0;
for ($i=1;$i<count($collisions);$i++)
{

$gallery_q=mysql_query("SELECT * FROM `gallery` WHERE `id_user` = '$collisions[$i]'");
while ($gallery = mysql_fetch_assoc($gallery_q))
{
$foto_coll+=mysql_result(mysql_query("SELECT COUNT(*) FROM `gallery_foto` WHERE `id_gallery` = '$gallery[id]'"),0);
}
}
if ($obmennik_coll!=0)
$foto="$foto +$foto_coll*";
}

echo "<span class=\"ank_n\">My Albums:</span> <span class=\"ank_d\">$foto</span><br />\n";

?>