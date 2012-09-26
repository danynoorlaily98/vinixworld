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
only_reg();


if ((!isset($_SESSION['refer']) || $_SESSION['refer']==NULL)
&& isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER']!=NULL &&
!ereg('mail\.php',$_SERVER['HTTP_REFERER']))
$_SESSION['refer']=str_replace('&','&amp;',ereg_replace('^http://[^/]*/','/', $_SERVER['HTTP_REFERER']));
if (isset($_GET['id']) && mysql_result(mysql_query("SELECT COUNT(*) FROM `user` WHERE `id` = '".intval($_GET['id'])."'"),0)==1)
{



$ank=mysql_fetch_assoc(mysql_query("SELECT * FROM `user` WHERE `id` = ".intval($_GET['id'])." LIMIT 1"));
$set['title']='Privado: '.$ank['nick'];
include_once 'sys/inc/thead.php';
//title();


mysql_query("UPDATE `mail` SET `read` = '1' WHERE `id_kont` = '$user[id]' AND `id_user` = '$ank[id]' AND `read` = '0'");
if (isset($_POST['msg']))
{
$msg=$_POST['msg'];
if (isset($_POST['translit']) && $_POST['translit']==1)$msg=translit($msg);
if (strlen2($msg)>1024)$err='Max message 1024 characters';
if (strlen2($msg)<2)$err='Min message 2 characters';
if (!isset($err) && mysql_result(mysql_query("SELECT COUNT(*) FROM `mail` WHERE `id_user` = '$user[id]' AND `id_kont` = '$ank[id]' AND `msg` = '".mysql_escape_string($msg)."' LIMIT 1"),0)==0)
{

if (mysql_result(mysql_query("SELECT COUNT(*) FROM `konts` WHERE `id_user` = '$ank[id]' AND `id_kont` = '$user[id]'"), 0)==0)
{
mysql_query("INSERT INTO `konts` (`id_kont`, `id_user`, `time`) values('$user[id]', '$ank[id]', '$time')");

}
$msg=mysql_escape_string($msg);
mysql_query("INSERT INTO `mail` (`id_user`, `id_kont`, `msg`, `time`) values('$user[id]', '$ank[id]', '$msg', '$time')");
mysql_query("UPDATE `konts` SET `time` = '$time' WHERE `id_user` = '$user[id]' AND `id_kont` = '$ank[id]' OR `id_user` = '$ank[id]' AND `id_kont` = '$user[id]'");
msg('Message has been sent');

//mysql_query("UPDATE `user` SET `balls` = '".($user['balls']+1)."' WHERE `id` = '$user[id]' LIMIT 1");
}
}


if ($user['id']!=$ank['id'] && mysql_result(mysql_query("SELECT COUNT(*) FROM `konts` WHERE `id_user` = '$user[id]' AND `id_kont` = '$ank[id]'"), 0)==0)
{
mysql_query("INSERT INTO `konts` (`id_user`, `id_kont`, `time`) values('$user[id]', '$ank[id]', '$time')");
msg("\"$ank[nick]\" added to your contact");
}
err();
$rid = $_SESSION["rid"];
echo "<form method=\"post\" name='message' action=\"mail.php?id=$ank[id]&amp;rid=$rid\">\n";


if ($set['web'] && is_file(H.'style/themes/'.$set['set_them'].'/altername_post_form.php'))
include_once H.'style/themes/'.$set['set_them'].'/altername_post_form.php';
else
echo "<div class='search'>";
echo "Mensaje:<br />\n<textarea name=\"msg\"></textarea><br />\n";
//if ($user['set_translit']==1)echo "<input type=\"checkbox\" name=\"translit\" value=\"1\" /> Translate<br />\n";


echo "<input class=\"btn btnC\" value=\"Enviar\" type=\"submit\" />\n";
echo "</form>\n";
echo "</div>";
echo "<table class='post'>\n";
$k_post=mysql_result(mysql_query("SELECT COUNT(*) FROM `mail` WHERE `id_user` = '$user[id]' AND `id_kont` = '$ank[id]' OR `id_user` = '$ank[id]' AND `id_kont` = '$user[id]'"),0);
$k_page=k_page($k_post,$set['p_str']);
$page=page($k_page);
$start=$set['p_str']*$page-$set['p_str'];
if ($k_post==0)
{
echo "   <tr>\n";
echo "  <td class='p_t'>\n";
echo "Sin Mensajes\n";
echo "  </td>\n";
echo "   </tr>\n";

}
$q=mysql_query("SELECT * FROM `mail` WHERE `id_user` = '$user[id]' AND `id_kont` = '$ank[id]' OR `id_user` = '$ank[id]' AND `id_kont` = '$user[id]' ORDER BY id DESC LIMIT $start, $set[p_str]");
while ($post = mysql_fetch_assoc($q))
{
$ank2=mysql_fetch_assoc(mysql_query("SELECT * FROM `user` WHERE `id` = $post[id_user] LIMIT 1"));

echo "   <tr>\n";
if ($set['set_show_icon']==2){
echo "  <td class='icon14' rowspan='2'>\n";
avatar($ank2['id']);
echo "  </td>\n";
}
elseif ($set['set_show_icon']==1)
{
echo "  <td class='icon14' rowspan='2'>\n";
avatar($ank2['id']);

echo "  </td>\n";
}



echo "  <td class='p_t'>\n";
echo "<a href=\"/info.php?id=$ank2[id]\">$ank2[nick]</a>".online($ank2['id'])."\n";
echo "(".vremja($post['time']).")\n";
echo "  </td>\n";
echo "   </tr>\n";


echo "   <tr>\n";
if ($set['set_show_icon']==1)echo "  <td class='p_m' colspan='2'>\n"; else echo "  <td class='p_m'>\n";
if ($post['read']==0)echo "(Nuevo)<br />\n";
echo output_text($post['msg'])."\n";
echo "  </td>\n";
echo "   </tr>\n";


}
echo "</table>\n";
if ($k_page>1)str("mail.php?id=$ank[id]&amp;",$k_page,$page); // Вывод страниц


echo "<a href=\"/mail.php?delete=$ank[id]\">Eliminar Amigo</a><br />\n";
echo "<a href=\"/mail.php\">Contactar</a><br />\n";


echo "<div class='foot'>\n";
//if(isset($_SESSION['refer']) && $_SESSION['refer']!=NULL && otkuda($_SESSION['refer']))
//echo "&laquo;<a href='$_SESSION[refer]'>".otkuda($_SESSION['refer'])."</a><br />\n";
if($rid>0)echo "<a href='/chat/room/$rid/".rand(1000,9999)."/'>Volver a la Sala</a><br />\n";
echo "<a href='umenu.php'>Mi Menu</a><br />\n";
echo "</div>\n";
include_once 'sys/inc/tfoot.php';
}


