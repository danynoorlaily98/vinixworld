<?
global $user, $time;
if (isset($user)) // новости показываем только зарегистрированным
{
$q=mysql_query("SELECT * FROM `news` LEFT JOIN `news_read` ON `news`.`id` = `news_read`.`id_news` AND `news_read`.`id_user` = '$user[id]' WHERE `news_read`.`id_user` IS NULL AND `news`.`time` > '".($time-60*60*24*7)."' ORDER BY `time` ASC LIMIT 1");
if (mysql_num_rows($q)){
$block = new Smarty_conf();
//echo "Новостей: ".mysql_num_rows($q)."<br />\n";
$news=mysql_fetch_assoc($q);

$content=output_text($news['msg'])."<br />";
$content.= "<a href='/news/hide.php?id=$news[id]'>Sembunyikan berita</a> ";
if ($news['link'])$content.="<a href='".input_value_text($news['link'])."'>Rincian</a> ";
$content.= "<a href='/news/komm.php?id=$news[id]'>Komentar</a> (".mysql_result(mysql_query("SELECT COUNT(*) FROM `news_komm` WHERE `id_news` = '$news[id]'"),0).")";



$block->assign('content',$content);
$block->assign('title',$news['title'].' ('.vremja($news['time']).')');
$block->display('inc.index.block.tpl');
}
}

?>
