<?php

// remodified by noe
// http://nnetwork.tk
// loegue.info@gmail.com
// dilarang menjual-belikan script ini
// hargailah privasi orang
// LISENSI.txt
// INSTALL.txt

include_once 'sys/inc/start.php';
include_once 'sys/inc/compress.php';
include_once 'sys/inc/sess.php';
include_once 'sys/inc/home.php';
include_once 'sys/inc/settings.php';
include_once 'sys/inc/db_connect.php';
include_once 'sys/inc/ipua.php';
include_once 'sys/inc/fnc.php';
include_once 'sys/inc/user.php';

if (isset($user))
{
$set['title']='Vinix World - Inicio';
}
include_once 'sys/inc/thead.php';
$statuse=mysql_fetch_array(mysql_query("select * from `statuse_list` where `id`='".intval($_GET['id'])."';"));

if (!$set['web']){
if (isset($_POST['msg']) && isset($user))
{
$msg=$_POST['msg'];
if (isset($_POST['translit']) && $_POST['translit']==1)$msg=translit($msg);
if (strlen2($msg)>5000){$err='Message is too long, max 5000 charackters';}
elseif (strlen2($msg)<2){$err='Message is too short!';}
elseif(mysql_result(mysql_query("SELECT COUNT(*) FROM `statuse_list` WHERE `id_user` = '$user[id]' AND `msg` = '".mysql_real_escape_string($msg)."' AND `time` > '".($time - 900)."' LIMIT 1"), 0)!= 0){$err='';}
else{
$msg=mysql_real_escape_string($msg);
mysql_query("INSERT INTO `statuse_list` (`id_user`, `name`, `msg`, `time`, `privat`) values('$user[id]', '$name', '$msg', '$time', '$privat')");
mysql_query("UPDATE `user` SET `balls` = '".($user['balls']+1)."' WHERE `id` = '$user[id]' LIMIT 1");
msg('<small><b>Tu estado ha sido actualizado</b></small>');
}
}
err();

if (isset($user))
{
include ('poke_inc.php');
echo userBirthday();
echo "<div class=\"penanda\"><div id=\"body\" class=\"kolom\"><form method=\"post\" id=\"composer_form\" name=\"message\" action=\"?\"><table class=\"comboInput\" cellpadding=\"0\" cellspacing=\"0\"><tbody><tr><td class=\"inputCell\"><textarea class=\"input composerInput\" name=\"msg\" rows=\"2\" cols=\"13\"></textarea></td><td><input value=\"Publicar\" class=\"btn btnC\" type=\"submit\"><br/><a href=\"/smiles/\">Emos</a><br/><a href=\"/bb-code.php\">BB-Code</a></td></tr></tbody></table></div></form></div></div>";
if (isset($_GET['sort']) && $_GET['sort'] =='t')$order='order by `time` desc';
elseif (isset($_GET['sort']) && $_GET['sort'] =='c') $order='order by `count` desc';
else $order='order by `time` desc';

if (!isset($_GET['top'])){
echo "<div class='penanda1'><a href='?top'><strong>Destacadas</strong></a> <strong>&#183; Mas Recientes</strong></div>";

$k_post=mysql_result(mysql_query("SELECT COUNT(*) FROM `statuse_list` WHERE `privat` = 0"),0);
$k_page=k_page($k_post,$set['p_str']);
$page=page($k_page);
$start=$set['p_str']*$page-$set['p_str'];
echo "<table class='post'>\n";


if($k_post==0)
{
echo "   <tr>\n";
echo "  <td class='p_t'>\n";
echo "Sin Actualizaciones!!!<br/>";
echo "  </td>\n";
echo "   </tr>\n";
}

include_once 'sys/inc/main_new.php';
echo "</table>\n";
}

else {echo "<strong>Destacadas &#183;</strong> <a href='?new'><strong>Mas Recientes</strong></a>";

$k_post=mysql_result(mysql_query("SELECT COUNT(*) FROM `statuse_list` WHERE `privat` = 0"),0);
$k_page=k_page($k_post,$set['p_str']);
$page=page($k_page);
$start=$set['p_str']*$page-$set['p_str'];
echo "<table class='post'>\n";
if($k_post==0)
{
echo "   <tr>\n";
echo "  <td class='p_t'>\n";
echo "Sin Actualizaciones !!!<br />";
echo "  </td>\n";
echo "   </tr>\n";
}

include_once 'sys/inc/main_top.php';
echo "</table>\n";
}
echo "<div class='str'><a href='/home.php?page=1'>Ver Mas</a></div>";
include_once "sys/inc/kenalan.php";
include_once "sys/inc/bookmark.php";
}
else
{

echo "<div class='login'>";
echo "<b>Bienvenid@s a VINIXWORLD</b><br/><br/>";
echo "</div><div class='blogin'>";
echo "<form method='post' action='/?$passgen'>\n";
echo "<font color='#808080'>Nick:</font><br /><input type='text' name='nick' size='20' maxlength='32' /><br/>\n";
echo "<font color='#808080'>Password:</font><br /><input type='password' name='pass' size='20' maxlength='32' /><input class='btn btnC' type='submit' value='Entrar' />\n";
echo "</form><br/>\n";
echo "<a href='/pass.php'>Olvidaste tu Password?</a><br/>";
echo "Aun no eres miembro? <a href='/reg.php'>Registrate</a><br/>\n";
echo "</div>\n";
echo "<div class='foot'></div><div id='footer'><div class='acg apm'><span class='mfss fcg'>";
echo "<a href='/aut.php'>Login Alternativo</a><br/>";
echo "<a href='/bantuan.php'>Ayuda</a><br/><br/>";
echo "Vinix World &copy; ".date("Y")." Vinix Media Group.<br/>\n";
echo "</span><br/>";
echo "</div></div>";
}
}

include_once 'sys/inc/tfoot.php';
?>
