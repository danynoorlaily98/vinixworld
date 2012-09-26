<?php

// remodified by noe
// http://nnetwork.tk
// loegue.info@gmail.com
// hargailah privasi orang

echo '<div class="penanda"><span class="lgn">Favoritos</span></div><div class="face">';
echo '<a href="/jurnal.php">Notificaciones</a><br/>';
echo '<a href="/chat/">Chat</a><br/>';
echo '<a href="/group/">Grupos</a><br/>';
mysql_query("SELECT * FROM `user` WHERE `id` = '$ank[id]' LIMIT 1");
$user_id = $ank['id'];
echo "<a href='/blog/user.php'>Notas</a><br/>";
echo "<a href='/foto/'>Fotos</a><br/>";
echo '<a href="/shout/">Vociao</a><br/>';
echo '<a href="/partner/">Paginas</a><br/>';
echo '<a href="/menu.php">Mas...</a></div>';
?>
