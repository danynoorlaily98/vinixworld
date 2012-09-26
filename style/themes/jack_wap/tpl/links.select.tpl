<div class="module_menu_select">
{if $menu_title}
<b>{$menu_title}:</b>
{/if}
{section name=any_menu loop=$menu}
{if $menu[any_menu][2]}
[{$menu[any_menu][1]}]
{else}
<a href='{$menu[any_menu][0]}'>{$menu[any_menu][1]} </a>
{/if}
{/section}
</div>
