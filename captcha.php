<?
include_once 'sys/inc/start.php';
include_once 'sys/inc/sess.php';
include_once 'sys/inc/home.php';
include_once 'sys/inc/settings.php';
include_once 'sys/inc/db_connect.php';
include_once 'sys/inc/ipua.php';
include_once 'sys/inc/fnc.php';
include_once 'sys/inc/MultiWave.php';
$show_all=true; // показ для всех, в противном случае невозможно будет пройти регистрацию
include_once 'sys/inc/user.php';

$_SESSION['captcha']=rand(10000,99999);


$img=imagecreatetruecolor(100, 30);

imagefill($img, 0, 0, imagecolorallocate ($img, 255, 255, 255));

imagettftext ($img, 12, 0, 30, 20, imagecolorallocate ($img, 0, 0, 0), 'sys/fonts/tahoma.ttf', "$_SESSION[captcha]");
header("Content-type: image/jpeg");

$img=MultiWave($img);
imagejpeg($img,null,20);
?>