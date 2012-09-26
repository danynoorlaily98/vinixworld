<div class="user_menu">
{if $user}
<a href='/umenu.php'>Личный кабинет</a><br />
{if $msg_new_fav}<a href='/new_mess.php'>Избранные сообщения ({$msg_new_fav})</a><br />
{elseif $msg_new}<a href='/new_mess.php'>Новые сообщения ({$msg_new})</a><br />{/if}
{if $forum_zakl}<a href='/zakl.php'>Новые сообщения в закладках ({$forum_zakl})</a><br />{/if}
{else}
<a href='/aut.php'>Вход</a> <a href='/reg.php'>Регистрация</a>
{/if}
</div>
