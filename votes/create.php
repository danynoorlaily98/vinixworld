<?
include_once '../sys/inc/start.php';
include_once '../sys/inc/compress.php';
include_once '../sys/inc/sess.php';
include_once '../sys/inc/home.php';
include_once '../sys/inc/settings.php';
include_once '../sys/inc/db_connect.php';
include_once '../sys/inc/ipua.php';
include_once '../sys/inc/fnc.php';
include_once '../sys/inc/adm_check.php';
include_once '../sys/inc/user.php';
user_access('votes_create',null,'index.php?'.SID);

$set['title']='Create Polls'; // заголовок страницы
include_once '../sys/inc/thead.php';
title();
if (isset($_POST['surv']) && isset($_POST['ok']) && isset($_POST['result']))
{
$results=array();
$surv=$_POST['surv'];
if (strlen2($surv)<5)$err[]='Short questions';
elseif (strlen2($surv)>1024)$err[]='Long questions';
elseif (!is_array($_POST['result']))$err[]='Error form';
else
{
foreach ($_POST['result'] as $key=>$value) {
if ($value!=null)$results[]=esc(htmlentities($value, ENT_QUOTES, 'UTF-8'));
}

if (count($results)<2)$err[]='Permission for less than 2 polls option';



$ch=intval($_POST['ch']);
$mn=intval($_POST['mn']);
$time_last=$time+$ch*$mn*60*60*24;

if ($time_last<=$time)$err[]='Error in the time of survey';

if (!isset($err)){
mysql_query("INSERT INTO `survey_s` (`surv`, `time`, `time_close`) VALUES ('".my_esc($surv)."','$time','$time_last')");
$s_id=mysql_insert_id();
for($i=0;$i<count($results);$i++)
{
mysql_query("INSERT INTO `survey_r` (`id_sur`, `msg`) VALUES ('$s_id','".my_esc($results[$i])."')");
}
admin_log('Polls','Create polls',"Create survey '$surv'");
msg('Polls successfully added');


}
}
}




err();
//aut();

echo "<form method='post' action='?$passgen'>\n";
echo "Poll (5-1024 characters):<br />\n";
echo "<textarea name='surv'></textarea><br />\n";
echo "Possible answer*:<br />\n";
for ($i=1;$i<=10;$i++)
echo "<input type='text' name='result[]' value='' /><br />\n";
echo "* You must specify a minimum 2 variants answer<br />\n";


echo "Lenght of survey:<br />\n";

echo "<input type='text' name='ch' size='3' value='1' />\n";
echo "<select name='mn'>\n";
echo "  <option value='1'>Days</option>\n";
echo "  <option value='7' selected='selected'>Weeks</option>\n";
echo "  <option value='31'>Months</option>\n";
echo "</select><br />\n";

echo "<input type='submit' name='ok' value='Create' />\n";
echo "</form>\n";


echo "<div class='foot'>\n";
echo "&nbsp;<a href='index.php?$passgen'>Back</a><br />\n";
echo "</div>\n";
include_once '../sys/inc/tfoot.php';
?>
