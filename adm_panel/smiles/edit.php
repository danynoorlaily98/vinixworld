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

$set['title']='Smiles &amp; '.$_SERVER['HTTP_HOST'];

include_once '../../sys/inc/thead.php';

//title();
//aut();

echo '<div class="status">';

if(!isset($user)){
echo '<div class="err">ACCESS CLOSED.</div>';
}else if($id==0 || $id<0){
echo '<div class="err">YOURE NOT MEMBER.</div>';
}else if(isset($user) && $user['level']<4){
echo '<div class="err">ACCESS CLOSED! For ADMIN ONLY.</div>';
}else{
if($_GET['act']=='dir'){

if(isset($_POST['name']) && isset($_POST['pos'])){
$name = esc(stripcslashes(htmlspecialchars($_POST['name'])));
$pos = intval($_POST['pos']);

if(strlen2($name)>32){
$err='nama terlalu panjang';
}else if(strlen2($name)<3){
$err='nama terlalu pendek';
}else if($pos<0){
$err='posisi belum ditentukan';
}else{

mysql_query("UPDATE `smiles_zanger` SET `name` = '".$name."', `pos` = '".$pos."'  WHERE `id` = '".$id."' LIMIT 1");
mysql_query("OPTIMIZE TABLE `smiles_zanger`");
msg('Directory <b>'.$name.'</b> diubah');
}
}

err();

$dir = mysql_fetch_array(mysql_query("SELECT * FROM `smiles_zanger` WHERE `id` = '".$id."'"));
echo '<form method="post" action="edit.php?id='.$id.'&amp;act=dir">';
echo 'Nama:(3-32)<br/><input name="name" maxlength="32" value="'.esc(stripcslashes(htmlspecialchars($dir['name']))).'"/><br/>';
echo 'posisi:(ex. 1)<br/><input name="pos" value="'.intval($dir['pos']).'"/><br/>';
echo '<input value="Submit" type="submit"/></form>';

echo '&#187;&nbsp;<a href="index.php">smiles setting</a><br/>';
echo '&#187;&nbsp;<a href="../index.php">admin panel</a><br/>';

}else if($_GET['act']=='smile'){
if(isset($_POST['sim'])){   $sim = $_POST['sim'];

mysql_query("UPDATE `smiles_grim` SET `sim` = '".$sim."'  WHERE `id` = '".$id."' LIMIT 1");
mysql_query("OPTIMIZE TABLE `smiles_zanger`");
msg('smiles diubah');
}

$smile = mysql_fetch_array(mysql_query("SELECT * FROM `smiles_grim` WHERE `id` = '".$id."'"));
echo '<img src="'.H.'style/smiles/'.$smile['name'].'.gif" alt="'.$smile['name'].'/">&nbsp;&#187;&nbsp;'.$smile['sim'].'<br/>';
echo '<form method="post" action="edit.php?id='.$id.'&amp;act=smile">';
echo '<b>nama pemanggil?</b>:<br/><input name="sim" value="'.htmlspecialchars($smile['sim']).'"/><br/>';
echo '<input value="Submit" type="submit"/></form>';

echo '&#187;&nbsp;<a href="index.php">smiles setting</a><br/>';
echo '&#187;&nbsp;<a href="../index.php">admin panel</a><br/>';
}else{
echo '<div class="err">akses ditutup</div>';
}
}

echo '</div>';
include_once '../../sys/inc/tfoot.php';
?>
