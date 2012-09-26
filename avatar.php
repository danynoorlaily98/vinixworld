<?

#Avatar Fix 664

// remodified by noe
// http://nnetwork.tk
// loegue.info@gmail.com
// hargailah privasi orang

include_once 'sys/inc/start.php';
include_once 'sys/inc/compress.php';
include_once 'sys/inc/sess.php';
include_once 'sys/inc/home.php';
include_once 'sys/inc/settings.php';
include_once 'sys/inc/db_connect.php';
include_once 'sys/inc/ipua.php';
include_once 'sys/inc/fnc.php';
include_once 'sys/inc/user.php';

only_reg();
$set['title']='Change Photo Profile';
include_once 'sys/inc/thead.php';
//title();

if (isset($_FILES['file'])){

if (eregi('\.jpe?g$',$_FILES['file']['name']) && $imgc=@imagecreatefromjpeg($_FILES['file']['tmp_name'])){
if (imagesx($imgc)>32 || imagesy($imgc)>36){
$img_x=imagesx($imgc);
$img_y=imagesy($imgc);

if ($img_x==$img_y){
$dstW=32;
$dstH=36;}
elseif ($img_x>$img_y){
$prop=$img_x/$img_y;
$dstW=32;
$dstH=ceil($dstW/$prop);}

else{
$prop=$img_y/$img_x;
$dstH=36;
$dstW=ceil($dstH/$prop);}

$screen=imagecreatetruecolor($dstW, $dstH);
imagecopyresampled($screen, $imgc, 0, 0, 0, 0, $dstW, $dstH, $img_x, $img_y);
imagedestroy($imgc);
@chmod(H."sys/avatar/$user[id].jpg",0777);
@unlink(H."sys/avatar/$user[id].jpg");
imagejpeg($screen,H."sys/avatar/$user[id].jpg",36);
@chmod(H."sys/avatar/$user[id].jpg",0777);
imagedestroy($screen);}

else
{copy($_FILES['file']['tmp_name'], H."sys/avatar/$user[id].jpg");}


msg("Your photo profile has been changed");
$msg='[time]Change photo profile[/time] [url=/primary.php?id='.$user[id].'][img]/sys/avatar/'.$user[id].'.jpg[/img][/url]';
mysql_query("INSERT INTO `statuse_list` (`id_user`, `msg`, `time`, `kategori`) values('$user[id]', '$msg', '$time', '1')");
mysql_query("UPDATE `user` SET `balls` = '".($user['balls']+1)."' WHERE `id` = '$user[id]' LIMIT 1");
//$msgak='[url=/info.php?id='.$user[id].']'.$user[nick].'[/url] profile [img]/sys/avatar/'.$user[id].'.jpg[/img]';
//mysql_query("INSERT INTO `aktivitas_ku` (`id_user`, `id_kont`, `msg`, `time`) values('0', '$user[id]', '$msgak', '$time')");
}
if (eregi('\.jpe?g$',$_FILES['file']['name']) && $imgc=@imagecreatefromjpeg($_FILES['file']['tmp_name'])){
if (imagesx($imgc)>280 || imagesy($imgc)>360){
$img_x=imagesx($imgc);
$img_y=imagesy($imgc);

if ($img_x==$img_y){
$dstW=280;
$dstH=360;}

elseif ($img_x>$img_y){
$prop=$img_x/$img_y;
$dstW=280;
$dstH=ceil($dstW/$prop);}

else{
$prop=$img_y/$img_x;
$dstH=360;
$dstW=ceil($dstH/$prop);}

$screen=imagecreatetruecolor($dstW, $dstH);
imagecopyresampled($screen, $imgc, 0, 0, 0, 0, $dstW, $dstH, $img_x, $img_y);
imagedestroy($imgc);
@chmod(H."sys/avatars/$user[id].jpg",0777);
@unlink(H."sys/avatars/$user[id].jpg");
imagejpeg($screen,H."sys/avatars/$user[id].jpg",360);
@chmod(H."sys/avatars/$user[id].jpg",0777);
imagedestroy($screen);}

else
{copy($_FILES['file']['tmp_name'], H."sys/avatars/$user[id].jpg");}
}
else
{$err='File format not allowed';}

}

err();
//aut();
//title();
echo "<div class='menu'><center>";
avatars($user['id']);
echo "</center></div>";
echo "<div class='p_m'>file format allowed: .jpg</div><div>";
echo "<form class='foot' method='post' enctype=\"multipart/form-data\" action='?$passgen'>\n";
echo "<input type=\"file\" name=\"file\" style='width: 98%;' accept='image/*,image/jpeg' />\n";
echo "<input value=\"Upload\" type=\"submit\" />\n";
echo "</form>";


echo '</div><div class="foot" style="text-align: left;">';
echo '&bull; <a href="/info.php">Profile</a>';
echo "</div>";
include_once 'sys/inc/tfoot.php';
?>
