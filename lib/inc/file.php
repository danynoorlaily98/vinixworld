<?

if (file_exists($file))
{

$stat1=implode(null,gzfile($file));


if (!$set['web'])$mn=10;else $mn=30; // количество слов выводится в зависимости от браузера




$stat=explode(' ', $stat1); // деление статьи на отдельные слова

$k_page=k_page(count($stat),$set['p_str']*$mn);
$page=page($k_page);

$start=$set['p_str']*$mn*($page-1);
$stat_1=NULL;
for ($i=$start;$i<$set['p_str']*$mn*$page && $i<count($stat);$i++)
{
$stat_1.=$stat[$i].' ';
}


echo output_text($stat_1)."<br />\n"; // вывод статьи со всем форматированием

if ($k_page>1)str("?",$k_page,$page); // Вывод страниц
}
else
echo "Ошибка: файл поврежден<br />\n";
?>