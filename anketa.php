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
$set['title']='Edit Profile';
include_once 'sys/inc/thead.php';
//title();


if (isset($_POST['save'])){
if (isset($_POST['ank_name']) && preg_match('#^([A-Z \-]*)$#ui', $_POST['ank_name']))
{
$user['ank_name']=$_POST['ank_name'];
mysql_query("UPDATE `user` SET `ank_name` = '".mysql_real_escape_string($user['ank_name'])."' WHERE `id` = '$user[id]' LIMIT 1");
}
else $err[]='Invalid name format';

if (isset($_POST['ank_d_r']) && (is_numeric($_POST['ank_d_r']) && $_POST['ank_d_r']>0 && $_POST['ank_d_r']<=31 || $_POST['ank_d_r']==NULL))
{
$user['ank_d_r']=$_POST['ank_d_r'];
if ($user['ank_d_r']==null)$user['ank_d_r']='null';
mysql_query("UPDATE `user` SET `ank_d_r` = $user[ank_d_r] WHERE `id` = '$user[id]' LIMIT 1");
if ($user['ank_d_r']=='null')$user['ank_d_r']=NULL;
}
else $err[]='Invalid verification';

if (isset($_POST['ank_m_r']) && (is_numeric($_POST['ank_m_r']) && $_POST['ank_m_r']>0 && $_POST['ank_m_r']<=12 || $_POST['ank_m_r']==NULL))
{
$user['ank_m_r']=$_POST['ank_m_r'];
if ($user['ank_m_r']==null)$user['ank_m_r']='null';
mysql_query("UPDATE `user` SET `ank_m_r` = $user[ank_m_r] WHERE `id` = '$user[id]' LIMIT 1");
if ($user['ank_m_r']=='null')$user['ank_m_r']=NULL;
}
else $err[]='Invalid month format';

if (isset($_POST['ank_g_r']) && (is_numeric($_POST['ank_g_r']) && $_POST['ank_g_r']>0 && $_POST['ank_g_r']<=date('Y') || $_POST['ank_g_r']==NULL))
{
$user['ank_g_r']=$_POST['ank_g_r'];
if ($user['ank_g_r']==null)$user['ank_g_r']='null';
mysql_query("UPDATE `user` SET `ank_g_r` = $user[ank_g_r] WHERE `id` = '$user[id]' LIMIT 1");
if ($user['ank_g_r']=='null')$user['ank_g_r']=NULL;
}
else $err[]='Invalid date format';

if (isset($_POST['ank_city']) && preg_match('#^([A-Z \-]*)$#ui', $_POST['ank_city']))
{
$user['ank_city']=$_POST['ank_city'];
mysql_query("UPDATE `user` SET `ank_city` = '".mysql_real_escape_string($user['ank_city'])."' WHERE `id` = '$user[id]' LIMIT 1");
}
else $err[]='Invalid word format';

if (isset($_POST['ank_icq']) && (is_numeric($_POST['ank_icq']) && strlen($_POST['ank_icq'])>=5 && strlen($_POST['ank_icq'])<=9 || $_POST['ank_icq']==NULL))
{
$user['ank_icq']=$_POST['ank_icq'];
if ($user['ank_icq']==null)$user['ank_icq']='null';
mysql_query("UPDATE `user` SET `ank_icq` = $user[ank_icq] WHERE `id` = '$user[id]' LIMIT 1");
if ($user['ank_icq']=='null')$user['ank_icq']=NULL;
}
else $err[]='Invalid ICQ format';



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
else $err[]='Invalid phone number format';

if (isset($_POST['ank_mail']) && ($_POST['ank_mail']==null || preg_match('#^[A-z0-9-\._]+@[A-z0-9]{2,}\.[A-z]{2,4}$#ui',$_POST['ank_mail'])))
{
$user['ank_mail']=$_POST['ank_mail'];
mysql_query("UPDATE `user` SET `ank_mail` = '$user[ank_mail]' WHERE `id` = '$user[id]' LIMIT 1");
}
else $err[]='Invalid E-mail format';


if (isset($_POST['ank_o_sebe']) && strlen2($_POST['ank_o_sebe'])<=512)
{

if (preg_match('#[^A-Z0-9 _\-\=\+\(\)\*\?\.,]#ui',$_POST['ank_o_sebe']))$err[]='at URL"use invalid character" ';
else {
$user['ank_o_sebe']=$_POST['ank_o_sebe'];
mysql_query("UPDATE `user` SET `ank_o_sebe` = '".mysql_real_escape_string($user['ank_o_sebe'])."' WHERE `id` = '$user[id]' LIMIT 1");
}
}
else $err[]='Invalid url format:)';

if (!isset($err))msg('Profile has been update');
$msgsts='[time]update information[/time] [url=/info.php?id='.$user[id].'&info]profile[/url]';
mysql_query("INSERT INTO `statuse_list` (`id_user`, `msg`, `time`, `kategori`) values('$user[id]', '$msgsts', '$time', '1')");
//$msgak='[url=/info.php?id='.$user[id].']'.$user[nick].'[/url] [time]update information[/time] [url=/info.php?id='.$user[id].'&info]profile[/url]';
//mysql_query("INSERT INTO `aktivitas_ku` (`id_user`, `id_kont`, `msg`, `time`) values('0', '$user[id]', '$msgak', '$time')");
//mysql_query("INSERT INTO `wall` (`user_id`, `message`, `time`) values('".$user_id."', '  $msgak', '".$time."')");
}
err();

echo "&nbsp;<a href='/info.php?info'>View profile</a><br/><br/>";

echo "<form method='post' action='?$passgen'>\n";
echo "Name:<br />\n<input type='text' name='ank_name' value='".output_text($user['ank_name'],false)."' maxlength='32' /><br />\n";
echo "Date of birth:<br />\n";
echo "<input type='text' name='ank_d_r' value='$user[ank_d_r]' size='2' maxlength='2' />\n";
echo "<input type='text' name='ank_m_r' value='$user[ank_m_r]' size='2' maxlength='2' />\n";
echo "<input type='text' name='ank_g_r' value='$user[ank_g_r]' size='4' maxlength='4' /><br />\n";
echo "City:<br />\n<input type='text' name='ank_city' value='$user[ank_city]' maxlength='32' /><br />\n";
echo "ICQ:<br />\n<input type='text' name='ank_icq' value='$user[ank_icq]' maxlength='9' /><br />\n";
echo "E-mail:<br />\n<input type='text' name='ank_mail' value='$user[ank_mail]' maxlength='32' /><br />\n";


echo "<label><input type=\"checkbox\" name=\"set_show_mail\"".($user['set_show_mail']==1?' checked="checked"':null)." value=\"1\" />Show E-mail</label><br />\n";
echo "Phone:<br />\n<input type='text' name='ank_n_tel' value='$user[ank_n_tel]' maxlength='13' /><br />\n";
echo "Site (no http://):<br />\n<input type='text' name='ank_o_sebe' value='$user[ank_o_sebe]' maxlength='512' /><br />\n";
echo "<input class='button' type='submit' name='save' value='Save' />\n";
echo "</form><br/>";
//echo "<div class='foot'>\n";



//if(isset($_SESSION['refer']) && $_SESSION['refer']!=NULL && otkuda($_SESSION['refer']))
//echo "&laquo;<a href='$_SESSION[refer]'> ".otkuda($_SESSION['refer'])."</a><br />\n";

//echo "<a href='/umenu.php'> My Menu</a><br />\n";
//echo "</div>\n";

include_once 'sys/inc/tfoot.php';
?>
