<div class='links_path'>
Path:&nbsp;
<a href='/'>Awal</a> 
{section name=any_menu loop=$menu step=-1}
&gt; <a href='{$menu[any_menu][0]}'>{$menu[any_menu][1]}{if $menu[any_menu][2]} ({$menu[any_menu][2]}){/if}</a>
{/section}
</div>

