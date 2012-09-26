<?

// Translated by : zanger
// Site : http://www.frendzmobile.co.cc

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
$set['title']='Update status';
include_once 'sys/inc/thead.php';
title();


if (isset($_POST['save'])){
if (isset($_POST['privet']) && strlen2(esc(stripcslashes(htmlspecialchars($_POST['privet']))))<=84)
{
$user['privet']=esc(stripcslashes(htmlspecialchars($_POST['privet'])));
mysql_query("UPDATE `user` SET `privet` = '$user[privet]' WHERE `id` = '$user[id]' LIMIT 1");
}else $err='It is neccesery to write less :)';

if (!isset($err))msg('status succesfully changed');

}
err();
aut();



echo "<form method='post' action='?'>\n";

echo "Text status:<br />\n<input type='text' name='privet' value='$user[privet]' maxlength='83' /><br />\n";

echo "<input type='submit' name='save' value='Save' />\n";
echo "</form>\n";


if(isset($_SESSION['refer']) && $_SESSION['refer']!=NULL && otkuda($_SESSION['refer']))
echo "&laquo;<a href='$_SESSION[refer]'>".otkuda($_SESSION['refer'])."</a><br />\n";

echo "<div class='foot'>\n";
echo "&laquo;<a href='umenu.php'>My menu</a><br />\n";
echo "</div>\n";

include_once 'sys/inc/tfoot.php';
?>