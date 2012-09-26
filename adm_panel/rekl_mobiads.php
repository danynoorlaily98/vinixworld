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
user_access('adm_rekl',null,true);
adm_check();

$set['title']=' admob';
include_once '../sys/inc/thead.php';
title();
if (isset($_POST['mobiads_id']))
{
$temp_set['mobiads_id']=esc($_POST['mobiads_id']);
$temp_set['mobiads_top']=esc($_POST['mobiads_top']);
$temp_set['mobiads_middle']=esc($_POST['mobiads_middle']);
$temp_set['mobiads_bottom']=esc($_POST['mobiads_bottom']);
if (save_settings($temp_set))
msg('Pengaturan berhasil');
else
$err='Tidak ada izin untuk mengubah pengaturan file';
}
err();
//aut();

echo "<form method=\"post\" action=\"?\">\n";
echo "ADMOB ID:<br />\n<input name=\"mobiads_id\" value=\"$temp_set[mobiads_id]\" type=\"text\" /><br />\n";
echo "Iklan atas:<br />\n<input name=\"mobiads_top\" value=\"$temp_set[mobiads_top]\" type=\"text\" /><br />\n";
echo "Iklan tengah:<br />\n<input name=\"mobiads_middle\" value=\"$temp_set[mobiads_middle]\" type=\"text\" /><br />\n";
echo "Iklan bawah:<br />\n<input name=\"mobiads_bottom\" value=\"$temp_set[mobiads_bottom]\" type=\"text\" /><br />\n";
echo "<input value=\"Simpan\" type=\"submit\" />\n";
echo "</form>\n";



echo "Registrasi ID di situs <a target='_blank' href='http://www.admob.com'>ADMOB.COM</a><br />\n";
echo "* Untuk iklan di atas/tengah/bawah,isi \"Iklan atas\" dengan \"1\" ,jika tidak isi \"0\"<br />\n";
echo "<div class='foot'>\n";
echo "&laquo;<a href='/adm_panel/'>Admin Panel</a><br />\n";
echo "</div>\n";

include_once '../sys/inc/tfoot.php';
?>
