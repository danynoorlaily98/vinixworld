<?

// remodified by noe
// http://nnetwork.tk
// loegue.info@gmail.com
// hargailah privasi orang

function online($user=NULL){
global $set,$time;
static $users;

if (!isset($users[$user])){
if (mysql_result(mysql_query("SELECT COUNT(*) FROM `ban` WHERE `id_user` = '$user' AND `time` > '$time'"), 0)!=0)
$users[$user]= ' <span class="off">[BAN]</span>';

elseif (mysql_result(mysql_query("SELECT COUNT(*) FROM `user` WHERE `id` = '$user' AND `date_last` > '".(time()-600)."' LIMIT 1"),0)==1){
if ($set['show_away']==0){
$ank=mysql_fetch_array(mysql_query("SELECT * FROM `user` WHERE `id` = $user LIMIT 1"));
if ($ank['pol']==1)
$on='<span class="on"> &bull;</span>';
else
$on='<span class="on"> &bull;</span>';
$mod='<img src="/style/ico/$ank[avt_ico]" alt="" class="icon" />';
}

else {
$ank=mysql_fetch_assoc(mysql_query("SELECT `date_last` FROM `user` WHERE `id` = '$user' LIMIT 1"));
if ((time()-$ank['date_last'])==0)
$on='on';
else
$on='away: '.(time()-$ank['date_last']).' secs';}
if ($ank['avt_ico']==NULL)
$users[$user]= "$on";
else {
$users[$user]= "<img src='/style/ico/$ank[avt_ico]' >";}
}

else {
$ank=mysql_fetch_array(mysql_query("SELECT * FROM `user` WHERE `id` = $user LIMIT 1"));
if ($ank['pol']==1)
return '<span class="off"> &bull;</span>';
else
return '<span class="off"> &bull;</span>';
}}

return $users[$user];
}

?>
