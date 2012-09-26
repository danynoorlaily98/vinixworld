<?
include_once '../sys/inc/start.php';
include_once '../sys/inc/compress.php';
include_once '../sys/inc/sess.php';
include_once '../sys/inc/home.php';
include_once '../sys/inc/settings.php';
include_once '../sys/inc/db_connect.php';
include_once '../sys/inc/ipua.php';
include_once '../sys/inc/fnc.php';
include_once '../sys/inc/adm_check.php';
include_once '../sys/inc/user.php';
user_access('adm_rekl',null,'index.php?'.SID);
adm_check();
if (isset($_GET['sel']) && is_numeric($_GET['sel']) && $_GET['sel']>0 && $_GET['sel']<=4)
{
$sel=intval($_GET['sel']);
$set['title']='Advertising';
include_once '../sys/inc/thead.php';
title();

if (isset($_GET['add']) && isset($_POST['name']) && $_POST['name']!=NULL && isset($_POST['link']) && isset($_POST['img']) && isset($_POST['ch']) && isset($_POST['mn']))
{
$ch=intval($_POST['ch']);
$mn=intval($_POST['mn']);
$time_last=time()+$ch*$mn*60*60*24;

if (isset($_POST['dop_str']) && $_POST['dop_str']==1)
$dop_str=1;else $dop_str=0;


$link=stripcslashes(htmlspecialchars($_POST['link']));
$name=stripcslashes(htmlspecialchars($_POST['name']));
$img=stripcslashes(htmlspecialchars($_POST['img']));

mysql_query("INSERT INTO `rekl` (`time_last`, `name`, `img`, `link`, `sel`, `dop_str`) VALUES ('$time_last', '$name', '$img', '$link', '$sel', '$dop_str')");

msg('Advertising link added');


}
elseif (isset($_GET['set']) && mysql_result(mysql_query("SELECT COUNT(*) FROM `rekl` WHERE `sel` = '$sel' AND `id` = '".intval($_GET['set'])."'"),0)
&& isset($_POST['name']) && isset($_POST['link']) && isset($_POST['img']) && isset($_POST['ch']) && isset($_POST['mn']))
{
$rekl = mysql_fetch_assoc(mysql_query("SELECT * FROM `rekl` WHERE `sel` = '$sel' AND `id` = '".intval($_GET['set'])."' LIMIT 1"));
$ch=intval($_POST['ch']);
$mn=intval($_POST['mn']);
if ($rekl['time_last']>time())
$time_last=$rekl['time_last']+$ch*$mn*60*60*24;
else
$time_last=time()+$ch*$mn*60*60*24;

$link=stripcslashes(htmlspecialchars($_POST['link']));
$name=stripcslashes(htmlspecialchars($_POST['name']));
$img=stripcslashes(htmlspecialchars($_POST['img']));

if (isset($_POST['dop_str']) && $_POST['dop_str']==1)
$dop_str=1;else $dop_str=0;
mysql_query("UPDATE `rekl` SET `time_last` = '$time_last', `name` = '$name', `link` = '$link', `img` = '$img', `dop_str` = '$dop_str' WHERE `id` = '".intval($_GET['set'])."'");
msg('Advertising link added');

}
elseif (isset($_GET['del']) && mysql_result(mysql_query("SELECT COUNT(*) FROM `rekl` WHERE `sel` = '$sel' AND `id` = '".intval($_GET['del'])."'"),0))
{

mysql_query("DELETE FROM `rekl` WHERE `id` = '".intval($_GET['del'])."' LIMIT 1");
msg('Advertising link removed');


}
err();
//aut();

$k_post=mysql_result(mysql_query("SELECT COUNT(*) FROM `rekl` WHERE `sel` = '$sel'"),0);
$k_page=k_page($k_post,$set['p_str']);
$page=page($k_page);
$start=$set['p_str']*$page-$set['p_str'];
$q=mysql_query("SELECT * FROM `rekl` WHERE `sel` = '$sel' ORDER BY `time_last` DESC LIMIT $start, $set[p_str]");
echo "<table class='post'>\n";
if ($k_post==0)
{
echo "   <tr>\n";
echo "  <td class='p_t'>\n";
echo "No Advertising\n";
echo "  </td>\n";
echo "   </tr>\n";
}

while ($post = mysql_fetch_assoc($q))
{
echo "   <tr>\n";
echo "  <td class='p_t'>\n";
if ($post['img']==NULL)echo "$post[name]<br />\n"; else echo "<a href='$post[img]'>[Image]</a><br />\n";
if ($post['time_last']>time()) echo "(to ".vremja($post['time_last']).")\n";
else echo "(show time expired)\n";
echo "  </td>\n";
echo "   </tr>\n";
echo "   <tr>\n";
echo "  <td class='p_m'>\n";
echo "Link: $post[link]<br />\n";
if ($post['img']!=NULL)
echo "Pictures: $post[img]<br />\n";
if ($post['dop_str']==1)
echo "Refferals: $post[count]<br />\n";
echo "<a href='rekl.php?sel=$sel&amp;del=$post[id]&amp;page=$page'>Remove</a><br />\n";


if (isset($_GET['set']) && $_GET['set']==$post['id'])
{
echo "<form method='post' action='rekl.php?sel=$sel&amp;set=$post[id]&amp;page=$page'>\n";
echo "Link:<br />\n<input type=\"text\" name=\"link\" value=\"$post[link]\" /><br />\n";
echo "Title:<br />\n<input type=\"text\" name=\"name\" value=\"$post[name]\" /><br />\n";
echo "Picture:<br />\n<input type=\"text\" name=\"img\" value=\"$post[img]\" /><br />\n";

if ($post['time_last']>time())echo "Extend the:<br />\n";
else echo "Extend to:<br />\n";

echo "<input type=\"text\" name=\"ch\" size='3' value=\"0\" />\n";
echo "<select name=\"mn\">\n";
echo "  <option value=\"1\" selected='selected'>Days</option>\n";
echo "  <option value=\"7\">Weeks</option>\n";
echo "  <option value=\"31\">Months</option>\n";
echo "</select><br />\n";
if ($post['dop_str']==1)$dop=" checked='checked'";else $dop=NULL;
echo "<label><input type=\"checkbox\"$dop name=\"dop_str\" value=\"1\" /> Extra. Home</label><br />\n";
echo "<input value=\"Apply\" type=\"submit\" />\n";
echo "</form>\n";
echo "<a href='rekl.php?sel=$sel&amp;page=$page'>Cancel</a><br />\n";
}
else
echo "<a href='rekl.php?sel=$sel&amp;set=$post[id]&amp;page=$page'>Edit</a><br />\n";
echo "  </td>\n";
echo "   </tr>\n";
}

echo "</table>\n";
if ($k_page>1)str("rekl.php?sel=$sel&amp;",$k_page,$page); // Вывод страниц



echo "<form class='foot' method='post' action='rekl.php?sel=$sel&amp;add'>\n";
echo "Title:<br />\n<input type=\"text\" name=\"name\" value=\"\" /><br />\n";
echo "Link:<br />\n<input type=\"text\" name=\"link\" value=\"\" /><br />\n";

echo "Pictures:<br />\n<input type=\"text\" name=\"img\" value=\"\" /><br />\n";

echo "Durations:<br />\n";

echo "<input type=\"text\" name=\"ch\" size='3' value=\"1\" />\n";
echo "<select name=\"mn\">\n";
echo "  <option value=\"1\">Days</option>\n";
echo "  <option value=\"7\" selected='selected'>Weeks</option>\n";
echo "  <option value=\"31\">Months</option>\n";
echo "</select><br />\n";

echo "<label><input type=\"checkbox\" checked='checked' name=\"dop_str\" value=\"1\" /> Extras. Home</label><br />\n";
echo "<input value=\"Submit\" type=\"submit\" />\n";
echo "</form>\n";


echo "<div class='foot'>\n";
echo "<a href='rekl.php'>Cancel</a><br />\n";
if (user_access('adm_panel_show'))
echo "&laquo;<a href='/adm_panel/'>Admin Panel</a><br />\n";
echo "</div>\n";

include_once '../sys/inc/tfoot.php';
}
$set['title']='Advertising';
include_once '../sys/inc/thead.php';
title();

err();
//aut();

echo "<div class='menu'>\n";
echo "<a href='rekl.php?sel=1'>Under</a><br />\n";
echo "<a href='rekl.php?sel=2'>Main Menu</a><br />\n";
echo "<a href='rekl.php?sel=3'>The bottom of the site (main)</a><br />\n";
echo "<a href='rekl.php?sel=4'>The bottom of the site (the rest)</a><br />\n";

echo "<a href='rekl_select.php'>Dynamic Advertising</a><br />\n";
if ($set['rekl']=='mobiads')
echo "<a href='rekl_mobiads.php'>Advertising mobiads.ru</a><br />\n";
if ($set['rekl']=='wappc')
echo "<a href='rekl_wappc.php'>Advertising wappc.biz</a><br />\n";



echo "<a href='raiting.php'>Rating o5top.ru</a><br />\n";
echo "</div>\n";



if (user_access('adm_panel_show')){
echo "<div class='foot'>\n";
echo "&laquo;<a href='/adm_panel/'>Admin Panel</a><br />\n";
echo "</div>\n";
}

include_once '../sys/inc/tfoot.php';
?>
