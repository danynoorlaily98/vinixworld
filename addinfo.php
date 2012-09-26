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
include_once 'sys/inc/user.php';
only_reg();
$set['title']='Update Additional Information';
include_once 'sys/inc/thead.php';

if (isset($_POST['save'])){
if (isset($_POST['tertarik']) && strlen2(esc(stripcslashes(htmlspecialchars($_POST['tertarik']))))<=25)
{
$user['tertarik']=esc(stripcslashes(htmlspecialchars($_POST['tertarik'])));
mysql_query("UPDATE `user` SET `tertarik` = '$user[tertarik]' WHERE `id` = '$user[id]' LIMIT 1");
}
else
$err[]='Invalid interested';

if (isset($_POST['hubungan']) && strlen2(esc(stripcslashes(htmlspecialchars($_POST['hubungan']))))<=25)
{
$user['hubungan']=esc(stripcslashes(htmlspecialchars($_POST['hubungan'])));
mysql_query("UPDATE `user` SET `hubungan` = '$user[hubungan]' WHERE `id` = '$user[id]' LIMIT 1");
}
else
$err[]='Invalid relationship';

if (isset($_POST['agama']) && strlen2(esc(stripcslashes(htmlspecialchars($_POST['agama']))))<=30)
{
$user['agama']=esc(stripcslashes(htmlspecialchars($_POST['agama'])));
mysql_query("UPDATE `user` SET `agama` = '$user[agama]' WHERE `id` = '$user[id]' LIMIT 1");
}
else
$err[]='Invalid religion';


if (isset($_POST['asal']) && strlen2(esc(stripcslashes(htmlspecialchars($_POST['asal']))))<=100)
{
$user['asal']=esc(stripcslashes(htmlspecialchars($_POST['asal'])));
mysql_query("UPDATE `user` SET `asal` = '$user[asal]' WHERE `id` = '$user[id]' LIMIT 1");
}
else
$err[]='Invalid hometown';


if (isset($_POST['negara']) && preg_match('#^([A-Z \-]*)$#ui', $_POST['negara']))
{
$user['negara']=$_POST['negara'];
mysql_query("UPDATE `user` SET `negara` = '".mysql_real_escape_string($user['negara'])."' WHERE `id` = '$user[id]' LIMIT 1");
}
else
$err[]='Invalid country';

if (!isset($err))msg('Profile has been update');
$msg='[time]Update information[/time] [url=/info.php?id='.$user[id].'&info]profile[/url]';
mysql_query("INSERT INTO `statuse_list` (`id_user`, `msg`, `time`, `kategori`) values('$user[id]', '$msg', '$time', '1')");
}
err();

echo "&nbsp;<a href='/info.php?info'>View profile</a><br/><br/>";

echo "<form method='post' action='?$passgen''>\n";
echo "Interested:<br/><input type='text' name='tertarik' value='$user[tertarik]' maxlength='25' /><br/>";

echo "Relationship:<br/><input type='text' name='hubungan' value='$user[hubungan]' maxlength='25' /><br/>";

echo "Religion:<br/><input type='text' name='agama' value='$user[agama]' maxlength='30' /><br/>";

echo "Hometown:<br/><input type='text' name='asal' value='$user[asal]' maxlength='100' /><br/>";

echo "Country:<br/><input type='text' name='negara' value='$user[negara]' maxlength='20' /><br/>";
echo "<input class='button' type='submit' name='save' value='Save' />\n";
echo "</form><br/>";


include_once 'sys/inc/tfoot.php';
?>
