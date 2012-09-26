<?
include_once '../sys/inc/start.php';
include_once '../sys/inc/sess.php';
include_once '../sys/inc/home.php';
include_once '../sys/inc/settings.php';
include_once '../sys/inc/db_connect.php';
include_once '../sys/inc/ipua.php';
$set['antidos']=0;
include_once '../sys/inc/fnc.php';
include_once '../sys/inc/user.php';

if (!isset($_GET['p']))exit;
$p=max(0,min(100,intval($_GET['p'])));


$k=max(0,intval(@$_GET['k']));
$a=max(0,intval(@$_GET['a']));

$x=128;
$y=10;

$x2=@intval($x/(100/$p));


$img=imagecreate($x,$y);


$col['back']=imagecolorallocate($img, 255,255,255);
$col['draw']=imagecolorallocate($img, 200,200,200);
$col['font']=imagecolorallocate($img, 0,0,0);
$col['border']=imagecolorallocate($img, 155,155,155);

imagefill($img, $x, $y, $col['back']);

imagefilledrectangle($img, 0, 0, $x2, $y, $col['draw']);

imagerectangle($img, 0, 0, $x-1, $y-1, $col['border']);

imagettftext ($img, 7, 0, $x/10, $y-2, $col['font'], H.'sys/fonts/tahoma.ttf', "$k of $a");





header("Content-type: image/png");
imagepng($img);
?>
