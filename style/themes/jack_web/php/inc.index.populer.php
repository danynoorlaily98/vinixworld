<?php
if (isset($user))
{
echo "<table><tr><td>";
echo "<li><span class='off'>Top member</span></li>";

echo '<table class="post">';

$okbook = mysql_query("SELECT * FROM `user` ORDER BY `rating` DESC LIMIT 3;");

while ($ank = mysql_fetch_array($okbook))
{
echo "<td class='icon'>\n";


echo "<a onclick='fun();' href='/info.php?id=$ank[id]'>";

avatar($ank['id']);


echo "</a><br />";
echo "<a onclick='fun();' href=\"/info.php?id=$ank[id]\"><span style=\"color:$ank[color_nick]\">$ank[nick]</span></a>\n";

echo "</td>\n";
}

echo '</table>';
echo "</td><td>";
}
?>
