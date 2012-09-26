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
$set['title']='Smiles settings';
include_once '../../sys/inc/thead.php';

only_level(3);
//title();
//aut();

if($_GET['act']=='smile'){                  $smile = mysql_fetch_array(mysql_query("SELECT * FROM `smiles_grim` WHERE `id` = '$id' LIMIT 1"));
if(!isset($err)){
mysql_query("DELETE FROM `smiles_grim` WHERE `id` = '$smile[id]' LIMIT 1");
mysql_query("OPTIMIZE TABLE `smiles_grim`");
msg("Smile successfully deleted");
}
}
echo '<div class="menu_razd"><b>Directory smiles.</b><br/></div>';
echo '<div class="status">';

$k_post = mysql_result(mysql_query("SELECT COUNT(*) FROM `smiles_zanger`"),0);
$k_page = k_page($k_post,$set['p_str']);
$page = page($k_page);
$start = $set['p_str']*$page-$set['p_str'];

if(!$k_post){
echo 'empty.<br/>';
}else{
$q=mysql_query("SELECT * FROM `smiles_zanger` ORDER BY `pos` ASC LIMIT $start, $set[p_str]");
while($post = mysql_fetch_array($q)){
echo '&#187;&nbsp;<a href="folder.php?id='.$post['id'].'">'.$post['name'].'</a> ('.mysql_result(mysql_query("SELECT COUNT(*) FROM `smiles_grim` WHERE `id_dir` = '$post[id]'"),0).')<br/>';
echo '[<a href="hapus.php?id='.$post['id'].'&amp;act=dir">delete</a> | <a href="edit.php?id='.$post['id'].'&amp;act=dir">change</a>]<br/>';
}

if($k_page>1){
str('?',$k_page,$page);
}
}

echo '&#187;&nbsp;<a href="tambah.php?act=dir">Add directory</a><br/>';
echo '&#187;&nbsp;<a href="../index.php">Admin panel</a></div>';
include_once '../../sys/inc/tfoot.php';
?>
