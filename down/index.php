<?
include_once '../sys/inc/start.php';
include_once '../sys/inc/compress.php';
include_once '../sys/inc/sess.php';
include_once '../sys/inc/home.php';
include_once '../sys/inc/settings.php';
include_once '../sys/inc/db_connect.php';
include_once '../sys/inc/ipua.php';
include_once '../sys/inc/fnc.php';
include_once '../sys/inc/user.php';

$set['title']='Gameloft mob';
include_once '../sys/inc/thead.php';
title();
//err();
aut();

if (is_file(H.'down/game.dat'))
{
$f=file(H.'down/game.dat');

$k_page=k_page(count($f),$set['p_str']);
$page=page($k_page);
$start=$set['p_str']*($page-1);
$end=$set['p_str']*$page;

echo "<div class='title'>Download gameloft</div>";
echo "<table class='post'>\n";

for ($i=$start;$i<$end && $i<count($f);$i++)
{
echo "<tr>\n";
$smile=explode(' ', $f[$i]);
echo "<td>\n";

echo smiles($smile[0]);
echo "</td>\n";
echo "<td>\n";

echo $f[$i];

echo "</td>\n";
echo "</tr>\n";
}
echo "</table>\n";


if ($k_page>1)str("?",$k_page,$page); // S'N<S2SlS' N?N,NESzS?SlN?
}



include_once '../sys/inc/tfoot.php';
?>