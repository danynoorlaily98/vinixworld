<?
$k_p=mysql_result(mysql_query("SELECT COUNT(*) FROM `blog_list`",$db), 0);
$k_n= mysql_result(mysql_query("SELECT COUNT(*) FROM `blog_list` WHERE `time` > '".(time()-86400)."'",$db), 0);
if ($k_n==0)$k_n=NULL;
else $k_n='+'.$k_n;
echo "$k_p<span class='off'>$k_n</span>";
?>
