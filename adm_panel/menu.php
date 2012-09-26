<?
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
user_access('adm_menu',null,'index.php?'.SID);
adm_check();
$set['title']='Menu Settings';
include_once '../sys/inc/thead.php';
//title();

$opendiricon=opendir(H.'style/icons');
while ($icons=readdir($opendiricon))
{
// record of all those in the array
if (ereg('^\.|default.png',$icons))continue;
$icon[]=$icons;
}
closedir($opendiricon);


if (isset($_POST['add']) && isset($_POST['name']) && $_POST['name']!=NULL && isset($_POST['url']) && $_POST['url']!=NULL && isset($_POST['counter']))
{
$name=esc(stripcslashes(htmlspecialchars($_POST['name'])));
$url=esc(stripcslashes(htmlspecialchars($_POST['url'])));
$counter=esc(stripcslashes(htmlspecialchars($_POST['counter'])));
$pos=mysql_result(mysql_query("SELECT MAX(`pos`) FROM `menu`"), 0)+1;

$icon=eregi_replace('[^a-z0-9 _\-\.]', null, $_POST['icon']);
mysql_query("INSERT INTO `menu` (`name`, `url`, `counter`, `pos`, `icon`) VALUES ('$name', '$url', '$counter', '$pos', '$icon')");
msg('Link successfully added');
}



if (isset($_POST['add']) && isset($_POST['name']) && $_POST['name']!=NULL && isset($_POST['counter']) && isset($_POST['type']) && $_POST['type']=='razd')
{
$name=esc(stripcslashes(htmlspecialchars($_POST['name'])));
$url=esc(stripcslashes(htmlspecialchars($_POST['url'])));
$counter=esc(stripcslashes(htmlspecialchars($_POST['counter'])));
$pos=mysql_result(mysql_query("SELECT MAX(`pos`) FROM `menu`"), 0)+1;

$icon=eregi_replace('[^a-z0-9 _\-\.]', null, $_POST['icon']);
mysql_query("INSERT INTO `menu` (`type`, `name`, `url`, `counter`, `pos`, `icon`) VALUES ('razd', '$name', '$url', '$counter', '$pos', '$icon')");
msg('Link successfully added');
}



if (isset($_POST['change']) && isset($_GET['id']) && isset($_POST['name']) && $_POST['name']!=NULL && isset($_POST['url']) && isset($_POST['counter']))
{
$id=intval($_GET['id']);
$name=esc(stripcslashes(htmlspecialchars($_POST['name'])));
$url=esc(stripcslashes(htmlspecialchars($_POST['url'])));
$counter=esc(stripcslashes(htmlspecialchars($_POST['counter'])));
$icon=eregi_replace('[^a-z0-9 _\-\.]', null, $_POST['icon']);
mysql_query("UPDATE `menu` SET `name` = '$name', `url` = '$url', `counter` = '$counter', `icon` = '$icon' WHERE `id` = '$id' LIMIT 1");
msg('The menu item was successfully changed');
}

if (isset($_GET['id']) && isset($_GET['act']) && mysql_result(mysql_query("SELECT COUNT(*) FROM `menu` WHERE `id` = '".intval($_GET['id'])."'"),0))
{

$menu=mysql_fetch_assoc(mysql_query("SELECT * FROM `menu` WHERE `id` = '".intval($_GET['id'])."' LIMIT 1"));
if ($_GET['act']=='up')
{
mysql_query("UPDATE `menu` SET `pos` = '".($menu['pos'])."' WHERE `pos` = '".($menu['pos']-1)."' LIMIT 1");
mysql_query("UPDATE `menu` SET `pos` = '".($menu['pos']-1)."' WHERE `id` = '".intval($_GET['id'])."' LIMIT 1");

msg('Menu item is shifted to up position');
}
if ($_GET['act']=='down')
{
mysql_query("UPDATE `menu` SET `pos` = '".($menu['pos'])."' WHERE `pos` = '".($menu['pos']+1)."' LIMIT 1");
mysql_query("UPDATE `menu` SET `pos` = '".($menu['pos']+1)."' WHERE `id` = '".intval($_GET['id'])."' LIMIT 1");

msg('Menu item is shifted to position down');
}
if ($_GET['act']=='del')
{

mysql_query("DELETE FROM `menu` WHERE `id` = '".intval($_GET['id'])."' LIMIT 1");

msg('Menu item was successfully removed');
}


}



