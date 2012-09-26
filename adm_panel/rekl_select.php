<?
include_once '../sys/inc/start.php';
include_once '../sys/inc/compress.php';
include_once '../sys/inc/sess.php';
include_once '../sys/inc/home.php';
include_once '../sys/inc/settings.php';
$temp_set=$set;
include_once '../sys/inc/db_connect.php';
include_once '../sys/inc/ipua.php';
include_once '../sys/inc/fnc.php';
include_once '../sys/inc/adm_check.php';
include_once '../sys/inc/user.php';
user_access('adm_rekl',null,'index.php?'.SID);
adm_check();

$set['title']='Select Dynamic Advertising';
include_once '../sys/inc/thead.php';
title();
if (isset($_POST['save']))
{

$temp_set['rekl']=esc($_POST['rekl']);


if (save_settings($temp_set))
msg('Pengaturan sukses');
else
$err='Tidak ada hak untuk mengubah pengaturan';
}
err();
//aut();



echo "<form method=\"post\" action=\"?\">\n";

echo "Iklan dinamis:<br />\n<select name=\"rekl\">\n";
echo "<option value=\"\">Tidak</option>\n";
if ($temp_set['rekl']=='wappc')$sel=' selected="selected"';else $sel=NULL;
echo "<option value=\"wappc\"$sel>WAPPC.BIZ</option>\n";
if ($temp_set['rekl']=='mobiads')$sel=' selected="selected"';else $sel=NULL;
echo "<option value=\"mobiads\"$sel>ADMOB.COM</option>\n";
echo "</select><br />\n";

echo "<input value=\"Select\" name='save' type=\"submit\" />\n";
echo "</form>\n";

if ($temp_set['rekl']=='mobiads')
echo "<a href='rekl_mobiads.php'>admob.com</a><br />\n";
if ($temp_set['rekl']=='wappc')
echo "<a href='rekl_wappc.php'>wappc.biz</a><br />\n";

echo "<div class='foot'>\n";

echo "&laquo;<a href='/adm_panel/rekl.php'>Daftar iklan</a><br />\n";
if (user_access('adm_panel_show'))
echo "&laquo;<a href='/adm_panel/'>Admin Panel</a><br />\n";
echo "</div>\n";

include_once '../sys/inc/tfoot.php';
?>
