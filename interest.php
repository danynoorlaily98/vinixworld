<?

// created by noe
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
$set['title']='Update likes and interests';
include_once 'sys/inc/thead.php';

if (isset($_POST['save'])){
if (isset($_POST['aktivitas']) && strlen2(esc(stripcslashes(htmlspecialchars($_POST['aktivitas']))))<=100)
{
$user['aktivitas']=esc(stripcslashes(htmlspecialchars($_POST['aktivitas'])));
mysql_query("UPDATE `user` SET `aktivitas` = '$user[aktivitas]' WHERE `id` = '$user[id]' LIMIT 1");
}
else
$err[]='Invalid character';

if (isset($_POST['minat']) && strlen2(esc(stripcslashes(htmlspecialchars($_POST['minat']))))<=100)
{
$user['minat']=esc(stripcslashes(htmlspecialchars($_POST['minat'])));
mysql_query("UPDATE `user` SET `minat` = '$user[minat]' WHERE `id` = '$user[id]' LIMIT 1");
}
else
$err[]='Invalid college name';

if (isset($_POST['musik']) && strlen2(esc(stripcslashes(htmlspecialchars($_POST['musik']))))<=35)
{
$user['musik']=esc(stripcslashes(htmlspecialchars($_POST['musik'])));
mysql_query("UPDATE `user` SET `musik` = '$user[musik]' WHERE `id` = '$user[id]' LIMIT 1");
}
else
$err[]='Invalid character';

if (isset($_POST['tv']) && strlen2(esc(stripcslashes(htmlspecialchars($_POST['tv']))))<=35)
{
$user['tv']=esc(stripcslashes(htmlspecialchars($_POST['tv'])));
mysql_query("UPDATE `user` SET `tv` = '$user[tv]' WHERE `id` = '$user[id]' LIMIT 1");
}
else
$err[]='Invalid character';

if (isset($_POST['film']) && strlen2(esc(stripcslashes(htmlspecialchars($_POST['film']))))<=35)
{
$user['film']=esc(stripcslashes(htmlspecialchars($_POST['film'])));
mysql_query("UPDATE `user` SET `film` = '$user[film]' WHERE `id` = '$user[id]' LIMIT 1");
}
else
$err[]='Invalid character';

if (isset($_POST['buku']) && strlen2(esc(stripcslashes(htmlspecialchars($_POST['buku']))))<=35)
{
$user['buku']=esc(stripcslashes(htmlspecialchars($_POST['buku'])));
mysql_query("UPDATE `user` SET `buku` = '$user[buku]' WHERE `id` = '$user[id]' LIMIT 1");
}
else
$err[]='Invalid character';

if (isset($_POST['kutipan']) && strlen2(esc(stripcslashes(htmlspecialchars($_POST['kutipan']))))<=75)
{
$user['kutipan']=esc(stripcslashes(htmlspecialchars($_POST['kutipan'])));
mysql_query("UPDATE `user` SET `kutipan` = '$user[kutipan]' WHERE `id` = '$user[id]' LIMIT 1");
}
else
$err[]='Invalid character';

if (isset($_POST['bio']) && strlen2(esc(stripcslashes(htmlspecialchars($_POST['bio']))))<=512)
{
$user['bio']=esc(stripcslashes(htmlspecialchars($_POST['bio'])));
mysql_query("UPDATE `user` SET `bio` = '$user[bio]' WHERE `id` = '$user[id]' LIMIT 1");
}
else
$err[]='Invalid character';



if (!isset($err))msg('Profile has been update');
$msg='[time]update information[/time] [url=/info.php?id='.$user[id].'&info]profile[/url]';
mysql_query("INSERT INTO `statuse_list` (`id_user`, `msg`, `time`, `kategori`) values('$user[id]', '$msg', '$time', '1')");
}
err();

echo "&nbsp;<a href='/info.php?info'>View profile</a><br/><br/>";

echo "<form method='post' action='?$passgen''>\n";
echo "Activity:<br/><input type='text' name='aktivitas' value='$user[aktivitas]' maxlength='100' /><br/>";

echo "Interest:<br/><input type='text' name='minat' value='$user[minat]' maxlength='100' /><br/>";

echo "Music:<br/><input type='text' name='musik' value='$user[musik]' maxlength='35' /><br/>";

echo "TV Show:<br/><input type='text' name='tv' value='$user[tv]' maxlength='35' /><br/>";

echo "Films:<br/><input type='text' name='film' value='$user[film]' maxlength='35' /><br/>";

echo "Books:<br/><input type='text' name='buku' value='$user[buku]' maxlength='35' /><br/>";

echo "Quote:<br/><input type='text' name='kutipan' value='$user[kutipan]' maxlength='75' /><br/>";

echo "Bio:<br/><input type='text' name='bio' value='$user[bio]' maxlength='512' /><br/>";

echo "<input class='button' type='submit' name='save' value='Save' />";
echo "</form><br/>";



include_once 'sys/inc/tfoot.php';
?>
