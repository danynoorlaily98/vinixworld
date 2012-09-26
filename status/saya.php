<?

// Mod by : Arvana
// Site : www.arvana.in.gp
// Hargailah privasi orang lain

// remodified by noe
// http://nnetwork.tk
// loegue.info@gmail.com
// hargailah privasi orang


include_once '../sys/inc/start.php';
include_once '../sys/inc/compress.php';
include_once '../sys/inc/sess.php';
include_once '../sys/inc/home.php';
include_once '../sys/inc/settings.php';
include_once '../sys/inc/db_connect.php';
include_once '../sys/inc/ipua.php';
include_once '../sys/inc/fnc.php';
include_once '../sys/inc/user.php';
if (isset($_GET['del']))
{
only_reg();
$set['title']='Hapus Status';
include_once '../sys/inc/thead.php';
aut();

if (isset($_GET['ok']))
{
mysql_query("DELETE FROM `statuse_list` WHERE `id` = '".intval($_GET['id'])."' LIMIT 1");
header("Location: /status/user.php?".SID);
exit;
}
else
{
echo "<div class='acw apm'><b>Hapus Status</b></div>";
echo "<div class='acw apm'>Yakin ingin menghapus status ini ?<br /><a href='?id=".intval($_GET['id'])."&amp;del&amp;ok'><button type='button' class='btn btnC'>Hapus</button></a> <a href='" . htmlspecialchars(getenv('HTTP_REFERER')) . "'><span>Batalkan</span></a>";
echo "</div>";
}
include_once '../sys/inc/tfoot.php';
}


if (!isset($user) && !isset($_GET['id']))
{
header("Location: /index.php?".SID);
exit;
}

if (isset($user))$ank['id']=$user['id'];
if (isset($_GET['id']))$ank['id']=intval($_GET['id']);
if (mysql_result(mysql_query("SELECT COUNT(*) FROM `user` WHERE `id` = '$ank[id]' LIMIT 1"),0)==0){
header("Location: /index.php?".SID);
exit;
}

$ank=mysql_fetch_array(mysql_query("SELECT * FROM `user` WHERE `id` = $ank[id] LIMIT 1"));
$set['title']= 'Status '.$ank['nick'].'';
include_once '../sys/inc/thead.php';

if ((!isset($_SESSION['refer']) || $_SESSION['refer']==NULL)
&& isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER']!=NULL &&
!ereg('info\.php',$_SERVER['HTTP_REFERER']))
$_SESSION['refer']=str_replace('&','&amp;',ereg_replace('^http://[^/]*/','/', $_SERVER['HTTP_REFERER']));
aut();
if(!$set['web']){
if ($ank['ban']>$time){
echo "<span class=\"status\">$ank[nick]</span><br />\n";
echo "Banned</span> <a href='/rules.php'>Peraturan<a><div/>";
}



$user_id = $ank['id'];
$k_post = mysql_result(mysql_query("SELECT COUNT(*) FROM `statuse_list` WHERE `id_user` = '".$user_id."' AND `cat` = '0'"),0);
$k_page = k_page($k_post, $set['p_str']);
$page = page($k_page);
$start = $set['p_str'] * $page - $set['p_str'];
if($k_post==0)
{
echo "<div class='p_t'>Belum ada update status</div>";
}

$query = @mysql_query("SELECT * FROM `statuse_list` WHERE `id_user` = '".$user_id."' ORDER BY `time` DESC LIMIT $start, $set[p_str];");
while ($array = mysql_fetch_array($query)){
echo '<div><div class="abb acw apl" id="'.$ank['id'].'"><a href="info.php?id='.$ank['id'].'"><b>'.$ank['nick'].'</b></a> '.output_text($array['msg']).'<div class="actions mfss fcg"><abbr class="timestamp">'.waktu($array['time']).'</abbr>';




if($user['level']>3 OR $ank['id']==$user['id'])
{
echo" &#183; <a class='sec' href='?id=".$array['id']."&amp;del'>Hapus</a>";
}
echo '</div></div></div>';
}
}

if($k_page>1){
str('?id='.$user_id.'&amp;', $k_page, $page);
}
if(isset($user))
{

echo'<div class="acw apm">';
echo "<a href=\"tambah.php\">Update Status</a><br />";
echo '</div>';
}
include_once '../sys/inc/tfoot.php';
?>
