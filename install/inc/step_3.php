<?
$set['title']='Install MySQL';
include_once 'inc/head.php'; // верхняя часть темы оформления



if (isset($_SESSION['mysql_ok']) && $_SESSION['mysql_ok']==true)
{
if(isset($_GET['step']) && $_GET['step']=='4')
{
$_SESSION['install_step']++;
header("Location: index.php?$passgen&".SID);
exit;
}
}
elseif (isset($_POST['host']) && isset($_POST['user']) && isset($_POST['pass']) && isset($_POST['db']))
{
if(!($db=@mysql_connect($_POST['host'], $_POST['user'],$_POST['pass'])))
{
$err[]='Unable connect to server '.$_POST['host'];
}
elseif(!@mysql_select_db($_POST['db'],$db))
{
$err[]='Check the database name';
}
else
{
$set['mysql_db_name']=$_SESSION['db']=$_POST['db'];
$set['mysql_host']=$_SESSION['host']=$_POST['host'];
$set['mysql_user']=$_SESSION['user']=$_POST['user'];
$set['mysql_pass']=$_SESSION['pass']=$_POST['pass'];

mysql_query('set charset utf8');
mysql_query('SET names utf8');
mysql_query('set character_set_client="utf8"');
mysql_query('set character_set_connection="utf8"');
mysql_query('set character_set_result="utf8"');

$db_tables=array();
$tab=mysql_query('SHOW TABLES FROM '.$_SESSION['db']);
for($i=0;$i<mysql_num_rows($tab);$i++)
{
$db_tables[]=mysql_tablename($tab,$i);
}
$opdirtables=opendir(H.'sys/db_tables');
while ($filetables=readdir($opdirtables))
{
if (eregi('\.sql$',$filetables))
{
$table_name=eregi_replace('\.sql$',null,$filetables);
if (in_array($table_name, $db_tables))
{
if (isset($_POST['rename']) && $_POST['rename']==1)
{
mysql_query("ALTER TABLE `$table_name` RENAME `~".$time."_$table_name`");
}
else $db_not_null=true;
}
}
}

if (isset($db_not_null))
{


$err[]='In the selected database ('.$_SESSION['db'].') contain tables with identical names. Clear or select another database';
}
else {

include_once H.'sys/fnc/ver_tables.php';
$msg[]="Successfully executed $ok_sql from $k_sql query";

$_SESSION['mysql_ok']=true;
}
}



}

if (isset($_SESSION['mysql_ok']) && $_SESSION['mysql_ok']==true)
{
echo "<div class='msg'>Successfully connect to the database</div>\n";

if (isset($msg))
{
foreach ($msg as $key=>$value) {
echo "<div class='msg'>$value</div>\n";
}
}
if (isset($err))
{
foreach ($err as $key=>$value) {
echo "<div class='err'>$value</div>\n";
}
}
echo "<hr />\n";
echo "<form method=\"get\" action=\"index.php\">\n";
echo "<input name=\"step\" value=\"".($_SESSION['install_step']+1)."\" type=\"hidden\" />\n";
echo "<input value=\"".(isset($err)?'Script not ready to install':'Continue')."\" type=\"submit\"".(isset($err)?' disabled="disabled"':null)." />\n";
echo "</form>\n";
}
else
{
if (isset($err))
{
foreach ($err as $key=>$value) {
echo "<div class='err'>$value</div>\n";
}
}
echo "<form method=\"post\" action=\"index.php?$passgen\">\n";
echo "Host:<br />\n";
echo "<input name=\"host\" value=\"$set[mysql_host]\" type=\"text\" /><br />\n";
echo "Username:<br />\n";
echo "<input name=\"user\" value=\"$set[mysql_user]\" type=\"text\" /><br />\n";
echo "Password:<br />\n";
echo "<input name=\"pass\" value=\"$set[mysql_pass]\" type=\"text\" /><br />\n";
echo "Database:<br />\n";
echo "<input name=\"db\" value=\"$set[mysql_db_name]\" type=\"text\" /><br />\n";
if (isset($db_not_null))
echo "<label><input type='checkbox' checked='checked' name='rename' value='1' /> Renaming the existing table<br /></label>\n";
echo "<input value=\"Install\" type=\"submit\" />\n";
echo "</form>\n";
}

echo "<hr />\n";
echo "<b>Step: $_SESSION[install_step]</b>\n";

include_once 'inc/foot.php'; // нижняя часть темы оформления
?>