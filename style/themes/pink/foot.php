<?

// remodified by noe
// http://nnetwork.tk
// loegue.info@gmail.com
// hargailah privasi orang

list($msec, $sec) = explode(chr(32), microtime());
if(isset($user)){
echo "<div class='footer'>";
echo "<a href='/index.php?SESS=$sess'>Home</a> &#183; <a href='/chat/?SESS=$sess'>Chat</a> &#183; <a href='/status.php?SESS=$sess'>Estado</a> &#183; <a href='/wall.php?SESS=$sess'>Muro</a><br/></div>";

if(isset($user)){
if ($_SERVER['PHP_SELF']=='/users.php'){
}
else
{
echo "<div class=\"abt acg apm\" id=\"search\"><form method=\"post\" action=\"/users.php?go&amp;sort=$sort&amp;$por\"><table class=\"comboInput\" cellpadding=\"0\" cellspacing=\"0\"><tbody><tr><td class=\"inputCell\"><input class=\"input\" name=\"usearch\" value=\"\" size=\"15\" type=\"text\"></td><td><input value=\"Buscar\" class=\"btn\" type=\"submit\"></td></tr></tbody></table></form></div>";
}
}
echo "<div class='footer'>";
echo "<a href='/bantuan.php?SESS=$sess'>Ayuda</a> &#183; <a href='/settings.php?SESS=$sess'>Ajustes</a> &#183; <a href='/exit.php'>Salir</a><br/>";

echo "Online (<a href='/online.php'>".mysql_result(mysql_query("SELECT COUNT(*) FROM `user` WHERE `date_last` >".(time()-600).""), 0)."</a>/<a href='/online_g.php'>".mysql_result(mysql_query("SELECT COUNT(*) FROM `guests` WHERE `date_last` >".(time()-600)." AND `pereh` >'0'"), 0)."</a>)<br/>\n";

}
echo "<br/>";
$ife=mysql_result(mysql_query("SELECT COUNT(*) FROM `user` WHERE `date_last` > ".(time()-600).""), 0);

if($ife>0)
{

if(isset($user)){
$q = mysql_query("SELECT * FROM `user` WHERE `date_last` > '".(time()-600)."' ORDER BY `date_last` DESC LIMIT 7");
while ($ank = mysql_fetch_array($q))
{
$u_on[]="<a href='/info.php?id=$ank[id]'>$ank[nick]</a> ".otkuda($ank['url'])."";
}
echo implode(' , ',$u_on).' , ';
}
}
if($ife>7){
$sisa=$ife-6;
echo "and <a href='/online.php?PHPSESS=$sess'>$sisa</a>more...";

}
rekl(3);
echo "</div>";
//echo "</body></html>";
exit;
?>
