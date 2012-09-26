<?

// remodified by noe
// http://nnetwork.tk
// loegue.info@gmail.com
// hargailah privasi orang

if (!isset($user) && !isset($_GET['id_user'])){header("Location: /foto/?".SID);exit;}
if (isset($user))$ank['id']=$user['id'];
if (isset($_GET['id_user']))$ank['id']=intval($_GET['id_user']);
if (mysql_result(mysql_query("SELECT COUNT(*) FROM `user` WHERE `id` = '$ank[id]' LIMIT 1"),0)==0){header("Location: /foto/?".SID);exit;}
$ank=mysql_fetch_assoc(mysql_query("SELECT * FROM `user` WHERE `id` = $ank[id] LIMIT 1"));

$gallery['id']=intval($_GET['id_gallery']);

if (mysql_result(mysql_query("SELECT COUNT(*) FROM `gallery` WHERE `id` = '$gallery[id]' AND `id_user` = '$ank[id]' LIMIT 1"),0)==0){header("Location: /foto/$ank[id]/?".SID);exit;}
$gallery=mysql_fetch_assoc(mysql_query("SELECT * FROM `gallery` WHERE `id` = '$gallery[id]' AND `id_user` = '$ank[id]' LIMIT 1"));

$foto['id']=intval($_GET['id_foto']);

if (mysql_result(mysql_query("SELECT COUNT(*) FROM `gallery_foto` WHERE `id` = '$foto[id]' LIMIT 1"),0)==0){header("Location: /foto/$ank[id]/$gallery[id]/?".SID);exit;}
$foto=mysql_fetch_assoc(mysql_query("SELECT * FROM `gallery_foto` WHERE `id` = '$foto[id]'  LIMIT 1"));

$set['title']=$ank['nick'].' - '.$gallery['name'].' - '.$foto['name'].' - Comments'; // заголовок страницы

include_once '../sys/inc/thead.php';
//title();




if (isset($_POST['msg']) && isset($user))
{
$msg=$_POST['msg'];
if (isset($_POST['translit']) && $_POST['translit']==1)$msg=translit($msg);

$mat=antimat($msg);
if ($mat)$err[]='In the message body found mat: '.$mat;

if (strlen2($msg)>1024){$err='Maximal 1024 characters';}
elseif (strlen2($msg)<2){$err='Minimal 4 characters';}
elseif (mysql_result(mysql_query("SELECT COUNT(*) FROM `gallery_komm` WHERE `id_foto` = '$foto[id]' AND `id_user` = '$user[id]' AND `msg` = '".mysql_escape_string($msg)."' LIMIT 1"),0)!=0){$err='Your message repeats the previous';}
elseif(!isset($err)){

/*if ($ank['id']!=$user['id'])mysql_query("INSERT INTO `jurnal` (`id_user`, `id_kont`, `msg`, `time`) values('0', '$ank[id]', '$user[nick] left [url=/foto/$ank[id]/$gallery[id]/komm/$foto[id]/]comments your photos[/url]', '$time')");*/
if ($ank['id']!=$user['id']){
$msgn=" $user[nick] comments on your [url=/foto/$ank[id]/$gallery[id]/komm/$foto[id]/]photos[/url] album";
mysql_query("INSERT INTO `jurnal` (`id_user`, `id_kont`, `msg`, `time`) values('0', '$ank[id]', '$msgn', '$time')");
}
mysql_query("INSERT INTO `gallery_komm` (`id_foto`, `id_user`, `time`, `msg`) values('$foto[id]', '$user[id]', '$time', '".my_esc($msg)."')");
mysql_query("UPDATE `user` SET `balls` = '".($user['balls']+1)."' WHERE `id` = '$user[id]' LIMIT 1");
msg('Your comments successfully added');
}
}

elseif (isset($_GET['del']) && mysql_result(mysql_query("SELECT COUNT(*) FROM `gallery_komm` WHERE `id` = '".intval($_GET['del'])."' && `id_foto` = '$foto[id]'"),0))
{
if (isset($user) && ($user['level']>=4) || isset($user) && ($ank['id']==$user['id']))
{
mysql_query("DELETE FROM `gallery_komm` WHERE `id` = '".intval($_GET['del'])."' LIMIT 1");
msg('comment deleted');
}
}

err();
//aut();
$k_post=mysql_result(mysql_query("SELECT COUNT(*) FROM `gallery_komm` WHERE `id_foto` = '$foto[id]'"),0);
$k_page=k_page($k_post,$set['p_str']);
$page=page($k_page);
$start=$set['p_str']*$page-$set['p_str'];
echo "<table class='post'>\n";
if ($k_post==0)
{
echo "   <tr>\n";
echo "  <td class='p_t'>\n";
echo "No Comments\n";
echo "  </td>\n";
echo "   </tr>\n";

}

$q=mysql_query("SELECT * FROM `gallery_komm` WHERE `id_foto` = '$foto[id]' ORDER BY `id` ASC LIMIT $start, $set[p_str]");
while ($post = mysql_fetch_assoc($q))
{
$ank2=mysql_fetch_assoc(mysql_query("SELECT * FROM `user` WHERE `id` = '$post[id_user]' LIMIT 1"));
echo "   <tr>\n";
if ($set['set_show_icon']==2){
echo "  <td class='icon48' rowspan='2'>\n";
avatar($ank2['id']);
echo "  </td>\n";
}
elseif ($set['set_show_icon']==1)
{
echo "  <td class='icon14' rowspan='2'>\n";
avatar($ank2['id']);
//echo "<img src='/style/themes/$set[set_them]/user/$ank2[pol].png' alt='' />";
echo "  </td>\n";
}



echo "  <td class='p_t'>\n";
echo "<a href='/info.php?id=$ank2[id]'>$ank2[nick]</a>".online($ank2['id'])." (".vremja($post['time']).")\n";
echo "  </td>\n";
echo "   </tr>\n";
echo "   <tr>\n";
if ($set['set_show_icon']==1)echo "  <td class='p_m' colspan='2'>\n"; else echo "  <td class='p_m'>\n";
echo output_text($post['msg'])."<br />\n";
if (isset($user) && ($user['level']>=4) || isset($user) && ($ank['id']==$user['id']))
echo "<a href='?id=$foto[id]&amp;del=$post[id]'>Delete</a><br />\n";
echo "  </td>\n";
echo "   </tr>\n";

}
echo "</table>\n";


if ($k_page>1)str('?',$k_page,$page); // Вывод страниц

if (isset($user))
{
$teman2 = mysql_query("SELECT COUNT(*) FROM `frends` WHERE (`user` = '$ank[id]' AND `frend` = '$user[id]') OR (`user` = '$user[id]' AND `frend` = '$ank[id]') LIMIT 1");
if (isset($user) && $user['id']!=$ank['id'] && mysql_result($teman2, 0)==0)
{
}
else
{
echo "<form method='post' name='message' action='?$passgen'>\n";
echo "Comments:<br />\n<textarea name=\"msg\"></textarea><br />\n";
if ($user['set_translit']==1)echo "<label><input type=\"checkbox\" name=\"translit\" value=\"1\" /> Translate</label><br />\n";
echo "<input class=\"button\" value=\"Submit\" type=\"submit\" />\n";
echo "</form>\n";
}
}
echo "<div class=\"foot\">\n";
echo "<a href='/foto/$ank[id]/$gallery[id]/$foto[id]/'>Back</a>";
echo " &#183; <a href='/foto/$ank[id]/$gallery[id]/'>$gallery[name]</a><br/>";
echo "</div>";

include_once '../sys/inc/tfoot.php';
exit;
?>
