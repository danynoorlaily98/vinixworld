<?
include_once '../sys/inc/start.php';
include_once '../sys/inc/compress.php';
include_once '../sys/inc/sess.php';
include_once '../sys/inc/home.php';
include_once '../sys/inc/settings.php';
$tmp_set=$set;
include_once '../sys/inc/db_connect.php';
include_once '../sys/inc/ipua.php';
include_once '../sys/inc/fnc.php';
include_once '../sys/inc/adm_check.php';
include_once '../sys/inc/user.php';
user_access('adm_license_support',null,'index.php?'.SID);
adm_check();

if (!$license){header("Location: index.php?".SID);exit;}
$send['add']='support';

$set['title']='Служба поддержки DCMS.SU';
include_once '../sys/inc/thead.php';
title();
if (isset($_POST['query']))
{

$query=array();
if (mysql_result(mysql_query("SELECT COUNT(*) FROM `license_support` WHERE `otvet` IS NULL"),0)!=0)
{
$q2=mysql_query("SELECT `id` FROM `license_support` WHERE `otvet` IS NULL");
while ($post2 = mysql_fetch_assoc($q2))
{
$query[]=$post2;
}
}
$send['query']=$query;
$result=lic_dcms($send);

if ($result!==false && isset($result['otvet']))
{
foreach ($result['otvet'] as $key=>$value) {
if (isset($value['act']) && $value['act']=='delete')
{
mysql_query("DELETE FROM `license_support` WHERE `id` = '$key' LIMIT 1");
msg('Вопрос '.$key.' был удален');
}
if (isset($value['otvet']))
{
mysql_query("UPDATE `license_support` SET `otvet` = '".my_esc($value['otvet'])."' WHERE `id` = '$key' LIMIT 1");
msg('Ответ на вопрос '.$key.' получен');
}
}

if (count($result['otvet'])==0)msg('Нет новых данных');
}
else $err[]='Попробуйте позже';



}

if (isset($_POST['msg']))
{
$msg=$_POST['msg'];
if (isset($_POST['translit']) && $_POST['translit']==1)$msg=translit($msg);

if (strlen2($msg)<2){$err='Короткое сообщение';}
else{



$msg=my_esc($msg);

mysql_query("INSERT INTO `license_support` (`time`, `msg`) values('$time', '$msg')");

$id=mysql_insert_id();


$query=array();
if (mysql_result(mysql_query("SELECT COUNT(*) FROM `license_support` WHERE `otvet` IS NULL"),0)!=0)
{
$q2=mysql_query("SELECT `id` FROM `license_support` WHERE `otvet` IS NULL");
while ($post2 = mysql_fetch_assoc($q2))
{
$query[]=$post2;
}
}
$send['query']=$query;
$send['quest']=array('msg'=>$msg,'id'=>$id);
$result=lic_dcms($send);



if (isset($result['otvet']))
{
foreach ($result['otvet'] as $key=>$value) {
if (isset($value['act']) && $value['act']=='delete')
{
mysql_query("DELETE FROM `license_support` WHERE `id` = '$key' LIMIT 1");
msg('Вопрос '.$key.' был удален');
}
if (isset($value['otvet']))
{
mysql_query("UPDATE `license_support` SET `otvet` = '".my_esc($value['otvet'])."' WHERE `id` = '$key' LIMIT 1");
msg('Ответ на вопрос '.$key.' получен');
}
}
}

if ($result!==false && isset($result['info']) && $result['info']=='ok')
msg('Сообщение успешно добавлено');
else
{
$err[]='Ошибка при передаче запроса';
mysql_query("DELETE FROM `license_support` WHERE `id` = '$id' LIMIT 1");
}
}
}


err();
//aut();

// для отладки
//echo '<textarea>';
//print_r ($result);
//echo "</textarea>";
//echo "<br />\n";


echo "<form method=\"post\" name='query' action=\"?\">\n";

echo "<input value=\"Запрос ответов\" name=\"query\" type=\"submit\" />\n";
echo "</form>\n";
$k_post=mysql_result(mysql_query("SELECT COUNT(*) FROM `license_support`"),0);
$k_page=k_page($k_post,$set['p_str']);
$page=page($k_page);
$start=$set['p_str']*$page-$set['p_str'];
echo "<table class='post'>\n";
if ($k_post==0)
{
echo "   <tr>\n";
echo "  <td class='p_t'>\n";
echo "Нет вопросов\n";
echo "  </td>\n";
echo "   </tr>\n";

}

$q=mysql_query("SELECT * FROM `license_support` ORDER BY id DESC LIMIT $start, $set[p_str]");
while ($post = mysql_fetch_assoc($q))
{

echo "   <tr>\n";
echo "  <td class='p_t'>\n";
echo vremja($post['time'])."<br />\n";
echo output_text($post['msg'])."\n";
echo "  </td>\n";
echo "   </tr>\n";
echo "   <tr>\n";
echo "  <td class='p_m'>\n";
if ($post['otvet']!=null)
echo output_text($post['otvet'])."\n";
else
echo "--Ожидание ответа--";
echo "  </td>\n";
echo "   </tr>\n";

}
echo "</table>\n";




if ($k_page>1)str('?',$k_page,$page); // Вывод страниц
echo "<form method=\"post\" name='message' action=\"?\">\n";
if ($set['web'] && is_file(H.'style/themes/'.$set['set_them'].'/altername_post_form.php'))
include_once H.'style/themes/'.$set['set_them'].'/altername_post_form.php';
else
echo "Задать вопрос:<br />\n<textarea name=\"msg\"></textarea><br />\n";

if (isset($user) && $user['set_translit']==1)echo "<label><input type=\"checkbox\" name=\"translit\" value=\"1\" /> Транслит</label><br />\n";
echo "<input value=\"Отправить\" type=\"submit\" />\n";
echo "</form>\n";
echo "* Вопросы от пользователей лицензионных версий обрабатываются в первую очередь<br />\n";
echo "** Злоупотребление данным сервисом может стать причиной его отключения<br />\n";
if (user_access('adm_panel_show')){
echo "<div class='foot'>\n";
echo "&laquo;<a href='/adm_panel/'>В админку</a><br />\n";
echo "</div>\n";
}


include_once '../sys/inc/tfoot.php';
?>
