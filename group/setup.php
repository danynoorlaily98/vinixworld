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

if (isset($_GET['id']))
{
$id = intval($_GET['id']);
if (mysql_result(mysql_query("SELECT COUNT(id) FROM `group` where `id` = '$id' LIMIT 1"),0)==0)exit;
$g = mysql_fetch_array(mysql_query("SELECT * FROM `group` WHERE `id` = '$id'  LIMIT 1"));
$ank = mysql_fetch_array(mysql_query("SELECT * FROM `user` WHERE `id` = '$g[user]'  LIMIT 1"));
if ($user['id']!=$ank['id'] && $user['level']<2)exit;

if (isset($_GET['logo']) && isset($_FILES['file']) && $_FILES['file']!=NULL)
{
if (ereg("=|\+|\{|\}|\(|\)|\^|\%|\\$|#|@|!|\~|'|\"|:|;|`|,|\?|<|>",$fname)) {header("Location: index.php?err=file");exit;}
if (filesize($_FILES['file']['tmp_name']) > 1024*100) {header("Location: index.php?err=file_size");exit;}

$W = 128;  // ?epeia
$H = 128;  // Bucooa

$rnd = rand(00000,99999);
$name_f = NULL;

chmod('logo/'.$g['logo'],0777);

if (ereg('<\?.*\?>',file_get_contents($_FILES['file']['tmp_name'])))
{
header("Location: index.php?err=name&".SID);exit;
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

unlink('logo/'.$g['logo']);
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

unlink('logo/'.$g['logo']);
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

unlink('logo/'.$g['logo']);
imagepng($a,'logo/'.$name_f);
}
imagedestroy($imgc);
imagedestroy($a);

mysql_query("UPDATE `group` SET `logo` = '$name_f' WHERE `id` = '$id' LIMIT 1");
header("Location: setup.php?id=".$id);
exit;
}
elseif (isset($_POST['name']) && isset($_POST['opis']))
{
$opis = mysql_real_escape_string($_POST['opis']);
$name = mysql_real_escape_string($_POST['name']);
if (strlen2($name)<3 && strlen2($name)>32){header("Location: index.php?err=name&".SID);exit;}
if (strlen2($opis)>10 && strlen2($opis)>128){header("Location: index.php?err=msg&".SID);exit;}

mysql_query("UPDATE `group` SET `name` = '$name', `about` = '$opis' WHERE `id` = '$id' LIMIT 1");
header("Location: setup.php?id=".$id);
exit;
}

$set['title'] = $g['name'];
include_once '../sys/inc/thead.php';
title();
//aut();
# O:acoieee
echo '<div class="p_t">Members '.$g['name'].'</div>
<div class="post"> :: <a href="users.php?id='.$id.'">Reference</a> ('.$g['all'].')</div>';

echo '<div class="p_t">Pengaturan group '.$g['name'].'</div>',
'<div class="post">',
'<form action="setup.php?id='.$id.'" method="post">',
'Nama group (3-64)*:<br /><input type="text" name="name" value="'.$g['name'].'" maxlength = "64"><br />',
'Deskripsi (10-250)*:<br />',
'<textarea name="opis"  rows="3" cols="35" maxlength="520">'.$g['about'].'</textarea><br />',
'<table><td>',
'<input type="submit" value="Edit"></form>',
'</td></table>',
'</div>'."\n".'<br />';

# Eoaooei
echo '<div class="name">Logo '.$g['name'].'</div>';

if (isset($_GET['del_logo']))
{
if (isset($_GET['ok']))
{
chmod('logo/'.$g['logo'],0777);
unlink('logo/'.$g['logo']);
mysql_query("UPDATE `group` SET `logo` = '' WHERE `id` = '$id' LIMIT 1");

header("Location: setup.php?id=$id&".SID);
exit;
}
echo '<div class="post"><b>Hapus logo?</b></div>
&nbsp; <a href="setup.php?id='.$id.'&del_logo&ok">ya</a>  &nbsp; <a href="setup.php?id='.$id.'">tidak</a>';
}

echo '<div class="post">';
if ($g['logo']!=NULL){echo '<div class="post"> <img src="logo/'.$g['logo'].'" alt="logo"> </div>';}
else{echo '<div class="post"> Tidak ada logo </div>';}
echo '<br />Logo: <form enctype="multipart/form-data" action="setup.php?id='.$id.'&logo" method="post">',
'Logo: (max. 100kb)<br />',
'<input name="file" type="file" accept="images"><br />',
'<table><td>',
'<input type="submit" value="Edit"></form>',
'</td><td>',
'<form action="setup.php?id='.$id.'&del_logo" method="post"><input type="submit" value="Hapus"></form>',
'</td></table>';

echo '</div>'."\n";

# ieie :ao
echo '<div class="p_t">Mini chat '.$g['name'].'</div>';
if (isset($_GET['del_chat']))
{
if (isset($_GET['ok']))
{
mysql_query("DELETE FROM `group_board` WHERE `g` = '$id'");
mysql_query("OPTIMIZE TABLE `group_board`");
header("Location: setup.php?id=$id&".SID);
exit;
}
echo '<div class="post"><b>Hapus chat?</b></div>
&nbsp; <a href="setup.php?id='.$id.'&del_chat&ok">ya</a>  &nbsp; <a href="setup.php?id='.$id.'">tidak</a>';
}

echo '<div class="post"> :: <a href="group_board.php?id='.$id.'">Di mini-chat</a></div>';
echo '<div class="post">',
'<table><td>',
'<form action="setup.php?id='.$id.'&del_chat" method="post"><input type="submit" value="Hapus"></form>',
'</td></table>';

echo '</div>'."\n";

echo ' :: <a href="index.php?id='.$id.'">'.$g['name'].'</a>';

include_once '../sys/inc/tfoot.php';
}
?>
