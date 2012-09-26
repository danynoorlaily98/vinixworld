<?

// remodified by noe
// http://nnetwork.tk
// loegue.info@gmail.com
// hargailah privasi orang



if (user_access('guest_clear'))

{

if (isset($_GET['act']) && $_GET['act']=='create')

{



echo "<form method=\"post\" class='foot' action=\"?\">\n";

echo "Ini akan menghapus posting yang Anda tentukan<br />\n";

echo "<input name=\"write\" value=\"12\" type=\"text\" size='3' />\n";

echo "<select name=\"write2\">\n";

echo "<option value=\"\">       </option>\n";

echo "<option value=\"mes\">Months</option>\n";

echo "<option value=\"sut\">Days</option>\n";

echo "</select><br />\n";

echo "<input value=\"Clean\" type=\"submit\" /><br />\n";

echo "<a href=\"?\">Cancel</a><br />\n";

echo "</form>\n";

}





echo "<div class=\"foot\">\n";

echo "<a href=\"?act=create\">Refine Shoutbox</a><br />\n";

echo "</div>\n";

}

?>
