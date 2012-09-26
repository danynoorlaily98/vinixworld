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
$ank['id'] = $user['id'];
if (isset($_GET['id']))$ank['id'] = intval($_GET['id']);
$q = mysql_query("SELECT * FROM `user` WHERE `id` = $ank[id] LIMIT 1");
if (mysql_num_rows($q)==0){header("Location: index.php?".SID);exit;}


$set['title'] = 'Gift';
include_once 'sys/inc/thead.php';
//title();


$k_post = mysql_result(mysql_query("SELECT COUNT(*) FROM `gifts` WHERE `id_user` = '$ank[id]' LIMIT 1"), 0);

if ($k_post==0)
{
echo 'No gift';
}


$k_page=k_page($k_post,$set['p_str']);
$page=page($k_page);
$start=$set['p_str']*$page-$set['p_str'];


$q = mysql_query("SELECT * FROM `gifts` WHERE `id_user` = '$ank[id]' ORDER BY time DESC LIMIT $start, $set[p_str]");
while ($f = mysql_fetch_array($q))
{
$a = mysql_fetch_array(mysql_query("SELECT * FROM `user` WHERE `id` = '$f[ot_id]' LIMIT 1"));
if($num==1){
echo "<div class='rowdown'>";
$num=0;
}else{
echo "<div class='rowup'>";
$num=1;}

echo"<img src='/gifts/".$f['id_gifts'].".png' alt='' class='icon'/><br>";
echo "".$f['text']." \n";
echo "<br>from: <a href='info.php?id=$a[id]'><span style=\"color:$a[ncolor]\">$a[nick]</span></a><br/>\n";
echo "Sent: ".vremja($f['time'])." \n";
if (isset($user) && $user['id']==$ank['id']){
echo "<br/>Send back <a href=\"podarki/gifts.php?id=$a[id]&pod=1\">Gift</a><br />";
}
echo "</div>";

}


if ($k_page>1)str("?",$k_page,$page); // Home
include_once 'sys/inc/tfoot.php';
?>
