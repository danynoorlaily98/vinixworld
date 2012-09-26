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
if(isset($_GET['id'])){   $id = intval($_GET['id']);
}else{      header("Location: /");
}

$set['title']='delete smiles';
include_once '../../sys/inc/thead.php';

only_level(3);
title();
//aut();

echo '<div class="menu">';

if($id==0 || $id<0){   echo '<div class="err">INVALID INPUT ID.</div>';
}else{      if($_GET['act']=='dir'){         $dir = mysql_fetch_array(mysql_query("SELECT * FROM `smiles_zanger` WHERE `id` = '$id' LIMIT 1"));         if($id!=$dir['id']){            echo '<div class="err">Directory not found.</div>';
}else{               $q = mysql_query("SELECT * FROM `smiles_grim` WHERE `id_dir` = '$dir[id]'");
}
while($sm = mysql_fetch_array($q)){                  unlink('../style/smiles/'.$sm['name'].'.gif');
}

$q1 = mysql_query("SELECT * FROM `smiles_grim` WHERE `id_dir` = '$dir[id]'");
while($sm1 = mysql_fetch_array($q1)){                  mysql_query("DELETE FROM `smiles_grim` WHERE `id_dir` = '$sm1[id]'");
}
if(!isset($err)){
mysql_query("DELETE FROM `smiles_zanger` WHERE `id` = '$dir[id]' LIMIT 1");

mysql_query("OPTIMIZE TABLE `smiles_grim`, `smiles_zanger`");
header("Location: index.php");
msg("dir successfully deleted");
}

}else{ if($_GET['act']=='smile'){                  $smile = mysql_fetch_array(mysql_query("SELECT * FROM `smiles_grim` WHERE `id` = '$id' LIMIT 1"));
if($id!=$smile['id']){                     echo '<div class="err">Smile not found.</div>';
}else{                        unlink('../style/smiles/'.$smile['name'].'.gif');

if(!isset($err)){
mysql_query("DELETE FROM `smiles_grim` WHERE `id` = '$smile[id]' LIMIT 1");
mysql_query("OPTIMIZE TABLE `smiles_grim`");
msg("Smile successfully deleted");
}

header("Location: index.php");
}
}else{                     echo '<div class="err">Invalid input</div>';
}
}
}

echo '</div>';
include_once '../../sys/inc/tfoot.php';
?>
