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
$set['title']='Settings';
include_once 'sys/inc/thead.php';
//title();

if (isset($_POST['save'])){

if (isset($_POST['set_show_icon']) && ($_POST['set_show_icon']==2 || $_POST['set_show_icon']==1 || $_POST['set_show_icon']==0))
{
$user['set_show_icon']=intval($_POST['set_show_icon']);
mysql_query("UPDATE `user` SET `set_show_icon` = '$user[set_show_icon]' WHERE `id` = '$user[id]' LIMIT 1");
}
else $err='Error mode display icons';

if (isset($_POST['add_konts']) && ($_POST['add_konts']==2 || $_POST['add_konts']==1 || $_POST['add_konts']==0))
{
$user['add_konts']=intval($_POST['add_konts']);
mysql_query("UPDATE `user` SET `add_konts` = '$user[add_konts]' WHERE `id` = '$user[id]' LIMIT 1");
}
else $err='Error mode add contacts';


if (isset($_POST['set_translit']) && ($_POST['set_translit']==1 || $_POST['set_translit']==0))
{
$user['set_translit']=intval($_POST['set_translit']);
mysql_query("UPDATE `user` SET `set_translit` = '$user[set_translit]' WHERE `id` = '$user[id]' LIMIT 1");
}
else $err='Error mode translit';

if (isset($_POST['set_files']) && ($_POST['set_files']==1 || $_POST['set_files']==0))
{
$user['set_files']=intval($_POST['set_files']);
mysql_query("UPDATE `user` SET `set_files` = '$user[set_files]' WHERE `id` = '$user[id]' LIMIT 1");
}
else $err='Error mode files';

if (isset($_POST['show_url']) && ($_POST['show_url']==1 || $_POST['show_url']==0))
{
$user['show_url']=intval($_POST['show_url']);
mysql_query("UPDATE `user` SET `show_url` = '$user[show_url]' WHERE `id` = '$user[id]' LIMIT 1");
}
else $err='Location error';



if (isset($_POST['set_time_chat']) && (is_numeric($_POST['set_time_chat']) && $_POST['set_time_chat']>=0 && $_POST['set_time_chat']<=900))
{
$user['set_time_chat']=intval($_POST['set_time_chat']);
$set['time_chat']=$user['set_time_chat'];
mysql_query("UPDATE `user` SET `set_time_chat` = '$user[set_time_chat]' WHERE `id` = '$user[id]' LIMIT 1");
}
else $err='Error in auto update time';

if (isset($_POST['set_news_to_mail']) && $_POST['set_news_to_mail']==1)
{
$user['set_news_to_mail']=1;
mysql_query("UPDATE `user` SET `set_news_to_mail` = '1' WHERE `id` = '$user[id]' LIMIT 1");
}
else
{
$user['set_news_to_mail']=0;
mysql_query("UPDATE `user` SET `set_news_to_mail` = '0' WHERE `id` = '$user[id]' LIMIT 1");
}


if (isset($_POST['set_them']) && preg_match('#^([A-z0-9\-_\(\)]+)$#ui', $_POST['set_them']) && is_dir(H.'style/themes/'.$_POST['set_them']))
{
$user['set_them']=$_POST['set_them'];
mysql_query("UPDATE `user` SET `set_them` = '$user[set_them]' WHERE `id` = '$user[id]' LIMIT 1");
}
elseif (isset($_POST['set_them2']) && preg_match('#^([A-z0-9\-_\(\)]+)$#ui', $_POST['set_them2']) && is_dir(H.'style/themes/'.$_POST['set_them2']))
{
$user['set_them2']=$_POST['set_them2'];
mysql_query("UPDATE `user` SET `set_them2` = '$user[set_them2]' WHERE `id` = '$user[id]' LIMIT 1");
}
else $err='Error applying theme';


if (isset($_POST['set_p_str']) && is_numeric($_POST['set_p_str']) && $_POST['set_p_str']>0 && $_POST['set_p_str']<=100)
{
$user['set_p_str']=intval($_POST['set_p_str']);
$set['p_str']=$user['set_p_str'];
mysql_query("UPDATE `user` SET `set_p_str` = '$user[set_p_str]' WHERE `id` = '$user[id]' LIMIT 1");
}
else $err='Wrong number of items per page';

if (isset($_POST['set_timesdvig']) && (is_numeric($_POST['set_timesdvig']) && $_POST['set_timesdvig']>=-12 && $_POST['set_timesdvig']<=12))
{
$user['set_timesdvig']=intval($_POST['set_timesdvig']);
mysql_query("UPDATE `user` SET `set_timesdvig` = '$user[set_timesdvig]' WHERE `id` = '$user[id]' LIMIT 1");
}
else $err='Wrong number of items per page';

if (!isset($err))msg('Changes have successfully taken');
}
err();
//aut();

