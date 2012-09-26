<?
$list=null;
if ($l=='/')
$set['title']='Archivos Compartidos'; // заголовок страницы
else $set['title']='Compartir - '.$dir_id['name']; // заголовок страницы
$_SESSION['page']=1;
include_once '../sys/inc/thead.php';
title();
include 'inc/upload_act.php';
include 'inc/admin_act.php';

err();
aut(); // форма авторизации


if ($l!='/'){
echo "<div class='foot'>";
echo "<a href='/obmen/'>Archivos Compartdos</a> &gt; ".obmen_path($l)."<br />\n";

echo "</div>\n";
}



echo "<table class='post'>\n";


$q=mysql_query("SELECT * FROM `obmennik_dir` WHERE `dir_osn` = '/$l' OR `dir_osn` = '$l/' OR `dir_osn` = '$l' ORDER BY `name`,`num` ASC");
while ($post = mysql_fetch_assoc($q))
{
$list[]=array('dir'=>1,'post'=>$post);
}
$q=mysql_query("SELECT * FROM `obmennik_files` WHERE `id_dir` = '$id_dir' ORDER BY `time` DESC");
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
echo "Carpeta Vacia\n";
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

echo "<a href='/obmen$post[dir]'>$post[name]</a>";

echo "  </td>\n";
echo "   </tr>\n";
echo "   <tr>\n";
if ($set['set_show_icon']==1)echo "  <td class='p_m' colspan='2'>\n"; else echo "  <td class='p_m'>\n";


$k_f=0;
$k_n=0;
$q3=mysql_query("SELECT * FROM `obmennik_dir` WHERE `dir_osn` like '$post[dir]%'");
while ($post2 = mysql_fetch_assoc($q3))
{
$k_f=$k_f+mysql_result(mysql_query("SELECT COUNT(*) FROM `obmennik_files` WHERE `id_dir` = '$post2[id]'"),0);
$k_n=$k_n+mysql_result(mysql_query("SELECT COUNT(*) FROM `obmennik_files` WHERE `id_dir` = '$post2[id]' AND `time` > '".(time()-60*60*$set['loads_new_file_hour'])."'",$db), 0);
}
$k_f=$k_f+mysql_result(mysql_query("SELECT COUNT(*) FROM `obmennik_files` WHERE `id_dir` = '$post[id]'"),0);
$k_n=$k_n+mysql_result(mysql_query("SELECT COUNT(*) FROM `obmennik_files` WHERE `id_dir` = '$post[id]' AND `time` > '".(time()-60*60*$set['loads_new_file_hour'])."'",$db), 0);

if ($k_n==0)$k_n=NULL;
else $k_n='/+'.$k_n;


echo "Archivos: $k_f$k_n<br />\n";



echo "  </td>\n";
echo "   </tr>\n";

}
else
{
$post=$list[$i]['post'];


$ras=$post['ras'];
$file=H."sys/obmen/files/$post[id].dat";
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

if ($set['echo_rassh']==1)$ras=".$post[ras]";else $ras=NULL;

echo "<a href='/obmen$dir_id[dir]$post[name].$post[ras]?showinfo'>$post[name]$ras</a><br />\n";

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
echo "<a href='/obmen/'>Archivos Compartidos</a> &gt; ".obmen_path($l)."<br />\n";

echo "</div>\n";
}


include 'inc/upload_form.php';
include 'inc/admin_form.php';


?>