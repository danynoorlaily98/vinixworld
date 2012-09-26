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

$set['title']='Реклама WAPPC.BIZ';
include_once '../sys/inc/thead.php';
title();


if (isset($_POST['wappc_id']) && isset($_POST['wappc_num_links']))
{
$temp_set['wappc_id']=esc($_POST['wappc_id'],1);
$temp_set['wappc_pwdtech']=esc($_POST['wappc_pwdtech'],1);
$temp_set['wappc_num_links']=intval($_POST['wappc_num_links']);
if (save_settings($temp_set))
msg('Настройки успешно приняты');
else
$err='Нет прав для изменения файла настроек';
}
err();
//aut();

echo "<form method=\"post\" action=\"?\">\n";

echo "ID клиента:<br />\n<input name='wappc_id' value='$temp_set[wappc_id]' type='text' /><br />\n";
echo "Технический пароль:<br />\n<input name='wappc_pwdtech' value='$temp_set[wappc_pwdtech]' type='text' /><br />\n";
echo "Количество ссылок (1-5):<br />\n<input name='wappc_num_links' value='$temp_set[wappc_num_links]' type='text' /><br />\n";
echo "<input value='Изменить' type='submit' />\n";
echo "</form>\n";



echo "Регистрация своего ID на сайте <a target='_blank' href='http://wappc.biz/partner.php?uid=5408'>wappc.biz</a><br />\n";
echo "* Для удаления рекламы в поле \"Количество ссылок\" поставьте \"0\"<br />\n";

if ($set['rekl']!='wappc')
echo "** <b>Для использования рекламы, ее необходимо выбрать в <a href='rekl_select.php'>настройках</a></b><br />\n";

echo "<div class='foot'>\n";
echo "&laquo;<a href='/adm_panel/rekl.php'>Реклама</a><br />\n";
if (user_access('adm_panel_show'))
echo "&laquo;<a href='/adm_panel/'>В админку</a><br />\n";
echo "</div>\n";

include_once '../sys/inc/tfoot.php';
?>
