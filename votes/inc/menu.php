<?
$set['title']='Survey'; // заголовок страницы
include_once '../sys/inc/thead.php';
title();
err();
//aut();

echo "Pollings: $k_post_active<br />\n";
echo "Total number of polls: $k_post_all<br />\n";
echo "<div class='menu'>\n";
echo "<a href='?survey=open'>Vote ($k_post_open)</a><br />\n";
echo "<a href='?survey=close'>Result ($k_post_close)</a><br />\n";

if (user_access('votes_settings'))
echo "<a href='?survey=all'>All survey ($k_post_all)</a><br />\n";
echo "</div>";


echo "* The results will be available at the end of interviews<br />\n";
?>
