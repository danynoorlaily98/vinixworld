<?

// remodified by noe
// http://nnetwork.tk
// loegue.info@gmail.com
// hargailah privasi orang

include_once 'sys/inc/start.php';
include_once 'sys/inc/compress.php';
include_once 'sys/inc/sess.php';
include_once 'sys/inc/home.php';
include_once 'sys/inc/settings.php';
include_once 'sys/inc/db_connect.php';
include_once 'sys/inc/ipua.php';
include_once 'sys/inc/fnc.php';
include_once 'sys/inc/user.php';

if (!isset($user) && !isset($_GET['id'])){header("Location: /index.php?".SID);exit;}
if (isset($user))$ank['id']=$user['id'];
if (isset($_GET['id']))$ank['id']=intval($_GET['id']);
if (mysql_result(mysql_query("SELECT COUNT(*) FROM `user` WHERE `id` = '$ank[id]' LIMIT 1"),0)==0){header("Location: /index.php?".SID);exit;}

$ank=get_user($ank['id']);
$ank['rating']=intval(@mysql_result(mysql_query("SELECT SUM(`rating`) FROM `user_voice2` WHERE `id_kont` = '$ank[id]'"),0));
$set['title']=$ank['nick'].' - Profile '; // заголовок страницы
include_once 'sys/inc/thead.php';
//title();


if ((!isset($_SESSION['refer']) || $_SESSION['refer']==NULL)
&& isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER']!=NULL &&
!ereg('info\.php',$_SERVER['HTTP_REFERER']))
$_SESSION['refer']=str_replace('&','&amp;',ereg_replace('^http://[^/]*/','/', $_SERVER['HTTP_REFERER']));


if (isset($_POST['rating']) && isset($user)  && $user['id']!=$ank['id'] && $user['balls']>=50 && mysql_result(mysql_query("SELECT SUM(`rating`) FROM `user_voice2` WHERE `id_kont` = '$user[id]'"),0)>=0)
{
$new_r=min(max(@intval($_POST['rating']),-2),2);
mysql_query("DELETE FROM `user_voice2` WHERE `id_user` = '$user[id]' AND `id_kont` = '$ank[id]' LIMIT 1");
mysql_query("INSERT INTO `user_voice2` (`rating`, `id_user`, `id_kont`) VALUES ('$new_r','$user[id]','$ank[id]')");
$ank['rating']=intval(mysql_result(mysql_query("SELECT SUM(`rating`) FROM `user_voice2` WHERE `id_kont` = '$ank[id]'"),0));
mysql_query("UPDATE `user` SET `rating` = '$ank[rating]' WHERE `id` = '$ank[id]' LIMIT 1");
msg('Rating di tambahkan');
}
echo "<div class='penanda'>Friends</div>";
echo"<table><small>";
echo "<tr><td class='label' valign='top'><a href='/frend.php?id=$ank[id]'>All Friends (".mysql_result(mysql_query("SELECT COUNT(*) FROM `frends` WHERE `user` = '$ank[id]' AND `i` = '1'"), 0).")</a></td></tr></small></table>";

echo "<div class='penanda'>User Information</div>";
if($user['id']==$ank['id']){
echo "<a href='/anketa.php'>Edit</a> <font color='#a9a9a9'>user information</font>";
}

echo"<table><small>";
if ($ank['ank_mail']!=NULL && ($ank['set_show_mail']==1 || isset($user) && ($user['level']>$ank['level'] || $user['level']==4))){

if ($ank['set_show_mail']==0)$hide_mail=' (hidden)';else $hide_mail=NULL;

if (ereg("(@mail\.ru$)|(@bk\.ru$)|(@inbox\.ru$)|(@list\.ru$)", $ank['ank_mail']))
echo "<tr><td class=\"label\" valign=\"top\"><img src=\"http://status.mail.ru/?$ank[ank_mail]\" width=\"13\" height=\"13\" alt=\"\" /></td><td class=\"label\" valign=\"top\"> <a href=\"mailto:$ank[ank_mail]\" title=\"Написать письмо\" class=\"ank_d\">$ank[ank_mail]</a>$hide_mail</td></tr>\n";
else echo "<tr><td class=\"label\" valign=\"top\">E-mail:</td><td class=\"label\" valign=\"top\"> <a href=\"mailto:$ank[ank_mail]\" title=\"Написать письмо\" class=\"ank_d\">$ank[ank_mail]</a>$hide_mail</td></tr>\n";
}

