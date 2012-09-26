<?
$set['title']='Not Complete Surveys'; // заголовок страницы
include_once '../sys/inc/thead.php';
title();
err();
//aut();
$k_page=$k_post=$k_post_close;
$page=page($k_page);
$start=$page-1;


echo "<table class='post'>\n";
if ($k_post==0)
{
echo "   <tr>\n";
echo "  <td class='p_t'>\n";
echo "Not Complete Surveys\n";
echo "  </td>\n";
echo "   </tr>\n";
}
else
{
$survey = mysql_fetch_assoc(mysql_query("SELECT * FROM `survey_s` WHERE `time_close` <= '$time' ORDER BY `id` DESC LIMIT $start, 1"));
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

$all_sur=mysql_result(mysql_query("SELECT COUNT(*) FROM `survey_v` WHERE `id_s` = '$survey[id]'"), 0);
$q=mysql_query("SELECT `survey_r`.`msg`, COUNT(`survey_v`.`id_user`) AS `count` FROM `survey_r` LEFT JOIN `survey_v`
ON `survey_r`.`id` = `survey_v`.`id_r` WHERE `survey_r`.`id_sur` = '$survey[id]' GROUP BY `survey_r`.`id` ORDER BY `count` DESC");

while($res=mysql_fetch_assoc($q))
{
echo "$res[msg]<br />\n";
echo "<img src='img.php?p=".@intval($res['count']/$all_sur*100)."&amp;k=$res[count]&amp;a=$all_sur' alt='' /><br />\n";
echo "<div style='height:5px;background-color:#ffffff;border: 1px solid #cccccc;width: 120px;'><div style='height:5px;background-color:#B3C0ED;width:".@intval($res['count']/$all_sur*100)."%;'>&nbsp;</div></div>";
}


echo "  </td>\n";
echo "   </tr>\n";
}
echo "</table>\n";


if ($k_page>1)str("?survey=close&amp;",$k_page,$page); // Вывод страниц


echo "<div class='foot'>\n";
echo "&nbsp;<a href='?$passgen'>Back</a><br />\n";
echo "</div>\n";
?>
