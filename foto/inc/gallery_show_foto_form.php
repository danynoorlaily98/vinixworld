<?

// remodified by noe
// http://nnetwork.tk
// loegue.info@gmail.com
// hargailah privasi orang


if (isset($_GET['act']) && $_GET['act']=='rename')
{
echo "<form class='foot' action='?act=rename&amp;ok' method=\"post\">";
echo "Title:<br />\n";
echo "<input name='name' type='text' value='$foto[name]' /><br />\n";
echo "Description:<br />\n";
echo "<textarea name='opis'>".esc(stripcslashes(htmlspecialchars($foto['opis'])))."</textarea><br />\n";
echo "<input class='submit' type='submit' value='Apply' /><br />\n";
echo "&nbsp;<a href='?'>Cancel</a><br />\n";
echo "</form>";
}
if (isset($_GET['act']) && $_GET['act']=='delete')
{
echo "<form class='foot' action='?act=delete&amp;ok' method=\"post\">";
echo "<div class='err'>Confirm to delete photos</div>\n";
echo "<input class='submit' type='submit' value='Delete' /><br />\n";
echo "&nbsp;<a href='?'>Cancel</a><br />\n";
echo "</form>";
}




echo "<div class=\"foot\">\n";
echo "&nbsp;<a href='?act=delete'>Delete</a><br />\n";
echo "&nbsp;<a href='?act=rename'>Rename</a><br />\n";
echo "</div>\n";
?>