if ($ank['ank_icq']!=NULL && $ank['ank_icq']!=0)
echo "<tr><td class=\"label\" valign=\"top\"><img src=\"http://web.icq.com/whitepages/online?icq=$ank[ank_icq]&amp;img=27\" alt=\"icq\" height=\"16\" width=\"16\" /> </td><td class=\"ank_d\" valign=\"top\">$ank[ank_icq]</td></tr>\n";

echo "<tr><td class='label' valign='top'>Profile:</td><td valign='top'><a href='/info.php?id=$ank[id]$ank[id]'>".$_SERVER[HTTP_HOST]."/info.php?id=$ank[id]</a></td></tr><br />\n";

echo "<tr><td class='label' valign='top'>Phone:</td><td class='label' valign='top'>";
if ($ank['ank_n_tel']!=NULL){echo "$ank[ank_n_tel]</td></tr>\n";}
else
{
echo "______</td></tr>";
}

echo "<tr><td class='label' valign='top'>Site:</td><td class='label' valign='top'>";
if ($ank['ank_o_sebe']!=NULL){echo "<span class=\"ank_d\"><a href=\"http://$ank[ank_o_sebe]\">http://$ank[ank_o_sebe]</a></td></tr>\n";}
else
{
echo "______</td></tr>";
}

if (mysql_result(mysql_query("SELECT COUNT(*) FROM `ban` WHERE `id_user` = '$ank[id]' AND `time` > '$time'"), 0)!=0)
{
$q=mysql_query("SELECT * FROM `ban` WHERE `id_user` = '$ank[id]' AND `time` > '$time' ORDER BY `time` DESC LIMIT 5");
while ($post = mysql_fetch_assoc($q))
{
echo "<tr><td class='label' valign='top'>Di larang sampai
".vremja($post['time']).":</td></tr><tr><td class='label' valign='top'>";
echo "<span class='ank_d'>".output_text($post['prich'])."</td></tr>";
}
}
else
{
$narush=mysql_result(mysql_query("SELECT COUNT(*) FROM `ban` WHERE `id_user` = '$ank[id]'"), 0);
echo "<tr><td class='label' valign='top'>Violation:</td><td valign='top'>".(($narush==0)?" Nothing</td></tr>\n":" <tr><td class='label' valign='top'>$narush</td></tr>\n");
}

echo "<tr><td class='label' valign='top'>Points:</td> <td class='label' valign='top'>$ank[balls]</td></tr>";

echo "<tr><td class='label' valign='top'>Name:</td><td class='label' valign='top'>";
if ($ank['ank_name']!=NULL){
echo "$ank[ank_name]</td></tr>\n";
}
else
{
echo "______</td></tr>";
}

echo "<tr><td class='label' valign='top'>Sex:</td><td class='label' valign='top'>";
echo "".(($ank['pol']==1)?'Male':'Female')."</td></tr>\n";

