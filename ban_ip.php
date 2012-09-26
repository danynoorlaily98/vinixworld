<?
include_once 'sys/inc/start.php';
include_once 'sys/inc/compress.php';
include_once 'sys/inc/sess.php';
include_once 'sys/inc/home.php';
include_once 'sys/inc/settings.php';
include_once 'sys/inc/db_connect.php';
include_once 'sys/inc/ipua.php';
$ban_ip_page=true; // чтобы небыло зацикливания
include_once 'sys/inc/fnc.php';
//include_once 'sys/inc/user.php';

$set['title']='Ban by IP';
include_once 'sys/inc/thead.php';
title();
$err="<h1>Acesses from IP ($_SERVER[REMOTE_ADDR]) temporary blocked</h1>";
err();
//aut();
?>

<h2>Possible reasons:</h2>
1) Frequent request to the server from one IP address.<br />
2) Your IP address matches with the addres of offender.<br />
<h2>Workaraund:</h2>
1) Restart the connection to the internet.<br />
2) In the case of static IP address, you can use a proxy server<br />
<?include_once 'sys/inc/tfoot.php';?>