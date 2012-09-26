<?php

// remodified by noe
// http://nnetwork.tk
// loegue.info@gmail.com
// hargailah privasi orang

if (isset($user)){
$res = mysql_query("SELECT * FROM `blog_list` ORDER BY rand() DESC LIMIT 1");
while ($blog = mysql_fetch_array($res)){

$ank=get_user($blog['id_user']);
echo "<div class='penanda'><a href='/info.php?id=$ank[id]'>$ank[nick]</a>'s Note</div>";
echo "<table class='post'><tr>\n";
echo "  <td>\n";
echo "Title : ".output_text($blog['name'])."<br/>Post : ".vremja($blog['time'])."<br/>\n";
echo esc(trim(br(bbcode(links(stripcslashes(htmlspecialchars(substr($blog['msg'], 0, 80))))))))." <a href='/blog/list.php?id=".$blog['id']."'>More</a><br/>";
$cmn=mysql_result(mysql_query("SELECT COUNT(*) FROM `blog_komm` WHERE `id_blog` = '$blog[id]'"),0);

echo"View : ".$blog['count']." Comments : <a href='/blog/list.php?id=".$blog['id']."&amp;SESS=$sess'>$cmn</a><br/>\n";
}
echo "  </td>\n";
echo "   </tr>\n";
echo "   <tr>\n";
echo "</td>\n";
echo "</tr></table>\n";
}

?>