echo "<tr><td class='label' valign='top'>City:</td><td class='label' valign='top'>";
if ($ank['ank_city']!=NULL)
{
echo "$ank[ank_city]</td></tr>\n";
}
else
{
echo "______</td></tr>";
}
if ($ank['ank_d_r']!=NULL && $ank['ank_m_r']!=NULL && $ank['ank_g_r']!=NULL){
if ($ank['ank_m_r']==1)$ank['mes']='Januari';
elseif ($ank['ank_m_r']==2)$ank['mes']='Februari';
elseif ($ank['ank_m_r']==3)$ank['mes']='Маret';
elseif ($ank['ank_m_r']==4)$ank['mes']='Аpril';
elseif ($ank['ank_m_r']==5)$ank['mes']='Маi';
elseif ($ank['ank_m_r']==6)$ank['mes']='Juni';
elseif ($ank['ank_m_r']==7)$ank['mes']='Juli';
elseif ($ank['ank_m_r']==8)$ank['mes']='Аgustus';
elseif ($ank['ank_m_r']==9)$ank['mes']='September';
elseif ($ank['ank_m_r']==10)$ank['mes']='Оktober';
elseif ($ank['ank_m_r']==11)$ank['mes']='November';
else $ank['mes']='Desember';
echo "<tr><td class='label' valign='top'>Date of Birth:</td><td valign='top'>$ank[ank_d_r] $ank[mes] $ank[ank_g_r]</td></tr>\n";
$ank['ank_age']=date("Y")-$ank['ank_g_r'];
if (date("n")<$ank['ank_m_r'])$ank['ank_age']=$ank['ank_age']-1;
elseif (date("n")==$ank['ank_m_r']&& date("j")<$ank['ank_d_r'])$ank['ank_age']=$ank['ank_age']-1;
echo "<tr><td class='label' valign='top'>Age:</td><td valign='top'>$ank[ank_age] Years</td></tr>\n";
}
elseif($ank['ank_d_r']!=NULL && $ank['ank_m_r']!=NULL)
{
if ($ank['ank_m_r']==1)$ank['mes']='Januari';
elseif ($ank['ank_m_r']==2)$ank['mes']='Februari';
elseif ($ank['ank_m_r']==3)$ank['mes']='Маret';
elseif ($ank['ank_m_r']==4)$ank['mes']='Аpril';
elseif ($ank['ank_m_r']==5)$ank['mes']='Мai';
elseif ($ank['ank_m_r']==6)$ank['mes']='Juni';
elseif ($ank['ank_m_r']==7)$ank['mes']='Juli';
elseif ($ank['ank_m_r']==8)$ank['mes']='Аgustus';
elseif ($ank['ank_m_r']==9)$ank['mes']='Oktober';
elseif ($ank['ank_m_r']==10)$ank['mes']='November';
elseif ($ank['ank_m_r']==11)$ank['mes']='Desember';
else $ank['mes']='have birthday';

echo "<tr><td class=\"label\" valign=\"top\">Birthday: </td><td class=\"label\" valign=\"top\">$ank[ank_d_r] $ank[mes]</td></tr>\n";
}
echo"</table></small>";
echo "<div class='penanda'>Additional Information</div>";
echo"<table><small>";
if($user['id']==$ank['id']){
echo "<a href='/addinfo.php'>Edit</a> <font color='#a9a9a9'>additional information</font>";
}
echo "<tr><td class='label' valign='top'>Interested in:</td><td class='label' valign='top'>";
if ($ank['tertarik']!=NULL)
{
echo "$ank[tertarik]</td></tr>";
}
else
{
echo "______</td></tr>";
}
echo "<tr><td class='label' valign='top'>Relationship:</td><td class='label' valign='top'>";
if ($ank['hubungan']!=NULL)
{
echo "$ank[hubungan]</td></tr>";
}
else
{
echo "______</td></tr>";
}
echo "<tr><td class='label' valign='top'>Religion:</td><td class='label' valign='top'>";
if ($ank['agama']!=NULL)
{
echo "$ank[agama]</td></tr>";
}
else
{
echo "______</td></tr>";
}
echo "<tr><td class='label' valign='top'>Hometown:</td><td class='label' valign='top'>";
if ($ank['asal']!=NULL)
{
echo "$ank[asal]</td></tr>";
}
else
{
echo "______</td></tr>";
}
echo "<tr><td class='label' valign='top'>Country:</td><td class='label' valign='top'>";
if ($ank['negara']!=NULL)
{
echo "$ank[negara]</td></tr>";
}
else
{
echo "______</td></tr>";
}

echo"</table></small>";

