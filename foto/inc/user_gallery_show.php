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
$gallery['id']=intval($_GET['id_gallery']);

if (mysql_result(mysql_query("SELECT COUNT(*) FROM `gallery` WHERE `id` = '$gallery[id]' AND `id_user` = '$ank[id]' LIMIT 1"),0)==0){header("Location: /foto/$ank[id]/?".SID);exit;}
$gallery=mysql_fetch_assoc(mysql_query("SELECT * FROM `gallery` WHERE `id` = '$gallery[id]' AND `id_user` = '$ank[id]' LIMIT 1"));



$set['title']=$ank['nick'].' - '.$gallery['name'].''; // заголовок страницы
include_once '../sys/inc/thead.php';
//title();

include 'inc/gallery_show_act.php';
err();
//aut();


$k_post=mysql_result(mysql_query("SELECT COUNT(*) FROM `gallery_foto` WHERE `id_gallery` = '$gallery[id]'"),0);
$k_page=k_page($k_post,$set['p_str']);
$page=page($k_page);
$start=$set['p_str']*$page-$set['p_str'];
if ($k_post==0)
{
echo "  <div class='p_t'>";
echo "No photo!";
echo "  </div>";
}

echo "<div class='async_like'><div style='text-align:center;' id='tumbnail_area'><div class='acw '>";
$q=mysql_query("SELECT * FROM `gallery_foto` WHERE `id_gallery` = '$gallery[id]' ORDER BY `id` DESC LIMIT $start, $set[p_str]");
while ($post = mysql_fetch_assoc($q))
{

echo "<a class='square_tumbnail' href='/foto/$ank[id]/$gallery[id]/$post[id]/'><img src='/foto/foto48/$post[id].$post[ras]' alt='$post[name]' /></a>";
}
echo "</div></div>";
if ($k_page>1)str('?',$k_page,$page); // Вывод страниц


include 'inc/gallery_show_form.php';
echo "<div class=\"foot\">\n";
echo "&nbsp;$gallery[name] by <a href='/info.php?id=$ank[id]'>$ank[nick]</a><br/>";
echo "&nbsp;<a href='/foto/$ank[id]/'>Back</a><br/>";
echo "</div></div>";
include_once '../sys/inc/tfoot.php';
exit;
?>
