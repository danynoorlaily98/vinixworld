<?
if (!isset($user))
{
$err[]='To participate the Pollings, you must login or register';
include 'inc/menu.php';
}
elseif ($k_post_open==0)
{
$err[]='Not accepted your polling';
include 'inc/menu.php';
}
else
{
$set['title']='User survey'; // заголовок страницы
include_once '../sys/inc/thead.php';
title();

if (isset($_POST['sur']) && isset($_POST['result']))
{
$sur=intval($_POST['sur']);
$result=intval($_POST['result']);

if (mysql_result(mysql_query("SELECT COUNT(*) FROM `survey_s` WHERE `id` = '$sur'"),0)==0)
$err[]='Polling deleted';
elseif (mysql_result(mysql_query("SELECT COUNT(*) FROM `survey_s` WHERE `id` = '$sur' AND `time_close` > '$time'"),0)==0)
$err[]='Polling expired';
elseif (mysql_result(mysql_query("SELECT COUNT(*) FROM `survey_s` WHERE `id` = '$sur' AND (SELECT COUNT(*) FROM `survey_v` WHERE `survey_v`.`id_s` = `survey_s`.`id` AND `survey_v`.`id_user` = '$user[id]') = 0  AND `survey_s`.`time_close` > '$time'"),0)==0)
$err[]='Your answer is already covered';
elseif (mysql_result(mysql_query("SELECT COUNT(*) FROM `survey_r` WHERE `id` = '$result' AND `id_sur` = '$sur'"),0)==0)
$err[]='There is no answer choice';
else
{
mysql_query("INSERT INTO `survey_v` (`id_s`, `id_r`, `time`, `id_user`) VALUES ('$sur', '$result', '$time', '$user[id]')");
msg("YOUR VOTE ACCEPTED");

$k_post_open=mysql_result(mysql_query("SELECT COUNT(*) FROM `survey_s` WHERE (SELECT COUNT(*) FROM `survey_v` WHERE `survey_v`.`id_s` = `survey_s`.`id` AND `survey_v`.`id_user` = '$user[id]') = 0  AND `survey_s`.`time_close` > '$time'"),0);




}
}

err();
//aut();

if ($k_post_open){
$survey=mysql_fetch_assoc(mysql_query("SELECT * FROM `survey_s` WHERE (SELECT COUNT(*) FROM `survey_v` WHERE `survey_v`.`id_s` = `survey_s`.`id` AND `survey_v`.`id_user` = '$user[id]') = 0 AND `time_close` > '$time' LIMIT ".rand(0,$k_post_open-1).", 1"));
echo "<form method='post' action='?survey=open&amp;$passgen'>\n";
echo "<input type='hidden' name='sur' value='$survey[id]' />\n";
echo "<table class='post'>\n";
echo "   <tr>\n";
if ($set['set_show_icon']==2){
echo "  <td class='icon48' rowspan='2'>\n";
echo "<img src='/style/themes/$set[set_them]/votes/vote.png' alt='' />";
echo "  </td>\n";
}
elseif ($set['set_show_icon']==1)
{
echo "  <td class='icon14'>\n";
echo icons('votes.png','code');
echo "  </td>\n";
}
echo "  <td class='p_t'>\n";
echo "Survey (".vremja($survey['time'])."):";
echo "  </td>\n";
echo "   </tr>\n";
echo "   <tr>\n";
if ($set['set_show_icon']==1)echo "  <td class='p_m' colspan='2'>\n"; else echo "  <td class='p_m'>\n";
echo output_text($survey['surv']);
echo "  </td>\n";
echo "   </tr>\n";
echo "   <tr>\n";
echo "  <td class='main_menu' colspan='2'>\n";

$q=mysql_query("SELECT * FROM `survey_r` WHERE `id_sur` = '$survey[id]' ORDER BY RAND()");
while($res=mysql_fetch_assoc($q))
{
echo "<label><input type='radio' name='result' value='$res[id]' />$res[msg]</label><br />\n";
}
echo "  </td>\n";
echo "   </tr>\n";
echo "</table>\n";
echo "<input type='submit' name='ok' value='Vote' />\n";
echo "</form>\n";
}
else echo "<div class='menu'>No active polls</div>\n";

echo "<div class='foot'>\n";
echo "&nbsp;<a href='?$passgen'>Back</a><br />\n";
echo "</div>\n";
}
?>
