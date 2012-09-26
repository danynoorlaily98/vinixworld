<?

list($msec, $sec) = explode(chr(32), microtime());
echo "<div class='foot'>\n";
//echo "<a href='/' accesskey='0' title='Home'>".(isset ($set['copy']) && $set['copy']!=null?$set['copy']:'Home')."</a><br />\n";

echo "Generation: ".round(($sec + $msec) - $conf['headtime'], 3)." sec<br />\n";
echo "</div>\n";
echo "</div>\n</body>\n</html>";
exit;

?>