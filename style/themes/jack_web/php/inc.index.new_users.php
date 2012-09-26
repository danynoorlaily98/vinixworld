<?
$block = new Smarty_conf();
$content=array();

$q=mysql_query("SELECT `id`,`nick`,`date_reg` FROM `user` WHERE `activation` IS NULL AND `date_reg` >= '".DCMS_TIME_TODAY."' ORDER BY `id` ASC");

while ($ank=mysql_fetch_assoc($q)) {
$content[]="<a href='/info.php?id=$ank[id]'>$ank[nick]</a> (".vremja($ank['date_reg']).")";
}




$block->assign('title','Pendaftar hari ini');
$block->assign('content',implode(', ',$content));
if($content)$block->display('inc.index.block.tpl');
?>
