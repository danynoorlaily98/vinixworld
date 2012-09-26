<?
//valerik mod  ICQ 489132964

include_once '../sys/inc/start.php';
include_once '../sys/inc/compress.php';
include_once '../sys/inc/sess.php';
include_once '../sys/inc/home.php';
include_once '../sys/inc/settings.php';
include_once '../sys/inc/db_connect.php';
include_once '../sys/inc/ipua.php';
include_once '../sys/inc/fnc.php';
include_once '../sys/inc/user.php';
only_level(4);


function checked($var){if($var)return 'checked="CHECKED"'; else return '';}
function str2base($str){return htmlspecialchars(mysql_real_escape_string(trim(str_replace("\00",'',$str))));}


$fname=H."/sys/dat/reg_mess.txt";
if(!is_file($fname))file_put_contents($fname,"0|{name}, congratulate the registration!");

$reg_mess_arr=explode('|',file_get_contents($fname));
$reg_mess_on=$reg_mess_arr[0];
$reg_mess_text=$reg_mess_arr[1];

//Обработка формы----
if(isset($_POST['save']))
{
$reg_mess_on=(isset($_POST['reg_mess_on']))?1:0;
$reg_mess_text=str2base($_POST['reg_mess_text']);

file_put_contents($fname,$reg_mess_on.'|'.$reg_mess_text);
header('location: reg_conf.php');
exit;
}
//--------------------

$set['title']='Admin - Costomizing greeting registration';
include_once '../sys/inc/thead.php';
title();
err();
//aut();

echo "<div class='menu'>\n";
?>
<form method="post" >
<input type="checkbox" name="reg_mess_on"  value="1" <?php echo checked($reg_mess_on);?> /> Message included<br />
Message<br />
<textarea style="width:70%; height:200px;" name="reg_mess_text" ><?php echo $reg_mess_text;?></textarea><br />
<input type="submit" name="save" value="Save" />
</form>
<br />
<b>{name}</b> - username
<?
echo "</div>\n";

if (user_access('adm_panel_show')){
echo "<div class='foot'>\n";
echo "&laquo;<a href='/adm_panel/'>Admin Panel</a><br />\n";
echo "</div>\n";
}

include_once '../sys/inc/tfoot.php';
?>
