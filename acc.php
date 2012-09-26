<?

// Translated by : zanger
// Site : http://www.frendzmobile.co.cc

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
include_once 'sys/inc/user.php';
only_reg();
$set['title']='Account';
include_once 'sys/inc/thead.php';
if (isset($_POST['save'])){

if (isset($_POST['set_show_mail']) && $_POST['set_show_mail']==1)
{
$user['set_show_mail']=1;
mysql_query("UPDATE `user` SET `set_show_mail` = '1' WHERE `id` = '$user[id]' LIMIT 1");
}
else
{
$user['set_show_mail']=0;
mysql_query("UPDATE `user` SET `set_show_mail` = '0' WHERE `id` = '$user[id]' LIMIT 1");
}
if (isset($_POST['ank_n_tel']) && (is_numeric($_POST['ank_n_tel']) && strlen($_POST['ank_n_tel'])>=5 && strlen($_POST['ank_n_tel'])<=13 || $_POST['ank_n_tel']==NULL))
{
$user['ank_n_tel']=$_POST['ank_n_tel'];
mysql_query("UPDATE `user` SET `ank_n_tel` = '$user[ank_n_tel]' WHERE `id` = '$user[id]' LIMIT 1");
}
else $err[]='Invalid number';

if (isset($_POST['ank_mail']) && ($_POST['ank_mail']==null || preg_match('#^[A-z0-9-\._]+@[A-z0-9]{2,}\.[A-z]{2,4}$#ui',$_POST['ank_mail'])))
{
$user['ank_mail']=$_POST['ank_mail'];
mysql_query("UPDATE `user` SET `ank_mail` = '$user[ank_mail]' WHERE `id` = '$user[id]' LIMIT 1");
}
else $err[]='invalid E-mail format';

if (!isset($err))msg('Your account has been update');
}
err();
echo "<a href='/settings.php'>Settings</a> &#183; <b>Account</b>";
echo "<div class='penanda'>My account email</div>";
echo "<form method='post' action='?$passgen'>\n";

echo "<font color='#808080'>E-mail:</font><br />\n<input type='text' name='ank_mail' value='$user[ank_mail]' maxlength='32' /><br />\n";

echo "<label><input type=\"checkbox\" name=\"set_show_mail\"".($user['set_show_mail']==1?' checked="checked"':null)." value=\"1\" />Show E-mail</label><br />\n";
echo "<div class='penanda'>Add an additional phone number</div>";
echo "<font color='#808080'>Phone number:</font><br />\n<input type='text' name='ank_n_tel' value='$user[ank_n_tel]' maxlength='13' /><br />\n";

echo "<input class='button' type='submit' name='save' value='Save' />\n";
echo "</form>\n";
echo "Password <a href='/secure.php'>Change password</a><br/>";
include_once 'sys/inc/tfoot.php';
?>
