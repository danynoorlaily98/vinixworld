<?php

// Smiles Uploader DCMS style
// Script by : Zanger a.k.a grim4ngel
// Homepage : www.frendzmobile.co.cc

include_once '../sys/inc/start.php';
include_once '../sys/inc/compress.php';
include_once '../sys/inc/sess.php';
include_once '../sys/inc/home.php';
include_once '../sys/inc/settings.php';
include_once '../sys/inc/db_connect.php';
include_once '../sys/inc/ipua.php';
include_once '../sys/inc/fnc.php';
include_once '../sys/inc/user.php';
$set['title']='Emos';
include_once '../sys/inc/thead.php';

//title();
//aut();

echo '<div class="status"><b>Carpeta de Emos.</b><br/>';

$k_post = mysql_result(mysql_query("SELECT COUNT(*) FROM `smiles_zanger`"),0);
$k_page = k_page($k_post,$set['p_str']);
$page = page($k_page);
$start = $set['p_str']*$page-$set['p_str'];

if(!$k_post){
echo 'Vacio.<br/>';
}else{
$q=mysql_query("SELECT * FROM `smiles_zanger` ORDER BY `pos` ASC LIMIT $start, $set[p_str]");
while($post = mysql_fetch_array($q)){
echo '&#187;&nbsp;<a href="folder.php?id='.$post['id'].'">'.$post['name'].'</a> ('.mysql_result(mysql_query("SELECT COUNT(*) FROM `smiles_grim` WHERE `id_dir` = '$post[id]'"),0).')<br/>';
}

if($k_page>1){
str('?',$k_page,$page);
}
}
$rid = $_SESSION["rid"];
if($rid>0)echo "<br/><a href='/chat/room/$rid/".rand(1000,9999)."/'>Volver a la Sala</a><br />\n";
echo '</div>';
include_once '../sys/inc/tfoot.php';
?>
