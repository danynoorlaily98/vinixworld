<?php

// Translated by : zanger
// Site : http://www.frendzmobile.co.cc

include_once '../sys/inc/start.php';
include_once '../sys/inc/compress.php';
include_once '../sys/inc/sess.php';
include_once '../sys/inc/home.php';
include_once '../sys/inc/settings.php';
include_once '../sys/inc/db_connect.php';
include_once '../sys/inc/ipua.php';
include_once '../sys/inc/fnc.php';
include_once '../sys/inc/user.php';

only_reg();

if ($user['balls']<50 || mysql_result(mysql_query("SELECT COUNT(*) FROM `group` WHERE `user` = '$user[id]'"), 0)!=0)
{header("Location: index.php?");exit;}

$set['title'] = 'Group baru';
include_once '../sys/inc/thead.php';
title();
//aut();
################### mod by antoq http://indwap.com####################################
// oopia aaoopecaoee

if (isset($_POST['name']) && isset($_POST['opis']))
{
$rnd = rand(00000,99999);
$opis = mysql_real_escape_string($_POST['opis']);
$name = mysql_real_escape_string($_POST['name']);

if (strlen2($name)<3 && strlen2($name)>32){header("Location: group_new.php?err=name&".SID);exit;}
if (strlen2($opis)>10 && strlen2($opis)>128){header("Location: group_new.php?err=msg&".SID);exit;}

$name_f = NULL;
if ($_POST['logo']==1 && isset($_FILES['file']) && $_FILES['file']!=NULL)
{
if (ereg("=|\+|\{|\}|\(|\)|\^|\%|\\$|#|@|!|\~|'|\"|:|;|`|,|\?|<|>",$fname)) {header("Location: group_new.php?err=file");exit;}
if (filesize($_FILES['file']['tmp_name']) > 1024*1024) {header("Location: group_new.php?err=file_size");exit;}

$W = 128;  // †epeia
$H = 128;  // Bucooa

if (ereg('<\?.*\?>',file_get_contents($_FILES['file']['tmp_name'])))
{
header("Location: group_new.php?err=name&".SID);exit;
}
elseif (eregi('\.jpe?g$',$_FILES['file']['name']) && $imgc=imagecreatefromjpeg($_FILES['file']['tmp_name']))
{
$img_x = imagesx($imgc);
$img_y = imagesy($imgc);

$name_f = $rnd.'_'.uniqid('').'.jpg';
if ($img_x<$W || $img_y<$H)
{
$W = $img_x;
$H = $img_y;
}
elseif ($img_x>$img_y)
{
$prop = $img_x/$img_y;
$H = ceil($W/$prop);
}
else
{
$prop = $img_y/$img_x;
$W = ceil($H/$prop);
}

$a = imagecreatetruecolor($W, $H);
imagecopyresized($a, $imgc, 0, 0, 0, 0, $W, $H, $img_x, $img_y);

imagejpeg($a, 'logo/'.$name_f,100);
}
elseif (eregi('\.gif$',$_FILES['file']['name']) && $imgc=imagecreatefromgif($_FILES['file']['tmp_name']))
{
$img_x = imagesx($imgc);
$img_y = imagesy($imgc);
$name_f = $rnd.'_'.uniqid('').'.gif';
if ($img_x<$W || $img_y<$H)
{
$W = $img_x;
$H = $img_y;
}
elseif ($img_x>$img_y)
{
$prop = $img_x/$img_y;
$H = ceil($W/$prop);
}
else
{
$prop = $img_y/$img_x;
$W = ceil($H/$prop);
}

$a=ImageCreate($W, $H);
imagecopyresized($a, $imgc, 0, 0, 0, 0, $W, $H, $img_x, $img_y);

imagegif($a, 'logo/'.$name_f,100);
}
elseif (eregi('\.png$',$_FILES['file']['name']) && $imgc=imagecreatefrompng($_FILES['file']['tmp_name']))
{
$img_x=imagesx($imgc);
$img_y=imagesy($imgc);
$name_f = $rnd.'_'.uniqid('').'.png';
if ($img_x<$W || $img_y<$H)
{
$W=$img_x;
$H=$img_y;
}
elseif ($img_x>$img_y)
{
$prop=$img_x/$img_y;
$H=ceil($W/$prop);
}
else
{
$prop=$img_y/$img_x;
$W=ceil($H/$prop);
}

$a=ImageCreate($W, $H);
imagecopyresized($a, $imgc, 0, 0, 0, 0, $W, $H, $img_x, $img_y);

imagepng($a,'logo/'.$name_f);

}
imagedestroy($imgc);
imagedestroy($a);
}

mysql_query("INSERT INTO `group` (`user`, `time`, `name`, `logo`, `about`, `all`) VALUES ('$user[id]', '$time', '$name', '$name_f', '$opis', '1')");
$m_id = mysql_insert_id();
mysql_query("INSERT INTO `group_u` (`user`, `id`, `time`) VALUES ('$user[id]', '$m_id', '$time')");

header("Location: index.php?".SID);
exit;
}


echo '<div class="p_t">Buat Group?</div>',
'<div class="post">',
'<form enctype="multipart/form-data" action="group_new.php" method="post">',
'Nama Group (3-64)*:<br />
<input type = "text" name = "name" value = "" maxlength = "64"><br />',
'<input type="checkbox" name="logo" value="1">Gunakan Logo?<br />',
'Logo: (max. 1Mb)<br />',
'<input name="file" type="file" accept="images"><br />',
'Deskripsi (10-250)*:<br />',
'<textarea name="opis"  rows="3" cols="35" maxlength = "520"></textarea><br />',
'<br />',
'<input type="submit" value="Submit"></form>',
'<br />',
' :: <a href="index.php">Group</a>';

echo '</div>'."\n";


################### mod by antoq http://indwap.com####################################
include_once '../sys/inc/tfoot.php';
?>
