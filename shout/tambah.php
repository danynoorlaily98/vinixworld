<?php

// remodified by noe
// http://nnetwork.tk
// loegue.info@gmail.com
// hargailah privasi orang

include_once '../sys/inc/start.php';
include_once '../sys/inc/compress.php';
include_once '../sys/inc/sess.php';
include_once '../sys/inc/home.php';
include_once '../sys/inc/settings.php';
include_once '../sys/inc/db_connect.php';
include_once '../sys/inc/ipua.php';
include_once '../sys/inc/fnc.php';
include_once '../sys/inc/user.php';
if (isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER']!=NULL){
$balek=$_SERVER['HTTP_REFERER'];
} elseif (ereg("&pass=", $_SERVER['HTTP_REFERER'])){
$balek='/';
} else { $balek='/';
}
if (isset($_POST['msg']) && isset($user))
{
$msg=$_POST['msg'];
if (isset($_POST['translit']) && $_POST['translit']==1)$msg=translit($msg);
if (strlen2($msg)>500){header ("Location: /stayup.php");}
elseif (strlen2($msg)<2){header ("Location: /stayup.php");}

elseif (mysql_result(mysql_query("SELECT COUNT(*) FROM `shout` WHERE `id_user` = '$user[id]' AND `msg` = '".mysql_real_escape_string($msg)."' LIMIT 1"),0)!=0){header ("Location: /stayup.php");}

else{
$msg=mysql_real_escape_string($msg);

mysql_query("INSERT INTO `shout` (id_user, time, msg) values('$user[id]', '$time', '$msg')");
mysql_query("UPDATE `user` SET `balls` = '".($user['balls']+1)."' WHERE `id` = '$user[id]' LIMIT 1");
header ("Location: /stayup.php");}
}
?>
