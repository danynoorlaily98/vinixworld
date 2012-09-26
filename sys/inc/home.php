<?
$flevel = NULL;
$flevelk =0;
while (! is_file ($flevel .'sys/inc/home.php') && $flevelk <20) { $flevel .='../';
$flevelk ++;
}
define("H", $flevel );
?>
