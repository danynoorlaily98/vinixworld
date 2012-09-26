<div class="umenu">

{section name=any_menu loop=$menu}
{$user[nick]}
<a href='{$menu[any_menu][0]}'>{$menu[any_menu][1]}{if $menu[any_menu][2]} ({$menu[any_menu][2]}){/if}</a>
{/section}
</div>