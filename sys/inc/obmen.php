<?

function obmen_path($path)
{
$path=ereg_replace("(/){1,}","/",$path);
$path=ereg_replace("(^(/){1,})|((/){1,}$)","",$path);
$path_arr=explode('/',$path);
$rdir=NULL;
$rudir=NULL;
for ($i=0;$i<count($path_arr);$i++)
{
$of='/';
for ($z=0;$z<=$i;$z++)$of.=$path_arr[$z].'/';
$rdir.=$path_arr[$i].'/';

$dir_id=mysql_fetch_assoc(mysql_query("SELECT * FROM `obmennik_dir` WHERE `dir` = '/$rdir' OR `dir` = '$rdir/' OR `dir` = '$rdir' LIMIT 1"));
$dirname=$dir_id['name'];
$rudir.="<a href=\"/obmen/".url(ereg_replace("(^(/){1,})|((/){1,}$)","",$rdir))."/?page=$_SESSION[page]\">".$dirname.'</a> &gt; ';

}

return ereg_replace(" &gt; $","",$rudir);

}

?>