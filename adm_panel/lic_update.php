<?
include_once '../sys/inc/start.php';
include_once '../sys/inc/compress.php';
include_once '../sys/inc/sess.php';
include_once '../sys/inc/home.php';
include_once '../sys/inc/settings.php';
include_once '../sys/inc/db_connect.php';
include_once '../sys/inc/ipua.php';
include_once '../sys/inc/fnc.php';
include_once '../sys/inc/adm_check.php';
include_once '../sys/inc/user.php';
user_access('lic_update',null,'index.php?'.SID);
adm_check();
if (!$license){header("Location: index.php?".SID);exit;}


$set['title']='Обновление движка';
include_once '../sys/inc/thead.php';
title();

if (isset($_GET['update']) && mysql_result(mysql_query("SELECT COUNT(*) FROM `license_list_ver` WHERE `id` = '".intval($_GET['update'])."'"),0)==1)
{
$ver=mysql_fetch_assoc(mysql_query("SELECT * FROM `license_list_ver` WHERE `id` = '".intval($_GET['update'])."'"));

include_once '../sys/inc/zip.php';
$file_up=H.'sys/tmp/'.$passgen;
$file_backup=H.'sys/tmp/'.time().'.backup.'.$conf['dcms_ver'].'.zip';

if (false==copy("http://dcms.su/dcms/downloads/update/".intval($_GET['update'])."/update.zip",$file_up))$err[]='Невозможно загрузить обновление';
else
{
$zip_up=new PclZip($file_up);
$zip_backup=new PclZip($file_backup);
if (($list = $zip_up->listContent()) == 0)$err[]='Невозможно получить список файлов';
else
{
if ($ver['delete']!=null)
{
$del=split("(\r|\n)+", $ver['delete']);
for ($i=0;$i<sizeof($del);$i++) // проверка возможности удаления
{
if (file_exists(H.$del[$i]))
{
$back[]=H.$del[$i];
if (!is_writable(H.$del[$i]))
{
$wr_err[]=$del[$i];
$err='Некоторые файлы не могут быть удалены';
}
}
}
}



for ($i=0;$i<count($list);$i++) // проверка возможности записи
{

@chmod(H.$list[$i]['filename'], 0777);

if (file_exists(H.$list[$i]['filename']))
{
$back[]=H.$list[$i]['filename'];
if (!is_writable(H.$list[$i]['filename']))
{
$wr_err[]=$list[$i]['filename'];
$err='Некоторые файлы не могут быть обновлены';
}
}
elseif (!@file_put_contents(H.$list[$i]['filename'],'test'))
{
$wr_err[]=$list[$i]['filename'];
$err='Некоторые файлы не могут быть обновлены';
}
else
{
@unlink(H.$list[$i]['filename']);
}

}

$zip_backup->create($back,PCLZIP_OPT_REMOVE_PATH, H); // создаем бэкап

if (!isset($err))
{


for ($i=0;$i<count($del) ;$i++ ){
if (!unlink(H.$del[$i]))$err[]=H.$del[$i].' - невозможно удалить';
}
$list_up = $zip_up->extract(PCLZIP_OPT_PATH, H);
if ($list_up == 0) {
$err[]=$zip_up->errorInfo(true);
}
if (isset($err))
{
$zip_backup->extract(PCLZIP_OPT_PATH, H);
}
else
{


// выполнение sql запроса
if ($ver['sql']!=null)
{
if ($conf['phpversion']==5)
{
include_once H.'sys/inc/sql_parser.php';
$sql=SQLParser::getQueries($ver['sql']); // при помощи парсера запросы разбиваются точнее, но работает это только в php5
}
else
{
$sql=split(";(\n|\r)*",$ver['sql']);
}

for ($i=0;$i<count($sql);$i++)
{
mysql_query($sql[$i]);
}

}
msg("Версия DCMS успешно обновлена до $ver[ver_1].$ver[ver_2].$ver[ver_3]");
}
}






}
unlink($file_up);
}
err();
//aut();

if (isset($wr_err))
{
echo "Выставьте права на запись (777):<br />\n";
for($i=0;$i<count($wr_err);$i++)
{
echo $wr_err[$i]."<br />\n";
}
echo "<form action='?update=".intval($_GET['update'])."&amp;$passgen' method='post'>";

echo "<input type='submit' value='Повтор' />";
echo "</form>";

}


echo "<div class='foot'>\n";
echo "&laquo;<a href='/adm_panel/lic_update.php?$passgen'>К обновлениям</a><br />\n";
if (user_access('adm_panel_show'))
echo "&laquo;<a href='/adm_panel/'>В админку</a><br />\n";
echo "</div>\n";


include_once '../sys/inc/tfoot.php';
}




err();
//aut();


$ver=explode('.', $set['dcms_version']);



$k_post=mysql_result(mysql_query("SELECT COUNT(*) FROM `license_list_ver` WHERE `ver_1` >= '$ver[0]' AND `ver_2` >= '$ver[1]' AND `ver_3` > '$ver[2]' OR `ver_1` >= '$ver[0]' AND `ver_2` > '$ver[1]'"),0);
$k_page=k_page($k_post,$set['p_str']);
$page=page($k_page);
$start=$set['p_str']*$page-$set['p_str'];
echo "<table class='post'>\n";
if ($k_post==0)
{
echo "   <tr>\n";
echo "  <td class='p_t'>\n";
echo "Вы используете последнюю стабильную версию\n";
echo "  </td>\n";
echo "   </tr>\n";

}else
{

$q=mysql_query("SELECT * FROM `license_list_ver` WHERE `ver_1` >= '$ver[0]' AND `ver_2` >= '$ver[1]' AND `ver_3` > '$ver[2]' OR `ver_1` >= '$ver[0]' AND `ver_2` > '$ver[1]' ORDER BY `id` DESC LIMIT 1");
while ($post = mysql_fetch_assoc($q))
{
echo "   <tr>\n";
echo "  <td class='p_t'>\n";
echo "<a href='?update=$post[id]&amp;page=$page'>Обновить с $set[dcms_version] до $post[ver_1].$post[ver_2].$post[ver_3]</a><br />\n";
echo "  </td>\n";
echo "   </tr>\n";
echo "   <tr>\n";
echo "  <td class='p_m'>\n";
$q_log=mysql_query("SELECT `text` FROM `license_list_changelog` WHERE `ver_1` = '$post[ver_1]' AND `ver_2` = '$post[ver_2]' AND `ver_3` = '$post[ver_3]'");
while ($post_log = mysql_fetch_assoc($q_log))
{
echo output_text($post_log['text'])."<br />\n";
}
echo "  </td>\n";
echo "   </tr>\n";
}
}
echo "</table>\n";
if ($k_page>1)str('?',$k_page,$page); // Вывод страниц



if (user_access('adm_panel_show')){
echo "<div class='foot'>\n";
echo "&laquo;<a href='/adm_panel/'>В админку</a><br />\n";
echo "</div>\n";
}

include_once '../sys/inc/tfoot.php';
?>
