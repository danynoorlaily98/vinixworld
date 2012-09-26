<?



if (user_access('obmen_file_delete') && isset($_GET['act']) && $_GET['act']=='delete' && isset($_GET['ok']) && $l!='/')
{
mysql_query("DELETE FROM `obmennik_files` WHERE `id` = '$file_id[id]'");
unlink(H.'sys/obmen/files/'.$file_id['id'].'.dat');

header ("Location: /obmen$dir_id[dir]?".SID);
exit;
}
?>