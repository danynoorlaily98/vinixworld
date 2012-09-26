<?php
if (isset($user))
{
$query = " select `frends`.*, `aktifitas`.*, ( select `nick` from `user` where `id`=`aktifitas`.`uid` limit 1 ) `nick` from `frends`, `aktifitas` where `frends`.`user`='".$user['id']."' and `aktifitas`.`uid`=`frends`.`frend` order by `aktifitas`.`id` desc";$k_post = mysql_num_rows(mysql_query($query));
echo "<table><tr><td>";
echo "<li><span class='off'>Aktifitas dan berita teman</span></li>";

if ( $k_post == 0 ) 
echo"<div class='post1'>
Tidak ada pemberitahuan. Tambahkan beberapa teman untuk mendapatkan pembaharuan.</div>";
else 
echo "&raquo; <a onclick='fun();' href=\"/allaktifitas.php\"> <span class='off'>View all aktifitas</span></a>";

{
$k_page=k_page($k_post,$set['p_str']);
$page=page($k_page);$start=$set['p_str']*$page-$set['p_str'];

$query = mysql_query($query." limit ".$start.", ".$set['p_str'].";"); while ( $data = mysql_fetch_assoc($query) ) 

{

echo"<div class='post1'>\n";

echo 'date: ('.vremja($data['date']).')
</div>
<a href="/info.php?id='.$data['uid'].'"><span style=\"color:$data[color_nick]\">'.$data['nick'].'</span></a> 

'.$data['link'];
echo "</td><td>";

}

}
}
?>
