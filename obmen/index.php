<?
include_once '../sys/inc/start.php';
if (isset($_GET['showinfo']) || !isset($_GET['f']) || isset($_GET['komm']))
include_once '../sys/inc/compress.php';
include_once '../sys/inc/sess.php';
include_once '../sys/inc/home.php';
include_once '../sys/inc/settings.php';
include_once '../sys/inc/db_connect.php';
include_once '../sys/inc/ipua.php';
include_once '../sys/inc/fnc.php';
include_once '../sys/inc/obmen.php';
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
$dir_id['upload']=0;
$id_dir=0;
$l='/';
}

elseif (mysql_result(mysql_query("SELECT COUNT(*) FROM `obmennik_dir` WHERE `dir` = '/$l' OR `dir` = '$l/' OR `dir` = '$l' LIMIT 1"),0)!=0)
{
$dir_id=mysql_fetch_assoc(mysql_query("SELECT * FROM `obmennik_dir` WHERE `dir` = '/$l' OR `dir` = '$l/' OR `dir` = '$l' LIMIT 1"));
$id_dir=$dir_id['id'];
}
else
{
$dir_id['upload']=0;
$id_dir=0;
$l='/';
}


if (isset($_GET['f']))
{
$f=esc(urldecode($_GET['f']));
$name=eregi_replace('\.[^\.]*$', NULL, $f); // имя файла без расширения
$ras=strtolower(eregi_replace('^.*\.', NULL, $f));


$ras=str_replace('jad', 'jar', $ras);

if (mysql_result(mysql_query("SELECT COUNT(*) FROM `obmennik_files` WHERE `id_dir` = '$id_dir' AND `name`='$name' AND `ras` = '$ras' LIMIT 1"),0)!=0)
{
$file_id=mysql_fetch_assoc(mysql_query("SELECT * FROM `obmennik_files` WHERE `id_dir` = '$id_dir' AND `name`='$name' AND `ras` = '$ras' LIMIT 1"));


$ras=$file_id['ras'];
$file=H."sys/obmen/files/$file_id[id].dat";
$name=$file_id['name'];
$size=$file_id['size'];

if (!isset($_GET['showinfo']) && !isset($_GET['komm']) && is_file(H.'sys/obmen/files/'.$file_id['id'].'.dat'))
{





if ($ras=='jar' && strtolower(eregi_replace('^.*\.', NULL, $f))=='jad')
{


include_once H.'sys/inc/zip.php';
$zip=new PclZip(H.'sys/obmen/files/'.$file_id['id'].'.dat');
$content = $zip->extract(PCLZIP_OPT_BY_NAME, "META-INF/MANIFEST.MF" ,PCLZIP_OPT_EXTRACT_AS_STRING);
$jad=eregi_replace("(MIDlet-Jar-URL:( )*[^(\n|\r)]*)", NULL, $content[0]['content']);
$jad=eregi_replace("(MIDlet-Jar-Size:( )*[^(\n|\r)]*)(\n|\r)", NULL, $jad);
$jad=trim($jad);
$jad.="\r\nMIDlet-Jar-Size: ".filesize(H.'sys/obmen/files/'.$file_id['id'].'.dat')."";
$jad.="\r\nMIDlet-Jar-URL: /obmen$dir_id[dir]$file_id[name].$file_id[ras]";
$jad=br($jad,"\r\n");
header('Content-Type: text/vnd.sun.j2me.app-descriptor');
header('Content-Disposition: attachment; filename="'.$file_id['name'].'.jad";');
echo $jad;
exit;



}



@mysql_query("UPDATE `obmennik_files` SET `k_loads` = '".($file_id['k_loads']+1)."' WHERE `id` = '$file_id[id]' LIMIT 1");
include_once '../sys/inc/downloadfile.php';
DownloadFile(H.'sys/obmen/files/'.$file_id['id'].'.dat', $name.'.'.$ras, ras_to_mime($ras));
/*
header("Content-type: $file_id[type]");
header("Content-Disposition: attachment; filename=$name.$ras");
header("Accept-Ranges: bytes");
header("Content-length: $file_id[size]");
echo file_get_contents(H.'sys/obmen/files/'.$file_id['id'].'.dat');
*/
exit;
}
elseif(isset($_GET['komm']) && is_file(H.'sys/obmen/files/'.$file_id['id'].'.dat'))
{
$set['title']='Archivos Compartidos - Comentarios - '.$file_id['name']; // заголовок страницы
$_SESSION['page']=1;
include_once '../sys/inc/thead.php';
title();

include_once 'inc/komm_act.php'; // действия с комментариями
include_once 'inc/komm.php';
echo "<div class='foot'>";
echo "&raquo;<a href='/obmen$dir_id[dir]".urlencode($file_id['name']).".$file_id[ras]?showinfo'>Descripcion</a><br />\n";
echo "&laquo;<a href='/obmen$dir_id[dir]'>En la Carpeta</a><br />\n";
echo "</div>\n";
include_once '../sys/inc/tfoot.php';
exit;
}
else
{
$set['title']='Archivos Compartidos - '.$file_id['name']; // заголовок страницы
include_once '../sys/inc/thead.php';
title();

include 'inc/file_act.php';
err();
aut(); // форма авторизации

if(is_file("inc/file/$ras.php"))include "inc/file/$ras.php";
else
include_once 'inc/file.php';


echo "<div class='foot'>";
if ($file_id['ras']=='jar')
echo "&raquo;<a href='/obmen$dir_id[dir]".urlencode($file_id['name']).".jad'>Descargar</a> <a href='/obmen$dir_id[dir]".urlencode($file_id['name']).".$file_id[ras]'>JAR</a> ($file_id[k_loads])<br />\n";
else
echo "&raquo;<a href='/obmen$dir_id[dir]".urlencode($file_id['name']).".$file_id[ras]'>Descargar</a> ($file_id[k_loads])<br />\n";

echo "<input type='text' value='http://$_SERVER[SERVER_NAME]/obmen$dir_id[dir]".urlencode($file_id['name']).".$file_id[ras]' /><br />\n";
echo "&raquo;<a href='/obmen$dir_id[dir]".urlencode($file_id['name']).".$file_id[ras]?komm'>Comentarios</a> (".mysql_result(mysql_query("SELECT COUNT(*) FROM `obmennik_komm` WHERE `id_file` = '$file_id[id]'"), 0).")<br />\n";
echo "&laquo;<a href='/obmen$dir_id[dir]'>En la carpeta</a><br />\n";
echo "</div>\n";


include 'inc/file_form.php';
include_once '../sys/inc/tfoot.php';
}
}
}





include_once 'inc/dir.php';




include_once '../sys/inc/tfoot.php';
?>