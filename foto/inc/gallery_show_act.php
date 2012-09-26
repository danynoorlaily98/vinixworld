<?

// remodified by noe
// http://nnetwork.tk
// loegue.info@gmail.com
// hargailah privasi orang


if ((user_access('foto_alb_del') || isset($user) && $user['id']==$ank['id']) && isset($_GET['act']) && $_GET['act']=='delete' && isset($_GET['ok']))
{
$q=mysql_query("SELECT * FROM `gallery_foto` WHERE `id_gallery` = '$gallery[id]'");
while ($post = mysql_fetch_assoc($q))
{
@unlink(H."sys/gallery/48/$post[id].jpg");
@unlink(H."sys/gallery/128/$post[id].jpg");
@unlink(H."sys/gallery/640/$post[id].jpg");
@unlink(H."sys/gallery/foto/$post[id].jpg");

mysql_query("DELETE FROM `gallery_foto` WHERE `id` = '$post[id]' LIMIT 1");

}
mysql_query("DELETE FROM `gallery` WHERE `id` = '$gallery[id]' LIMIT 1");
msg('Foto berhasil di hapus');
aut();



echo "<div class=\"foot\">\n";

echo "&laquo;<a href='/foto/$ank[id]/'>Album Foto</a><br />\n";

echo "</div>\n";
include_once '../sys/inc/tfoot.php';
exit;
}

if (isset($user) && $user['id']==$ank['id'] && isset($_FILES['file']))
{
if ($imgc=@imagecreatefromstring(file_get_contents($_FILES['file']['tmp_name'])))
{
$name=esc(stripcslashes(htmlspecialchars($_POST['name'])),1);
if (isset($_POST['translit1']) && $_POST['translit1']==1)$name=translit($name);
if ($name==null)$name=esc(stripcslashes(htmlspecialchars(eregi_replace('\.[^\.]*$', NULL, $_FILES['file']['name'])))); // nama file tanpa ekstensi)),1);



if (ereg("\{|\}|\^|\%|\\$|#|@|!|\~|'|\"|`|<|>",$name))$err='Judul album mengandung karakter yg tidak valid';
if (strlen2($name)<3)$err='Judul terlalu pendek,minimal judul 2 karakter';
if (strlen2($name)>32)$err='Haзвaниe нe дoлжнo быть длиннee 32-x cимвoлoв';
$name=mysql_real_escape_string($name);

$msg=$_POST['opis'];
if (isset($_POST['translit2']) && $_POST['translit2']==1)$msg=translit($msg);
//if (strlen2($msg)<10)$err='';
if (strlen2($msg)>1024)$err='Deskripsi terlalu panjang,maksimal 1024 karakter';
$msg=mysql_real_escape_string($msg);
$img_x=imagesx($imgc);
$img_y=imagesy($imgc);


if ($img_x>$set['max_upload_foto_x'] || $img_y>$set['max_upload_foto_y'])$err='Ukuran Gambar melebihi batas'.$set['max_upload_foto_x'].'*'.$set['max_upload_foto_y'];

if (!isset($err)){
mysql_query("INSERT INTO `gallery_foto` (`id_gallery`, `name`, `ras`, `type`, `opis`) values ('$gallery[id]', '$name', 'jpg', 'image/jpeg', '$msg')");
$id_foto=mysql_insert_id();
mysql_query("UPDATE `gallery` SET `time` = '$time' WHERE `id` = '$gallery[id]' LIMIT 1");
if ($img_x==$img_y)
{
$dstW=48; // width
$dstH=48; // height
}
elseif ($img_x>$img_y)
{
$prop=$img_x/$img_y;
$dstW=48;
$dstH=ceil($dstW/$prop);
}
else
{
$prop=$img_y/$img_x;
$dstH=48;
$dstW=ceil($dstH/$prop);
}

$screen=imagecreatetruecolor($dstW, $dstH);
imagecopyresampled($screen, $imgc, 0, 0, 0, 0, $dstW, $dstH, $img_x, $img_y);
//imagedestroy($imgc);
imagejpeg($screen,H."sys/gallery/48/$id_foto.jpg",90);
@chmod(H."sys/gallery/48/$id_foto.jpg",0777);
imagedestroy($screen);

if ($img_x==$img_y)
{
$dstW=128; // шиpинa
$dstH=128; // выcoтa
}
elseif ($img_x>$img_y)
{
$prop=$img_x/$img_y;
$dstW=128;
$dstH=ceil($dstW/$prop);
}
else
{
$prop=$img_y/$img_x;
$dstH=128;
$dstW=ceil($dstH/$prop);
}

$screen=imagecreatetruecolor($dstW, $dstH);
imagecopyresampled($screen, $imgc, 0, 0, 0, 0, $dstW, $dstH, $img_x, $img_y);
//imagedestroy($imgc);
$screen=img_copyright($screen); // нaлoжeниe кoпиpaйтa
imagejpeg($screen,H."sys/gallery/128/$id_foto.jpg",90);
@chmod(H."sys/gallery/128/$id_foto.jpg",0777);
imagedestroy($screen);

if ($img_x>640 || $img_y>640){
if ($img_x==$img_y)
{
$dstW=640; // шиpинa
$dstH=640; // выcoтa
}
elseif ($img_x>$img_y)
{
$prop=$img_x/$img_y;
$dstW=640;
$dstH=ceil($dstW/$prop);
}
else
{
$prop=$img_y/$img_x;
$dstH=640;
$dstW=ceil($dstH/$prop);
}

$screen=imagecreatetruecolor($dstW, $dstH);
imagecopyresampled($screen, $imgc, 0, 0, 0, 0, $dstW, $dstH, $img_x, $img_y);
//imagedestroy($imgc);
$screen=img_copyright($screen); // нaлoжeниe кoпиpaйтa
imagejpeg($screen,H."sys/gallery/640/$id_foto.jpg",90);
imagedestroy($screen);
$imgc=img_copyright($imgc); // нaлoжeниe кoпиpaйтa
imagejpeg($imgc,H."sys/gallery/foto/$id_foto.jpg",90);
@chmod(H."sys/gallery/foto/$id_foto.jpg",0777);
}
else
{
$imgc=img_copyright($imgc); // нaлoжeниe кoпиpaйтa

imagejpeg($imgc,H."sys/gallery/640/$id_foto.jpg",90);
imagejpeg($imgc,H."sys/gallery/foto/$id_foto.jpg",90);
@chmod(H."sys/gallery/foto/$id_foto.jpg",0777);
}

@chmod(H."sys/gallery/640/$id_foto.jpg",0777);

imagedestroy($imgc);
msg("Foto berhasil di tambahkan");

$foto='[time]add a photo in a Photo Album[/time]
[url=/foto/'.$ank[id].'/'.$gallery[id].'/'.$id_foto.'/][img]/foto/foto128/'.$id_foto.'.jpg[/img][/url]
[nome][url=/foto/'.$ank[id].'/'.$gallery[id].'/]'.$gallery[name].'[/url][/nome]';
mysql_query("INSERT INTO `statuse_list` (`id_user`, `msg`, `time`, `kategori`) values('$user[id]', '$foto', '$time', '1')");
mysql_query("UPDATE `user` SET `balls` = '".($user['balls']+1)."' WHERE `id` = '$user[id]' LIMIT 1");
}
}
else $err='Format gambar yg di pilih tidak valid';
}



?>
