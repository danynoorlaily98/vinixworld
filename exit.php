<?php

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
$set['title']='Sign Out';
include_once 'sys/inc/thead.php';

err();
only_reg();
if (!isset($_GET['exit'])){
echo "<div class='footer'>";
echo "Are you sure want to exit???<br/>";
echo "<left><table width='100%'>";
echo "<tr><td width='10%'><form method='post' action='?exit'><input value=\"Exit\" class=\"btn btnC\" type=\"submit\"></form><td width='50%'> &#183; <a href='/index.php'>Back</a></table></div>";
}
else
{
setcookie('id_user');
setcookie('pass');
session_destroy();
header('Location: /?'.SID);
}
include_once 'sys/inc/tfoot.php';

?>
