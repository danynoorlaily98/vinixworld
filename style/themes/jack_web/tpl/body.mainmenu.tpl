<div class="main_menu">
{section name=main_menu loop=$main_menu}
{if $main_menu[main_menu].type eq 'link'}
<a href="{$main_menu[main_menu].url}">{$main_menu[main_menu].name}{if $main_menu[main_menu].counter} ({$main_menu[main_menu].counter}){/if}</a>
{elseif $main_menu[main_menu].type eq 'razd'}<div class="mr">{$main_menu[main_menu].name}</div>{/if}
{/section}
</div>
