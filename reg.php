<?
//mod by wapid.org

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
include_once 'sys/inc/shif.php';
$show_all=true;
include_once 'sys/inc/user.php';
only_unreg();
$set['title']='Registration';
include_once 'sys/inc/thead.php';

if ($set['guest_select']=='1')msg("Access to the site is allowed only to authorized users");
if ((!isset($_SESSION['refer']) || $_SESSION['refer']==NULL)
&& isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER']!=NULL &&
!ereg('mail\.php',$_SERVER['HTTP_REFERER']))
$_SESSION['refer']=str_replace('&','&amp;',ereg_replace('^http://[^/]*/','/', $_SERVER['HTTP_REFERER']));


if ($set['reg_select']=='close')
{
$err='Registration suspended';
title();
err();

echo "<a href='/aut.php'>Login</a><br />\n";
include_once 'sys/inc/tfoot.php';
}
elseif($set['reg_select']=='open_mail' && isset($_GET['id']) && isset($_GET['activation']) && $_GET['activation']!=NULL)
{
if (mysql_result(mysql_query("SELECT COUNT(*) FROM `user` WHERE `id` = '".intval($_GET['id'])."' AND `activation` = '".my_esc($_GET['activation'])."'"),0)==1)
{

mysql_query("UPDATE `user` SET `activation` = null WHERE `id` = '".intval($_GET['id'])."' LIMIT 1");
$user=mysql_fetch_assoc(mysql_query("SELECT * FROM `user` WHERE `id` = '".intval($_GET['id'])."' LIMIT 1"));
mysql_query("INSERT INTO `reg_mail` (`id_user`,`mail`) VALUES ('$user[id]','$user[ank_mail]')");
msg('Your account has been successfully activated');

$_SESSION['id_user']=$user['id'];
include_once 'sys/inc/tfoot.php';
}
}

if (isset($_SESSION['step']) && $_SESSION['step']==1 && mysql_result(mysql_query("SELECT COUNT(*) FROM `user` WHERE `nick` = '".$_SESSION['reg_nick']."'"),0)==0 && isset($_POST['pass1']) && $_POST['pass1']!=NULL && $_POST['pass2'] && $_POST['pass2']!=NULL)
{

if ($set['reg_select']=='open_mail')
{
if (!isset($_POST['ank_mail']) || $_POST['ank_mail']==NULL)$err[]='Enter your valid email address';
elseif (!preg_match('#^[A-z0-9-\._]+@[A-z0-9]{2,}\.[A-z]{2,4}$#ui',$_POST['ank_mail']))$err[]='Email wrong!!!';
elseif(mysql_result(mysql_query("SELECT COUNT(*) FROM `reg_mail` WHERE `mail` = '".my_esc($_POST['ank_mail'])."'"),0)!=0)
{
$err[]="Users with this email is already registered";
}
}


if (strlen2($_POST['pass1'])<6)$err[]='For security reasons, the password must be longer than 6 characters';
if (strlen2($_POST['pass1'])>32)$err[]='The password lenght is more than 32 characters';
if ($_POST['pass1']!=$_POST['pass2'])$err[]='Paswords do not match';
if (!isset($_SESSION['captcha']) || !isset($_POST['chislo']) || $_SESSION['captcha']!=$_POST['chislo']){$err[]='Wrong verification number';}

if (!isset($err))
{
if ($set['reg_select']=='open_mail')
{
$activation=md5(passgen());
mysql_query("INSERT INTO `user` (`nick`, `pass`, `date_reg`, `date_last`, `pol`, `activation`, `ank_mail`) values('".$_SESSION['reg_nick']."', '".shif($_POST['pass1'])."', '$time', '$time', '".intval($_POST['pol'])."', '$activation', '".my_esc($_POST['ank_mail'])."')",$db);

$id_reg=mysql_insert_id();
$subject = "Account Activate";
$regmail = "Hi $_SESSION[reg_nick]<br />
To activate your account, go to:<br />
<a href='http://$_SERVER[HTTP_HOST]/reg.php?id=$id_reg&amp;activation=$activation'>http://$_SERVER[HTTP_HOST]/reg.php?id=".mysql_insert_id()."&amp;activation=$activation</a><br />
If your account not activated within 24 hours, Admin will be removed your account <br />
Sincerely, site administration<br />
";
$adds="From: \"admin@$_SERVER[HTTP_HOST]\" <admin@$_SERVER[HTTP_HOST]>\n";
//$adds = "From: <$set[reg_mail]>\n";
//$adds .= "X-sender: <$set[reg_mail]>\n";
$adds .= "Content-Type: text/html; charset=utf-8\n";
mail($_POST['ank_mail'],'=?utf-8?B?'.base64_encode($subject).'?=',$regmail,$adds);

}
else
mysql_query("INSERT INTO `user` (`nick`, `pass`, `date_reg`, `date_last`, `pol`, `ank_mail`) values('".$_SESSION['reg_nick']."', '".shif($_POST['pass1'])."', '$time', '$time', '".intval($_POST['pol'])."', '".my_esc($_POST['ank_mail'])."')",$db);


$uid=mysql_insert_id();
$fname=H."sys/dat/reg_mess.txt";
if(is_file($fname))
{
$reg_mess_arr=explode('|',file_get_contents($fname));
$reg_mess_on=$reg_mess_arr[0];
$reg_mess_text=$reg_mess_arr[1];

if($reg_mess_on)
{
$msg=mysql_escape_string($reg_mess_text);
$reg_mess_text=str_replace('{name}',$_SESSION['reg_nick'],$reg_mess_text);
mysql_query("INSERT INTO `konts` (`id_user`, `id_kont`, `time`) values('$uid', '2', '$time')");
mysql_query("INSERT INTO `konts_aut` (`id_user`, `id_kont`, `aut`) VALUES ('$uid','2', 'ok')");
mysql_query("INSERT INTO `mail` (`id_user`, `id_kont`, `msg`, `time`) values('2', '$uid', '$reg_mess_text', '$time')");
}
}

$user=mysql_fetch_assoc(mysql_query("SELECT * FROM `user` WHERE `nick` = '".my_esc($_SESSION['reg_nick'])."' AND `pass` = '".shif($_POST['pass1'])."' LIMIT 1"));

if (isset($_SESSION['http_referer']))
mysql_query("INSERT INTO `user_ref` (`time`, `id_user`, `type_input`, `url`) VALUES ('$time', '$user[id]', 'reg', '".my_esc($_SESSION['http_referer'])."')");

$_SESSION['id_user']=$user['id'];
setcookie('id_user', $user['id'], time()+60*60*24*365);
setcookie('pass', cookie_encrypt($_POST['pass1'],$user['id']), time()+60*60*24*365);
if ($set['reg_select']=='open_mail')
{
msg('You need to activate your account on the link sent to Email');
}
else
{
mysql_query("INSERT INTO `frends` (`user`, `frend`, `time`, `i`) values('$user[id]', '1', '$time', '1')");
mysql_query("INSERT INTO `frends` (`user`, `frend`, `time`, `i`) values('1', '$user[id]', '$time', '1')");
mysql_query("INSERT INTO `statuse_list` (`id_user`, `msg`, `time`, `kategori`) VALUES('$user[id]', '[time]joined on[/time] [url=http://loegue.tk]LoeGue[/url]', '$time', '1')");
mysql_query("UPDATE `user` SET `balls` = '".($user['balls']+1)."' WHERE `id` = '$user[id]' LIMIT 1");
mysql_query("OPTIMIZE TABLE `frends`, `statuse_list`, `balls`,");
msg('Registration was successfully');
}

//echo "Bookmark to autologin<br />\n";
//echo "<input type='text' value='http://$_SERVER[SERVER_NAME]/?id=$user[id]&amp;pass=".htmlspecialchars($_POST['pass1'])."' /><br />\n";
if ($set['reg_select']=='open_mail')unset($user);
echo "<div class='menu2'>";
echo "<a href='/avatar.php'>Upload Photo</a><br/><a href='/panel.php'>My Menu</a><br/><a href='/index.php'>Go to LoeGue</a>";
echo "</div>\n";
include_once 'sys/inc/tfoot.php';
}
}
elseif (isset($_POST['nick']) && $_POST['nick']!=NULL )
{
if (mysql_result(mysql_query("SELECT COUNT(*) FROM `user` WHERE `nick` = '".my_esc($_POST['nick'])."'"),0)==0)
{
$nick=my_esc($_POST['nick']);

if( !preg_match("#^([a-zA-Z0-9\-\_])+$#ui", $_POST['nick']))$err[]='Do not use a invalid characters!';

if (strlen2($nick)<3)$err[]='Short nickname';
if (strlen2($nick)>8)$err[]='Nick lenght exceeds 8 characters';
}
else $err[]='Nick "'.stripcslashes(htmlspecialchars($_POST['nick'])).'" already registered';


if (!isset($err)){
$_SESSION['reg_nick']=$nick;
$_SESSION['step']=1;
msg ("Nick \"$nick\" available, continue with registration?");
}
}
err();

