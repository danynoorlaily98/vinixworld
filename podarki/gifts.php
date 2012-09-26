<?

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

if (!isset($user) && !isset($_GET['id'])){header("Location: /index.php?".SID);exit;}
if (isset($user))$ank['id']=$user['id'];
if (isset($_GET['id']))$ank['id']=intval($_GET['id']);
if (mysql_result(mysql_query("SELECT COUNT(*) FROM `user` WHERE `id` = '$ank[id]' LIMIT 1"),0)==0){header("Location: /index.php?".SID);exit;}
$ank=mysql_fetch_array(mysql_query("SELECT * FROM `user` WHERE `id` = $ank[id] LIMIT 1"));



if ((!isset($_SESSION['refer']) || $_SESSION['refer']==NULL)
&& isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER']!=NULL &&
!ereg('gifts\.php',$_SERVER['HTTP_REFERER']))
$_SESSION['refer']=str_replace('&','&amp;',ereg_replace('^http://[^/]*/','/', $_SERVER['HTTP_REFERER']));

if (isset($user))
{
$p = (isset($_GET['p'])) ? htmlspecialchars($_GET['p']) : null;

switch($p){

case 'send_gifts':

include_once '../sys/inc/thead.php';
$set['title']='Send Gift'; // зaгoлoвoк cтpaницы
//title();
//aut();


$pid = intval($_GET['pid']);

if (isset($_GET['go'])){
$curr=date("d.m.y / H:i");
$balls = 1;
$msg=$_POST['msg'];
$ank['id'];
if($ank==0){
msg ('user not found :(');
}else{if (isset($user) & $user['balls']<=$balls){
msg ('You dont have points :(');}else{
////////////////////
mysql_query("UPDATE `user` SET `balls` = '".($user['balls']-$balls)."' WHERE `id` = '$user[id]' LIMIT 1",$db);
mysql_query("UPDATE `user` SET `balls` = '".($ank['balls']+$balls)."' WHERE `id` = '$ank[id]' LIMIT 1");
////////////////////
mysql_query("INSERT INTO `fin_oper` (`user`, `oper`, `time`, `cena`) values('$user[id]', 'Posted present $balls KM  $ank[nick]', '$time', '$balls')",$db);
////////////////////
mysql_query("INSERT INTO `gifts` (`id_user`, `ot_id`, `text`, `time`, `id_gifts`) values('$ank[id]', '$user[id]', '$msg', '$time', '$pid')",$db);
////////////////////
$msgrat="Come to you got [url=/gifts.php?id=$ank[id]]some gift[/url] from $user[nick]!";
mysql_query("INSERT INTO `jurnal` (`id_user`, `id_kont`, `msg`, `time`) values('0', '$ank[id]', '$msgrat', '$time')");
msg ('Sending a gift is succesfully :)');
}}
include_once '../sys/inc/tfoot.php';}

echo"<br/><img src='/gifts/".$pid.".png' alt='' class='icon'/>";

echo "<form method=\"post\" action=\"gifts.php?p=send_gifts&id=$ank[id]&pid=".$_GET['pid']."&go\">";
echo "Receipent:<b> $ank[nick]</b><br/><br />\n";
echo "Your message:<br/>";
echo "<input type=\"text\" name=\"msg\" value=\"\"/><br />\r\n";
echo "<input class=\"button\" type=\"submit\" value=\"To present\" />";
echo "</form>\n";
echo'<small>Your account will be charged 1 point</small>';

include_once '../sys/inc/tfoot.php';
break;
}
$pod = (isset($_GET['pod'])) ? htmlspecialchars($_GET['pod']) : null;

$set['title']='Gifts';
include_once '../sys/inc/thead.php';
//title();
aut();


////////////

switch($pod) {
case '1':
echo "<img src='/gifts/1.png' width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=1\">Sandals</a><br/>";
echo "<img src='/gifts/24.png' width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=24\">Rose</a><br/>";
echo "<img src='/gifts/25.png' width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=25\">Tulips</a><br/>";
echo "<img src='/gifts/26.png' width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=26\">Strawberry</a><br/>";
echo "<img src='/gifts/5.png' width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=5\">Banana</a><br/>";
echo "<img src='/gifts/6.png' width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=6\">Birthday cream</a><br/>";
echo "<img src='/gifts/7.png' width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=7\">Money</a><br/>";
echo "<img src='/gifts/9.png' width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=9\">A Glass ice cream</a><br/>";
echo "<img src='/gifts/10.png' width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=10\">Snake</a><br/>";
echo "<img src='/gifts/30.png' width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=30\">Love flowers</a><br/>";
echo "<img src='/gifts/11.png' width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=11\">Sun flowers</a><br/>";
echo "<br /><a href=\"gifts.php?id=$ank[id]&pod=2\">Next&bull;&raquo;</a>\n";
break;
case '2':

echo "<img src='/gifts/12.png' width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=12\">Squirrel</a><br/>";
echo "<img src='/gifts/13.png' width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=13\">Eggs</a><br/>";
echo "<img src='/gifts/14.png' width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=14\">balons</a><br/>";
echo "<img src='/gifts/15.png' width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=15\">Fish</a><br/>";
echo "<img src='/gifts/16.png' width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=16\">Glass giraffe</a><br/>";
echo "<img src='/gifts/17.png' width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=17\">Fowl</a><br/>";
echo "<img src='/gifts/18.png' width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=18\">Cocka</a><br/>";
echo "<img src='/gifts/19.png' width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=19\">Rings</a><br/>";
echo "<img src='/gifts/20.png' width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=20\">Leafs</a><br/>";
echo "<img src='/gifts/21.png' width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=21\">Soda</a><br/>";
echo "<br /><a href=\"gifts.php?id=$ank[id]&pod=1\">&laquo;&bull;back</a> |\n";
echo "<a href=\"gifts.php?id=$ank[id]&pod=3\"> next&bull;&raquo;</a><br/>\n";

break;
case '3':

echo "<img src='/gifts/22.png' width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=22\">Green glass</a><br/>";
echo "<img src='/gifts/23.png' width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=23\">Cow dance</a><br/>";
echo "<img src='/gifts/2.png' width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=2\">Star</a><br/>";
echo "<img src='/gifts/3.png' width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=3\">squirrel2</a><br/>";
echo "<img src='/gifts/4.png' width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=4\">tissue</a><br/>";
echo "<img src='/gifts/27.png' width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=27\">Tank</a><br/>";
echo "<img src='/gifts/28.png' width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=28\">Shield</a><br/>";
echo "<img src='/gifts/29.png' width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gift&id=$ank[id]&p&id=29\">Title star</a><br/>";
echo "<img src='/gifts/8.png' width='45' height='45' alt=''> <a href=\"gifts.php?p=send_gifts&id=$ank[id]&pid=8\">Underpants</a><br/>";
echo "<br /><a href=\"gifts.php?id=$ank[id]&pod=2\">&laquo;&bull;back</a>\n";

break;

}



}else{
include_once '../sys/inc/thead.php';
$set['title']='Gifts Autorization'; // зaгoлoвoк cтpaницы
//title();
aut();
echo'Akses Closed please Register or login';}
include_once '../sys/inc/tfoot.php';
?>
