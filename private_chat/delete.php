<?

////////////////////////////////////////////////
//////   WIZART    ///////
////////////////////////////////////////////////
include_once '../sys/inc/start.php';
include_once '../sys/inc/compress.php';
include_once '../sys/inc/sess.php';
include_once '../sys/inc/home.php';
include_once '../sys/inc/settings.php';
include_once '../sys/inc/db_connect.php';
include_once '../sys/inc/ipua.php';
include_once '../sys/inc/fnc.php';
include_once '../sys/inc/user.php';

if (isset($_GET['id']) && mysql_result(mysql_query("SELECT COUNT(*) FROM `private_chat` WHERE `id` = '".intval($_GET['id'])."'"),0)==1)
{
$post=mysql_fetch_array(mysql_query("SELECT * FROM `private_chat` WHERE `id` = '".intval($_GET['id'])."' LIMIT 1"));
$ank=mysql_fetch_array(mysql_query("SELECT * FROM `user` WHERE `id` = $post[id_user] LIMIT 1"));

if (isset($user) && ($user['level']>$ank['level'] || $user['level']==4))
mysql_query("DELETE FROM `private_chat` WHERE `id` = '$post[id]'");
}

if (isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER']!=NULL)
header("Location: ".$_SERVER['HTTP_REFERER']);
else
header("Location: logan.php?".SID);

?>