echo "<div class='penanda'>Likes and Interests</div>";
if($user['id']==$ank['id']){
echo "<a href='/interest.php'>Edit</a> <font color='#a9a9a9'>likes and interests</font><br/>";
}
echo"<table><small>";
echo "<tr><td class='label' valign='top'>Activity:</td> <td class='label' valign='top'>";
if ($ank['aktivitas']!=NULL)
{
echo "$ank[aktivitas]</td></tr>";
}
else
{
echo "______</td></tr>";
}
echo "<tr><td class='label' valign='top'>Interest:</td><td class='label' valign='top'>";
if ($ank['minat']!=NULL)
{
echo "$ank[minat]</td></tr>";
}
else
{
echo "______</td></tr>";
}
echo "<tr><td class='label' valign='top'>Music:</td><td class='label' valign='top'>";
if ($ank['musik']!=NULL)
{
echo "$ank[musik]</td></tr>";
}
else
{
echo "______</td></tr>";
}
echo "<tr><td class='label' valign='top'>TV Show:</td><td class='label' valign='top'>";
if ($ank['tv']!=NULL)
{
echo "$ank[tv]</td></tr>";
}
else
{
echo "______</td></tr>";
}
echo "<tr><td class='label' valign='top'>Films:</td><td class='label' valign='top'>";
if ($ank['film']!=NULL)
{
echo " $ank[film]</td></tr>";
}
else
{
echo "______</td></tr>";
}
echo "<tr><td class='label' valign='top'>Books:</td><td class='label' valign='top'>";
if ($ank['buku']!=NULL)
{
echo "$ank[buku]</td></tr>";
}
else
{
echo "______</td></tr>";
}
echo "<tr><td class='label' valign='top'>Quote:</td><td class='label' valign='top'>";
if ($ank['kutipan']!=NULL)
{
echo "$ank[kutipan]</td></tr>";
}
else
{
echo "______</td></tr>";
}
echo "<tr><td class='label' valign='top'>Bio:</td><td class='label' valign='top'>";
if ($ank['bio']!=NULL)
{
echo "$ank[bio]</td></tr>";
}
else
{
echo "______</td></tr>";
}
echo "</small></table>";
echo "<div class='penanda'>Education and Work</div>";
if($user['id']==$ank['id']){
echo "<a href='/educat.php'>Edit</a> <font color='#a9a9a9'>education and work</font>";
}
echo "<table><small>";
echo "<tr><td class='label' valign='top'>School:</td><td class='label' valign='top'>";
if ($ank['sekolah']!=NULL)
{
echo "$ank[sekolah]</td></tr>";
}
else
{
echo "______</td></tr>";
}
echo "<tr><td class='label' valign='top'>University:</td><td class='label' valign='top'>";
if ($ank['kampus']!=NULL)
{
echo "$ank[kampus]</td></tr>";
}
else
{
echo " ______</td></tr>";
}
echo "<tr><td class='label' valign='top'>Company:</td><td class='label' valign='top'>";
if ($ank['kerja']!=NULL)
{
echo "$ank[kerja]</td></tr>";
}
else
{
echo " ______</td></tr>";
}
echo "<tr><td class='label' valign='top'>Position:</td><td class='label' valign='top'>";
if ($ank['jabatan']!=NULL)
{
echo "$ank[jabatan]</td></tr>";
}
else
{
echo " ______</td></tr>";
}
echo "</small></table><br/>";

//admin ketoke
if ($user['level']>$ank['level']){
if ($ank['ip']!=NULL){
if (user_access('user_show_ip') && $ank['ip']!=0){
echo "<span class=\"ank_n\">IP:</span> <span class=\"ank_d\">".long2ip($ank['ip'])."</span>";
if (user_access('adm_ban_ip'))
echo " [<a href='/adm_panel/ban_ip.php?min=$ank[ip]'>Ban</a>]";
echo "<br />\n";
}
}

if ($ank['ip_cl']!=NULL){
if (user_access('user_show_ip') && $ank['ip_cl']!=0){
echo "<span class=\"ank_n\">IP (CLIENT):</span> <span class=\"ank_d\">".long2ip($ank['ip_cl'])."</span>";
if (user_access('adm_ban_ip'))
echo " [<a href='/adm_panel/ban_ip.php?min=$ank[ip_cl]'>Ban</a>]";
echo "<br />\n";
}
}

if ($ank['ip_xff']!=NULL){
if (user_access('user_show_ip') && $ank['ip_xff']!=0){
echo "<span class=\"ank_n\">IP (XFF):</span> <span class=\"ank_d\">".long2ip($ank['ip_xff'])."</span>";
if (user_access('adm_ban_ip'))
echo " [<a href='/adm_panel/ban_ip.php?min=$ank[ip_xff]'>Ban</a>]";
echo "<br />\n";
}
}

if (user_access('user_show_ua') && $ank['ua']!=NULL)
echo "<span class=\"ank_n\">Browser:</span> <span class=\"ank_d\">$ank[ua]</span><br />\n";
if (user_access('user_show_ip') && opsos($ank['ip']))
echo "<span class=\"ank_n\">Ip:</span> <span class=\"ank_d\">".opsos($ank['ip'])."</span><br />\n";
if (user_access('user_show_ip') && opsos($ank['ip_cl']))
echo "<span class=\"ank_n\">Ip (CL):</span> <span class=\"ank_d\">".opsos($ank['ip_cl'])."</span><br />\n";
if (user_access('user_show_ip') && opsos($ank['ip_xff']))
echo "<span class=\"ank_n\">Ip (XFF):</span> <span class=\"ank_d\">".opsos($ank['ip_xff'])."</span><br />\n";

}

