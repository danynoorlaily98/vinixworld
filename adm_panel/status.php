<?

// created by noe
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
$set['title']='Delete Status';
include_once '../sys/inc/thead.php';


if (isset($_GET['ok']))
{
mysql_query("DELETE FROM `statuse_list` WHERE `id` = '".intval($_GET['id'])."' LIMIT 1");
header("Location: status.php?".SID);
exit;
}
else
{
echo "<div class='acw apm'><b>Delete Status</b></div>";
echo "<div class='acw apm'>Are you sure want to delete?<br /><a href='?id=".intval($_GET['id'])."&amp;del&amp;ok'><button type='button' class='btn btnC'>Delete</button></a>";
echo " <a href='?'><span>Cancel</span></a>";
echo "</div>";
}
include_once '../sys/inc/tfoot.php';
}

$set['title']='Status Panel';
include_once '../sys/inc/thead.php';
if (isset($_GET['sort']) && $_GET['sort'] =='t')$order='order by `time` desc';
elseif (isset($_GET['sort']) && $_GET['sort'] =='c') $order='order by `count` desc';
else $order='order by `time` desc';

echo '<div class="penanda">';
echo "All Stories";
echo '</div>';
$k_post=mysql_result(mysql_query("SELECT COUNT(*) FROM `statuse_list` WHERE `privat` = 0"),0);

$k_page=k_page($k_post,$set['p_str']);
$page=page($k_page);
$start=$set['p_str']*$page-$set['p_str'];
echo "<table class='post'>\n";
if($k_post==0)
{
echo "   <tr>\n";
echo "  <td class='p_t'>\n";
echo "No Status !!!<br />";
echo "  </td>\n";
echo "   </tr>\n";
}
$res = mysql_query("select * from `statuse_list` WHERE `privat` = 0 $order LIMIT $start, $set[p_str];");
while ($statuse = mysql_fetch_array($res)){
$ank=get_user($statuse['id_user']);
echo "<tr>";
echo " <td class='icon14'>";echo avatar($ank['id']);
echo "</td><td class='status'>";
echo "<a href='/info.php?id=$ank[id]'><b>$ank[nick]</b/></a>";
echo " ".output_text($statuse['msg'])." ";
echo "<br/>";
echo "<font class='time' size='2'>".waktu($statuse['time'])."</font>";

if($statuse['kategori']!=1){

if ($ank['ank_city']!=NULL){echo "<font class='time' size='2'> near $ank[ank_city]</font><br/>\n";}

echo" &#183; <a href='/list.php?id=".$statuse['id']."'>See</a>";
}
if($user['level']>3)
{
echo" &#183; <a href='?id=".$statuse['id']."&amp;del'>Delete</a>";
}
echo "  </td>";
echo "   </tr>";
}
echo "</table>";

if (isset($_GET['sort'])) $dop="sort=$_GET[sort]&amp;";
else $dop='';
if ($k_page>1)str('?'.$dop.'',$k_page,$page);

echo "<div class='foot'>";
if (user_access('adm_panel_show'))
echo "&laquo;<a href='/adm_panel/'>Admin Panel</a><br/>";
echo "</div>";
include_once '../sys/inc/tfoot.php';
?>
