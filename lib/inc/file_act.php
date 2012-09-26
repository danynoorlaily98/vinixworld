<?
if (user_access('lib_stat_delete')){
if (isset($_GET['act']) && $_GET['act']=='delete' && isset($_GET['ok']) && $l!='/')
{
mysql_query("DELETE FROM `lib_files` WHERE `id` = '$file_id[id]'");
admin_log('Библиотека','Удаление',"Удаление статьи id#$file_id[id]");
unlink(H.'sys/lib/stats/'.$file_id['id'].'.txt.gz');
header ("Location: /lib$dir_id[dir]?".SID);
exit;
}
}
?>