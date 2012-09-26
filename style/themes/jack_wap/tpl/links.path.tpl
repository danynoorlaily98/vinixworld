<div class="menu_path_title">{$menu_title}</div>
<div class="menu_path">
{section name=any_menu loop=$menu}
<a class='menu_path' href='{$menu[any_menu][0]}'>{$menu[any_menu][1]}{if $menu[any_menu][2]} ({$menu[any_menu][2]}){/if}</a><br />
{/section}
</div>