<?

// Translated by : zanger
// Site : http://www.frendzmobile.co.cc

include_once '../sys/inc/start.php';
include_once '../sys/inc/compress.php';
include_once '../sys/inc/sess.php';
include_once '../sys/inc/home.php';
include_once '../sys/inc/settings.php';
include_once '../sys/inc/db_connect.php';
include_once '../sys/inc/ipua.php';
include_once '../sys/inc/fnc.php';
include_once '../sys/inc/user.php';

only_reg();

$id = $user['id'];
if (isset($_GET['id'])) $id = intval($_GET['id']);
$q = mysql_query("SELECT * FROM `user` WHERE `id` = '$id' LIMIT 1");
$a = mysql_fetch_array($q);
if (mysql_num_rows($q)==0){header("Location: index.php?".SID);exit;}

$set['title'] = ($a['id']==$user['id']) ? 'My groups' : 'Groups '.$ank['nick'];
include_once '../sys/inc/thead.php';
title();
//aut();

if (mysql_result(mysql_query("SELECT COUNT(id) FROM `group` WHERE `user` = '$a[id]'"), 0)==1)
{
$m = mysql_fetch_array(mysql_query("SELECT * FROM `group` WHERE `user` = '$a[id]'"));
echo '<div class="post"><div class="p_t">'.( ($a['id']==$user['id']) ? 'My groups' : 'Group '.$a['nick'] ).'</div>
<div class="p_m"> <img src="g.png" alt=""> <a href="index.php?id='.$m['id'].'">'.$m['name'].'</a>('.$m['all'].')</div>
<div class="p_m">'.esc(trim(br(bbcode(smiles(links(stripcslashes(htmlspecialchars($m['about'])))))))).'</div>
</div>';
}


$k_g = mysql_result(mysql_query("SELECT COUNT(*) FROM `group_u` WHERE `user` = '$a[id]'"), 0);
$k_page=k_page($k_g,$set['p_str']);
$page=page($k_page);
$start=$set['p_str']*$page-$set['p_str'];

echo '<div class="p_t">';
echo ($a['id']==$user['id']) ? 'Group with participation' : 'Group with '.$a['nick'];
echo '</div>';

echo '<table class="post">'."\n";
if ($k_g==0)echo '<div class="post"> No post</div>';

$q = mysql_query("SELECT * FROM `group_u` WHERE `user` = '$a[id]' ORDER BY time DESC LIMIT $start, $set[p_str]");
while ($l = mysql_fetch_array($q))
{
$p = mysql_fetch_array(mysql_query("SELECT * FROM `group` WHERE `id` = '$l[id]'"));
echo '   <tr>'."\n";
if ($set['set_show_icon']==2){
echo ' <td class="icon48" rowspan="2">'."\n";
echo '<center> <img src="g48.png" alt=""> </center>';
echo '  </td>'."\n";
}
elseif ($set['set_show_icon']==1)
{
echo '  <td class="icon14">'."\n";
echo ' <img src="g14.png" alt=""> ';
echo '  </td>'."\n";
}

echo '  <td class="p_t">'."\n";
echo '  <a href="index.php?id='.$p['id'].'">'.$p['name'].'</a> '."\n";
echo '  </td>'."\n";
echo '   </tr>'."\n";

echo "   <tr>\n";
if ($set['set_show_icon']==1)echo "  <td class='p_m' colspan='2'>\n"; else echo "  <td class='p_m'>\n";

echo 'Members: '.$p['all'].'<br />'."\n";

echo esc(trim(br(bbcode(smiles(links(stripcslashes(htmlspecialchars($p['about']))))))))."\n";
echo "  </td>\n";
echo "   </tr>\n";

}

echo '</table>'."\n";
if ($k_page > 1)str('?id='.$a['id'].'&amp;',$k_page,$page);

echo '<br /> :: <a href="index.php">User Groups</a><br />';

include_once '../sys/inc/tfoot.php';
?>
