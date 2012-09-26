<?

echo "<span class=\"ank_n\"><a href='/foto/$ank[id]/'>Albums</a>:</span> <span class=\"ank_d\">";



echo mysql_result(mysql_query("SELECT COUNT(*) FROM `gallery` WHERE `id_user` = '$ank[id]'"),0);


echo "</span><br />\n";
?>
