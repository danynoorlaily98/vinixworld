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
include_once 'sys/inc/shif.php';
$show_all=true; // показ для всех
include_once 'sys/inc/user.php';
only_unreg();
$set['title']='Password Reset';
include_once 'sys/inc/thead.php';
//title();


if (isset($_POST['nick']) && isset($_POST['mail']) && $_POST['nick']!=NULL && $_POST['mail']!=NULL)
{
if (mysql_result(mysql_query("SELECT COUNT(*) FROM `user` WHERE `nick` = '".my_esc($_POST['nick'])."'"), 0)==0)
{
$err = "A user witf this login is not registered";
}
elseif (mysql_result(mysql_query("SELECT COUNT(*) FROM `user` WHERE `nick` = '".my_esc($_POST['nick'])."' AND `ank_mail` = '".my_esc($_POST['mail'])."'"), 0)==0)
{
$err ='Invalid email address or information about the email missing';
}
else
{
$q = mysql_query("SELECT * FROM `user` WHERE `nick` = '".my_esc($_POST['nick'])."' LIMIT 1");
$user2 = mysql_fetch_assoc($q);
$new_sess=substr(md5(passgen()), 0, 20);
$subject = "Password Recovery";
$regmail = "Hi $user2[nick],<br />
You have activated the password recovery prosess<br />
To install new password, go to:<br />
<a href='http://$_SERVER[HTTP_HOST]/pass.php?id=$user2[id]&amp;set_new=$new_sess'>http://$_SERVER[HTTP_HOST]/pass.php?id=$user2[id]&amp;set_new=$new_sess</a><br />
This link is valid until the first login using your login ($user2[nick])<br />
Sincerely, site administration<br />
";
$adds="From: \"password@$_SERVER[HTTP_HOST]\" <password@$_SERVER[HTTP_HOST]>\n";
//$adds = "From: <$set[reg_mail]>\n";
//$adds .= "X-sender: <$set[reg_mail]>\n";
$adds .= "Content-Type: text/html; charset=utf-8\n";
mail($user2['ank_mail'],'=?utf-8?B?'.base64_encode($subject).'?=',$regmail,$adds);

mysql_query("UPDATE `user` SET `sess` = '$new_sess' WHERE `id` = '$user2[id]' LIMIT 1");

msg("Link to install the new sent to the email \"$user2[ank_mail]\"");
}
}


if (isset($_GET['id']) && isset($_GET['set_new']) && strlen($_GET['set_new'])==20 &&
mysql_result(mysql_query("SELECT COUNT(*) FROM `user` WHERE `id` = '".intval($_GET['id'])."' AND `sess` = '".my_esc($_GET['set_new'])."'"), 0)==1)
{
$q = mysql_query("SELECT * FROM `user` WHERE `id` = '".intval($_GET['id'])."' LIMIT 1");
$user2 = mysql_fetch_assoc($q);

if (isset($_POST['pass1']) && isset($_POST['pass2']))
{
if ($_POST['pass1']==$_POST['pass2'])
{
if (strlen2($_POST['pass1'])<6)$err='For security reasons, the new password can not be shorter than 6 characters';
if (strlen2($_POST['pass1'])>32)$err='The password lenght is more than 32 characters';
}
else $err='The new password does not match confirmation';

if (!isset($err)){
setcookie('id_user', $user2['id'], time()+60*60*24*365);
mysql_query("UPDATE `user` SET `pass` = '".shif($_POST['pass1'])."' WHERE `id` = '$user2[id]' LIMIT 1");
setcookie('pass', cookie_encrypt($_POST['pass1'],$user2['id']), time()+60*60*24*365);
msg('Password successfully changed');
}
}




err();
//aut();


echo "<form action='/pass.php?id=$user2[id]&amp;set_new=".esc($_GET['set_new'],1)."&amp;$passgen' method=\"post\">\n";
echo "Username:<br />\n";
echo "<input type=\"text\" disabled='disabled' value='$user2[nick]' maxlength=\"32\" size=\"16\" /><br />\n";
echo "New Password:<br />\n<input type='password' name='pass1' value='' /><br />\n";
echo "Confirmation:<br />\n<input type='password' name='pass2' value='' /><br />\n";
echo "<input type='submit' name='save' value='Edit' />\n";
echo "</form>";

}
else
{
err();
//aut();

echo "<form action=\"?$passgen\" method=\"post\">\n";
echo "Nickname:<br/>";
echo "<input type=\"text\" name=\"nick\" title=\"Nick\" value=\"\" maxlength=\"32\" size=\"16\" /><br />\n";
echo "E-mail:<br />\n";
echo "<input type=\"text\" name=\"mail\" title=\"E-mail\" value=\"\" maxlength=\"32\" size=\"16\" /><br/>\n";
echo "<input class=\"button\" type=\"submit\" value=\"Next\" title=\"Next\" />";
echo "</form>";
echo "Password sent to your e-mail.<br/>";
echo "If you do not insert e-mail in your account, reset is impossible.<br/>";
}
echo "<a href='/aut.php'>Login</a><br/>";
echo "<a href='/reg.php'>Register</a><br/>";

include_once 'sys/inc/tfoot.php';
?>