if ($ank['show_url']==1)
{
if (otkuda($ank['url']))echo "<span class=\"ank_n\">Las halaman terakhir:</span> <span class=\"ank_d\"><a href='$ank[url]'>".otkuda($ank['url'])."</a></span><br />\n";
}
if (user_access('user_collisions') && $user['level']>$ank['level'])
{
$mass[0]=$ank['id'];
$collisions=user_collision($mass);


if (count($collisions)>1)
{
echo "<span class=\"ank_n\">Nama lain dari:</span><br />\n";
echo "<span class=\"ank_d\">\n";

for ($i=1;$i<count($collisions);$i++)
{
$ank_coll=mysql_fetch_assoc(mysql_query("SELECT * FROM `user` WHERE `id` = '$collisions[$i]' LIMIT 1"));
echo "\"<a href='/info.php?id=$ank_coll[id]'>$ank_coll[nick]</a>\"<br />\n";
}

echo "</span>\n";
}
}
if (user_access('adm_ref') && ($ank['level']<$user['level'] || $user['id']==$ank['id']) && mysql_result(mysql_query("SELECT COUNT(*) FROM `user_ref` WHERE `id_user` = '$ank[id]'"), 0))
{
$q=mysql_query("SELECT * FROM `user_ref` WHERE `id_user` = '$ank[id]' ORDER BY `time` DESC LIMIT $set[p_str]");
echo "A: \n";
while ($url=mysql_fetch_assoc($q)) {
$site=htmlentities($url['url'], ENT_QUOTES, 'UTF-8');
echo "<a".($set['web']?" target='_blank'":null)." href='/go.php?go=".base64_encode("http://$site")."'>$site</a> (".vremja($url['time']).")<br />\n";
}
echo "<br />\n";
}


echo "<div>";
//if (isset($user) && $user['id']!=$ank['id'])echo "&nbsp;<a href=\"/mail.php?id=$ank[id]\">Kirim Pesan</a><br />\n";
//if (isset($user) && $user['id']==$ank['id'])echo "&nbsp;<a href=\"/anketa.php\">Edit Profile</a><br />\n";

if ($user['level']>$ank['level']){

if (user_access('user_prof_edit'))
echo "&nbsp;<a href='/adm_panel/user.php?id=$ank[id]'>Edit Profile</a><br />\n";

if ($user['id']!=$ank['id']){


if (user_access('user_ban_set') || user_access('user_ban_set_h') || user_access('user_ban_unset'))
echo "&nbsp;<a href='/adm_panel/ban.php?id=$ank[id]'>Baned users(bas)</a><br />\n";
if (user_access('user_delete'))
{
echo "&nbsp;<a href='/adm_panel/delete_user.php?id=$ank[id]'>Delete ID</a>";
if (count(user_collision($mass,1))>1)
echo "&nbsp;(<a href='/adm_panel/delete_user.php?id=$ank[id]&amp;all'>Delete User</a>)";
echo "<br/>\n";

}
}
}

//if(isset($_SESSION['refer']) && $_SESSION['refer']!=NULL && otkuda($_SESSION['refer']))
//echo "&laquo;<a href='$_SESSION[refer]'>".otkuda($_SESSION['refer'])."</a><br/>\n";

echo "</div>\n";

include_once 'sys/inc/tfoot.php';
?>
