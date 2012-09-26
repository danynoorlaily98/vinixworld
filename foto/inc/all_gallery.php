<?

// remodified by noe
// http://nnetwork.tk
// loegue.info@gmail.com
// hargailah privasi orang


$set['title']='Photo Albums'; // заголовок страницы

include_once '../sys/inc/thead.php';
//title();

err();
//aut();




$k_post=mysql_result(mysql_query("SELECT COUNT(*) FROM `gallery`"),0);
$k_page=k_page($k_post,$set['p_str']);
$page=page($k_page);
$start=$set['p_str']*$page-$set['p_str'];
echo "<table class='post'>\n";
if ($k_post==0)
{
echo "   <tr>\n";
echo "  <td class='p_t'>\n";
echo "Photo albums empty\n";
echo "  </td>\n";
echo "   </tr>\n";

}

$q=mysql_query("SELECT * FROM `gallery` ORDER BY `time` DESC LIMIT $start, $set[p_str]");
while ($post = mysql_fetch_assoc($q))
{
$ank=get_user($post['id_user']);
echo "   <tr>\n";


$foto = mysql_fetch_assoc(mysql_query("SELECT * FROM `gallery_foto` WHERE `id_gallery` = '$post[id]' ORDER BY RAND()"));
if ($foto==null){
echo "<td class='icon48'><img src='/foto/foto48/0.png' alt='no photo' /></td>";
}
else
{
echo "<td class='icon48'><img src='/foto/foto48/$foto[id].$foto[ras]' alt='photo_$foto[id]' /></td>";
}

echo "  <td class='status' valign='top'>";
if (isset($user)){
$teman2 = mysql_query("SELECT COUNT(*) FROM `frends` WHERE (`user` = '$ank[id]' AND `frend` = '$user[id]') OR (`user` = '$user[id]' AND `frend` = '$ank[id]') LIMIT 1");
if (isset($user) && $user['id']!=$ank['id'] && mysql_result($teman2, 0)==0)
{
echo "$post[name]<br/><font color='#808080'> ".mysql_result(mysql_query("SELECT COUNT(*) FROM `gallery_foto` WHERE `id_gallery` = '$post[id]'"),0)." photo</font><br/>";
}
else
{
echo "<a href='/foto/$ank[id]/$post[id]/'>$post[name]</a><br/><font color='#808080'> ".mysql_result(mysql_query("SELECT COUNT(*) FROM `gallery_foto` WHERE `id_gallery` = '$post[id]'"),0)." photo</font><br/>";
}
}
if ($post['opis']==null)
echo "No descriptions!<br/>";
else
echo esc(trim(br(bbcode(smiles(links(stripcslashes(htmlspecialchars($post['opis']))))))))."<br/>";
echo "<div class='time' size='2'> ".vremja($post['time_create'])." </div>";
echo "Album: <a href='/info.php?id=$ank[id]'>$ank[nick]</a><br/>";
echo "  </td>";
echo "   </tr>";

}
echo "</table>\n";
if ($k_page>1)str('?',$k_page,$page); // Вывод страниц
if (isset($user))
{
echo "<div class=\"foot\">\n";
echo "&nbsp;<a href='/foto/$user[id]/'>My Albums</a><br />\n";
echo "</div>\n";
}
include_once '../sys/inc/tfoot.php';
exit;
?>
