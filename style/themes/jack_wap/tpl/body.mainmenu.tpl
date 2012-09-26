<div class="main_menu">

{if $advertising[2]}
{assign var="adv_title" value=`$advertising[2]`}
<!-- start inc.rekl.menu.tpl  -->{include file="inc.rekl.menu.tpl"}<!-- end inc.rekl.menu.tpl  -->
{/if}
{section name=main_menu loop=$main_menu}
{if $main_menu[main_menu].type eq 'link'}
<div style="text-align:left;">
<img src="/style/icons_menu/{$main_menu[main_menu].icon}" alt="" />
<a  href="{$main_menu[main_menu].url}">
{$main_menu[main_menu].name}{if $main_menu[main_menu].counter !== false} ({$main_menu[main_menu].counter}){/if}
</a>
</div>{elseif $main_menu[main_menu].type eq 'razd'}
<div class="menu_razd">
{$main_menu[main_menu].name}
</div>
{/if}
{/section}
</div>
