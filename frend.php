<?

// Translated by : zanger
// Site : http://www.frendzmobile.co.cc

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
only_reg();
$ank['id'] = $user['id'];
if (isset($_GET['id']))$ank['id'] = intval($_GET['id']);
$q = mysql_query("SELECT * FROM `user` WHERE `id` = $ank[id] LIMIT 1");
if (mysql_num_rows($q)==0){header("Location: index.php?".SID);exit;}

$ank = mysql_fetch_array($q);

$set['title'] = ''.$ank['nick'].' - Friends List';
include_once 'sys/inc/thead.php';
//title();
if (isset($_GET['add']))msg('Request friendship have been sent');
if ($ank['id']==$user['id'])
{
echo "<div class='penanda'>";
echo '<a href="frend_new.php">See more request...</a></div>';
echo "</div>";
}

$k_post = mysql_result(mysql_query("SELECT COUNT(*) FROM `frends` WHERE `user` = '$ank[id]' AND `i` = '1'"), 0);

if ($k_post==0)
{
echo 'User '.$ank['nick'].' No friends';
}

$k_page=k_page($k_post,$set['p_str']);
$page=page($k_page);
$start=$set['p_str']*$page-$set['p_str'];


$q = mysql_query("SELECT * FROM `frends` WHERE `user` = '$ank[id]' AND `i` = '1' ORDER BY time DESC LIMIT $start, $set[p_str]");
while ($f = mysql_fetch_array($q))
{
$a = mysql_fetch_array(mysql_query("SELECT * FROM `user` WHERE `id` = '$f[frend]' LIMIT 1"));
if($num==1){
echo "<div class='rowdown'>";
$num=0;
}else{
echo "<div class='rowup'>";
$num=1;}
echo "<table class='post'>\n";
echo "<tr><td class='icon14' rowspan='2'><a href='/info.php?id=$a[id]'>";
avatar($a['id']);
echo "</a></td></tr>";
echo "<tr><td class='footer' valign='top'>";
echo "<a href='/info.php?id=$a[id]'><span style=\"color:$a[ncolor]\">$a[nick]</span></a> ".online($a['id'])."\n";
echo "".adm($a['id'])."\n";
echo ' <span class="ank_n">('.vremja($f['time']).')</span><br />';
if ($ank['id']==$user['id'])echo '<a href="frend_new.php?del='.$a['id'].'">Remove friends</a>';

echo '</td></tr></table>';
echo "</div>";
}


if ($k_page>1)str("?id=$ank[id]&",$k_page,$page); // Home
include_once 'sys/inc/tfoot.php';
?>
