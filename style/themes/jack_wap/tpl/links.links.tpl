<div class="links_title">{$menu_title}</div>
<div class="links">
{section name=any_menu loop=$menu}
<a class='links' href='{$menu[any_menu][0]}'>{$menu[any_menu][1]}</a>{if $menu[any_menu][2]} ({$menu[any_menu][2]}){/if}<br />
{if $menu[any_menu].input}<input type="text" value="http://{$smarty.server.SERVER_NAME}{$menu[any_menu][0]}" /><br />{/if}
{/section}
</div>
