<?

// remodified by noe
// http://nnetwork.tk
// loegue.info@gmail.com
// hargailah privasi orang

function page($k_page=1){ // Выдает текущую страницу

$page=1;

if (isset($_GET['page'])){

if ($_GET['page']=='end')$page=intval($k_page);elseif(is_numeric($_GET['page'])) $page=intval($_GET['page']);}

if ($page<1)$page=1;

if ($page>$k_page)$page=$k_page;

return $page;}



function k_page($k_post=0,$k_p_str=10){ // Высчитывает количество страниц

if ($k_post!=0){$v_pages=ceil($k_post/$k_p_str);return $v_pages;}

else return 1;}



function str($link='?',$k_page=1,$page=1){ // Вывод номеров страниц (только на первый взгляд кажется сложно ;))

if ($page<1)$page=1;

echo "<div class=\"status\">\n";



if ($page<$k_page)echo " <a href=\"".$link."page=".($page+1)."\" title='Next (No".($page+1).")'>See next</a>";

if ($page!=$k_page)echo " <a href=\"".$link."page=end\" title='Last Page'>...</a><br/>";


if ($page>1)echo "<a href=\"".$link."page=".($page-1)."\" title='Previous (No".($page-1).")'>See previous</a> ";

if ($page!=1)echo "<a href=\"".$link."page=1\" title='First Page'>...</a><br/>";
echo "</div>\n";

}




?>
