<?


function rupath($path,$loads='.')
{
$path=ereg_replace("(/){1,}","/",$path);
$path=ereg_replace("(^(/){1,})|((/){1,}$)","",$path);
$path_arr=explode('/',$path);
$rdir=NULL;
$rudir=NULL;
for ($i=0;$i<count($path_arr);$i++)
{
$of=$loads.'/';
for ($z=0;$z<=$i;$z++)$of.=$path_arr[$z].'/';
$rdir.=$path_arr[$i].'/';
if (is_file("$of/.dirname"))
{
$rudir.="<a href=\"index.php?d=".urlencode(ereg_replace("(^(/){1,})|((/){1,}$)","",$rdir))."&amp;page=$_SESSION[page]\">".trim(file_get_contents("$of/.dirname")).'</a> &gt; ';
}
else
{
$rudir.="<a href=\"index.php?d=".urlencode(ereg_replace("(^(/){1,})|((/){1,}$)","",$rdir))."&amp;page=$_SESSION[page]\">".dir_name($loads.'/'.$rdir).'</a> &gt; ';
}
}
return ereg_replace(" &gt; $","",$rudir);
}

function rupath2($path,$loads='.')
{
$path=ereg_replace("(/){1,}","/",$path);
$path=ereg_replace("(^(/){1,})|((/){1,}$)","",$path);
$path_arr=explode('/',$path);
$rdir=NULL;
$rudir=NULL;
for ($i=0;$i<count($path_arr);$i++)
{
$of=$loads.'/';
for ($z=0;$z<=$i;$z++)$of.=$path_arr[$z].'/';
$rdir.=$path_arr[$i].'/';
if (is_file("$of/.dirname"))
{
$dir_info=file("$of/.dirname");

$rudir.=trim($dir_info[0]).'/';
}
else
{
$dirname=$path_arr[$i];
if (function_exists('iconv'))$dirname=iconv('windows-1251', 'utf-8', $dirname);
$rudir.=$dirname.'/';
}
}
return ereg_replace("/$","",$rudir);
}

// вывод списка директорий для option
function dirrs($dir='/',$replace=NULL){
$dir=ereg_replace("(/){1,}","/",$dir);              // вырез двух и более слешей подряд
$dir=ereg_replace("(^(/){1,})|((/){1,}$)","",$dir); // вырез слеша в начале и конце
$od=opendir($dir);
while ($rd=readdir($od))
{
if (is_dir("$dir/$rd") && $rd!='.' && $rd!='..')
{
$pathh=str_replace($replace, '', "$dir/$rd");
echo "<option value=\"".urlencode("$dir/$rd")."\">".rupath2($pathh,'../sys/loads/files')."</option>\n";
dirrs("$dir/$rd",$replace);
}
}
}

// счетчик скачиваний
function k_loads($file,$size)
{
global $l;
$path=(function_exists('iconv'))?iconv('windows-1251', 'utf-8', $l):$l;
$path='/'.eregi_replace('^/+|/+$', null, $path).'/';
if (function_exists('iconv'))$file=iconv('windows-1251', 'utf-8', $file);
$loads=mysql_fetch_assoc(mysql_query("SELECT * FROM `loads_list` WHERE `name` = '$file' AND `size` = '$size' AND `path` = '".my_esc($path)."' LIMIT 1"));
if ($loads==NULL)return 0;
else return $loads['loads'];
}



function loads_rename($dir)
{
$dir=str_replace("//", "/", $dir);
$od=opendir("$dir/$rd");
while ($rd=readdir($od))
{
if (is_dir("$dir/$rd") && $rd!='.' && $rd!='..')
{
loads_rename("$dir/$rd");
}
elseif (is_file("$dir/$rd") && ereg('^!',$rd))
{
$rd2=translit(ereg_replace('^!|\.[^\.]*$',NULL,$rd));
file_put_contents("$dir/$rd.name",$rd2);
rename("$dir/$rd", ereg_replace('^!',NULL,$rd));
}

}
$dir1=ereg_replace('^.*/', NULL, $dir);
if (ereg('^!',$dir1))
{
file_put_contents("$dir/.dirname",translit(ereg_replace('^!',NULL,$dir1)));
rename($dir, str_replace('!',NULL,$dir));
}
}


function k_komm($file,$size)
{
if (function_exists('iconv'))$file=iconv('windows-1251', 'utf-8', $file);
return mysql_result(mysql_query("SELECT COUNT(*) FROM `loads_komm` WHERE `file` = '$file' AND `size` = '$size'"),0);
}



function dir_name($dir)
{

$dir=ereg_replace("(/){1,}","/",$dir);
$dir=ereg_replace("(^(/){1,})|((/){1,}$)","",$dir);

if (is_dir($dir))
{

if (is_file($dir.'/.dirname') && filesize($dir.'/.dirname')>0)
{
return esc(stripcslashes(htmlspecialchars(file_get_contents($dir.'/.dirname'))));
}
else
{


$dirname= ereg_replace('^.*/', NULL, $dir);
$dirname=esc(stripcslashes(htmlspecialchars($dirname)));
if (function_exists('iconv'))$dirname=iconv('windows-1251', 'utf-8', $dirname);

return $dirname;
}
}
}


function loads_del_screen()
{
$dir=H.'sys/loads/screens/48';
$od=opendir($dir);
while ($rd=readdir($od))
{
if (is_file("$dir/$rd") && $rd!='.' && $rd!='..')
{
@chmod("$dir/$rd",0777);
@unlink("$dir/$rd");
}
}
$dir=H.'sys/loads/screens/128';
$od=opendir($dir);
while ($rd=readdir($od))
{
if (is_file("$dir/$rd") && $rd!='.' && $rd!='..')
{
@chmod("$dir/$rd",0777);
@unlink("$dir/$rd");
}
}

$dir=H.'sys/loads/screens/14';
$od=opendir($dir);
while ($rd=readdir($od))
{
if (is_file("$dir/$rd") && $rd!='.' && $rd!='..')
{
@chmod("$dir/$rd",0777);
@unlink("$dir/$rd");
}
}

}



?>