echo "<b>Settings</b> &#183; <a href='/acc.php'>Account</a>";
echo "<div class='penanda'>My setting</div>";
echo "<form method='post' action='?$passgen'>\n";
echo "Auto update in chat:<br />\n<input type='text' name='set_time_chat' value='$set[time_chat]' maxlength='3' /><br />\n";
echo "Items per page:<br />\n<input type='text' name='set_p_str' value='$set[p_str]' maxlength='3' /><br />\n";

echo "Icons :<br />\n<select name='set_show_icon'>\n";
echo "<option value='2'".($user['set_show_icon']==2?" selected='selected'":null).">Large</option>\n";
echo "<option value='1'".($user['set_show_icon']==1?" selected='selected'":null).">Small</option>\n";
echo "<option value='0'".($user['set_show_icon']==0?" selected='selected'":null).">Hide</option>\n";
echo "</select><br />\n";

echo "Themes (".($webbrowser?'WEB':'WAP')."):<br />\n<select name='set_them".($webbrowser?'2':null)."'>\n";
$opendirthem=opendir(H.'style/themes');
while ($themes=readdir($opendirthem)){
// пропускаем корневые папки и файлы
if ($themes=='.' || $themes=='..' || !is_dir(H."style/themes/$themes"))continue;
// пропускаем темы для определенных браузеров
if (file_exists(H."style/themes/$themes/.only_for_".($webbrowser?'wap':'web')))continue;

echo "<option value='$themes'".($user['set_them'.($webbrowser?'2':null)]==$themes?" selected='selected'":null).">".trim(file_get_contents(H.'style/themes/'.$themes.'/them.name'))."</option>\n";
}
closedir($opendirthem);
echo "</select><br />\n";

echo "Translate:<br />\n<select name='set_translit'>\n";
echo "<option value='1'".($user['set_translit']==1?" selected='selected'":null).">By choice</option>\n";
echo "<option value='0'".($user['set_translit']==0?" selected='selected'":null).">Never</option>\n";
echo "</select><br />\n";

echo "Upload files:<br />\n<select name='set_files'>\n";
echo "<option value='1'".($user['set_files']==1?" selected='selected'":null).">Show</option>\n";
echo "<option value='0'".($user['set_files']==0?" selected='selected'":null).">Don't use the uploading</option>\n";
echo "</select><br />\n";

echo "Location:<br />\n<select name='show_url'>\n";
echo "<option value='1'".($user['show_url']==1?" selected='selected'":null).">Show</option>\n";
echo "<option value='0'".($user['show_url']==0?" selected='selected'":null).">Hide</option>\n";
echo "</select><br />\n";

echo "Adding contacts:<br />\n<select name='add_konts'>\n";
echo "<option value='2'".($user['add_konts']==2?" selected='selected'":null).">When reading messages</option>\n";
echo "<option value='1'".($user['add_konts']==1?" selected='selected'":null).">When writing messages</option>\n";
echo "<option value='0'".($user['add_konts']==0?" selected='selected'":null).">Only hand</option>\n";
echo "</select><br />\n";

echo "Time<br />\n<select name=\"set_timesdvig\"><br />\n";
for ($i=-12;$i<12;$i++){
echo "<option value='$i'".($user['set_timesdvig']==$i?" selected='selected'":null).">".date("G:i", $time+$i*60*60)."</option>\n";}
echo "</select><br />\n";

if ($user['ank_mail'])
echo "<label><input type='checkbox' name='set_news_to_mail'".($user['set_news_to_mail']?" checked='checked'":null)." value='1' /> Receive News by E-mail</label><br />\n";


echo "<input type='submit' name='save' value='Save' />\n";
echo "</form>\n";

echo "<div class='foot'>\n";
//if(isset($_SESSION['refer']) && $_SESSION['refer']!=NULL && otkuda($_SESSION['refer']))
//echo "&laquo;<a href='$_SESSION[refer]'>".otkuda($_SESSION['refer'])."</a><br />\n";
echo "&nbsp;<a href='umenu.php'>Back</a><br />\n";
echo "</div>\n";
include_once 'sys/inc/tfoot.php';
?>
