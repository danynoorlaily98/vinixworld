{assign var="uniq" value=8|passgen}
<script>{literal}
function action_links_show_{/literal}{$uniq}{literal}(){
document.getElementById('action_links_{/literal}{$uniq}{literal}').style.display="block";
document.getElementById('action_title_{/literal}{$uniq}{literal}').style.display="none";
}
{/literal}</script>
<div id="action_title_{$uniq}" class='action_title'>
<a href='javascript:action_links_show_{$uniq}();'>
<b>{$menu_title}</b>
</a>
</div>

<div id="action_links_{$uniq}" class='action_links' style='display:none;'>
{section name=any_menu loop=$menu}
&nbsp;<a href='{$menu[any_menu][0]}'>{$menu[any_menu][1]}</a>&nbsp;
{/section}
</div>

