<?
include_once 'sys/inc/start.php';
include_once 'sys/inc/compress.php';
include_once 'sys/inc/sess.php';
include_once 'sys/inc/home.php';
include_once 'sys/inc/settings.php';
include_once 'sys/inc/db_connect.php';
include_once 'sys/inc/ipua.php';
include_once 'sys/inc/fnc.php';
include_once 'sys/inc/user.php';

$set['title']='Now Online'; // заголовок страницы
include_once 'sys/inc/thead.php';
//title();

$k_post=mysql_result(mysql_query("SELECT COUNT(*) FROM `user` WHERE `date_last` > '".(time()-600)."'"), 0);
$k_page=k_page($k_post,$set['p_str']);
$page=page($k_page);
$start=$set['p_str']*$page-$set['p_str'];
$q = mysql_query("SELECT `id` FROM `user` WHERE `date_last` > '".(time()-600)."' ORDER BY `date_last` DESC LIMIT $start, $set[p_str]");
echo "<table class='post'>\n";
if ($k_post==0)
{
echo "   <tr>\n";
echo "  <td class='p_t'>\n";
echo "There're currently no one\n";
echo "  </td>\n";
echo "   </tr>\n";
}
while ($ank = mysql_fetch_assoc($q))
{
$ank=get_user($ank['id']);
echo "   <tr>\n";

if ($set['set_show_icon']==2){
echo "  <td class='icon14' rowspan='2'>\n";
avatar($ank['id']);
echo "  </td>\n";
}
elseif ($set['set_show_icon']==1)
{
echo "  <td class='icon14'>\n";
avatar($ank['id']);
echo "  </td>\n";
}
echo "  <td class='p_t'>\n";
echo "<a href='/info.php?id=$ank[id]'>$ank[nick]</a>".online($ank['id'])."\n";
if ($ank['group_access']>1)echo "<span class='status'>$ank[group_name]</span>\n";
echo "  </td>\n";
echo "   </tr>\n";
echo "   <tr>\n";
if ($set['set_show_icon']==1)echo "  <td class='p_m' colspan='2'>\n"; else echo "  <td class='p_m'>\n";


echo "<span class=\"ank_n\">Joined:</span> <span class=\"ank_d\">".vremja($ank['date_reg'])."</span><br />\n";
echo "<span class=\"ank_n\">Last Login:</span> <span class=\"ank_d\">".vremja($ank['date_last'])."</span><br />\n";
if ($user['level']>$ank['level']){
if ($ank['ip']!=NULL){
if (user_access('user_show_ip') && $ank['ip']!=0){
echo "<span class=\"ank_n\">IP:</span> <span class=\"ank_d\">".long2ip($ank['ip'])."</span>";
if (user_access('adm_ban_ip'))
echo " [<a href='/adm_panel/ban_ip.php?min=$ank[ip]'>Ban</a>]";
echo "<br />\n";
}
}

if ($ank['ip_cl']!=NULL){
if (user_access('user_show_ip') && $ank['ip_cl']!=0){
echo "<span class=\"ank_n\">IP (CLIENT):</span> <span class=\"ank_d\">".long2ip($ank['ip_cl'])."</span>";
if (user_access('adm_ban_ip'))
echo " [<a href='/adm_panel/ban_ip.php?min=$ank[ip_cl]'>Ban</a>]";
echo "<br />\n";
}
}

if ($ank['ip_xff']!=NULL){
if (user_access('user_show_ip') && $ank['ip_xff']!=0){
echo "<span class=\"ank_n\">IP (XFF):</span> <span class=\"ank_d\">".long2ip($ank['ip_xff'])."</span>";
if (user_access('adm_ban_ip'))
echo " [<a href='/adm_panel/ban_ip.php?min=$ank[ip_xff]'>Ban</a>]";
echo "<br />\n";
}
}




if (user_access('user_show_ua') && $ank['ua']!=NULL)
echo "<span class=\"ank_n\">UA:</span> <span class=\"ank_d\">$ank[ua]</span><br />\n";
if (user_access('user_show_ip') && opsos($ank['ip']))
echo "<span class=\"ank_n\">IP:</span> <span class=\"ank_d\">".opsos($ank['ip'])."</span><br />\n";
if (user_access('user_show_ip') && opsos($ank['ip_cl']))
echo "<span class=\"ank_n\">IP (CL):</span> <span class=\"ank_d\">".opsos($ank['ip_cl'])."</span><br />\n";
if (user_access('user_show_ip') && opsos($ank['ip_xff']))
echo "<span class=\"ank_n\">IP (XFF):</span> <span class=\"ank_d\">".opsos($ank['ip_xff'])."</span><br />\n";


}




if ($ank['show_url']==1)
{
if (otkuda($ank['url']))echo "<span class=\"ank_n\">Last Page:</span> <span class=\"ank_d\"><a href='$ank[url]'>".otkuda($ank['url'])."</a></span><br />\n";
}
if (user_access('user_collisions') && $user['level']>$ank['level'])
{
$mass[0]=$ank['id'];
$collisions=user_collision($mass);


if (count($collisions)>1)
{
echo "<span class=\"ank_n\">Possible Nicknames:</span>\n";
echo "<span class=\"ank_d\">\n";

for ($i=1;$i<count($collisions);$i++)
{
$ank_coll=mysql_fetch_assoc(mysql_query("SELECT * FROM `user` WHERE `id` = '$collisions[$i]' LIMIT 1"));
echo "\"<a href='/info.php?id=$ank_coll[id]'>$ank_coll[nick]</a>\"\n";
}

echo "</span>\n";
}
}



echo "  </td>\n";
echo "   </tr>\n";
}

echo "</table>\n";


if ($k_page>1)str("?",$k_page,$page); // Вывод страниц




include_once 'sys/inc/tfoot.php';
?>
