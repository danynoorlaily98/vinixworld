<?


if (isset($_GET['act']) && $_GET['act']=='create')
{

echo "<form method=\"post\" class='foot' action=\"?\">\n";
echo "Будут удалены посты, написаные ... тому назад<br />\n";
echo "<input name=\"write\" value=\"12\" type=\"text\" size='3' />\n";
echo "<select name=\"write2\">\n";
echo "<option value=\"\">       </option>\n";
echo "<option value=\"mes\">Месяцев</option>\n";
echo "<option value=\"sut\">Суток</option>\n";
echo "</select><br />\n";
echo "<input value=\"Очистить\" type=\"submit\" /><br />\n";
echo "<a href=\"?\">Отмена</a><br />\n";
echo "</form>\n";
}



echo "<div class=\"foot\">\n";
echo "<a href=\"?act=create\">Очистить чат</a><br />\n";
echo "</div>\n";
?>