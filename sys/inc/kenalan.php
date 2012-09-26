<?
if(isset($user)){
$bq = mysql_query("SELECT * FROM `user` ORDER BY rand() LIMIT 1;");
echo '<div class="penanda"><span class="lgn">Quizas Conoscas</span></div>';
echo "<table widht='100%'>\n";
while ($ank = mysql_fetch_array($bq))
{
echo "<tr><td widht='50%'><a href='/info.php?id=$ank[id]'></a>";
avatar($ank['id']);

$d1sql = mysql_query("SELECT COUNT(*) FROM `frends_new` WHERE (`user` = '$user[id]' AND `to` = '$ank[id]') OR (`user` = '$ank[id]' AND `to` = '$user[id]') LIMIT 1");
$d2sql = mysql_query("SELECT COUNT(*) FROM `frends` WHERE (`user` = '$ank[id]' AND `frend` = '$user[id]') OR (`user` = '$user[id]' AND `frend` = '$ank[id]') LIMIT 1");
if (isset($user) && $user['id']!=$ank['id'] && mysql_result($d1sql, 0)==0 && mysql_result($d2sql, 0)==0)
{
echo "<td widht='50%'><a href=\"/info.php?id=$ank[id]\">$ank[nick]</a><br /><font color='#808080'>";
echo mysql_result(mysql_query("SELECT COUNT(*) FROM `frends` WHERE `user` = '$ank[id]' AND `i` = '1'"), 0);
echo " mutuals friends";
echo "</font><br/>";
echo '<a href="/frend_add.php?id='.$ank['id'].'">Agregar como Amigo</a>';
}
else{
echo "<td widht='50%'><a href=\"/info.php?id=$ank[id]\">$ank[nick]</a><br /><a href=\"/mail.php?id=$ank[id]\">Enviar Mensaje</a><br />\n";
echo '<a href="frend.php?id='.$ank['id'].'">Ver Perfil</a><br/>';
}
}
echo '</table>';
echo '<div class="status"><a href="users.php">Ver Mas</a> </div>';
}
?>
