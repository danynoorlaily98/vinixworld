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
user_access('adm_news',null,'index.php?'.SID);
adm_check();
$set['title']='News';
include_once '../sys/inc/thead.php';
title();

if (isset($_GET['del']) && is_numeric($_GET['del']) && mysql_result(mysql_query("SELECT COUNT(*) FROM `news` WHERE `id` = '".intval($_GET['del'])."' LIMIT 1",$db), 0)==1)
{

mysql_query("DELETE FROM `news` WHERE `id` = '".intval($_GET['del'])."' LIMIT 1");
mysql_query("OPTIMIZE TABLE `news`");
msg('News removed');
}

if (isset($_POST['title']) && isset($_POST['msg']) && isset($_POST['link']))
{
$title=esc($_POST['title'],1);
$link=esc($_POST['link'],1);

if ($link!=NULL && !eregi('^https?://',$link) && !eregi('^/',$link))$link='/'.$link;

$msg=esc($_POST['msg']);
if (strlen2($title)>32){$err='Too big headline news';}
if (strlen2($title)<3){$err='Short title';}

$mat=antimat($title);
if ($mat)$err[]='The headlines found mat: '.$mat;

if (strlen2($msg)>1024){$err='Maximal 1024 characters';}
if (strlen2($msg)<2){$err='Minimal 2 characters';}

$mat=antimat($msg);
if ($mat)$err[]='In the message body found mat: '.$mat;


$msg=my_esc($msg);
if (!isset($err)){

$ch=intval($_POST['ch']);
$mn=intval($_POST['mn']);
$main_time=time()+$ch*$mn*60*60*24;

if ($main_time<=time())
$main_time=0;

mysql_query("INSERT INTO `news` (`time`, `msg`, `title`, `main_time`, `link`) values('$time', '$msg', '$title', '$main_time', '$link')");
mysql_query("OPTIMIZE TABLE `news`");

if (isset($_POST['mail'])) // Расслылка новостей на майл
{
$q=mysql_query("SELECT `ank_mail` FROM `user` WHERE `set_news_to_mail` = '1' AND `ank_mail` <> ''");
while ($ank = mysql_fetch_assoc($q))
{
mysql_query("INSERT INTO `mail_to_send` (`mail`, `them`, `msg`) values('$ank[ank_mail]', 'Новости', '".trim(br(bbcode(links(stripcslashes(htmlspecialchars($msg))))))."')");
}
}


msg('News successfully added');
}
}

err();
//aut();




$k_post=mysql_result(mysql_query("SELECT COUNT(*) FROM `news`"),0);
$k_page=k_page($k_post,$set['p_str']);
$page=page($k_page);
$start=$set['p_str']*$page-$set['p_str'];
$q=mysql_query("SELECT * FROM `news` ORDER BY `id` DESC LIMIT $start, $set[p_str]");
echo "<table class='post'>\n";
if ($k_post==0)
{
echo "   <tr>\n";
echo "  <td class='p_t'>\n";
echo "No News\n";
echo "  </td>\n";
echo "   </tr>\n";

}
while ($post = mysql_fetch_assoc($q))
{
echo "   <tr>\n";
echo "  <td class='p_t'>\n";
echo "$post[title]\n";
echo "(".vremja($post['time']).")\n";
echo "  </td>\n";
echo "   </tr>\n";
echo "   <tr>\n";
echo "  <td class='p_m'>\n";
echo output_text($post['msg'])."<br />\n";

if ($post['link']!=NULL)echo "Link ".htmlentities($post['link'], ENT_QUOTES, 'UTF-8')."<br />\n";

echo "<a href=\"news.php?page=$page&amp;del=$post[id]\">Delete News</a><br />\n";
echo "  </td>\n";
echo "   </tr>\n";
}
echo "</table>\n";
if ($k_page>1)str('news.php?',$k_page,$page); // Вывод страниц




echo "<form method=\"post\" action=\"news.php\">\n";
echo "Title:<br />\n<input name=\"title\" size=\"16\" maxlength=\"32\" value=\"\" type=\"text\" /><br />\n";
echo "News Text:<br />\n<textarea name=\"msg\" ></textarea><br />\n";
echo "Link:<br />\n<input name=\"link\" size=\"16\" maxlength=\"64\" value=\"\" type=\"text\" /><br />\n";

echo "<label><input name=\"mail\" value=\"1\" type=\"checkbox\" checked=\"checked\" /> Newletter (".mysql_result(mysql_query("SELECT COUNT(*) FROM `user` WHERE `set_news_to_mail` = '1' AND `ank_mail` <> ''"),0).")</label><br />\n";


echo "Show On:<br />\n";
echo "<input type=\"text\" name=\"ch\" size='3' value=\"1\" />\n";
echo "<select name=\"mn\">\n";
echo "  <option value=\"0\" selected='selected'>   </option>\n";
echo "  <option value=\"1\">Days</option>\n";
echo "  <option value=\"7\">Weeks</option>\n";
echo "  <option value=\"31\">Months</option>\n";
echo "</select><br />\n";

echo "<input value=\"Add\" type=\"submit\" />\n";
echo "</form>\n";

if (user_access('adm_panel_show')){
echo "<div class='foot'>\n";
echo "&laquo;<a href='/adm_panel/'>Admin Panel</a><br />\n";
echo "</div>\n";
}
include_once '../sys/inc/tfoot.php';
?>
