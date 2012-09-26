<?

// remodified by noe
// http://nnetwork.tk
// loegue.info@gmail.com
// hargailah privasi orang


include_once 'sys/inc/start.php';
include_once 'sys/inc/compress.php';
include_once 'sys/inc/sess.php';
include_once 'sys/inc/home.php';
include_once 'sys/inc/settings.php';
include_once 'sys/inc/db_connect.php';
include_once 'sys/inc/ipua.php';
include_once 'sys/inc/fnc.php';
include_once 'sys/inc/user.php';
if (isset($_GET['del']))
{
only_reg();
$set['title']='Delete Status';
include_once 'sys/inc/thead.php';


if (isset($_GET['ok']))
{
mysql_query("DELETE FROM `statuse_list` WHERE `id` = '".intval($_GET['id'])."' LIMIT 1");
header("Location: /status.php?".SID);
exit;
}
else
{
echo "<div class='acw apm'><b>Delete Status</b></div>";
echo "<div class='acw apm'>Are you sure want to delete?<br /><a href='?id=".intval($_GET['id'])."&amp;del&amp;ok'><button type='button' class='btn btnC'>Delete</button></a>";
echo " <a href='?'><span>Cancel</span></a>";
echo "</div>";
}
include_once 'sys/inc/tfoot.php';
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
$set['title']= ''.$ank['nick'].' - Status';
include_once 'sys/inc/thead.php';

if ((!isset($_SESSION['refer']) || $_SESSION['refer']==NULL)
&& isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER']!=NULL &&
!ereg('info\.php',$_SERVER['HTTP_REFERER']))
$_SESSION['refer']=str_replace('&','&amp;',ereg_replace('^http://[^/]*/','/', $_SERVER['HTTP_REFERER']));


echo '<div class="acw apm"><div id="profile_header"><div class="ib"><table><tr><td><a href="/primary.php?id='.$ank['id'].'">';
avatar($ank['id']);
echo '</a></td><td><div class="c"><div class="right_column"><div class="profile_name"><strong>';
echo '<a href="/info.php?id='.$ank['id'].'">'.$ank['nick'].'</a>';
echo ''.online($ank['id']).'</strong></div></div></div></td></tr></table>';
echo '<div class="clear"></div></div>';
echo '</div></div>';
$user_id = $ank['id'];
$k_post = mysql_result(mysql_query("SELECT COUNT(*) FROM `statuse_list` WHERE `id_user` = '".$user_id."' AND `cat` = '0'"),0);
$k_page = k_page($k_post, $set['p_str']);
$page = page($k_page);
$start = $set['p_str'] * $page - $set['p_str'];
echo "<table class='post'>\n";
if($k_post==0)
{
echo "   <tr>\n";
echo "  <td class='p_t'>\n";
echo "No status !!!<br />";
echo "  </td>\n";
echo "   </tr>\n";
}

$query = @mysql_query("SELECT * FROM `statuse_list` WHERE `id_user` = '".$user_id."' ORDER BY `time` DESC LIMIT $start, $set[p_str];");
while ($array = mysql_fetch_array($query)){
echo "   <tr>";
echo "  <td class='status'>";
echo '<a href="/info.php?id='.$ank['id'].'"><b>'.$ank['nick'].'</b></a> '.output_text($array['msg']).'<br/><font class="time" size="2">'.waktu($array['time']).'</font>';
if($array['kategori']!=1){
if (isset($user)){
$teman2 = mysql_query("SELECT COUNT(*) FROM `frends` WHERE (`user` = '$ank[id]' AND `frend` = '$user[id]') OR (`user` = '$user[id]' AND `frend` = '$ank[id]') LIMIT 1");
if (isset($user) && $user['id']!=$ank['id'] && mysql_result($teman2, 0)==0)
{
}
else
{
echo" &#183; <a href='list.php?id=".$array['id']."'>See</a>";
}
}
if($user['level']>3 OR $ank['id']==$user['id'])
{
echo" &#183; <a href='?id=".$array['id']."&amp;del'>Delete</a>";
}
}
echo "  </td>";
echo "   </tr>";
}
echo "</table>";

if($k_page>1){
str('?id='.$user_id.'&amp;', $k_page, $page);
}

include_once 'sys/inc/tfoot.php';
?>
