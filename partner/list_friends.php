<?
if(!isset($HTTP_REQUEST_VARS))
$HTTP_REQUEST_VARS=$_REQUEST;
if(!isset($HTTP_SERVER_VARS))
$HTTP_SERVER_VARS=$_SERVER;
extract($HTTP_REQUEST_VARS);
extract($HTTP_SERVER_VARS);
$p = 15;
?>
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
print "<div class=\"p_t\"><font color='lime'>Name:</font> <font color='yellow'>".$konco[0]."</font><br><font color='orange'>Sites:</font> <a href=\"$konco[1]\">".$konco[1]."</a><br>
<font color='red'>City:</font><font color='magenta'> ".$konco[2]."</font><br></div>";
}
print "$rew&nbsp$next"
;
