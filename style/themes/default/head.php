<?
$set['web']=false;
//header("Content-type: application/vnd.wap.xhtml+xml");
//header("Content-type: application/xhtml+xml");
header("Content-type: text/html");
echo '<?xml version="1.0" encoding="utf-8"?>';
?><!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru">
<head><title><?echo $set['title'];?></title>
<link rel="shortcut icon" href="/favicon.ico" />
<link rel="stylesheet" href="/style/themes/<?echo $set['set_them'];?>/style.css" type="text/css" />
</head>
<body>
<?
if(isset($user)){
echo "<div class=\"mfsm\" id=\"root\"><div class=\"acb aps\" id=\"fb_header\"><table cellspacing=\"0\" cellpadding=\"0\" class=\"lr\"><tr><td valign=\"top\"><div class=\"header_logo\"><a href=\"/index.php?SESS=$sess\"><img class=\"img\" src=\"/style/themes/$set[set_them]/logo.png\" id=\"facebook_logo\" alt=\"logo\" title=\"forceimage\" width=\"76\" height=\"20\" /></a></div></td><td valign=\"top\">"; aut();
if($_SERVER['PHP_SELF']=='/panel.php'){
echo " <span class=\"mfss\"><a class=\"inv marquee_tab_select\" href=\"/panel.php?SESS=$sess\">$user[nick]</a></span>";
}
else
{
echo " <span class=\"mfss\"><a class=\"inv \" href=\"/menu.user.php?SESS=$sess\">$user[nick]</a></span>";}

echo "</td></tr></table></div><div class=\"marquee acb\">";
if($_SERVER['PHP_SELF']=='/index.php'){
echo "<span class=\"mfss\"><a class=\"inv marquee_tab_select\" href=\"/index.php?SESS=$sess\" accesskey=\"0\"><span>Inicio</span></a></span>";
}
else
{
echo "<span class=\"mfss\"><a class=\"inv\" href=\"/index.php?SESS=$sess\" accesskey=\"0\"><span>Inicio</span></a></span>";}
if($_SERVER['PHP_SELF']=='/info.php'){
echo "<span class=\"mfss\"><a class=\"inv marquee_tab_select\" href=\"/info.php?SESS=$sess\" accesskey=\"1\"><span>Perfil</span></a></span>";
}
else{
echo "<span class=\"mfss\"><a class=\"inv\" href=\"/info.php?SESS=$sess\" accesskey=\"1\"><span>Perfil</span></a></span>";}

if($_SERVER['PHP_SELF']=='/frend.php'){
echo "<span class=\"mfss\"><a class=\"inv marquee_tab_select\" href=\"/frend.php?SESS=$sess\" accesskey=\"2\"><span>Amigos</span></a></span>";
}
else{
echo "<span class=\"mfss\"><a class=\"inv\" href=\"/frend.php?SESS=$sess\" accesskey=\"2\"><span>Amigos</span></a></span>";}

// remodified by noe
// http://nnetwork.tk
// loegue.info@gmail.com
// hargailah privasi orang


if($_SERVER['PHP_SELF']=='/mail.php'){
$knm=mysql_result(mysql_query("SELECT COUNT(*) FROM `mail` WHERE `id_kont` = '$user[id]' AND `read` = '0'"), 0);
echo "<span class=\"mfss\"><a class=\"inv marquee_tab_select\" href=\"/mail.php?SESS=$sess\" accesskey=\"3\">";
echo "<span>Mensajes</span>";
if ($knm>0){
echo " $knm</a></span>";
}else{
echo "</a></span>";
}
}
else{
$knm=mysql_result(mysql_query("SELECT COUNT(*) FROM `mail` WHERE `id_kont` = '$user[id]' AND `read` = '0'"), 0);
echo "<span class=\"mfss\"><a class=\"inv\" href=\"/mail.php?SESS=$sess\" accesskey=\"3\">";
echo "<span>Mensajes</span>";
if ($knm>0){
echo "$knm </a></span>";
}else{
echo "</a></span>";
}
}
echo "</div>";
}

if(!isset($user)){
echo "<div valign=\"center\" class=\"logo\"><a href=\"/index.php\"><img class=\"img\" src=\"/style/themes/$set[set_them]/logo.png\" id=\"facebook_logo\" alt=\"logo\" title=\"forceimage\" width=\"76\" height=\"20\" /></a></div>";}

// remodified by noe
// http://nnetwork.tk
// loegue.info@gmail.com
// hargailah privasi orang

?>
