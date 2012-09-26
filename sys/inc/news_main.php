<?
$q=mysql_query("SELECT * FROM `news` WHERE `main_time` > '".time()."' ORDER BY `id` DESC LIMIT 1");
if (mysql_num_rows($q)==1 && !$set['web'])
{
$news = mysql_fetch_assoc($q);
echo "<div class='news'>\n";
echo "<div class='p_t'>\n";
echo "<a href='/news/'>$news[title]</a>\n";
echo "(".vremja($news['time']).")\n";
echo "</div>\n";
echo "<div class='p_m'>\n";
echo output_text($news['msg'])."<br />\n";
if ($news['link']!=NULL)echo "<a href='".htmlentities($news['link'], ENT_QUOTES, 'UTF-8')."'>Detalles</a><br />\n";
echo "<a href='/news/komm.php?id=$news[id]'>Comentarios</a> (".mysql_result(mysql_query("SELECT COUNT(*) FROM `news_komm` WHERE `id_news` = '$news[id]'"),0).")<br />\n";
echo "</div>\n";
echo "</div>\n";


}
?>