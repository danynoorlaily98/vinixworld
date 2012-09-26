<?

echo "<div class='main_menu'>\n";
rekl(2);



$q_menu=mysql_query("SELECT * FROM `menu` ORDER BY `pos` ASC");
while ($post_menu = mysql_fetch_assoc($q_menu))
{



if (!isset($post_menu['icon']))mysql_query('ALTER TABLE `menu` ADD `icon` VARCHAR( 32 ) NULL DEFAULT NULL');
if (!isset($post_menu['type']))mysql_query("ALTER TABLE  `menu` ADD  `type` ENUM('link', 'razd') NOT NULL DEFAULT 'link' AFTER `id`");

if ($post_menu['type']=='link')echo icons($post_menu['icon'],'code');

if ($post_menu['type']=='link')echo "<a onclick='fun();' href='$post_menu[url]'>";
else echo "<div class='menu_razd'>";
echo $post_menu['name'];

if ($post_menu['counter']!=NULL && is_file(H.$post_menu['counter']))
{
echo ' (';
@include H.$post_menu['counter'];
echo ')';
}

if ($post_menu['type']=='link')echo "</a><br />\n";
else echo "</div>\n";



}
echo "</div>\n";
?>
