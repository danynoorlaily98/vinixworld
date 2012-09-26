<?php

//Определяем сколько надо закрасить

$p = (isset($_GET['p']) && $_GET['p']>=0 && $_GET['p']<=100) ? (int)$_GET['p'] : 50;

//Создаем картинку

$image = imagecreate(100, 8);

//Цвет фона

$bg = imagecolorallocate ($image, 777, 777, 777);

//Цвет активной части и надписи к-ва %

$act = imagecolorallocate($image, 00, 00, 95);

//Цвет пассивной части

$emp = imagecolorallocate($image, 44, 999, 44);

imagefill($image, 0, 0, $bg);

imagefilledrectangle($image, 1, 1, 100, 6, $emp);

if($p > 0)

imagefilledrectangle($image, 1, 1, $p, 6, $act);

//Пишем к-во %

imagestring($image, 1, 50, 0, $p, $act);

header('Content-type: image/png');

imagepng($image);

imagedestroy($image);

?>