<?
if (user_access('lib_stat_zip') && isset($_GET['act']) && $_GET['act']=='upload_zip' && isset($_GET['ok']) && isset($_FILES['file']) && @eregi('\.zip$',$_FILES['file']['name']))
{
$k_new_dir=0;
$k_new_st=0;
if (function_exists('set_time_limit'))@set_time_limit(600);
include_once H.'/sys/inc/zip.php';
$zip = new PclZip($_FILES['file']['tmp_name']);
$list = $zip->listContent(); // содержание архива



$dirs=null;
for ($i=0; $i<sizeof($list); $i++)
{
if ($list[$i]['folder']==1)
{
$dirs[]=(function_exists('iconv'))?@iconv('cp866', 'utf-8', $list[$i]['filename']):$list[$i]['filename'];
}
elseif (eregi('\.txt$',$list[$i]['filename']))
{
$files_id[]=$list[$i]['index'];
$files[]=(function_exists('iconv'))?@iconv('cp866', 'utf-8', $list[$i]['filename']):$list[$i]['filename'];
}
}


for ($i=0;$i<sizeof($dirs);$i++)
{
$dir=ereg_replace('/+','/','/'.$dirs[$i].'/');
$dir_arr=explode('/', $dir);
$path_osn=$l.'/';
for ($id=1;$id<count($dir_arr)-1;$id++)
{
$dirname=preg_replace('#[^A-zА-я0-9\(\)\-\_\ \.\?]#ui', null, $dir_arr[$id]);
$path_dir=$path_osn.tr_loads(retranslit($dir_arr[$id])).'/';

if (mysql_result(mysql_query("SELECT COUNT(*) FROM `lib_dir` WHERE `dir` = '$path_dir' AND `dir_osn` = '$path_osn'"),0)==0)
{
mysql_query("INSERT INTO `lib_dir` (`name` , `dir` , `dir_osn` ) VALUES ('$dirname',  '$path_dir', '$path_osn')");
$k_new_dir++;
}

$path_osn=$path_dir;
}

}



for ($i=0;$i<sizeof($files);$i++)
{
$file=ereg_replace(".*/",NULL,urldecode($files[$i])); // получение имени файла
$name=eregi_replace('\.[^\.]*$', NULL, $file); // имя файла без расширения

$dir=ereg_replace('/+','/','/'.$files[$i]);
$dir_arr=explode('/', $dir);

$path_dir=$l.'/';
for ($id=1;$id<count($dir_arr)-1;$id++)
{
$path_dir=$path_dir.tr_loads(retranslit($dir_arr[$id])).'/';
}



if (mysql_result(mysql_query("SELECT COUNT(*) FROM `lib_dir` WHERE `dir` = '$path_dir' LIMIT 1"),0)!=0)
{
$dir_id2=mysql_fetch_assoc(mysql_query("SELECT * FROM `lib_dir` WHERE `dir` = '$path_dir' LIMIT 1"));

$list = $zip->extract(PCLZIP_OPT_BY_INDEX, $files_id[$i],PCLZIP_OPT_EXTRACT_AS_STRING);

$text=$list[0]['content'];
if (function_exists('iconv') && isset($_POST['charset']))
$text=@iconv($_POST['charset'], 'utf-8', $text);


if (isset($_POST['name_of']) && $_POST['name_of']=='string')
{
$name_1=split("(\n|\r)+", $text);
if ($name_1[0]!=NULL)$name=$name_1[0];
elseif($name_1[1]!=NULL)$name=$name_1[1];
}
$name=preg_replace('#[^A-zА-я0-9\(\)\-\_\ ]#ui', null, $name);


mysql_query("INSERT INTO `lib_files` (`id_dir`, `name`, `time`, `time_last`, `id_user`)
VALUES ('$dir_id2[id]', '$name', '$time', '$time', '$user[id]')");
$stat_id=mysql_insert_id();
if (!@file_put_contents(H."sys/lib/stats/$stat_id.txt.gz", gzencode($text,9)))
{
mysql_query("DELETE FROM `lib_files` WHERE `id` = '$stat_id'");
$err[]='Невозможно сохранить статью';
}
else
{
$k_new_st++;
}

}
}


admin_log('Библиотека','Создание статей',"Выгружен ZIP-архив $k_new_dir папок, $k_new_st статей");

if ($k_new_dir!=0)msg("Успешно создано $k_new_dir папок");
if ($k_new_st!=0)msg("Успешно выгружено $k_new_st статей");
}





if (user_access('lib_stat_txt') && isset($_GET['act']) && $_GET['act']=='upload_txt' && isset($_GET['ok']) && isset($_FILES['file']))
{
$file=preg_replace('#[^A-zА-я0-9\(\)\-\_\ \.]#ui', null, $_FILES['file']['name']);

$name=eregi_replace('\.[^\.]*$', NULL, $file); // имя файла без расширения
$ras=strtolower(eregi_replace('^.*\.', NULL, $file));


$text=file_get_contents($_FILES['file']['tmp_name']);


if (function_exists('iconv') && isset($_POST['charset']))$text=@iconv($_POST['charset'], 'utf-8', $text);



if ($name==NULL)$err='Название файла пусто или состоит из запрещенных символов';
elseif (!eregi('^txt$',$ras))$err='Неверный формат файла';
elseif (mysql_result(mysql_query("SELECT COUNT(*) FROM `lib_files` WHERE `id_dir` = '$id_dir' AND `name` = '$name'"), 0)!=0)$err='Статья с таким названием уже есть в этой папке';
elseif ($text==NULL)$err='Текст статьи пуст';
else
{

mysql_query("INSERT INTO `lib_files` (`id_dir`, `name`, `time`, `time_last`, `id_user`)
VALUES ('$dir_id[id]', '$name', '$time', '$time', '$user[id]')");
$stat_id=mysql_insert_id();
if (!@file_put_contents(H."sys/lib/stats/$stat_id.txt.gz", gzencode($text,9)))
{
mysql_query("DELETE FROM `lib_files` WHERE `id` = '$stat_id'");
$err='Нет прав на запись (sys/lib/stats/)';

}
else
{
admin_log('Библиотека','Создание статей',"Добавление статьи (txt) '$name'");
msg('Статья успешно добавлена');
}


}



}





if (user_access('lib_stat_create') && isset($_GET['act']) && $_GET['act']=='create_stat' && isset($_GET['ok']) && isset($_POST['name']) && isset($_POST['text']))
{
$name=preg_replace('#[^A-zА-я0-9\(\)\-\_\ ]#ui', null, $_POST['name']);

$text=trim($_POST['text']);




if ($name==NULL)$err[]='Введите название статьи';
elseif (mysql_result(mysql_query("SELECT COUNT(*) FROM `lib_files` WHERE `id_dir` = '$id_dir' AND `name` = '$name'"), 0)!=0)$err[]='Статья с таким названием уже есть в этой папке';
elseif ($text==NULL)$err[]='Текст статьи пуст';
else
{

mysql_query("INSERT INTO `lib_files` (`id_dir`, `name`, `time`, `time_last`, `id_user`)
VALUES ('$dir_id[id]', '$name', '$time', '$time', '$user[id]')");
$stat_id=mysql_insert_id();
if (!@file_put_contents(H."sys/lib/stats/$stat_id.txt.gz", gzencode($text,9)))
{
mysql_query("DELETE FROM `lib_files` WHERE `id` = '$stat_id'");
$err[]='Нет прав на запись (sys/lib/stats/)';

}
else 
{
admin_log('Библиотека','Создание статей',"Добавление статьи (создание) '$name'");
msg('Статья успешно добавлена');
}

}
}



?>