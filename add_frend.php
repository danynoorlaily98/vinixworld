<?

// Translated by : zanger
// Site : http://www.frendzmobile.co.cc

include_once 'sys/inc/start.php';
include_once 'sys/inc/compress.php';
include_once 'sys/inc/sess.php';
include_once 'sys/inc/home.php';
include_once 'sys/inc/settings.php';
include_once 'sys/inc/db_connect.php';
include_once 'sys/inc/ipua.php';
include_once 'sys/inc/fnc.php';
include_once 'sys/inc/user.php';
include_once 'sys/inc/thead.php';
only_reg();

if (!isset($_GET['id'])){header("Location: index.php?1".SID);exit;}
$ank['id']=intval($_GET['id']);
if (mysql_result(mysql_query("SELECT COUNT(*) FROM `user` WHERE `id` = '$ank[id]' LIMIT 1"),0)==0){header("Location: index.php?".SID);exit;}
if (mysql_result(mysql_query("SELECT COUNT(*) FROM `frends` WHERE (`user` = '$user[id]' AND `frend` = '$ank[id]') OR (`user` = '$ank[id]' AND `frend` = '$user[id]') LIMIT 1"),0)==1){header("Location: index.php?".SID);exit;}
if (mysql_result(mysql_query("SELECT COUNT(*) FROM `frends_new` WHERE (`user` = '$user[id]' AND `to` = '$ank[id]') OR (`user` = '$ank[id]' AND `to` = '$user[id]') LIMIT 1"),0)==1){header("Location: index.php?".SID);exit;}

if ($ank['id']==$user['id']){header("Location: index.php?".SID);exit;}

mysql_query("INSERT INTO `frends_new` (`user`, `to`, `time`) values('$user[id]', '$ank[id]', '$time')");
mysql_query("OPTIMIZE TABLE `frends_new`");
header("Location: frend.php?add".SID);
exit;

?>
