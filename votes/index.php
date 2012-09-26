<?

// remodified by noe

include_once '../sys/inc/start.php';
include_once '../sys/inc/compress.php';
include_once '../sys/inc/sess.php';
include_once '../sys/inc/home.php';
include_once '../sys/inc/settings.php';
include_once '../sys/inc/db_connect.php';
include_once '../sys/inc/ipua.php';
include_once '../sys/inc/fnc.php';
include_once '../sys/inc/user.php';

$s_menu=@$_GET['survey'];

if (isset($user))
$k_post_open=mysql_result(mysql_query("SELECT COUNT(*) FROM `survey_s` WHERE (SELECT COUNT(*) FROM `survey_v` WHERE `survey_v`.`id_s` = `survey_s`.`id` AND `survey_v`.`id_user` = '$user[id]') = 0  AND `survey_s`.`time_close` > '$time'"),0);
else $k_post_open=0;
$k_post_active=mysql_result(mysql_query("SELECT COUNT(*) FROM `survey_s` WHERE `time_close` > '$time'"),0);
$k_post_close=mysql_result(mysql_query("SELECT COUNT(*) FROM `survey_s` WHERE `time_close` <= '$time'"),0);
$k_post_all=mysql_result(mysql_query("SELECT COUNT(*) FROM `survey_s`"),0);



switch ($s_menu) {
case 'all':include 'inc/all.php';break;
//case 'active':include 'inc/active.php';break;
case 'open':include 'inc/open.php';break;
case 'close':include 'inc/close.php';break;
default:include 'inc/menu.php';	break;
}

if (user_access('votes_create')){
echo "<div class='foot'>\n";
echo "&nbsp;<a href='create.php?$passgen'>Create Polls</a><br />\n";
echo "</div>\n";
}

include_once '../sys/inc/tfoot.php';
?>