$set['title']='Contactar';
include_once 'sys/inc/thead.php';
//title();
if (isset($_GET['delete']) && is_numeric($_GET['delete']))
{
mysql_query("UPDATE `mail` SET `read` = '1' WHERE `id_kont` = '$user[id]' AND `id_user` = '".intval($_GET['delete'])."' AND `read` = '0'");
mysql_query("DELETE FROM `konts` WHERE `id_user` = '$user[id]' AND `id_kont` = '".intval($_GET['delete'])."' LIMIT 1");
if (mysql_result(mysql_query("SELECT COUNT(*) FROM `konts` WHERE `id_kont` = '$user[id]' AND `id_user` = '".intval($_GET['delete'])."'"),0)==0)
{
mysql_query("DELETE FROM `mail` WHERE `id_kont` = '$user[id]' AND `id_user` = '".intval($_GET['delete'])."' OR `id_user` = '$user[id]' AND `id_kont` = '".intval($_GET['delete'])."'");
mysql_query("OPTIMIZE TABLE `mail`");
}
mysql_query("OPTIMIZE TABLE `konts`");
msg('Contact has been deleted');
}



echo "<table class='post'>\n";

$k_konts=mysql_result(mysql_query("SELECT COUNT(*) FROM `konts` WHERE `id_user` = '$user[id]'"), 0);
if ($k_konts==0)
{
echo "   <tr>\n";
echo "  <td class='p_t'>\n";
echo "No message\n";
echo "  </td>\n";
echo "   </tr>\n";

}

$k_page=k_page($k_konts,$set['p_str']);
$page=page($k_page);
$start=$set['p_str']*$page-$set['p_str'];
$q = mysql_query("SELECT * FROM `konts` WHERE `id_user` = '$user[id]' ORDER BY `time` DESC LIMIT $start, $set[p_str]");
while ($konts = mysql_fetch_assoc($q))
{
$ank=mysql_fetch_assoc(mysql_query("SELECT * FROM `user` WHERE `id` = $konts[id_kont] LIMIT 1"));

echo "   <tr>\n";
if ($set['set_show_icon']==2){
echo "  <td class='icon14' rowspan='2'>\n";
avatar($ank['id']);
echo "  </td>\n";
}
elseif ($set['set_show_icon']==1)
{
echo "  <td class='icon14' rowspan='2'>\n";
avatar($ank2['id']);
//echo "  <td class='icon14'>\n";
//echo "<img src='/style/themes/$set[set_them]/user/$ank[pol].png' alt='' />";
echo "  </td>\n";
}
echo "  <td class='p_t'>\n";
echo "<a href=\"/mail.php?id=$ank[id]\">$ank[nick]</a>".online($ank['id'])."\n";
echo '('.mysql_result(mysql_query("SELECT COUNT(*) FROM `mail` WHERE `id_kont` = '$user[id]' AND `id_user` = '$ank[id]' AND `read` = '0'"), 0);
echo '/';
echo mysql_result(mysql_query("SELECT COUNT(*) FROM `mail` WHERE `id_user` = '$user[id]' AND `id_kont` = '$ank[id]' OR `id_user` = '$ank[id]' AND `id_kont` = '$user[id]'"), 0).')';
echo "\n  </td>\n";
echo "   </tr>\n";

echo "   <tr>\n";
if ($set['set_show_icon']==1)echo "  <td class='p_m' colspan='2'>\n"; else echo "  <td class='p_m'>\n";
echo "<a href=\"/info.php?id=$ank[id]\">Ver Perfil</a><br />\n";
echo "<a href=\"/mail.php?delete=$ank[id]\">Eliminar Amigo</a><br />\n";
echo "  </td>\n";
echo "   </tr>\n";


}

echo "</table>\n";


if ($k_page>1)str("mail.php?",$k_page,$page); // Вывод страниц

//echo "<div class='foot'>\n";
//if(isset($_SESSION['refer']) && $_SESSION['refer']!=NULL && otkuda($_SESSION['refer']))
//echo "&laquo;<a href='$_SESSION[refer]'>".otkuda($_SESSION['refer'])."</a><br />\n";
//echo "<a href='umenu.php'>My Menu</a><br />\n";
//echo "</div>\n";
include_once 'sys/inc/tfoot.php';
?>
