<table class="rekl_title" align="center">
<tr>
{section name=adv loop=$adv_title}
<td><a target="_blank" href="{$adv_title[adv].link}">
{if $adv_title[adv].img}
<img src="{$adv_title[adv].img}" alt="{$adv_title[adv].name}">
{else}
{$adv_title[adv].name}
{/if}
</a></td>
{/section}
</tr>
</table>