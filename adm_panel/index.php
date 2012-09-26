<?

// remodified by noe
// http://nnetwork.tk
// loegue.info@gmail.com
// hargailah privasi orang

include_once '../sys/inc/start.php';
include_once '../sys/inc/compress.php';
include_once '../sys/inc/sess.php';
include_once '../sys/inc/home.php';
include_once '../sys/inc/settings.php';
include_once '../sys/inc/db_connect.php';
include_once '../sys/inc/ipua.php';
include_once '../sys/inc/fnc.php';
include_once '../sys/inc/adm_check.php';
include_once '../sys/inc/user.php';
user_access('adm_panel_show',null,'/index.php?'.SID);


if (isset($_SESSION['adm_auth']) && $_SESSION['adm_auth']>$time || isset($_SESSION['captcha']) && isset($_POST['chislo']) && $_SESSION['captcha']==$_POST['chislo'])
{
$_SESSION['adm_auth']=$time+600;

if (isset($_GET['go']) && $_GET['go']!=null)
{
header('Location: '.base64_decode($_GET['go']));exit;
}


$set['title']='Admin Panel';
include_once '../sys/inc/thead.php';
//title();
err();
//aut();

echo "<div class='menu'>\n";

if (user_access('adm_info'))echo "<a href='info.php'>System Informations</a><br />\n";
if (user_access('lic_info'))echo "<a href='lic_info.php'>License Information</a><br />\n";
if (user_access('adm_statistic'))echo "<a href='statistic.php'>Site Statistics</a><br />\n";
if (user_access('adm_show_adm'))echo "<a href='administration.php'>Administration List</a><br />\n";
if (user_access('adm_log_read'))echo "<a href='adm_log.php'>Administration Reports</a><br />\n";
if (user_access('adm_menu'))echo "<a href='menu.php'>Menu Panel</a><br />\n";
if (user_access('adm_rekl'))echo "<a href='rekl.php'>Advertize Panel</a><br />\n";
if (user_access('adm_news'))echo "<a href='news.php'>News Panel</a><br />\n";
if (user_access('adm_set_sys'))echo "<a href='settings_sys.php'>System Settings</a><br />\n";
echo "<hr/>";
if (user_access('adm_set_sys'))echo "<a href='smiles/index.php'>SMILES Settings</a><br />\n";
if (user_access('adm_set_sys'))echo "<a href='send.php'>Msg All Member</a><br />\n";
if (user_access('adm_set_sys'))echo "<a href='settings_bbcode.php'>BBcode Settings</a><br />\n";
if (user_access('adm_set_forum'))echo "<a href='settings_forum.php'>Forum Settings</a><br />\n";
if (user_access('adm_forum_sinc'))echo "<a href='forum_sinc.php'>Synchronizing Forum Table</a><br />\n";
if (user_access('adm_set_loads'))echo "<a href='settings_loads.php'>Downloads Settings</a><br />\n";
echo "<hr/>";
if (user_access('adm_set_sys'))echo "<a href='status.php'>Status Panel</a><br/>";
if (user_access('adm_set_loads'))echo "<a href='loads_recount.php'>Downloads Recounts</a><br />\n";
if (user_access('adm_set_chat'))echo "<a href='settings_chat.php'>Chatbox Settings</a><br />\n";
if (user_access('adm_set_foto'))echo "<a href='settings_foto.php'>Gallery Preferences</a><br />\n";
if (user_access('adm_lib_repair'))echo "<a href='lib_repair.php'>Library Recovery</a><br />\n";
echo "<hr/>";
if (user_access('adm_themes'))echo "<a href='themes.php'>Themes Preferences</a><br />\n";
if (user_access('adm_set_user'))echo "<a href='settings_user.php'>Users Costumization</a><br />\n";
if (user_access('adm_accesses'))echo "<a href='accesses.php'>Privileges of user groups</a><br />\n";
if (user_access('adm_banlist'))echo "<a href='banlist.php'>List of Banned</a><br />\n";
if (user_access('adm_ref'))echo "<a href='referals.php'>Referrals</a><br />\n";
if (user_access('adm_ip_edit'))echo "<a href='opsos.php'>Editing IP address</a><br />\n";
if (user_access('adm_ban_ip'))echo "<a href='ban_ip.php'>Ban by IP address (range)</a><br />\n";
if (user_access('adm_mysql'))echo "<a href='mysql.php'>MySQL Queries</a><br />\n";


$opdirbase=@opendir(H.'sys/add/admin');
while ($filebase=@readdir($opdirbase))
if (eregi('\.php$',$filebase))
include_once(H.'sys/add/admin/'.$filebase);
closedir($opdirbase);


if ($license)
{
echo "<hr />\n";

if (user_access('lic_themes'))echo "<a href='lic_themes.php'>Themes Settings</a><br />\n";
if (user_access('lic_update'))echo "<a href='lic_update.php'>Update Engine</a><br />\n";
if (user_access('adm_license_support'))echo "<a href='lic_support.php'>Support</a><br />\n";

}
echo "</div>\n";

}
else
{

$set['title']='Protection from automatic changes';
include_once '../sys/inc/thead.php';
//title();
err();
//aut();
echo "<form method='post' action='?gen=$passgen&amp;".(isset($_GET['go'])?"go=$_GET[go]":null)."'>\n";

echo "<img src='/captcha.php?$passgen&amp;SESS=$sess' width='100' height='30' alt='Chaptcha' /><br />\nEnter the number:<br />\n<input name='chislo' size='5' maxlength='5' value='' type='text' /><br/>\n";
echo "<input type='submit' value='Submit' />\n";
echo "</form>\n";
}

include_once '../sys/inc/tfoot.php';
?>
