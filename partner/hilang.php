<?
$datakonco=("friends.txt");
$id=$_REQUEST[id];
$record = file($datakonco);
$jml = count($record);
for ($i=0; $i<$jml; $i++) {
$row = explode("|",$record[$i]);
if ($id==$row[0]) {
$record[$i] = "";}}
$deldata = fopen($datakonco,"w");
for ($j=0; $j<$jml; $j++)
{if($record[$j] <> "")
fputs($deldata,$record[$j]);}
fclose($deldata);
header("location: friends.php");
?>
