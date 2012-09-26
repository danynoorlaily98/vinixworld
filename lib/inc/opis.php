<?
/*
if (file_exists($file))
{
$gz_open=gzopen($file, 'r');
$stat=gzread($gz_open, 1024);
gzclose($gz_open);


if (function_exists('iconv_substr')){ // проверяется установлена ли библиотека iconv
if (!$set['web']) // проверяется тип браузера, если браузер ваповский, то и текста выведется меньше
echo esc(trim(br(bbcode(links(stripcslashes(htmlspecialchars(@iconv_substr($stat, 0, 64, 'utf-8'))))))))."...\n";
else echo esc(trim(br(bbcode(links(stripcslashes(htmlspecialchars(@iconv_substr($stat, 0, 256, 'utf-8'))))))))."...\n";
}
else {
if (!$set['web'])
echo esc(trim(br(bbcode(links(stripcslashes(htmlspecialchars(substr($stat, 0, 64))))))))."...\n";
else echo esc(trim(br(bbcode(links(stripcslashes(htmlspecialchars(substr($stat, 0, 256))))))))."...\n";
}


echo "<br />\n";
}
else
echo "Ошибка: файл поврежден<br />\n";
*/
$ank=mysql_fetch_assoc(mysql_query("SELECT * FROM `user` WHERE `id` = '$post[id_user]' LIMIT 1"));
echo "Автор: <a href='/info.php?id=$ank[id]'>$ank[nick]</a><br />\n";
?>