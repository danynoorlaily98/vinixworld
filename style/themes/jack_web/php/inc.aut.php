<?
global $user,$passgen;
$smarty = new Smarty_conf();
$menu=array();
echo "<div class='user_menu'>";
if (isset($user)){


echo "<table><tr><td class='nick'>$user[nick]</td><td><a title='Keluar' href='/exit.php?return=".urlencode($_SERVER['REQUEST_URI'])."&amp;$passgen'><img src='/style/themes/".THEME_DIR."/icons/user_exit.gif' alt='' /></a></td></tr></table>";



$msg=mysql_result(mysql_query("SELECT COUNT(`mail`.`id`) FROM `mail`
 LEFT JOIN `users_konts` ON `mail`.`id_user` = `users_konts`.`id_kont` AND `users_konts`.`id_user` = '$user[id]'
 WHERE `mail`.`id_kont` = '$user[id]' AND (`users_konts`.`type` IS NULL OR `users_konts`.`type` = 'common' OR `users_konts`.`type` = 'favorite') AND `mail`.`read` = '0'"),0);

$msg_f=mysql_result(mysql_query("SELECT COUNT(`mail`.`id`) FROM `mail`
 LEFT JOIN `users_konts` ON `mail`.`id_user` = `users_konts`.`id_kont` AND `users_konts`.`id_user` = '$user[id]'
 WHERE `mail`.`id_kont` = '$user[id]' AND (`users_konts`.`type` = 'favorite') AND `mail`.`read` = '0'"),0);

if ($msg)$menu[]=array('/new_mess.php',($msg_f?'<b>':null).'Baru'.($msg==1?'tentang':'s').'Pesan'.($msg==1?'e':'Aku').($msg_f?'</b>':null),$msg);


$zakl=mysql_result(mysql_query("SELECT COUNT(`forum_zakl`.`id_them`) FROM `forum_zakl` LEFT JOIN `forum_p` ON `forum_zakl`.`id_them` = `forum_p`.`id_them` AND `forum_p`.`time` > `forum_zakl`.`time` WHERE `forum_zakl`.`id_user` = '$user[id]' AND `forum_p`.`id` IS NOT NULL"),0);

if ($zakl)$menu[]=array('/zakl.php','Pesan bookmark',$zakl);

include H.'sys/inc/umenu.php';

}
else
{
$smarty = new Smarty_conf();
$smarty->assign('form_title','Masuk ke situs');
$smarty->assign('method','POST');
$smarty->assign('action',"/input.php?return=".urlencode($_SERVER['REQUEST_URI'])."&amp;$passgen");
$elements=array();
$elements[]=array('type'=>'input_text', 'title' => 'Username', 'br'=>1, 'info'=>array('name' => 'nick'));
$elements[]=array('type'=>'password', 'title' => 'Password (<a href="/pass.php">Lupa</a>)', 'br'=>1, 'info'=>array('name' => 'pass'));
$elements[]=array('type'=>'checkbox', 'br'=>1, 'info'=>array('value'=>1,'checked'=>1, 'name'=>'aut_save', 'text'=>'Ingat saya'));
$elements[]=array('type'=>'submit', 'br'=>1, 'info'=>array('value'=>'Login')); // êíoïêa
//$elements[]=array('type'=>'text', 'br'=>1, 'value'=>'<a href="/reg.php">Daftar</a>');
$smarty->assign('el',$elements);
$smarty->display('input.form.tpl');

$menu[]=array('/reg.php','Daftar');
}


$smarty->assign('menu',$menu);
$smarty->display('inc.umenu.tpl');
echo "</div>";
?>
