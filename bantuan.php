<?

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


//only_reg();
$set['title']='Ayuda';
include_once 'sys/inc/thead.php';
title();
err();

echo "<a href='help.php?SESS=$sess'>Bantuan Situs</a><br/>";
echo "<a href='bb-code.php?SESS=$sess'>BB-Code</a><br/>";
echo "<a href='terms.php?SESS=$sess'>Ketentuan Situs</a><br/>";
echo "<a href='rules.php?SESS=$sess'>Peraturan Situs</a> (English)<br/>";
echo "<a href='smiles.php?SESS=$sess'>Smiles</a><br/>";
echo "<a href='about.php?SESS=$sess'>Tentang Situs</a><br/>";

include_once 'sys/inc/tfoot.php';
?>
