<div class="select">
{if $menu_title}
{$menu_title}:&nbsp;
{/if}
{section name=any_menu loop=$menu}
&nbsp;
{if $menu[any_menu][2]}
<span>{$menu[any_menu][1]}</span>
{else}
<a href='{$menu[any_menu][0]}'>{$menu[any_menu][1]} </a>
{/if}
&nbsp;
{/section}
</div>