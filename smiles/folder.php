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
if(isset($_GET['id'])){
$id = intval($_GET['id']);
}else{
header("Location: /smiles/");
}

$set['title']='Emos';
include_once '../sys/inc/thead.php';

//title();
//aut();

echo '<div class="status">';
$dir = mysql_fetch_array(mysql_query("SELECT * FROM `smiles_zanger` WHERE `id` = '$id' LIMIT 1"));
if($id==0 || $id<0){
echo '<div class="err">Carpeta Vacia.</div>';
}else if($id!=$dir['id']){
echo '<div class="err">Carpeta no Encontrada.</div>';
}else{
echo '<b>Carpeta</b>: '.$dir['name'].'<br/>';
$rid = $_SESSION["rid"];

$k_post = mysql_result(mysql_query("SELECT COUNT(*) FROM `smiles_grim` WHERE `id_dir` = '$dir[id]'"),0);
$k_page = k_page($k_post,$set['p_str']);
$page = page($k_page);
$start = $set['p_str']*$page-$set['p_str'];

if(!$k_post){
echo 'Vacia<br/>';
}else{
$q=mysql_query("SELECT * FROM `smiles_grim` WHERE `id_dir` = '$id' ORDER BY `id` ASC LIMIT $start, $set[p_str]");
while($post = mysql_fetch_array($q)){
echo '<img src="/style/smiles/'.$post['name'].'.gif" alt="'.$post['name'].'"/>&nbsp;&#187;&nbsp;'.$post['sim'].'<br/>';
}


if($k_page>1){
str('folder.php?id='.$dir['id'].'&amp;',$k_page,$page);
}
}

echo '&#187;&nbsp;<a href="/smiles/">Todas las Carpetas</a><br/>';
}
if($rid>0)echo "<a href='/chat/room/$rid/".rand(1000,9999)."/'>Volver a la Sala</a><br />\n";
echo '</div>';
include_once '../sys/inc/tfoot.php';
?>
