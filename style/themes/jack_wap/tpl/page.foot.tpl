{if $user}
<div class="post1">
<a href="/avatar.php"><font color="white">Avatar</font></a> <font color="red">|</font>
<a href="/settings.php"><font color="white">Pengaturan</font></a> <font color="red">|</font>
<a href="/exit.php"><font color="white">Exit</font></a> 
</div>
{/if}


<div class="page_foot">
{if $smarty.server.SCRIPT_NAME != '/index.php'}
<img src="/style/themes/{$theme_dir}/for_css/home.png" alt="" /> <a href='/'>Home</a><br />
{/if}
<img src="/style/themes/{$theme_dir}/for_css/online.png" alt="" /> <a href='/users.php'>All member:  {$count_users}</a></div><div class="news"> <img src="/style/themes/{$theme_dir}/for_css/online.png" alt="" /> Online: <a href='/online.php'>{$count_users_online}</a> | Tamu: <a href='/online_g.php'>{$count_guest} </a><br />
Loading: {$time_gen} detik</div></div>
<div class='title'>
<div class='admob'>
<a href="http://ads.texad.mobi/banex/motor/motor_link.php?user_id_zone=6480&zone_id=14555"><img src="http://ads.texad.mobi/banex/motor/motor_img.php?user_id_zone=6480&zone_id=14555" alt="Click here" /></a>
<a href="http://counter.mobpartner.mobi/?id=10983"><img src="http://counter.mobpartner.mobi/counter.php?id=10983" alt="Counter" border="0" /></a>
<a href="http://waplog.net/c.shtml?341011"><img src="http://c.waplog.net/341011.cnt" alt="waplog" /></a><br>
<a href="http://www.mypagerank.net/seomonitor-71473.html" target="_blank"><img src="http://www.mypagerank.net/services/seomonitor/seomonitor.php?aut=71473" title="SEO Monitor by MyPagerank.Net"  border="0" /></a>
</div>
<a href=http://t87jack.mobpartner.com/join.php>Join MobPartner, the  first Mobile Affiliate Network</a>
</div>

</div>
</div>
</body></html>
