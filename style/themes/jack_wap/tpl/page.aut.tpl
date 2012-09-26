<div class="user_aut">

{if $user}
{if $msg_new_fav}<a href='/new_mess.php'>Feature posts ({$msg_new_fav})</a><br />
{elseif $msg_new}<a href='/new_mess.php'>Pesan baru ! ({$msg_new})</a><br />{/if}
{if $forum_zakl}<a href='/zakl.php'>Pesan baru di tab !({$forum_zakl})</a><br />{/if}
{/if}
</div>

{if $user}
{include file="inc.index.tpl"}
{else}
{include file="inc.index.tpl"}{/if}
