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
user_access('lic_info',null,'index.php?'.SID);
adm_check();
$set['title']='Сведения о лицензии';
include_once '../sys/inc/thead.php';
title();

if (isset($_POST['80']))
{
if (@file_get_contents("http://$set[http_license]/dcms/license.dcms?DCMS_HOST=http://".$_SERVER['HTTP_HOST']))
msg('80-й порт открыт');
else
$err[]='80-й порт закрыт или сайт DCMS.SU недоступен';
}

if (isset($_POST['get_lic']) && !$license)
{
admin_log('Лицензия','Сведения','Обновление сведений о лицензии');
lic_dcms();
if ($license)msg('Лицензия успешно получена');
else $err[]='Сведения о лицензии отсутствуют';
}
err();
//aut();

if ($license)
{
echo "<span class='on'>Лицензия: OK</span><br />\n";
if (isset($license['url']))echo "<span class='ank_n'>Адрес сайта:</span> <span class='ank_d'>$license[url]</span><br />\n";
if (isset($license['time']) && $license['time']!=null)echo "<span class='ank_n'>Дата выдачи:</span> <span class='ank_d'>".vremja($license['time'])."</span><br />\n";
if (isset($license['last_time']) && $license['last_time']!=null)echo "<span class='ank_n'>Посл. обновление:</span> <span class='ank_d'>".vremja($license['last_time'])."</span><br />\n";
if (isset($license['id_user']) && $license['id_user']!=null)echo "<span class='ank_n'>Плательщик:</span> <span class='ank_d'><a href='http://$set[http_license]/info.php?id=$license[id_user]'>$license[nick]</a></span><br />\n";
if (isset($license['R']) && $license['R']!=null)echo "<span class='ank_n'>Кошель:</span> <span class='ank_d'>R$license[R]</span><br />\n";
if (isset($license['wmr']) && $license['wmr']!=null)echo "<span class='ank_n'>Сумма:</span> <span class='ank_d'>$license[wmr] руб.</span><br />\n";
if (isset($license['tel']) && $license['tel']!=null)echo "<span class='ank_n'>Телефон:</span> <span class='ank_d'>$license[tel]</span><br />\n";
}
else
{
echo "<form method=\"post\" action=\"?$passgen\">\n";
echo "<span class='off'>Лицензия не активирована</span><br />\n";
echo "<br /><b>Что дает лицензия?</b><br />\n";
echo "1) Снятие копирайта (&copy;dcms.su) без нарушения авторских прав.<br />\n";
echo "2) Связь со службой поддержки через админку.<br />\n";
echo "3) Автоматическая загрузка и установка тем с dcms.su.<br />\n";
echo "4) Автоматическое обновление версии движка (по техническим причинам может быть невозможно).<br />\n";
echo "5) Финансовая поддержка проекта DCMS.<br />\n";


echo "<br /><b>WebMoney:</b><br />\n";
echo "Отправьте платеж 250 рублей на кошелек <b>R428849816208</b> или \$10 на кошелек <b>Z308551840797</b><br />\n";
echo "В комментарии к платежу необходимо указать <b>адрес сайта и свой ID на DCMS.SU</b><br />\n";

echo "При оплате через WebMoney активация происходит в течении суток.<br />\n";
echo "<br />\n";
echo "Лицензия активируется на 6 версию DCMS.<br />\n";
echo "<b>Система активации не предусматривает возврат средств.</b><br />\n";


echo "<br />Перед получением лицензии необходимо проверить 80-й порт<br />\n";
echo "<input value='Проверить 80-й порт' name='80' type=\"submit\" />\n";
echo "<input value='Проверить лицензию' name='get_lic' type=\"submit\" /><br />\n";

echo "</form>\n";
}


if (user_access('adm_panel_show')){
echo "<div class='foot'>\n";
echo "&laquo;<a href='/adm_panel/'>В админку</a><br />\n";
echo "</div>\n";
}

include_once '../sys/inc/tfoot.php';
?>
