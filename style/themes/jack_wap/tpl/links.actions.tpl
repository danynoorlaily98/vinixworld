<div class="act_link_title">
{$menu_title}
</div>
<div class="act_link">
{section name=any_menu loop=$menu}
<a class='act_link' href='{$menu[any_menu][0]}'>{$menu[any_menu][1]}</a><br />
{/section}
</div>

