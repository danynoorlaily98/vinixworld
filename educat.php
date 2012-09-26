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
$set['title']='Update education and work';
include_once 'sys/inc/thead.php';

if (isset($_POST['save'])){
if (isset($_POST['sekolah']) && strlen2(esc(stripcslashes(htmlspecialchars($_POST['sekolah']))))<=100)
{
$user['sekolah']=esc(stripcslashes(htmlspecialchars($_POST['sekolah'])));
mysql_query("UPDATE `user` SET `sekolah` = '$user[sekolah]' WHERE `id` = '$user[id]' LIMIT 1");
}
else
$err[]='Invalid school name';

if (isset($_POST['kampus']) && strlen2(esc(stripcslashes(htmlspecialchars($_POST['kampus']))))<=50)
{
$user['kampus']=esc(stripcslashes(htmlspecialchars($_POST['kampus'])));
mysql_query("UPDATE `user` SET `kampus` = '$user[kampus]' WHERE `id` = '$user[id]' LIMIT 1");
}
else
$err[]='Invalid college name';

if (isset($_POST['kerja']) && strlen2(esc(stripcslashes(htmlspecialchars($_POST['kerja']))))<=50)
{
$user['kerja']=esc(stripcslashes(htmlspecialchars($_POST['kerja'])));
mysql_query("UPDATE `user` SET `kerja` = '$user[kerja]' WHERE `id` = '$user[id]' LIMIT 1");
}
else
$err[]='Invalid character';


if (isset($_POST['jabatan']) && preg_match('#^([A-Z \-]*)$#ui', $_POST['jabatan']))
{
$user['jabatan']=$_POST['jabatan'];
mysql_query("UPDATE `user` SET `jabatan` = '".mysql_real_escape_string($user['jabatan'])."' WHERE `id` = '$user[id]' LIMIT 1");
}
else
$err[]='Invalid position name';

if (!isset($err))msg('Profile has been update');
$msg='[time]update information[/time] [url=/info.php?id='.$user[id].'&info]profile[/url]';
mysql_query("INSERT INTO `statuse_list` (`id_user`, `msg`, `time`, `kategori`) values('$user[id]', '$msg', '$time', '1')");
}
err();
//aut();


echo "&nbsp;<a href='/info.php?info'>View profile</a><br/><br/>";


echo "<form method='post' action='?$passgen''>\n";
echo "School:<br/><input type='text' name='sekolah' value='$user[sekolah]' maxlength='100' /><br/>";

echo "College:<br/><input type='text' name='kampus' value='$user[kampus]' maxlength='50' /><br/>";
echo "Company:<br/><input type='text' name='kerja' value='$user[kerja]' maxlength='50' /><br/>";

echo "Position:<br/><input type='text' name='jabatan' value='$user[jabatan]' maxlength='20' /><br/>";

echo "<input class='button' type='submit' name='save' value='Save' />";
echo "</form><br/>";



include_once 'sys/inc/tfoot.php';
?>
