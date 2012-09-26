<?php

// Smiles Uploader DCMS style
// Script by : Zanger a.k.a grim4ngel
// Homepage : www.frendzmobile.co.cc

include_once '../../sys/inc/start.php';
include_once '../../sys/inc/compress.php';
include_once '../../sys/inc/sess.php';
include_once '../../sys/inc/home.php';
include_once '../../sys/inc/settings.php';
include_once '../../sys/inc/db_connect.php';
include_once '../../sys/inc/ipua.php';
include_once '../../sys/inc/fnc.php';
include_once '../../sys/inc/user.php';
if(isset($_GET['id'])){
$id = intval($_GET['id']);
}else{
header("Location: /index.php");
}

$set['title']='Smiles; '.$_SERVER['HTTP_HOST'];
include_once '../../sys/inc/thead.php';

//title();
//aut();

echo '<div class="status">';
$dir = mysql_fetch_array(mysql_query("SELECT * FROM `smiles_zanger` WHERE `id` = '".$id."'"));
if(!isset($user)){
echo '<div class="err">Access denied</div>';
}else if(isset($user) && $user['level']<2){
echo '<div class="err">Access denied.</div>';
}else if($id==0 || $id<0){
echo '<div class="err">diretory not found</div>';
}else if($id!=$dir['id']){
echo '<div class="err">diretory not found</div>';
}else{

echo '<b>Directory</b>: '.esc(stripcslashes(htmlspecialchars($dir['name']))).'<br/>';

$k_post = mysql_result(mysql_query("SELECT COUNT(*) FROM `smiles_grim` WHERE `id_dir` = '$id'"),0);
$k_page = k_page($k_post,$set['p_str']);
$page = page($k_page);
$start = $set['p_str']*$page-$set['p_str'];

if($k_post==0){
echo '<div class="err">No smiles</div>';
}

$q=mysql_query("SELECT * FROM `smiles_grim` WHERE `id_dir` = '$id' ORDER BY `id` ASC LIMIT $start, $set[p_str]");
while($post = mysql_fetch_array($q)){
echo '<img src="'.H.'style/smiles/'.$post['name'].'.gif" alt="'.$post['name'].'/">&nbsp;&#187;&nbsp;'.$post['sim'].'<br/>';
echo '<a href="hapus.php?id='.$post['id'].'&amp;act=smile">remove</a> | <a href="edit.php?id='.$post['id'].'&amp;act=smile">change</a><br/>';
}

if($k_page>1){
str('folder.php?id='.$id.'&amp;',$k_page,$page);
}

echo '&#187;&nbsp;<a href="tambah.php?act=smile">add smiles</a><br/>';
echo '&#187;&nbsp;<a href="index.php">All directory</a><br/>';
echo '&#187;&nbsp;<a href="../index.php">admin panel</a><br/>';
}

echo '</div>';
include_once '../../sys/inc/tfoot.php';
?>
