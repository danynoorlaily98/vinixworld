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
$set['title']='Shoutbox';
include_once '../sys/inc/thead.php';
title();
include 'admin_act.php';

if (isset($_POST['msg']) && isset($user))
{
$msg=$_POST['msg'];
if (isset($_POST['translit']) && $_POST['translit']==1)$msg=translit($msg);
if (strlen2($msg)>500){$err='Too long, max  500 characters';}
elseif (strlen2($msg)<2){$err='Too short';}
elseif (mysql_result(mysql_query("SELECT COUNT(*) FROM `shout` WHERE `id_user` = '$user[id]' AND `msg` = '".mysql_real_escape_string($msg)."' LIMIT 1"),0)!=0){$err='Pesan telah tersimpan sebelumnya';}
else{
$msg=mysql_real_escape_string($msg);
mysql_query("INSERT INTO `shout` (id_user, time, msg) values('$user[id]', '$time', '$msg')");
mysql_query("UPDATE `user` SET `balls` = '".($user['balls']+1)."' WHERE `id` = '$user[id]' LIMIT 1");
msg('Message saved');
}
}
err();
//aut(); // Formulir otorisasi
if (isset($user))
{
echo "<form method=\"post\" name='message' action=\"?\">\n";
echo "<a href='index.php?SESS=$sess'>Refresh</a>  <a href='/smiles.php'>Smiles</a>  <a href='/bb-code.php'>BB-Code</a><br />\n<textarea name=\"msg\"></textarea><br />\n";

echo "<input value=\"Send\" type=\"submit\" />\n";
echo "</form>\n";
$k_post=mysql_result(mysql_query("SELECT COUNT(*) FROM `shout`"),0);
$k_page=k_page($k_post,$set['p_str']);
$page=page($k_page);
$start=$set['p_str']*$page-$set['p_str'];
echo "<table class='post'>\n";
if ($k_post==0)
{
echo "   <tr>\n";
echo "  <td class='p_t'>\n";
echo "No message\n";
echo "  </td>\n";
echo "   </tr>\n";

}
$q=mysql_query("SELECT * FROM `shout` ORDER BY id DESC LIMIT $start, $set[p_str]");
while ($post = mysql_fetch_array($q))
{
$ank=get_user($post['id_user']);
echo "   <tr>\n";
if ($set['set_show_icon']==1){
echo "  <td class='icon14' rowspan='2'>\n";
avatar($ank['id']);
echo "  </td>\n";
}
elseif ($set['set_show_icon']==2)
{
echo "  <td class='icon14'>\n";
echo "<img src='/style/themes/$set[set_them]/user/$ank[pol].png' alt='' />";
echo "  </td>\n";
}


echo "  <td class='p_t'>\n";
echo "<a href='/info.php?id=$ank[id]'>$ank[nick]</a>".online($ank['id'])." (".vremja($post['time']).")\n";
echo "  </td>\n";
echo "   </tr>\n";
echo "   <tr>\n";
if ($set['set_show_icon']==1)echo "  <td class='p_m' colspan='2'>\n"; else echo "  <td class='p_m'>\n";
echo output_text($post['msg'])."<br />\n";

if (user_access('guest_delete'))
echo "<a href='delete.php?id=$post[id]'>Hapus</a><br />\n";
echo "  </td>\n";
echo "   </tr>\n";
}
echo "</table>\n";
if ($k_page>1)str('?',$k_page,$page); // Halaman output

include 'admin_form.php';
}
include_once '../sys/inc/tfoot.php';
?>
