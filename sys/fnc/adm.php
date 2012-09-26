<?
function adm($user=NULL)
{
global $set;


$adm = mysql_fetch_array(mysql_query("SELECT `level`,`balls`,`rating` from `user` where `id`='$user' limit 1;"));


if ($adm['level']==1)echo "<img src='http://mykz.net/sys/img/admin_sign.gif' alt=''/>\n";
elseif ($adm['level']==2)echo "<img src='http://mykz.net/sys/img/admin_sign.gif' alt=''/>\n";
elseif ($adm['level']==3)echo "<img src='http://mykz.net/sys/img/admin_sign.gif' alt=''/>\n";
elseif ($adm['level']==4)echo "<img src='http://mykz.net/sys/img/admin_sign.gif' alt=''/>\n";
if ($adm['balls']>=10000 && $adm['level']==0 && $adm['rating']>=50)echo "<img src='http://mykz.net/sys/img/medal.gif' alt='m'/>\n";

}

?>