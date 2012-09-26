<?

// remodified by noe
// http://nnetwork.tk
// loegue.info@gmail.com
// hargailah privasi orang

include_once '../sys/inc/start.php';
if (!isset($_GET['save']))
include_once '../sys/inc/compress.php';
include_once '../sys/inc/sess.php';
include_once '../sys/inc/home.php';
include_once '../sys/inc/settings.php';
include_once '../sys/inc/db_connect.php';
include_once '../sys/inc/ipua.php';
include_once '../sys/inc/fnc.php';
include_once '../sys/inc/user.php';
if (isset($_GET['d']) && esc($_GET['d'])!=NULL)
{
$l=ereg_replace("\.{2,}",NULL,esc(urldecode($_GET['d'])));
$l=ereg_replace("\./|/\.",NULL,$l);
$l=ereg_replace("(/){1,}","/",$l);
$l='/'.ereg_replace("(^(/){1,})|((/){1,}$)","",$l);
}
else
{
$l='/';
}

if ($l=='/')
{
$dir_id['dir']='/';
$id_dir=0;
}
elseif (mysql_result(mysql_query("SELECT COUNT(*) FROM `lib_dir` WHERE `dir` = '/$l' OR `dir` = '$l/' OR `dir` = '$l' LIMIT 1"),0)!=0)
{
$dir_id=mysql_fetch_assoc(mysql_query("SELECT * FROM `lib_dir` WHERE `dir` = '/$l' OR `dir` = '$l/' OR `dir` = '$l' LIMIT 1"));
$id_dir=$dir_id['id'];
}
else
{
$id_dir=0;
$l='/';
}


if (isset($_GET['f']))
{
$name=esc(urldecode($_GET['f']));
$ras='txt';
if (mysql_result(mysql_query("SELECT COUNT(*) FROM `lib_files` WHERE `id_dir` = '$id_dir' AND `name`='$name' LIMIT 1"),0)!=0)
{
$file_id=mysql_fetch_assoc(mysql_query("SELECT * FROM `lib_files` WHERE `id_dir` = '$id_dir' AND `name`='$name' LIMIT 1"));

$file=H."sys/lib/stats/$file_id[id].txt.gz";
$name=$file_id['name'];
$size=$file_id['size'];









if (isset($_GET['save']) && ($_GET['save']=='jar' || $_GET['save']=='jad'))
{
include_once H.'sys/inc/zip.php';
$book = new PclZip('inc/book.jar');
$book_new = new PclZip(H."sys/tmp/$sess.jar");
@mkdir(H."sys/tmp/$sess", 0777);
$list = $book->extract(PCLZIP_OPT_PATH, H."sys/tmp/$sess",PCLZIP_OPT_SET_CHMOD, 0777);

$f=fopen(H.'sys/tmp/'.$sess.'/textfile.txt', 'w');
fwrite($f, @iconv('utf-8', 'windows-1251', implode(null,gzfile($file))));
fclose($f);

$ini="bgcolor=16777215
fgcolor=0
blint=100
wrap=-1
il=0
mgleft=0
mgtop=0
mgright=0
mgbottom=0
sbpos=0
deffont=0
hasdirbuttons=true
spareline=true
ascr=3000
J/textfile.txt.label=".str_replace(' ','_',retranslit($name))."
";
$f=fopen(H.'sys/tmp/'.$sess.'/props.ini', 'w');
fwrite($f, @iconv('utf-8', 'utf-16', $ini));
fclose($f);





$f=fopen(H.'sys/tmp/'.$sess.'/META-INF/MANIFEST.MF', 'w');
$mf="Manifest-Version: 1.0\r\n";
$mf.="MicroEdition-Configuration: CLDC-1.0\r\n";
$mf.="MicroEdition-Profile: MIDP-1.0\r\n";
$mf.="MIDlet-Name: ".retranslit($name)."\r\n";
$mf.="MIDlet-Icon: icon.png\r\n";
$mf.="Created-By: DCMS v6\r\n";
$mf.="MIDlet-Vendor: DCMS v6\r\n";
$mf.="MIDlet-1: ".retranslit($name).",icon.png,br.BookReader\r\n";
$mf.="MIDlet-Version: 1.6.10\r\n";
$mf.="MIDlet-Info-URL: http://".$_SERVER['HTTP_HOST']."/lib$dir_id[dir]$name.htm\r\n";

fwrite($f, $mf);
fclose($f);

$book_new->add(H."sys/tmp/$sess",PCLZIP_OPT_REMOVE_PATH,H."sys/tmp/$sess");

if ($_GET['save']=='jad')
{

$mf.="MIDlet-Jar-Size: ".filesize(H.'sys/tmp/'.$sess.'.jar')."\r\n";
$mf.="MIDlet-Jar-URL: http://".$_SERVER['HTTP_HOST']."/lib$dir_id[dir]$name.jar\r\n";
header("Content-type: text/vnd.sun.j2me.app-descriptor");
header("Content-Disposition: filename=".retranslit($name).".jad");
header("Accept-Ranges: bytes");
header("Content-length: ".strlen($mf)."");
echo $mf;
}
if ($_GET['save']=='jar')
{
include_once '../sys/inc/downloadfile.php';
DownloadFile(H.'sys/tmp/'.$sess.'.jar', retranslit($name).'.jar', 'application/java-archive');
}
@delete_dir(H."sys/tmp/$sess");
@unlink(H.'sys/tmp/'.$sess.'.jar');
exit;

}
elseif (isset($_GET['save']) && $_GET['save']=='txt')
{
file_put_contents(H."sys/tmp/$sess.txt", implode(null,gzfile($file)));
include_once '../sys/inc/downloadfile.php';
DownloadFile(H."sys/tmp/$sess.txt", $name.'.txt', 'text/plain;charset=utf-8');

unlink(H."sys/tmp/$sess.txt");
exit;
}
else
{

$set['title']='Library - '.$file_id['name']; // заголовок страницы
$_SESSION['page']=1;
include_once '../sys/inc/thead.php';
title();

include 'inc/file_act.php';
err();
aut(); // форма авторизации


include_once 'inc/file.php';


echo "<div class='foot'>";

echo "&raquo;<a href='/lib$dir_id[dir]$file_id[name].jar'>Download Java</a> (<a href='/lib$dir_id[dir]$file_id[name].jad'>jad</a>)<br />\n";
echo "&raquo;<a href='/lib$dir_id[dir]$file_id[name].txt'>Download $file_id[name].txt</a><br />\n";
echo "&laquo;<a href='/lib$dir_id[dir]'>Back</a><br />\n";
echo "</div>\n";


include 'inc/file_form.php';
include_once '../sys/inc/tfoot.php';
}
}
}





include_once 'inc/dir.php';




include_once '../sys/inc/tfoot.php';
?>
