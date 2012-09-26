<?

// created by noe
// http://nnetwork.tk
// loegue.info@gmail.com

echo "<a href='/info.php?info'>View Profile</a><br />\n";
echo "<a href='/profile.edit.php'>Edit Profile</a><br />\n";
echo "<a href='/avatar.php'>Avatar</a><br />\n";

$opdirbase=@opendir(H.'sys/add/umenu');
while ($filebase=@readdir($opdirbase))
if (eregi('\.php$',$filebase))
include_once(H.'sys/add/umenu/'.$filebase);
echo "<a href='/settings.php'>Settings</a><br />\n";
echo "<a href='/secure.php'>Change Password</a><br />\n";
echo "<a href='/rules.php'>Rules</a><br />\n";

if (user_access('adm_panel_show'))echo "<a href='/adm_panel/'>Admin Panel</a><br />\n";

if ($set['web']==false)
echo "<br />\n<a href='/exit.php'>Log Out</a><br />\n";
?>
