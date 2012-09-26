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
user_access('adm_themes',null,'index.php?'.SID);
adm_check();
include_once '../sys/inc/zip.php';
$set['title']='Themes Installer';
include_once '../sys/inc/thead.php';
title();

if (isset($_FILES['file']) && filesize($_FILES['file']['tmp_name'])!=0)
{
$file=esc(stripcslashes(htmlspecialchars($_FILES['file']['name'])));
$file=ereg_replace('(#|\?)', NULL, $file);
$name=esc(trim(retranslit(eregi_replace('\.[^\.]*$', NULL, $file)))); // имя файла без расширения
$ras=strtolower(eregi_replace('^.*\.', NULL, $file));
if ($ras!='zip')$err='Theme should be in ZIP archieve';
if (!isset($err))
{
$zip=new PclZip($_FILES['file']['tmp_name']);
$them_default=new PclZip(H.'sys/add/them.zip');
$content = $zip->extract(PCLZIP_OPT_BY_NAME, 'them.name' ,PCLZIP_OPT_EXTRACT_AS_STRING);
$them_name=trim(esc(@$content[0]['content']));
if (strlen2($them_name)==null)$err='File "them.name" empty or not found';

$content = $zip->extract(PCLZIP_OPT_BY_NAME, 'style.css' ,PCLZIP_OPT_EXTRACT_AS_STRING);
$css=trim(esc(@$content[0]['content']));
if (strlen2($them_name)==null)$err='File "style.css" empty or not found';
@mkdir(H.'style/themes/'.$name, 0777);
@chmod(H.'style/themes/'.$name, 0777);
if ($name!=NULL)
@delete_dir(PCLZIP_OPT_PATH, H.'style/themes/'.$name);
$zip->extract(PCLZIP_OPT_PATH, H.'style/themes/'.$name, PCLZIP_OPT_SET_CHMOD, 0777,PCLZIP_OPT_BY_PREG, "#^[^\.ht]+#ui");
if (isset($_POST['add_of_default']) && $_POST['add_of_default']==1)
$them_default->extract(PCLZIP_OPT_PATH, H.'style/themes/'.$name, PCLZIP_OPT_SET_CHMOD, 0777);

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

}
else $err='You can not create a folder with the theme';
if (!isset($err))msg('Theme "'.$name.' ('.$them_name.')" successfully installed');
}




err();
//aut();

echo "<form class='foot' enctype=\"multipart/form-data\" action='?' method=\"post\">";
echo "Upload:<br />\n";
echo "<input name='file' type='file' accept='application/zip' /><br />\n";
echo "<label><input type=\"checkbox\" name=\"add_of_default\" value=\"1\" /> Add missing files</label><br />\n";
echo "<input class=\"submit\" type=\"submit\" value=\"Install\" /><br />\n";
echo "Theme must be in a ZIP archieve without folder<br />\n";
echo "Precense of file 'style.css' and 'theme.name' necessarily<br />\n";
echo "Name the folder of theme is taken from name of the archieve<br />\n";
echo "</form>";



echo "<div class='foot'>\n";
echo "&laquo;<a href='themes.php'>Back</a><br />\n";
if (user_access('adm_panel_show'))
echo "&laquo;<a href='/adm_panel/'>Admin Panel</a><br />\n";
echo "</div>\n";

include_once '../sys/inc/tfoot.php';
?>
