<?

// remodified by noe
// http://nnetwork.tk
// loegue.info@gmail.com
// hargailah privasi orang

if (isset($user) && $user['id']==$ank['id']){
if (isset($_GET['act']) && $_GET['act']=='create' && isset($_GET['ok']) && isset($_POST['name']) && isset($_POST['opis']))
{
$name=esc(stripcslashes(htmlspecialchars($_POST['name'])),1);
if (isset($_POST['translit1']) && $_POST['translit1']==1)$name=translit($name);
if (strlen2($name)<3)$err='Short title, min. 3 characters';
if (strlen2($name)>32)$err='Title max. 32 characters';
$name=my_esc($name);

$msg=$_POST['opis'];
if (isset($_POST['translit2']) && $_POST['translit2']==1)$msg=translit($msg);
//if (strlen2($msg)<10)$err='Short title';
if (strlen2($msg)>256)$err='The lenght of the description exceeds the limit of 256 characters';
$msg=my_esc($msg);


if (mysql_result(mysql_query("SELECT COUNT(*) FROM `gallery` WHERE `id_user` = '$ank[id]' AND `name` = '$name'"),0)!=0)
$err='The album with the same name already exists';



if (!isset($err))
{
mysql_query("INSERT INTO `gallery` (`opis`, `time_create`, `id_user`, `name`, `time`) values('$msg', '$time', '$ank[id]', '$name', '$time')");
msg('Photo Albums successfully created');
}
}
}

?>
