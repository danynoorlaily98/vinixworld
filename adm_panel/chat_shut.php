<?
include_once '../sys/inc/start.php';
include_once '../sys/inc/compress.php';
include_once '../sys/inc/sess.php';
include_once '../sys/inc/home.php';
include_once '../sys/inc/settings.php';
include_once '../sys/inc/db_connect.php';
include_once '../sys/inc/ipua.php';
include_once '../sys/inc/fnc.php';
include_once '../sys/inc/adm_check.php';
include_once '../sys/inc/user.php';
user_access('adm_set_chat',null,'index.php?'.SID);
adm_check();

$set['title']='Chat - Jokes';
include_once '../sys/inc/thead.php';
title();
if (isset($_GET['act']) && isset($_FILES['file']['tmp_name']))
{

if (isset($_POST['replace']))
mysql_query('TRUNCATE `chat_shutnik`');
$k_add=0;
$list=@file($_FILES['file']['tmp_name']);
for($i=0;$i<count($list);$i++)
{
$shut=trim($list[$i]);
if (strlen2($shut)<10)continue;
mysql_query("INSERT INTO `chat_shutnik` (`anek`) VALUES ('".my_esc($shut)."')");
$k_add++;
}
admin_log('Chat','Addendum',"Add $k_add jokes");
msg("Successfully added $k_add of $i jokes");

}
err();
//aut();


echo "Total jokes in the database: ".mysql_result(mysql_query("SELECT COUNT(*) FROM `chat_shutnik`"),0)."<br />\n";
echo "<form method='post' action='?act=$passgen' enctype='multipart/form-data'>\n";

echo "<input type='file' name='file' /><br />\n";
echo "Onlu supports text files in UTF-8.<br />\Every joke should be on a separate line\nJokes shorted than 10 characters are ignored<br />\n";
echo "<input value='Replace' name='replace' type='submit' /><br />\n";
echo "<input value='Add' name='add' type='submit' /><br />\n";
echo "</form>\n";


echo "<div class='foot'>\n";
echo "&nbsp;<a href='/adm_panel/settings_chat.php'>IM Setting</a><br />\n";
echo "&nbsp;<a href='/adm_panel/chat_vopr.php'>Quistions Quiz</a><br />\n";
if (user_access('adm_panel_show'))
echo "&nbsp;<a href='/adm_panel/'>Admin Panel</a><br />\n";
echo "</div>\n";

include_once '../sys/inc/tfoot.php';
?>
