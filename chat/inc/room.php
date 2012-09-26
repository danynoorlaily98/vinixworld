<?
if (isset($_POST['msg']) && isset($user))
{
$msg=$_POST['msg'];
if (isset($_POST['translit']) && $_POST['translit']==1)$msg=translit($msg);

$mat=antimat($msg);
if ($mat)$err[]='In the message body found mat: '.$mat;

if (strlen2($msg)>512){$err[]='Message too long';}
elseif (strlen2($msg)<2){$err[]='Message too short';}
elseif (mysql_result(mysql_query("SELECT COUNT(*) FROM `chat_post` WHERE `id_user` = '$user[id]' AND `msg` = '".mysql_escape_string($msg)."' AND `time` > '".($time-300)."' LIMIT 1"),0)!=0){$err='wait a few seconds';}
elseif(!isset($err)){
if(isset($_POST['privat']))
{
$priv=abs(intval($_POST['privat']));
}else{
$priv=0;
}
mysql_query("INSERT INTO `chat_post` (`id_user`, `time`, `msg`, `room`, `privat`) values('$user[id]', '$time', '".my_esc($msg)."', '$room[id]', '$priv')");
mysql_query("UPDATE `user` SET `balls` = '".($user['balls']+1)."' WHERE `id` = '$user[id]' LIMIT 1");
msg('Mensaje enviado');
}
}
if ($room['umnik']=='1')include 'inc/umnik.php';
if ($room['shutnik']=='1')include 'inc/shutnik.php';
err();
echo "<div align=\"center\">";
//aut(); // форма авторизации
echo "<a href='/chat/room/$room[id]/".rand(1000,9999)."/'>Refresh</a> -   
    <a href=\"/smiles/\">Emos</a> - <a href=\"/bb-code.php\">BB-Code</a><br />\n";
if (isset($user))
{
echo "<form method=\"post\" name='message' action=\"/chat/room/$room[id]/".rand(1000,9999)."/\">\n";
if ($set['web'] && is_file(H.'style/themes/'.$set['set_them'].'/altername_post_form.php'))
include_once H.'style/themes/'.$set['set_them'].'/altername_post_form.php';
else
echo "Mensaje:<br />\n<textarea name=\"msg\"></textarea><br />\n";
//if ($user['set_translit']==1)echo "<label><input type=\"checkbox\" name=\"translit\" value=\"1\" /> Translit</label><br />\n";
echo "<input value=\"Enviar\" type=\"submit\" />\n";
echo "</form>\n";
}
echo "</div>";
$k_post=mysql_result(mysql_query("SELECT COUNT(*) FROM `chat_post` WHERE `room` = '$room[id]' AND (`privat`='0'".(isset($user)?" OR `privat` = '$user[id]'":null).")"),0);
$k_page=k_page($k_post,$set['p_str']);
$page=page($k_page);
$start=$set['p_str']*$page-$set['p_str'];
echo "<table class='post'>\n";
if ($k_post==0)
{
echo "   <tr>\n";
echo "  <td class='p_t'>\n";
echo "No hay Mensajes\n";
echo "  </td>\n";
echo "   </tr>\n";
}

$timeto = 6*60;
$timenw = time();
$timeout = $timenw-$timeto;
$deleted = mysql_query("DELETE FROM `chat_post` WHERE `time`<".$timeout."");
$q=mysql_query("SELECT * FROM `chat_post` WHERE `room` = '$room[id]' AND (`privat`='0'".(isset($user)?" OR `privat` = '$user[id]'":null).") ORDER BY id DESC ");
while ($post = mysql_fetch_assoc($q))
{
if ($post['umnik_st']==0 && $post['shutnik']==0)
$ank=get_user($post['id_user']);
//$ank=mysql_fetch_assoc(mysql_query("SELECT * FROM `user` WHERE `id` = $post[id_user] LIMIT 1"));
echo "   <tr>\n";
if ($set['set_show_icon']==2){
echo "  <td class='icon14' rowspan='2'>\n";
if ($post['umnik_st']==0 && $post['shutnik']==0)
avatar($ank['id']);
elseif ($post['shutnik']==1)
echo "<img src='/style/themes/$set[set_them]/chat/14/shutnik.png' alt='' />\n";
elseif ($post['umnik_st']!=0)
echo "<img src='/style/themes/$set[set_them]/chat/14/umnik.png' alt='' />\n";
//echo "  </td>\n";
}
elseif ($set['set_show_icon']==1)
{
echo "  <td class='icon14'>\n";
if ($post['umnik_st']==0 && $post['shutnik']==0)
avatar($ank['id']);
elseif ($post['shutnik']==1)
echo "<img src='/style/themes/$set[set_them]/chat/14/shutnik.png' alt='' />\n";
elseif ($post['umnik_st']!=0)
echo "<img src='/style/themes/$set[set_them]/chat/14/umnik.png' alt='' />\n";
//echo "  </td>\n";
}






if($post['privat']==$user['id'])
{
$Te6e_cyka='<font color="darkred">[PM]</font>';
}else{
$Te6e_cyka='';
}
echo "  <td class='p_t'>\n";
$_SESSION['rid'] = $room[id];
if ($post['umnik_st']==0 && $post['shutnik']==0)
//echo "<a href='/chat/room/$room[id]/".rand(1000,9999)."/$ank[id]/'>$ank[nick]</a> $Te6e_cyka".online($ank['id'])." (".vremja($post['time'])."):\n";
echo "<a href='/mail.php?id=$ank[id]&amp;rid=$room[id]/".rand(1000,9999)."'>$ank[nick]</a> $Te6e_cyka".online($ank['id'])." (".vremja($post['time'])."):\n";
elseif ($post['umnik_st']!=0)
echo "$set[chat_umnik] (".vremja($post['time'])."):\n";
elseif ($post['shutnik']==1)
echo "$set[chat_shutnik] (".vremja($post['time'])."):\n";
//echo "  </td>\n";
//echo "   </tr>\n";
//echo "   <tr>\n";
if ($set['set_show_icon']==1)echo "  <span class='' colspan='2'>\n"; else echo "  <span class=''>\n";
echo output_text($post['msg'])."\n";
echo "  </td>\n";
echo "   </tr>\n";
}
echo "</table>\n";
//if ($k_page>1)str("/chat/room/$room[id]/".rand(1000,9999)."/?",$k_page,$page); // Вывод страниц
?>
