<?
function k_files($dir=null)
{
global $set;
if ($dir!=null){
$path=(function_exists('iconv'))?iconv('windows-1251', 'utf-8', $dir):$dir;
$path='/'.eregi_replace('^/+|/+$', null, $path).'/';
$all= mysql_result(mysql_query("SELECT COUNT(*) FROM `loads_list` WHERE `path` LIKE '".my_esc($path)."%'"),0);
$new= mysql_result(mysql_query("SELECT COUNT(*) FROM `loads_list` WHERE `path` LIKE '".my_esc($path)."%' AND `time` > '".(time()-60*60*$set['loads_new_file_hour'])."'"),0);
}
else
{
$all= mysql_result(mysql_query("SELECT COUNT(*) FROM `loads_list`"),0);
$new= mysql_result(mysql_query("SELECT COUNT(*) FROM `loads_list` WHERE `time` > '".(time()-60*60*$set['loads_new_file_hour'])."'"),0);
}

return ($new==0)?$all:"$all/<span class='new'>+$new</span>";
}
?>