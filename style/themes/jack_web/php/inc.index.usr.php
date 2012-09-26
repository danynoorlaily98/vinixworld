<?php
//dcms 6.90 stabels full mods by t87jack, info visit my wap or web http://t87jack.kilu.de//
if (isset($user))
{
$bq = mysql_query("SELECT * FROM `user` ORDER BY rand() LIMIT 1;");
echo "<table><tr><td>";
echo "<span class='off'><li>Orang yang mungkin anda kenal?</li></span>";
while ($ank = mysql_fetch_array($bq))
{
echo "<table>";
echo "<tr>";
echo "<td rowspan='2'>";

avatar($ank['id']);

echo"</tr>";
echo"</td>";

echo"<tr>";
echo"<td>";

echo "<a href=\"/info.php?id=$ank[id]\"><span style=\"color:$ank[color_nick]\">$ank[nick]</span></a><br>\n";

echo "<span class='ank_n'>";
include_once 'levels.php';
echo "</span>";

echo "<br><span class=\"ank_n\">rating: ".($ank['id']==$user['id']?" $ank[rating] <a href='/who_rating.php'>[?]</a>":null)." <br> <img src='/rat.php?p=$ank[rating]'/></span>";
echo "<br />\n";


$d1sql = mysql_query("SELECT COUNT(*) FROM `frends_new` WHERE (`user` = '$user[id]' AND `to` = '$ank[id]') OR (`user` = '$ank[id]' AND `to` = '$user[id]') LIMIT 1");
$d2sql = mysql_query("SELECT COUNT(*) FROM `frends` WHERE (`user` = '$ank[id]' AND `frend` = '$user[id]') OR (`user` = '$user[id]' AND `frend` = '$ank[id]') LIMIT 1");
if (isset($user) && $user['id']!=$ank['id'] && mysql_result($d1sql, 0)==0 && mysql_result($d2sql, 0)==0)
{
echo '<a href="frend_add.php?id='.$ank['id'].'">Tambah keteman</a><br />';
}
else{
echo '<a href="frend.php?id='.$ank['id'].'">Lihat teman</a><br/>';
}
echo "  </td>\n";
echo "   </tr>\n";
echo "</table>\n";
echo "</td><td>";

}
}
?>
