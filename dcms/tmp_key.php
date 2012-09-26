<?
include_once '../sys/inc/start.php';
include_once '../sys/inc/sess.php';
include_once '../sys/inc/home.php';
include_once '../sys/inc/settings.php';
include_once '../sys/inc/db_connect.php';
include_once '../sys/inc/ipua.php';
include_once '../sys/inc/fnc.php';
error_reporting(0);
if (!is_file(H.'sys/tmp/tmp_key.dat'))exit;
if (!isset($_GET['passgen']))exit;
echo md5(file_get_contents(H.'sys/tmp/tmp_key.dat').$_GET['passgen']);
unlink(H.'sys/tmp/tmp_key.dat');
?>