if (isset($_SESSION['step']) && $_SESSION['step']==1){
echo "<div class='menu'>";
echo "<form method='post' action='/reg.php?$passgen'>\n";
echo "Username:<br /><input type='text' name='nick' maxlength='10' value='$_SESSION[reg_nick]' /><br />\n";
echo "<input type='submit' value='Change' />\n";
echo "</form><br />\n";
echo "<form method='post' action='/reg.php?$passgen'>\n";
echo "Sex:<br /><select name='pol'><option value='1'>Male</option><option value='0'>Female</option></select><br/><br/>\n";

if ($set['reg_select']=='open_mail')
{
echo "E-mail:<br /><input type='text' name='ank_mail' /><br/>\n";
echo "* Use a valid Email address.<br/><br/>\n";
}
if ($set['reg_select']!=='open_mail')
{
echo "E-mail:<br /><input class='input' type='text' name='ank_mail' /><br />";
echo "* Use a valid Email address.<br/><br/>\n";
}
echo "Password (6-8 char):<br /><input type='password' name='pass1' maxlength='8' /><br />\n";
echo "Repeat Password:<br /><input type='password' name='pass2' maxlength='10' /><br />\n";
echo "<img src='/captcha.php?$passgen&amp;SESS=$sess' width='100' height='30' alt='Chaptcha' /><br />\n<input name='chislo' size='5' maxlength='5' value='' type='text' /><br/>\n";
echo "<input type='submit' value='Continue' />\n";
echo "</form>";
echo "</div>";
}
else
{
switch(isset($_GET['act']))
{
case 'setuju' :
echo "<div class='menu'>";
echo "<form method='post' action='/reg.php?$passgen'>\n";
echo "Choose Username:<br /><input type='text' name='nick' maxlength='10' /><br />\n";
echo "<input type='submit' value='Continue' />\n";
echo "</form>";
echo "</div>";
break;
default :
echo "<div class='p_m'>";
echo "<div class='b'>";
echo "By registering, You are agree to the <a href='rules.php'>Rules</a> and Our <a href='terms.php'>Terms of Service</a>.<br/><br/><br/>";
echo '<a href="reg.php?act=setuju"><font color="#0084b5"><b>Agree</b></font></a> | <a href="index.php"><font color="red"><b>Disagree</b></font></a><br/>';
echo "</div>";
echo "</div>";
}
}
include_once 'sys/inc/tfoot.php';
?>
