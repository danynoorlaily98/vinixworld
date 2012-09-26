<?

if ($l=='/')
$set['title']='Библиотека'; // заголовок страницы
else $set['title']='Библиотека - '.$dir_id['name']; // заголовок страницы
$_SESSION['page']=1;
include_once '../sys/inc/thead.php';
title();
if ($l!='/')include 'inc/upload_act.php';
include 'inc/admin_act.php';

err();
aut(); // форма авторизации


if ($l!='/'){
echo "<div class='foot'>";
echo "<a href='/lib/'>Библиотека</a> &gt; ".lib_path($l)."<br />\n";

echo "</div>\n";
}



echo "<table class='post'>\n";


$list=null;
$q=mysql_query("SELECT * FROM `lib_dir` WHERE `dir_osn` = '/$l' OR `dir_osn` = '$l/' OR `dir_osn` = '$l' ORDER BY `name`,`num` ASC");
while ($post = mysql_fetch_assoc($q))
{
$list[]=array('dir'=>1,'post'=>$post);
}
$q=mysql_query("SELECT * FROM `lib_files` WHERE `id_dir` = '$id_dir' ORDER BY `time` DESC");
while ($post = mysql_fetch_assoc($q))
{
$list[]=array('dir'=>0,'post'=>$post);
}


$k_post=sizeof($list);
$k_page=k_page($k_post,$set['p_str']);
$page=page($k_page);
$start=$set['p_str']*$page-$set['p_str'];


if ($k_post==0)
{
echo "   <tr>\n";
echo "  <td class='p_t'>\n";
echo "Папка пуста\n";
echo "  </td>\n";
echo "   </tr>\n";
}


for ($i=$start;$i<$k_post && $i<$set['p_str']*$page;$i++)
{
if ($list[$i]['dir']==1) // папка 
{
$post=$list[$i]['post'];
echo "   <tr>\n";
if ($set['set_show_icon']==2){

echo "  <td rowspan='2' class='icon48'>\n";
echo "<img src='/style/themes/$set[set_them]/loads/48/dir.png' alt='' />\n";
echo "  </td>\n";
}
elseif ($set['set_show_icon']==1){

echo "  <td class='icon14'>\n";
echo "<img src='/style/themes/$set[set_them]/loads/14/dir.png' alt='' />\n";
echo "  </td>\n";
}



echo "  <td class='p_t'>\n";

echo "<a href='/lib$post[dir]'>$post[name]</a>";

echo "  </td>\n";
echo "   </tr>\n";
echo "   <tr>\n";
if ($set['set_show_icon']==1)echo "  <td class='p_m' colspan='2'>\n"; else echo "  <td class='p_m'>\n";


$k_f=0;
$k_n=0;
$q3=mysql_query("SELECT * FROM `lib_dir` WHERE `dir_osn` like '$post[dir]%'");
while ($post2 = mysql_fetch_assoc($q3))
{
$k_f=$k_f+mysql_result(mysql_query("SELECT COUNT(*) FROM `lib_files` WHERE `id_dir` = '$post2[id]'"),0);
$k_n=$k_n+mysql_result(mysql_query("SELECT COUNT(*) FROM `lib_files` WHERE `id_dir` = '$post2[id]' AND `time` > '".(time()-86400)."'",$db), 0);
}
$k_f=$k_f+mysql_result(mysql_query("SELECT COUNT(*) FROM `lib_files` WHERE `id_dir` = '$post[id]'"),0);
$k_n=$k_n+mysql_result(mysql_query("SELECT COUNT(*) FROM `lib_files` WHERE `id_dir` = '$post[id]' AND `time` > '".(time()-86400)."'",$db), 0);

if ($k_n==0)$k_n=NULL;
else $k_n='/+'.$k_n;


echo "Файлов: $k_f$k_n<br />\n";



echo "  </td>\n";
echo "   </tr>\n";

}
else // файл
{
$post=$list[$i]['post'];

$ras='txt';
$file=H."sys/lib/stats/$post[id].txt.gz";
$name=$post['name'];
$size=$post['size'];




echo "   <tr>\n";
if ($set['set_show_icon']==2){
echo "  <td class='icon48' rowspan='2'>\n";
include 'inc/icon48.php';
echo "  </td>\n";
}
elseif ($set['set_show_icon']==1)
{
echo "  <td class='icon14'>\n";
include 'inc/icon14.php';
echo "  </td>\n";
}



echo "  <td class='p_t'>\n";

echo "<a href='/lib$dir_id[dir]$post[name].htm'>$post[name]</a><br />\n";

echo "  </td>\n";
echo "   </tr>\n";
echo "   <tr>\n";
if ($set['set_show_icon']==1)echo "  <td class='p_m' colspan='2'>\n"; else echo "  <td class='p_m'>\n";



include 'inc/opis.php';

echo "  </td>\n";
echo "   </tr>\n";
}
}







echo "</table>\n";
if ($k_page>1)str('?',$k_page,$page); // Вывод страниц


if ($l!='/'){
echo "<div class='foot'>";
echo "<a href='/lib/'>Библиотека</a> &gt; ".lib_path($l)."<br />\n";

echo "</div>\n";
}


if ($l!='/')include 'inc/upload_form.php';
include 'inc/admin_form.php';


?>