<?php
function smiles($msg){
   $q=mysql_query("SELECT * FROM `smiles_grim`");
   while($post = mysql_fetch_array($q)){
      $msg = str_replace($post['sim'], '<img src="/style/smiles/'.$post['name'].'.gif" alt="'.$post['name'].'"/>', $msg);
      }
   return $msg;
   }
?>