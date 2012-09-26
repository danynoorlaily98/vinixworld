<?


if (user_access('lib_dir_delete') && isset($_GET['act']) && $_GET['act']=='delete' && isset($_GET['ok']) && $l!='/')
{

$q=mysql_query("SELECT * FROM `lib_dir` WHERE `dir_osn` like '$l/%'");
while ($post = mysql_fetch_assoc($q))
{

$q2=mysql_query("SELECT * FROM `lib_files` WHERE `id_dir` = '$post[id]'");
while ($post2 = mysql_fetch_assoc($q2))
{
unlink(H.'sys/lib/stats/'.$post2['id'].'.txt.gz');
}


mysql_query("DELETE FROM `lib_files` WHERE `id_dir` = '$post[id]'");
mysql_query("DELETE FROM `lib_dir` WHERE `id` = '$post[id]' LIMIT 1");
}
$q2=mysql_query("SELECT * FROM `lib_files` WHERE `id_dir` = '$dir_id[id]'");
while ($post4 = mysql_fetch_assoc($q2))
{
unlink(H.'sys/lib/stats/'.$post4['id'].'.txt.gz');
}
mysql_query("DELETE FROM `lib_files` WHERE `id_dir` = '$dir_id[id]'");
mysql_query("DELETE FROM `lib_dir` WHERE `id` = '$dir_id[id]' LIMIT 1");
$l=$dir_id['dir_osn'];
admin_log('Библиотека','Удаление',"Удалена папка $dir_id[name]");
msg('Папка успешно удалена');
$dir_id=mysql_fetch_assoc(mysql_query("SELECT * FROM `lib_dir` WHERE `dir` = '/$l' OR `dir` = '$l/' OR `dir` = '$l' LIMIT 1"));
$id_dir=$dir_id['id'];

}



if (user_access('lib_dir_mesto') && isset($_GET['act']) && $_GET['act']=='mesto' && isset($_GET['ok']) && isset($_POST['new_dir']) && $l!='/')
{
if ($_POST['new_dir']==NULL)
$err[]= "Не выбран коненый путь";
else
{
$l_old=$l;
$dir_arr=explode('/', $_POST['new_dir']);
$l='/';
for ($i=1;$i<count($dir_arr)-1;$i++)$l.=$dir_arr[$i].'/';
$l.=tr_loads(retranslit($dir_id['name']));


$q=mysql_query("SELECT * FROM `lib_dir` WHERE `dir_osn` LIKE '$l_old/%'");
while ($post = mysql_fetch_assoc($q))
{
$new_dir_osn=ereg_replace('^'.$l_old.'/',$l.'/',$post['dir_osn']);
$new_dir=ereg_replace('^'.$l_old.'/',$l.'/',$post['dir']);
mysql_query("UPDATE `lib_dir` SET `dir`='$new_dir', `dir_osn`='$new_dir_osn' WHERE `id` = '$post[id]' LIMIT 1");
}

mysql_query("UPDATE `lib_dir` SET `dir`='$l/', `dir_osn` = '".$_POST['new_dir']."' WHERE `id` = '$id_dir' LIMIT 1");
admin_log('Библиотека','Перемещение',"Перемещена папка $dir_id[name]");
msg('Папка успешно перемещена');
}
}


if (user_access('lib_dir_edit') && isset($_GET['act']) && $_GET['act']=='rename' && isset($_GET['ok']) && isset($_POST['name']) && $l!=NULL)
{
$name=preg_replace('#[^A-zА-я0-9\(\)\-\ ]#ui', null, $_POST['name']);

if ($name==NULL)$err[]="Название пусто или содержит запрещенные символы";
else
{
if (!isset($err)){
$l_old=$l;
$dir_arr=explode('/', $l);
$l='/';
for ($i=1;$i<count($dir_arr)-1;$i++)$l.=$dir_arr[$i].'/';
$l.=tr_loads(retranslit($name));

$q=mysql_query("SELECT * FROM `lib_dir` WHERE `dir_osn` LIKE '$l_old/%'");
while($list_dir=mysql_fetch_assoc($q))
{
$new_dir_osn=ereg_replace('^'.$l_old.'/',$l.'/',$list_dir['dir_osn']);
$new_dir=ereg_replace('^'.$l_old.'/',$l.'/',$list_dir['dir']);
mysql_query("UPDATE `lib_dir` SET `dir`='$new_dir', `dir_osn` = '$new_dir_osn' WHERE `id` = '$list_dir[id]' LIMIT 1");
}

mysql_query("UPDATE `lib_dir` SET `name`='$name', `dir`='$l/' WHERE `id` = '$id_dir' LIMIT 1");
admin_log('Библиотека','Изменение',"Переименована папка $dir_id[name] в $name");
msg('Папка успешно переименована');
$dir_id['name']=$name;
$dir_id['dir']=$l.'/';
}


}
}


if (user_access('lib_dir_create') && isset($_GET['act']) && $_GET['act']=='mkdir' && isset($_GET['ok']) && isset($_POST['name']))
{
$name=preg_replace('#[^A-zА-я0-9\(\)\-\ ]#ui', null, $_POST['name']);
if ($name==NULL)$err[]= "Введите название папки";
else
{
$newdir=tr_loads(retranslit($name));

if (mysql_result(mysql_query("SELECT COUNT(*) FROM `lib_dir` WHERE `dir` = '$l$newdir/'"),0)!=0)$err[]='Папка уже существует';

if (!isset($err) && $newdir!=NULL){
if ($l!='/')$l.='/';
mysql_query("INSERT INTO `lib_dir` (`name` , `dir` , `dir_osn`) VALUES ('$name',  '$l$newdir/', '$l')");
msg("Папка \"$name\" успешно создана");
admin_log('Библиотека','Создание папки',"Создана папка '$name'");
}
}
}




?>