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
$set['title']='Smiles &amp; '.$_SERVER['HTTP_HOST'];

include_once '../../sys/inc/thead.php';

//title();
//aut();

echo '<div class="status">';

if(!isset($user)){
echo '<div class="err">ONLY ADMINISTRATOR ALLOWED</div>';
}else if(isset($user) && $user['level']<4){
echo '<div class="err">ONLY ADMIN ALLOWED</div>';
}{
if($_GET['act']=='dir'){
if(isset($_POST['name']) && isset($_POST['pos']) && isset($_POST['level'])){   $name = esc(stripcslashes(htmlspecialchars($_POST['name'])));
$pos = intval($_POST['pos']);
$level = intval($_POST['level']);

if(strlen2($name)>32){   $err='nama terlalu panjang';
}else if(strlen2($name)<3){      $err='nama terlalu pendek';
}else if($pos<0){         $err='posisi belum ditentukan';
}else{

mysql_query("INSERT INTO `smiles_zanger` (`name`, `pos`, `level`) values('$name', '$pos', '$level')");
mysql_query("OPTIMIZE TABLE `smiles_zanger`");
msg('directory <b>'.$name.'</b> added');
}
}

err();

echo '<form method="post" action="tambah.php?act=dir">';
echo 'Name:(3-32)<br/><input name="name" maxlength="32"/><br/>';
echo 'Postition:(ex. 1)<br/><input name="pos"/><br/>';
echo 'pos(0-4)<br/><select name="level">';
echo '<option value="0">0</option><option value="1">1</option><option value="2">2</option>';
echo '<option value="3">3</option><option value="4">4</option></select>';
echo '<input value="Ok!" type="submit"/></form>';

echo '&#187;&nbsp;<a href="index.php">setting smiles</a><br/>';
echo '&#187;&nbsp;<a href="../index.php">admin panel</a><br/>';

}else if($_GET['act']=='smile'){if(isset($_FILES['file']) && $_FILES['file']!=NULL && isset($_POST['name']) && isset($_POST['sim']) && isset($_POST['dir'])){   $name = esc(stripcslashes(htmlspecialchars($_POST['name'])));
$dir_s = intval($_POST['dir']);
$sim = htmlspecialchars($_POST['sim']);

if($imgc=@imagecreatefromstring(file_get_contents($_FILES['file']['tmp_name']))){
$name = retranslit($name);

if($name==NULL){   $err = 'nama belum terisi!';
}else if(strlen2($name)>10){      $err = 'nama terlalu panjang!';
}else if(strlen2($name)<1){         $err = 'nama terlalu pendek';
}else{mysql_query("INSERT INTO `smiles_grim` (`name`, `id_dir`, `sim`) values ('".$name."', '$dir_s', '$sim')");
copy($_FILES['file']['tmp_name'], H.'style/smiles/'.$name.'.gif');
chmod(H.'style/smiles/'.$name.'.gif',0666);
msg("Successfully");
}
}else{   msg("Its not smiles");
}
mysql_query("OPTIMIZE TABLE `smiles_grim`");
}

err();

echo 'upload only *.gif extension<br/>';
echo '<form method="post" enctype="multipart/form-data" action="tambah.php?act=smile">';
echo '<input type="file" name="file" accept="image/*,image/gif"/><br/>';
echo '<b>name smile:</b><br/><input name="name"><br/>';
echo '<b>Nama pemanggil?:</b><br/><input name="sim"><br/>';
echo '<b>directory</b>:<br/><select name="dir">';

$q = mysql_query("SELECT * FROM `smiles_zanger`");
while($dir = mysql_fetch_array($q)){
echo '<option value="'.$dir['id'].'">'.esc(stripcslashes(htmlspecialchars($dir['name']))).'</option>';
}
echo '</select><br/>';
echo '<input value="Upload" type="submit"/></form>';

echo '&#187;&nbsp;<a href="index.php">smiles setting</a><br/>';
echo '&#187;&nbsp;<a href="../index.php">admin panel</a><br/>';

}else{   echo '<div class="err">Access closed!</div>';
}
}

echo '</div>';
include_once '../../sys/inc/tfoot.php';
?>
