<?
$k_p=mysql_result(mysql_query("SELECT COUNT(*) FROM `survey_s`",$db), 0);
$k_n= mysql_result(mysql_query("SELECT COUNT(*) FROM `survey_s` WHERE `time_close` > '$time'",$db), 0);
if ($k_n==0)$k_n=NULL;
else $k_n='/+'.$k_n;
echo "$k_p$k_n";
?>
