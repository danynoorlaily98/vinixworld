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

only_reg();
$set['title']='Update Status';
include_once '../sys/inc/thead.php';
//aut();


if (isset($_POST['msg']) && isset($user))
{
$msg=$_POST['msg'];
if (isset($_POST['translit']) && $_POST['translit']==1)$msg=translit($msg);
if (strlen2($msg)>5000){$err='Pesan terlalu panjang, max 5000 karakter';}
elseif (strlen2($msg)<2){$err='Pesan terlalu pendek';}
elseif(mysql_result(mysql_query("SELECT COUNT(*) FROM `statuse_list` WHERE `id_user` = '$user[id]' AND `msg` = '".mysql_real_escape_string($msg)."' AND `time` > '".($time - 900)."' LIMIT 1"), 0)!= 0){$err='';}
else{
$msg=mysql_real_escape_string($msg);
mysql_query("INSERT INTO `statuse_list` (`id_user`, `name`, `msg`, `time`, `privat`) values('$user[id]', '$name', '$msg', '$time', '$privat')");
mysql_query("UPDATE `user` SET `balls` = '".($user['balls']+1)."' WHERE `id` = '$user[id]' LIMIT 1");

msg('<b>Status Anda telah diperbarui</b>');
}
}
err();

echo "<div id=\"body\" class=\"kolom\"><form method=\"post\" id=\"composer_form\" name=\"message\" action=\"?\"><table class=\"comboInput\" cellpadding=\"0\" cellspacing=\"0\"><tbody><tr><td class=\"inputCell\"><textarea class=\"input composerInput\" name=\"msg\" rows=\"2\" cols=\"13\"></textarea></td><td><input value=\"Bagikan\" class=\"btn btnC\" type=\"submit\"><a href='/smiles/'>Smile</a><br/><a href='/bb-code.php'>bb-code</a></td></tr></tbody></table></div></form></div>";


echo"<div class='acw apm'>\n";
echo"<a href='saya.php'>Lihat Status Saya </a><br />\n";
echo"</div>\n";

include_once '../sys/inc/tfoot.php';

?>
