<?

if ($set['rekl']=='mobiads'){
if (isset ($set['mobiads_id']) && $set['mobiads_id']!=0 && isset ($set['mobiads_num_links']) && $set['mobiads_num_links']!=0){
echo "<div class='rekl_main'>\n";

echo "<!--mobiads.ru $set[mobiads_id]-->\n"; 
include_once H.'sys/inc/mobiads.php';
$ads = @get_ads($set['mobiads_id'], $set['mobiads_code'],$set['mobiads_num_links']); 
if($ads['STATUS'] == 'OK') 
foreach($ads['ADS'] as $link) 
{ 
echo '<a'.($set['web']?' target="_blank"':null).' href="'.htmlspecialchars($link[0], ENT_QUOTES, 'UTF-8').'">'.htmlspecialchars($link[1], ENT_QUOTES, 'UTF-8')."</a><br />\n"; 
} 
else echo $ads['DESCRIPTION']; 
echo "</div>\n";
}
}
if ($set['rekl']=='wappc' && $set['wappc_num_links']!=0){

echo "<div class='rekl_main'>\n";
echo "<!-- http://wappc.biz/?uid=".ereg_replace('\..*$','',$set['wappc_id'])." -->";
global $wappc3_curl, $wappc3_pwdtech;
$wappc3_curl=0;
$wappc3_pwdtech=$set['wappc_pwdtech'];
include_once H.'sys/inc/libwappc3.php';
print GetFeedWAPPC3($set['wappc_num_links'],array('charset'=>'utf-8','aff'=>$set['wappc_id'],'empty'=>"<a".($set['web']?" target='_blank'":null)." href='http://wappc.biz/?uid=5408'>Заработок wap мастерам</a><br />",'template'=>'%code%<br />','sep'=>'<br />','topbid'=>1));

/*
global $wappc3_curl;
$wappc3_curl=0;
include_once H.'sys/inc/libwappc3.php';
print GetFeedWAPPC3($set['wappc_num_links'],array('charset'=>'utf-8','aff'=>"$set[wappc_id]",'empty'=>"<a".($set['web']?" target='_blank'":null)." href='http://wappc.biz/partner.php?uid=5408'>Заработок WAP-мастеру</a>",'template'=>'%code%','sep'=>'<br />','topbid'=>1,'operator'=>1));
*/
echo "</div>\n";
}

?>