<table class="pages" cellpadding="0" cellspacing="0">
<tr>
<td class="b_left">&nbsp;</td>
<td>Halaman:</td>
{if $page == 1}
<td class="this_page">1</td>
{else}
<td class="page"><a href="{$link}page=1">1</a></td>
{/if}
{if $page>4}
<td>&nbsp;</td>
{/if}
{section name=page loop=$k_page}
{if $smarty.section.page.iteration > 1 AND $smarty.section.page.iteration < $k_page  AND $smarty.section.page.iteration<=$page+3  AND $smarty.section.page.iteration>=$page-2}
{if $page == $smarty.section.page.iteration}
<td class="this_page">{$smarty.section.page.iteration}</td>
{else}
<td class="page"><a href="{$link}page={$smarty.section.page.iteration}">{$smarty.section.page.iteration}</a></td>
{/if}
{/if}
{/section}
{if $page < $k_page-4}
<td>&nbsp;</td>
{/if}
{if $page == $k_page}
<td class="this_page">{$k_page}</td>
{else}
<td class="page"><a href="{$link}page={$k_page}">{$k_page}</a></td>
{/if}
<td class="b_right">&nbsp;</td>
</tr>
</table>
