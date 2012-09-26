<?

// remodified by noe
// http://nnetwork.tk
// loegue.info@gmail.com
// hargailah privasi orang


if (isset($_GET['act']) && $_GET['act']=='delete' && isset($_GET['ok']))
{

@unlink(H."sys/gallery/48/$foto[id].jpg");
@unlink(H."sys/gallery/128/$foto[id].jpg");
@unlink(H."sys/gallery/640/$foto[id].jpg");
@unlink(H."sys/gallery/foto/$foto[id].jpg");

mysql_query("DELETE FROM `gallery_foto` WHERE `id` = '$foto[id]' LIMIT 1");


msg('Photo has been deleted');
//aut();



echo "<div class=\"foot\">\n";
echo "&nbsp;<a href='/foto/$ank[id]/$gallery[id]/'>Album</a><br />\n";
echo "&nbsp;<a href='/foto/$ank[id]/'>Photo Album</a><br />\n";

echo "</div>\n";
include_once '../sys/inc/tfoot.php';
exit;
}
if (isset($_GET['act']) && $_GET['act']=='rename' && isset($_GET['ok']) && isset($_POST['name']) && isset($_POST['opis']))
{
$name=esc(stripcslashes(htmlspecialchars($_POST['name'])),1);
if (ereg("\{|\}|\^|\%|\\$|#|@|!|\~|'|\"|`|<|>",$name))$err='Invalid title';
if (isset($_POST['translit1']) && $_POST['translit1']==1)$name=translit($name);
if (strlen2($name)<3)$err='Min 3 charackters';
if (strlen2($name)>32)$err='Max 32 charackters';
$name=mysql_real_escape_string($name);

$msg=$_POST['opis'];
if (isset($_POST['translit2']) && $_POST['translit2']==1)$msg=translit($msg);
//if (strlen2($msg)<10)$err='Description min 10 charackters';
if (strlen2($msg)>1024)$err='Description max 1024 charackters';
$msg=mysql_real_escape_string($msg);



if (!isset($err))
{
mysql_query("UPDATE `gallery_foto` SET `name` = '$name', `opis` = '$msg' WHERE `id` = '$foto[id]' LIMIT 1");
$foto=mysql_fetch_assoc(mysql_query("SELECT * FROM `gallery_foto` WHERE `id` = '$foto[id]'  LIMIT 1"));
msg('Photo successfully changed');
}



}

?>
