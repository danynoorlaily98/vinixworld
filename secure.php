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
include_once 'sys/inc/user.php';

only_reg();
$set['title']='Safety';
include_once 'sys/inc/thead.php';
title();
if (isset($_POST['save'])){

if (isset($_POST['pass']) && mysql_result(mysql_query("SELECT COUNT(*) FROM `user` WHERE `id` = $user[id] AND `pass` = '".shif($_POST['pass'])."' LIMIT 1"), 0)==1)
{
if (isset($_POST['pass1']) && isset($_POST['pass2']))
{
if ($_POST['pass1']==$_POST['pass2'])
{
if (strlen2($_POST['pass1'])<6)$err='For security reasons the new password can not be shorter than 6 characters';
if (strlen2($_POST['pass1'])>32)$err='The password length is more than 32 characters';
}
else $err='The new password does nor match confirmation';
}
else $err='Enter a new password';
}
else $err='Old password is incorrect';



if (!isset($err))
{
mysql_query("UPDATE `user` SET `pass` = '".shif($_POST['pass1'])."' WHERE `id` = '$user[id]' LIMIT 1");
setcookie('pass', cookie_encrypt($_POST['pass1'],$user['id']), time()+60*60*24*365);
msg('Password successfuly changed');
}

}
err();
//aut();
echo "<form method='post' action='?$passgen'>\n";

echo "Old Password:<br />\n<input type='text' name='pass' value='' /><br />\n";
echo "New Password:<br />\n<input type='password' name='pass1' value='' /><br />\n";
echo "Confirmation:<br />\n<input type='password' name='pass2' value='' /><br />\n";
echo "<input type='submit' name='save' value='Save' />\n";
echo "</form>\n";


echo "<div class='foot'>\n";
//if(isset($_SESSION['refer']) && $_SESSION['refer']!=NULL && otkuda($_SESSION['refer']))
//echo "&laquo;<a href='$_SESSION[refer]'>".otkuda($_SESSION['refer'])."</a><br />\n";
echo "<a href='umenu.php'>Back</a><br />\n";
echo "</div>\n";
include_once 'sys/inc/tfoot.php';
?>
