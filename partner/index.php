<?
$willy=gmdate("H:i:s",time()+3600*(7));
$title = "$willy Add || Site";
ob_start();
include_once '../sys/inc/start.php';
include_once '../sys/inc/compress.php';
include_once '../sys/inc/sess.php';
include_once '../sys/inc/home.php';
include_once '../sys/inc/settings.php';
include_once '../sys/inc/db_connect.php';
include_once '../sys/inc/ipua.php';
include_once '../sys/inc/fnc.php';
include_once '../sys/inc/user.php';
$set['title']='Add Your sites';
include_once '../sys/inc/thead.php';
$datakonco="friends.txt";
$konco=$_REQUEST[konco];
$lkonco=$_REQUEST[lkonco];
$julukan=$_REQUEST[julukan];
$simpen=$_REQUEST[simpen];
if($simpen)
{if($konco==""||$lkonco==""||$julukan=="")
{echo"<div class=\"cit\"><font color=\"red\">Semua Kolom wajib diisi!!</font></div>";}
else
{$isian="$konco|$lkonco|$julukan\r\n";
$isian=stripslashes($isian);
$tambahan = fopen($datakonco,"a");
fwrite($tambahan,$isian);
fclose($tambahan);
echo"<div class=\"cit\"><font color=\"lime\">Site kamu berhasil ditambahkan ke partner. terima kasih.</font></div>";}
}
err();
//aut();
if (isset($user))
{
$ank=get_user($post['id_user']);
echo"<div class=\"p_m\">Add site Partner<br></div><div class=\"p_t\"><form action=\"?\" method=\"post\">
your name:<br>
<input type=\"text\" name=\"konco\"><br>
Your Sites:<br>
<input type=\"text\" name=\"lkonco\" value=\"http://\"><br>
Your city:<br>
<input type=\"text\" name=\"julukan\"><br>
<input type=\"submit\" name=\"simpen\" value=\"Add Sites\">
</form></div>";
if (user_access('adm_set_sys'))
echo "<div class='aut'>[<a href='friends.php'>Admin panel</a>]</div>\n";
}
include'./list_friends.php';
include_once '../sys/inc/tfoot.php';
?>
