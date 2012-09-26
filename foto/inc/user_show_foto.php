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

$set['title']=$ank['nick'].' - '.$gallery['name'].' - '.$foto['name']; // заголовок страницы

include_once '../sys/inc/thead.php';
//title();
if (user_access('foto_foto_edit') || isset($user) && $ank['id']==$user['id'])
include 'inc/gallery_show_foto_act.php';





if (isset($user) && $user['id']!=$ank['id'] && $user['balls']>=50 && $user['rating']>=0 && mysql_result(mysql_query("SELECT COUNT(*) FROM `gallery_rating` WHERE `id_user` = '$user[id]' AND `id_foto` = '$foto[id]'"), 0)==0)
{
if (isset($_GET['rating']) && $_GET['rating']=='down'){
mysql_query("UPDATE `gallery_foto` SET `rating` = '".($foto['rating']-1)."' WHERE `id` = '$foto[id]' LIMIT 1",$db);
mysql_query("INSERT INTO `gallery_rating` (`id_user`, `id_foto`) values('$user[id]', '$foto[id]')",$db);
msg ('You rate negative');$foto=mysql_fetch_assoc(mysql_query("SELECT * FROM `gallery_foto` WHERE `id` = $foto[id] LIMIT 1"));}
elseif(isset($_GET['rating']) && $_GET['rating']=='up'){
mysql_query("UPDATE `gallery_foto` SET `rating` = '".($foto['rating']+1)."' WHERE `id` = '$foto[id]' LIMIT 1",$db);
mysql_query("INSERT INTO `gallery_rating` (`id_user`, `id_foto`) values('$user[id]', '$foto[id]')",$db);
msg ('You ratet positive');$foto=mysql_fetch_assoc(mysql_query("SELECT * FROM `gallery_foto` WHERE `id` = $foto[id] LIMIT 1"));}
}



err();
//aut();
echo "<div class='async_like'><div class='acbk'><div style='text-align:center;'>";
if ($set['web'])
{
echo "<img class='show_foto' src='/foto/foto640/$foto[id].$foto[ras]' alt='$foto[name]' /><br/>";
}
else
{
echo "<img class='show_foto' src='/foto/foto128/$foto[id].$foto[ras]' alt='$foto[name]' /><br/>";
}
echo "</div></div>";
echo '<div class="acbk aps">';
echo "<table cellspacing='0' cellpadding='0' class='lr'><tr><td valign='top'><a class='inv' href='/foto/$ank[id]/$gallery[id]/'>Back</a></td><td valign='top' class='r'><span class='fcw'>Rating: ";
if (isset($user) && $user['id']!=$ank['id'] && $user['balls']>=50 && $user['rating']>=0 && mysql_result(mysql_query("SELECT COUNT(*) FROM `gallery_rating` WHERE `id_user` = '$user[id]' AND `id_foto` = '$foto[id]'"), 0)==0)
echo "<a class=\"inv\" href=\"?id=$foto[id]&amp;rating=down\" title=\"To give a negative vote\">-</a>";
echo " $foto[rating] ";
if (isset($user) && $user['id']!=$ank['id'] && $user['balls']>=50 && $user['rating']>=0 && mysql_result(mysql_query("SELECT COUNT(*) FROM `gallery_rating` WHERE `id_user` = '$user[id]' AND `id_foto` = '$foto[id]'"), 0)==0)
echo "<a class=\"inv\" href=\"?id=$foto[id]&amp;rating=up\" title=\"To give a positive vote\">+</a></span>";
echo "</td></tr></table>";
echo "</div>";
echo "<div class='acw apl'><strong><a href='/info.php?id=".$ank['id']."'>$ank[nick]</a></strong></div>";
if ($foto['opis']!=null)
echo esc(trim(br(bbcode(smiles(links(stripcslashes(htmlspecialchars($foto['opis']))))))))."<br/>";
echo "<a href='/foto/$ank[id]/$gallery[id]/'>$gallery[name]</a>";
if (isset($user) && $user['balls']>=50){
echo " &#183; <a href='/foto/foto0/$foto[id].$foto[ras]' title='Download'>Full size ".size_file(filesize(H.'sys/gallery/foto/'.$foto['id'].'.jpg'))."</a><br/>";
}

if (user_access('foto_foto_edit') || isset($user) && $ank['id']==$user['id'])
include 'inc/gallery_show_foto_form.php';
echo "<div class=\"foot\">\n";
echo "&nbsp;<a href='/foto/$ank[id]/$gallery[id]/komm/$foto[id]/'>Comments (".mysql_result(mysql_query("SELECT COUNT(*) FROM `gallery_komm` WHERE `id_foto` = '$foto[id]'"),0).")</a><br/>";
echo "<div>";
include_once '../sys/inc/tfoot.php';
exit;
?>
