<?
if ($set['mobiads_bottom']==1)
{
echo "<div class='title'><div class='rekl'>";

echo "</div></div>";
}
?>

<?
if (file_exists(H."style/themes/$set[set_them]/foot.php"))
include_once H."style/themes/$set[set_them]/foot.php";
else
{

list($msec, $sec) = explode(chr(32), microtime());
echo "<div class='foot'>";
echo "Registrados:<a href='/users.php'> ".mysql_result(mysql_query("SELECT COUNT(*) FROM `user`"), 0)."</a><br />\n";
echo "Online:<a href='/online.php'> ".mysql_result(mysql_query("SELECT COUNT(*) FROM `user` WHERE `date_last` > ".(time()-600).""), 0)."</a>\n";
echo "/ ".mysql_result(mysql_query("SELECT COUNT(*) FROM `guests` WHERE `date_last` > ".(time()-600)." AND `pereh` > '0'"), 0)."</a><br />\n";
if (isset($user) && $user['level']!=0) echo "".round(($sec + $msec) - $conf['headtime'], 3)." sec<br />\n";
echo "</div>\n";
echo "<div class='rekl'>\n";
rekl(3);
echo "</div>\n";
echo "</div>\n</body>\n</html>";
exit;
}
?>
