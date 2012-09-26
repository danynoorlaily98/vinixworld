<?
include_once H.'sys/inc/main_menu.php'; // главное меню
$smarty_menu = new Smarty_conf();
$smarty_menu->assign('main_menu',main_menu());
$smarty_menu->display('body.mainmenu.tpl');
?>
