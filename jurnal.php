<?php

// remodified by noe
// http://nnetwork.tk
// loegue.info@gmail.com
// hargailah privasi orang


include_once 'sys/inc/start.php';
include_once 'sys/inc/compress.php';
include_once 'sys/inc/sess.php';
include_once 'sys/inc/home.php';
include_once 'sys/inc/settings.php';
include_once 'sys/inc/db_connect.php';
include_once 'sys/inc/ipua.php';
include_once 'sys/inc/fnc.php';
include_once 'sys/inc/user.php';

$set['title'] = 'Notifications '.$ank['nick'].'';
include_once 'sys/inc/thead.php';

//title();
//aut();

//echo '<div class="p_m">';

if(!isset($user)){
echo '<div class="err">Acces closed.</div>';
}else{

mysql_query("UPDATE `jurnal` SET `read` = '1' WHERE `id_kont` = '".$user['id']."' AND `read` = '0'");
echo '<table class="post">';

$k_post = mysql_result(mysql_query("SELECT COUNT(*) FROM `jurnal` WHERE `id_user` = '0' AND `id_kont` = '".$user['id']."'"),0);
$k_page = k_page($k_post,$set['p_str']);
$page = page($k_page);
$start = $set['p_str']*$page-$set['p_str'];

if($k_post==0){   echo '<div class="p_m">No new notifications!</div>';
}

$q=mysql_query("SELECT * FROM `jurnal` WHERE `id_user` = '0' AND `id_kont` = '".$user['id']."' ORDER BY id DESC LIMIT $start, $set[p_str]");
while ($post = mysql_fetch_array($q)){
echo '<tr><td class="p_t">&nbsp;'.vremja($post['time']).'</td></tr><tr>';
echo '<td class="p_m">'.output_text($post['msg']).'</td></tr>';
}

echo '</table>';

if($k_page>1){
str("jurnal.php?id=".$ank['id']."&amp;",$k_page,$page);
}

//echo '<div class="foot">&nbsp;<a href="info.php?id='.$user['id'].'">user panel</a></div>';
}

//echo '</div>';
include_once 'sys/inc/tfoot.php';
?>
