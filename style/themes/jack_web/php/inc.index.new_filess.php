<?
echo '<table><tr><td>';
$block = new Smarty_conf();
$content=null;
$q=mysql_query("SELECT `name`, `path`, `size` FROM `loads_list` ORDER BY `time` DESC LIMIT 5");
if (mysql_num_rows($q)==0){
$block->assign('title','Tidak ada file terbaru');
echo '</td></tr>';
}

while ($post = mysql_fetch_assoc($q))
{
$i=passgen();
echo '<tr>';
$l=$post['path'];
$l=ereg_replace("\./|/\.",NULL,$l);
$l=ereg_replace("(/){1,}","/",$l);
$l=ereg_replace("(^(/){1,})|((/){1,}$)","",$l);


$dir_loads=H.'sys/loads/files/'.$l;
$dirlist[$i]=$post['name'];
if (function_exists('iconv'))$dirlist[$i]=iconv('utf-8', 'windows-1251', $dirlist[$i]);
$ras=strtolower(eregi_replace('^.*\.', NULL, $dirlist[$i]));
$name=eregi_replace('\.[^\.]*$', NULL, $dirlist[$i]);

if (is_file($dir_loads.'/'.$dirlist[$i].'.name'))
$name2=trim(esc(file_get_contents($dir_loads.'/'.$dirlist[$i].'.name')));
elseif (function_exists('iconv'))
$name2=iconv('windows-1251', 'utf-8', $name);
else $name2=$name;
$name2=htmlspecialchars($name2);
$size=$post['size'];
if ($set['set_show_icon']==2){
echo '<td>';
include H.'loads/inc/screens.php';
echo '</td>';
}
elseif ($set['set_show_icon']==1){
echo '<td>';
include H.'loads/inc/screens.php';
echo '</td>';
}
echo '<td>';
if ($set['echo_rassh']==1)$ras2=".$ras";else $ras2=NULL;
echo "<a href='/loads/?d=".urlencode("$l")."&amp;f=".urlencode("$dirlist[$i]")."'>$name2$ras2</a>\n";
echo '</td>';
echo '</tr>';
echo ' <tr>';
if ($set['set_show_icon']==1)
echo '<td>'; 
else echo '<td>';
include H.'loads/inc/opis.php';
echo '</td>';
echo '</tr>';
}
echo '</table>';

?>
