<?

// remodified by noe
// http://nnetwork.tk
// loegue.info@gmail.com
// hargailah privasi orang

if (!isset($user) && !isset($_GET['id_user'])){header("Location: /foto/?".SID);exit;}
if (isset($user))$ank['id']=$user['id'];
if (isset($_GET['id_user']))$ank['id']=intval($_GET['id_user']);
$ank=get_user($ank['id']);
if (!$ank){header("Location: /foto/?".SID);exit;}

$set['title']=$ank['nick'].' - Albums'; // заголовок страницы

include_once '../sys/inc/thead.php';
//title();

include 'inc/gallery_act.php';
err();
//aut();
echo "<div class='acw apm'><strong><span class='mfsm fcb'><a href='/info.php?id=$ank[id]'>Wall</a> &#183; <a href='/info.php?id=$ank[id]&amp;info'>Info</a> &#183; <b>Foto</b></span></strong></div>";
$k_post=mysql_result(mysql_query("SELECT COUNT(*) FROM `gallery` WHERE `id_user` = '$ank[id]'"),0);
$k_page=k_page($k_post,$set['p_str']);
$page=page($k_page);
$start=$set['p_str']*$page-$set['p_str'];
echo "<table class='post'>";
if ($k_post==0)
{
echo "   <tr>\n";
echo "  <td class='p_t'>";
echo "Albums empty!";
echo "  </td>";
echo "   </tr>";

}
$q=mysql_query("SELECT * FROM `gallery` WHERE `id_user` = '$ank[id]' ORDER BY `time` DESC LIMIT $start, $set[p_str]");
while ($post = mysql_fetch_assoc($q))
{

echo "   <tr>";

$foto = mysql_fetch_assoc(mysql_query("SELECT * FROM `gallery_foto` WHERE `id_gallery` = '$post[id]' ORDER BY RAND()"));
if ($foto==null){
echo "<td class='icon48'><img src='/foto/foto48/0.png' alt='No Photo' /></td>";
}
else
{
echo "<td class='icon48'><img src='/foto/foto48/$foto[id].$foto[ras]' alt='Photo_$foto[id]' /></td>";
}
echo "  <td class='status' valign='top'>";
echo "<a href='/foto/$ank[id]/$post[id]/'>$post[name]</a><br/><font color='#808080'> ".mysql_result(mysql_query("SELECT COUNT(*) FROM `gallery_foto` WHERE `id_gallery` = '$post[id]'"),0)." Photos</font><br/>";
if ($post['opis']==null)
echo "No descriptions!<br/>";
else
echo esc(trim(br(bbcode(smiles(links(stripcslashes(htmlspecialchars($post['opis']))))))))."<br />\n";
echo "<font class='time' size='2'> ".vremja($post['time_create'])." </font>";
echo "  </td>";
echo "   </tr>";
}
echo "</table>";

if ($k_page>1)str('?',$k_page,$page); // Вывод страниц


include 'inc/gallery_form.php';
echo "<div class=\"foot\">\n";
echo "&nbsp;<a href='/foto/'>All Albums</a><br />\n";
echo "</div>\n";

include_once '../sys/inc/tfoot.php';
exit;
?>
