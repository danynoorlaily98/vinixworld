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
user_access('lic_themes',null,'index.php?'.SID);
adm_check();
if (!$license){header("Location: index.php?".SID);exit;}
$set['title']='Themes DCMS.su License';
include_once '../sys/inc/thead.php';
title();

if (isset($_GET['install']) && mysql_result(mysql_query("SELECT COUNT(*) FROM `license_themes` WHERE `id` = '".intval($_GET['install'])."'"),0)==1)
{
$them=mysql_fetch_assoc(mysql_query("SELECT * FROM `license_themes` WHERE `id` = '".intval($_GET['install'])."'"));
if (copy("http://dcms.su/dcms/downloads/themes/$them[id]/$them[tr_name].zip",H."sys/tmp/$them[tr_name].zip"))
{
$name=$them['tr_name'];
include_once H.'sys/inc/zip.php';
$zip=new PclZip(H."sys/tmp/$them[tr_name].zip");
$content = $zip->extract(PCLZIP_OPT_BY_NAME, 'them.name' ,PCLZIP_OPT_EXTRACT_AS_STRING);
$them_name=trim(esc($content[0]['content']));
if (strlen2($them_name)==null)$err[]='File "them.name" empty or not found';

$content = $zip->extract(PCLZIP_OPT_BY_NAME, 'style.css' ,PCLZIP_OPT_EXTRACT_AS_STRING);
$css=trim(esc($content[0]['content']));
if (strlen2($them_name)==null)$err[]='File "style.css" empty or not found';
@mkdir(H.'style/themes/'.$name, 0777);
@chmod(H.'style/themes/'.$name, 0777);
if ($name!=NULL)
@delete_dir(PCLZIP_OPT_PATH, H.'style/themes/'.$name);
$zip->extract(PCLZIP_OPT_PATH, H.'style/themes/'.$name, PCLZIP_OPT_SET_CHMOD, 0777);

@chmod(H.'style/themes/'.$name.'/forum/', 0777);
@chmod(H.'style/themes/'.$name.'/forum/14/', 0777);
@chmod(H.'style/themes/'.$name.'/forum/48/', 0777);
@chmod(H.'style/themes/'.$name.'/chat/', 0777);
@chmod(H.'style/themes/'.$name.'/chat/14/', 0777);
@chmod(H.'style/themes/'.$name.'/chat/48/', 0777);
@chmod(H.'style/themes/'.$name.'/lib/', 0777);
@chmod(H.'style/themes/'.$name.'/lib/14/', 0777);
@chmod(H.'style/themes/'.$name.'/lib/48/', 0777);
@chmod(H.'style/themes/'.$name.'/loads/', 0777);
@chmod(H.'style/themes/'.$name.'/loads/14/', 0777);
@chmod(H.'style/themes/'.$name.'/loads/48/', 0777);
@chmod(H.'style/themes/'.$name.'/user/', 0777);
@chmod(H.'style/themes/'.$name.'/votes/', 0777);
@chmod(H.'style/themes/'.$name.'/graph/', 0777);

if (!isset($err))msg('Theme "'.$name.' ('.$them_name.')" sucessfully installed');
@unlink(H."sys/tmp/$them[tr_name].zip");
}
else
$err[]='Unable to download theme';


}



if (isset($_GET['reload']))
{
$send['add']='themes';
$themes=lic_dcms($send);
if ($themes==false)
{
$err[]='Error loading';
}
else
{
mysql_query('TRUNCATE TABLE `license_themes`');
for ($i=0;$i<count($themes);$i++)
{
$them=$themes[$i];

mysql_query("INSERT INTO `license_themes` (`id`, `name`, `tr_name`, `autor`, `opis`)
VALUES (
'$them[id]',
'".my_esc($them['name'])."',
'".my_esc($them['tr_name'])."',
'".my_esc($them['autor'])."',
'".my_esc($them['opis'])."'
)");
}
msg('The list of those successfully loaded');
}

}


err();
//aut();

$k_post=mysql_result(mysql_query("SELECT COUNT(*) FROM `license_themes`"),0);
$k_page=k_page($k_post,$set['p_str']);
$page=page($k_page);
$start=$set['p_str']*$page-$set['p_str'];
echo "<table class='post'>\n";
if ($k_post==0)
{
echo "   <tr>\n";
echo "  <td class='p_t'>\n";
echo "No list of themes\n";
echo "  </td>\n";
echo "   </tr>\n";

}

$q=mysql_query("SELECT * FROM `license_themes` ORDER BY id DESC LIMIT $start, $set[p_str]");
while ($post = mysql_fetch_assoc($q))
{
echo "   <tr>\n";
if ($set['set_show_icon']==2){
echo "  <td class='icon48' rowspan='2'>\n";
echo "<img src='http://dcms.su/dcms/screen/$post[id]/48/' alt='' />";
echo "  </td>\n";
}
elseif ($set['set_show_icon']==1)
{
echo "  <td class='icon14'>\n";
echo "<img src='/style/icons/egg.png' alt='' />";
echo "  </td>\n";
}
echo "  <td class='p_t'>\n";
echo "$post[name]\n";
echo "  </td>\n";
echo "   </tr>\n";
echo "   <tr>\n";
if ($set['set_show_icon']==1)echo "  <td class='p_m' colspan='2'>\n"; else echo "  <td class='p_m'>\n";
echo "Author: $post[autor]<br />\n";

echo output_text($post['opis'])."<br />\n";
if (is_dir(H.'style/themes/'.@$post['tr_name']))
echo "Theme already installed<br />\n";
else
echo "<a href='?install=$post[id]&amp;page=$page'>Set</a><br />\n";

echo "  </td>\n";
echo "   </tr>\n";

}
echo "</table>\n";
if ($k_page>1)str('?',$k_page,$page); // Вывод страниц

echo "<div class='foot'>";
echo "&raquo;<a href='?reload=$passgen'>Refresh list of themes</a><br />\n";

if (user_access('adm_themes'))
echo "&raquo;<a href='themes.php'>Themes set management</a><br />\n";
echo "</div>\n";
if (user_access('adm_panel_show')){
echo "<div class='foot'>\n";
echo "&laquo;<a href='/adm_panel/'>Admin Panel</a><br />\n";
echo "</div>\n";
}

include_once '../sys/inc/tfoot.php';
?>
