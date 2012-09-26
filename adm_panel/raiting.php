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
$set['title']='Рейтинг o5top.ru';
include_once '../sys/inc/thead.php';
title();

err();
//aut();

if ($_SERVER["SERVER_ADDR"]=='127.0.0.1')
{
echo "Использование данной функции невозможно на локальном сервере<br />\n";
echo "<div class='foot'>\n";
echo "&laquo;<a href='rekl.php'>Вся реклама</a><br />\n";
if (user_access('adm_panel_show'))
echo '&laquo;<a href="/adm_panel/">В админку</a><br />';
echo "</div>\n";
include_once '../sys/inc/tfoot.php';
}



$rai_url='o5top.ru';
$iss=file_get_contents('../sys/dat/raiting.dat');
$iss=explode('{:}',$iss);
if(intval($iss[0])==0)
{
$txt=file_get_contents('http://'.$rai_url.'/reg_dcms.php?'.$_SERVER['QUERY_STRING']);
$txt_arr=explode('{:}',$txt);

if($txt_arr[0]==0)
{
echo str_replace('http_url','http://'.$_SERVER['HTTP_HOST'],$txt_arr[1]);
}else
if($txt_arr[0]==1)
{
$email=esc(stripcslashes(htmlspecialchars($_GET['email'])));
$pass=esc(stripcslashes(htmlspecialchars($_GET['pass_1'])));

$f=fopen('../sys/dat/raiting.dat','w');
fwrite($f,$txt_arr[1].'{:}'.$email.'{:}'.$pass);
fclose($f);

echo 'Регистрация прошла успешно, <br />
ваш id:'.$txt_arr[1].'<br />
e-mail: '.$email.'<br />
пароль: '.$pass.'<br />
Счетчик рейтинга автоматически установлен на страницах сайта<br />';
}
}else{
echo '<b>Ваши данные в рейтинге '.$rai_url.':</b><br />
id: '.$iss[0].'<br />
e-mail: '.$iss[1].'<br />
пароль: '.$iss[2].'<br />';
}
echo "<div class='foot'>\n";
echo "&laquo;<a href='rekl.php'>Вся реклама</a><br />\n";
if (user_access('adm_panel_show'))
echo '&laquo;<a href="/adm_panel/">В админку</a><br />';
echo "</div>\n";
include_once '../sys/inc/tfoot.php';
?>
