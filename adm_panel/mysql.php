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
user_access('adm_mysql',null,'index.php?'.SID);
adm_check();
$set['title']='MySQL Query';
include_once '../sys/inc/thead.php';
//title();

if (isset($_GET['set']) && $_GET['set']=='set' && isset($_POST['query']))
{
$sql=trim($_POST['query']);



if ($conf['phpversion']==5)
{
include_once H.'sys/inc/sql_parser.php';
$sql=SQLParser::getQueries($sql); // при помощи парсера запросы разбиваются точнее, но работает это только в php5
}
else
{
$sql=split(";(\n|\r)*",$sql);
}




$k_z=0; $k_z_ok=0;
for ($i=0;$i<count($sql);$i++)
{
if ($sql[$i]!=''){
$k_z++;
if(mysql_query($sql[$i]))
{
$k_z_ok++;
}}}
if ($k_z_ok>0)
{
if ($k_z_ok==1 && $k_z=1)
msg("Request successfully completed");
else
msg("Run the $k_z_ok query from $k_z");



admin_log('Admin','MySQL',"Archieved $k_z_ok request (s)");
}
}

err();
//aut();


echo "<form method=\"post\" action=\"mysql.php?set=set\">\n";
echo "<textarea name=\"query\" ></textarea><br />\n";
echo "<input class='button' value=\"Run\" type=\"submit\" />\n";
echo "</form>\n";

if (user_access('adm_panel_show')){
echo "<div class='foot'>\n";
echo "&laquo;<a href='/adm_panel/'>Admin Panel</a><br />\n";
echo "</div>\n";
}
include_once '../sys/inc/tfoot.php';
?>
