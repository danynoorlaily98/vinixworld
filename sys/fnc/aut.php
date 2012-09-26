<?

// remodified by noe
// http://nnetwork.tk
// loegue.info@gmail.com
// hargailah privasi orang


function aut()
{
global $set;
if ($set['web']==false)
{

global $user;
if (isset($user))
{
$knm=mysql_result(mysql_query("SELECT COUNT(*) FROM `jurnal` WHERE `id_kont` = '$user[id]' AND `read` = '0'"), 0);
if($knm>0){
echo "<span class='mfss'><a class='inv marquee_tab_select' href='/jurnal.php?SESS=$sess'>$knm</a></span>";
}
}
/*$k_n_s_zak=0;
$q23=mysql_query("SELECT `id_them`, `time` FROM `forum_zakl` WHERE `id_user` = '$user[id]'");
while ($zakl = mysql_fetch_array($q23))
{
$k_n_s_zak+=mysql_result(mysql_query("SELECT COUNT(*) FROM `forum_p` WHERE `id_them` = '$zakl[id_them]' AND `time` > '$zakl[time]'"),0);
}

if ($k_n_s_zak>0)
echo "<a href=\"/zakl.php\" title=\"Posting baru di bookmark\">($k_n_s_zak) Pos baru di forum favorite</a>\n";
}*/
}
}
?>