err();
//aut();
echo "<table class='post'>\n";

$q=mysql_query("SELECT * FROM `menu` ORDER BY `pos` ASC");
while ($post = mysql_fetch_assoc($q))
{
echo "   <tr>\n";
if (!isset($post['icon']))mysql_query('ALTER TABLE `menu` ADD `icon` VARCHAR( 32 ) NULL DEFAULT NULL');
if (!isset($post['type']))mysql_query("ALTER TABLE  `menu` ADD  `type` ENUM('link', 'razd') NOT NULL DEFAULT 'link' AFTER `id`");
echo "  <td class='p_t'>\n";
if ($post['type']=='link')echo icons($post['icon'],'code');
echo "$post[pos]) $post[name] ".($post['type']=='link'?"($post[url])":null);
echo "  </td>\n";
echo "   </tr>\n";
echo "   <tr>\n";
echo "  <td class='p_m'>\n";


if (isset($_GET['id']) && $_GET['id']==$post['id'] && isset($_GET['act']) && $_GET['act']=='edit')
{

echo "<form action=\"?id=$post[id]\" method=\"post\">";
echo "Type: ".($post['type']=='link'?'Link':'Delimiter')."<br />\n";

echo "Title:<br />\n";
echo "<input type='text' name='name' value=\"$post[name]\" /><br />\n";

if ($post['type']=='link'){
echo "Link:<br />\n";
echo "<input type='text' name='url' value='$post[url]' /><br />\n";
}
else
echo "<input type='hidden' name='url' value='' />\n";


echo "Counter:<br />\n";
echo "<input type='text' name='counter' value='$post[counter]' /><br />\n";
if ($post['type']=='link'){
echo "Icons:<br />\n";
echo "<select name='icon'>\n";
echo "<option value='default.png'>Default</option>\n";
for ($i=0;$i<sizeof($icon);$i++)
{
echo "<option value='$icon[$i]'".($post['icon']==$icon[$i]?" selected='selected'":null).">$icon[$i]</option>\n";
}
echo "</select><br />\n";
}
else
echo "<input type='hidden' name='icon' value='$post[icon]' />\n";

echo "<input class=\"submit\" name=\"change\" type=\"submit\" value=\"Edit\" /><br />\n";
echo "</form>";


echo "<a href='?'>Cancel</a><br />";
}
else
{
echo "Counter: ".($post['counter']==null?'no':$post['counter'])."<br />\n";

echo "<a href='?id=$post[id]&amp;act=up&amp;$passgen'>Up</a> | ";
echo "<a href='?id=$post[id]&amp;act=down&amp;$passgen'>Down</a> | ";
echo "<a href='?id=$post[id]&amp;act=del&amp;$passgen'>Remove </a><br />";

echo "<a href='?id=$post[id]&amp;act=edit&amp;$passgen'>Edit </a><br />";
}

echo "  </td>\n";
echo "   </tr>\n";
}


echo "</table>\n";


if (isset($_GET['add'])){
echo "<form action='?add=$passgen' method=\"post\">";
echo "Type:<br />\n";
echo "<select name='type'>\n";
echo "<option value='link'>Link (1)</option>\n";
echo "<option value='razd'>Delimiter (2)</option>\n";
echo "</select><br />\n";
echo "Title (1,2):<br />\n";
echo "<input type=\"text\" name=\"name\" value=\"\"/><br />\n";
echo "Link (1):<br />\n";
echo "<input type=\"text\" name=\"url\" value=\"\"/><br />\n";
echo "Counter (1,2):<br />\n";
echo "<input type=\"text\" name=\"counter\" value=\"\"/><br />\n";
echo "Icon (1):<br />\n";
echo "<select name='icon'>\n";
echo "<option value='default.png'>Default</option>\n";
for ($i=0;$i<sizeof($icon);$i++)
{
echo "<option value='$icon[$i]'>$icon[$i]</option>\n";
}
echo "</select><br />\n";
echo "<input class='button' name='add' type='submit' value='Add' /><br />\n";
echo "<a href='?$passgen'>Cancel</a><br />\n";
echo "</form>";
}
else echo "<div class='foot'><a href='?add=$passgen'>Add Item</a></div>\n";

if (user_access('adm_panel_show')){
echo "<div class='foot'>\n";
echo "&laquo;<a href='/adm_panel/'>Admin Panel</a><br />\n";
echo "</div>\n";
}

include_once '../sys/inc/tfoot.php';
?>
