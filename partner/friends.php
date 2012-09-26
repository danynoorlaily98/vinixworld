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
$set['title']='Admin panel';
include_once '../sys/inc/thead.php';

if(!isset($HTTP_REQUEST_VARS))
$HTTP_REQUEST_VARS=$_REQUEST;
if(!isset($HTTP_SERVER_VARS))
$HTTP_SERVER_VARS=$_SERVER;
extract($HTTP_REQUEST_VARS);
extract($HTTP_SERVER_VARS);
$p = 15;
?>
<br><a href="index.php">add friends</a><br>
<?
if ($hal == ""){$hal = "1";}
$xfile=@file("friends.txt");
$first = count($xfile) - ($p * ($hal - 1));
$second = count($xfile) - ($p * $hal) + 1;
if ($second < 1) {$second = 1;}
$hals = (count($xfile) / $p);
if ($hal>1) $rew = "<a href=\"$PHP_SELF?hal=".($hal-1)."\">".($hal-1)."</a>";
if ($hal<$hals) $next = "<a href=\"$PHP_SELF?hal=".($hal+1)."\">".($hal+1)."</a>";
for ($i = $first-1; $i >= $second-1; $i--)
{
$ii = $i;
$ii++;
$konco = explode("|",$xfile[$i]);

print "<div class=\"menu\">Name: ".$konco[0]." <br> ";
echo"Sites: <a href=\"$konco[1]\">".$konco[1]."</a><br>City: ".$konco[2]."<br>";

if (user_access('adm_set_sys'))
echo "<a href=\"hilang.php?id=$konco[0]\">
Delete</a><br></div>";
}
print "$rew&nbsp$next"
;

include_once '../sys/inc/tfoot.php'; ?>
