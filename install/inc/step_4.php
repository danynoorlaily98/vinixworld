<?
$set['title']='Pendaftaran Administrator';
include_once 'inc/head.php'; // верхняя часть темы оформления

if (!isset($_SESSION['shif']))$_SESSION['shif']=$passgen;

$set['shif']=$_SESSION['shif'];

$db=mysql_connect($_SESSION['host'], $_SESSION['user'],$_SESSION['pass']);
mysql_select_db($_SESSION['db'],$db);
mysql_query('set charset utf8'); 
mysql_query('SET names utf8'); 
mysql_query('set character_set_client="utf8"');
mysql_query('set character_set_connection="utf8"'); 
mysql_query('set character_set_result="utf8"');



if (isset($_SESSION['adm_reg_ok']) && $_SESSION['adm_reg_ok']==true)
{
if(isset($_GET['step']) && $_GET['step']=='5')
{


$tmp_set['title']=strtoupper($_SERVER['HTTP_HOST']).' - Главная';
$tmp_set['mysql_host']=$_SESSION['host'];
$tmp_set['mysql_user']=$_SESSION['user'];
$tmp_set['mysql_pass']=$_SESSION['pass'];
$tmp_set['mysql_db_name']=$_SESSION['db'];
$tmp_set['shif']=$_SESSION['shif'];

if (save_settings($tmp_set))
{




unset($_SESSION['install_step'],$_SESSION['host'],$_SESSION['user'],$_SESSION['pass'],$_SESSION['db'],$_SESSION['adm_reg_ok'],$_SESSION['mysql_ok']);
if ($_SERVER["SERVER_ADDR"]!='127.0.0.1')delete_dir(H.'install/');
header ("Location: /index.php?".SID);
exit;


}
else $msg['Unable to save the system settings'];



}
}
elseif (isset($_POST['reg']))
{

// проверка ника
if (!isset($_POST['nick']) || $_POST['nick']==null)$err[]='Enter Nickname';
elseif (ereg("\=|\+|\{|\}|\(|\)|\^|\%|\\$|#|@|!|&|\~|'|\"|:|;|`|,|\.|\?|<|>",$_POST['nick']))$err[]='In the nickname there are invalid characters';
else{
if (strlen2($_POST['nick'])<3)$err[]='Minimal 3 characters';
elseif (strlen2($_POST['nick'])>8)$err[]='Maximal 8 character';
elseif (mysql_result(mysql_query("SELECT COUNT(*) FROM `user` WHERE `nick` = '".mysql_real_escape_string($_POST['nick'])."' LIMIT 1"),0)!=0)
$err[]='Chosen nickname is already occupied by another user';
else $nick=$_POST['nick'];
}
// проверка пароля
if (!isset($_POST['password']) || $_POST['password']==null)$err[]='Enter Password';
else{
if (strlen2($_POST['password'])<6)$err[]='Minimal 6 characters';
elseif (strlen2($_POST['password'])>16)$err[]='Maximal 16 characters';
elseif (!isset($_POST['password_retry']))$err[]='Enter the confirmation password';
elseif ($_POST['password']!==$_POST['password_retry'])$err[]='Password do not match';
else $password=$_POST['password'];
}


if (!isset($_POST['pol']) || !is_numeric($_POST['pol']) || ($_POST['pol']!=='0' && $_POST['pol']!=='1'))$err[]='Error when choosing gender';
else $pol=intval($_POST['pol']);



if (!isset($err)) // если нет ошибок
{


mysql_query("INSERT INTO `user` (`nick`, `pass`, `date_reg`, `date_aut`, `date_last`, `pol`, `level`, `group_access`, `balls`)
VALUES('$nick', '".shif($password)."', $time, $time, $time, '$pol', '4', '15', '500')");



$user=mysql_fetch_assoc(mysql_query("SELECT * FROM `user` WHERE `nick` = '$nick' AND `pass` = '".shif($password)."' LIMIT 1"));

$q=mysql_query("SELECT `type` FROM `accesses`");
while ($ac = mysql_fetch_assoc($q))
{
mysql_query("INSERT INTO `user_acсess` (`id_user`, `type`) VALUES ('$user[id]','$ac[type]')");
}



$_SESSION['id_user']=$user['id'];
setcookie('id_user', $user['id'], time()+60*60*24*365);
setcookie('pass', cookie_encrypt($password,$user['id']), time()+60*60*24*365);

$_SESSION['adm_reg_ok']=true;
}


}



if (isset($_SESSION['adm_reg_ok']) && $_SESSION['adm_reg_ok']==true)
{
echo "<div class='msg'>Pendaftaran Administrator berhasil</div>\n";

if (isset($msg))
{
foreach ($msg as $key=>$value) {
echo "<div class='msg'>$value</div>\n";
}
}
echo "<hr />\n";
echo "<form method=\"get\" action=\"index.php\">\n";
echo "<input name='gen' value='$passgen' type='hidden' />\n";
echo "<input name=\"step\" value=\"".($_SESSION['install_step']+1)."\" type=\"hidden\" />\n";
echo "<input value='Cepat bro installasi' type=\"submit\" />\n";
echo "</form>\n";
echo "* Sesudah installasi agar menjaga data akun hilangkan berkas /install/<br />\n";
}
else
{

if (isset($err))
{
foreach ($err as $key=>$value) {
echo "<div class='err'>$value</div>\n";
}
echo "<hr />\n";
}


echo "<form action='index.php?$passgen' method='post'>\n";
echo "Nama (3-8 characters):<br />\n<input type='text' name='nick'".((isset($nick))?" value='".$nick."'":" value='ADMIN'")." maxlength='16' /><br />\n";
echo "Kata Sandi (6-16 Characters):<br />\n<input type='password'".((isset($password))?" value='".$password."'":null)." name='password' maxlength='16' /><br />\n";
echo "* Gunakan kata sandi yang sulit tapi mudah di ingat agar menjaga dari kejahatan hackers<br />\n";
echo "Konfirm Kata Sandi:<br />\n<input type='password'".((isset($password))?" value='".$password."'":null)." name='password_retry' maxlength='16' /><br />\n";


echo "Jenis Kelamin:<br />\n";
echo "<select name='pol'>\n";
echo "<option value='1'".((isset($pol) && $pol===1)?" selected='selected'":null).">Pria</option>\n";
echo "<option value='0'".((isset($pol) && $pol===0)?" selected='selected'":null).">Wanita</option>\n";
echo "</select><br />\n";


echo "* Semua bidang di perlukan<br />\n";
echo "<input type='submit' name='reg' value='Pancal' /><br />\n";
echo "</form>\n";
}
echo "<hr />\n";
echo "<b>Step: $_SESSION[install_step]</b>\n";

include_once 'inc/foot.php'; // нижняя часть темы оформления
?>