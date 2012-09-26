<div class='contentlist'>
{section name=i loop=$post}
<div class="post_item{if $post[i].new}_new{/if}">
{if $post[i].link_block}<a href="{$post[i].link_block}" class="block">{/if}
<table class="post_msg" cellspacing="0" callpadding="0">
{if $post[i].icon.size eq 'big'}
<tr>
<td width="50" rowspan="3"><img src="{$post[i].icon.src}" alt="" /></td><td width="100%">
{$post[i].title}
{elseif $post[i].icon.size eq 'small'}
<tr class="post_title"><td width="100%">
<img src="{$post[i].icon.src}" alt="" />
{$post[i].title}
{else}
<tr class="post_title"><td>{$post[i].title}
{/if}
</td>
{if $post[i].link_cit}<td class='content_act'><a title="Kutip" href="{$post[i].link_cit}"><img src="/style/themes/{$theme_dir}/icons/contentlist_cit.png" alt="Kutip" /></a></td>{/if}
{if $post[i].link_edit}<td class='content_act'><a title="Edit" href="{$post[i].link_edit}"><img src="/style/themes/{$theme_dir}/icons/contentlist_edit.png" alt="Edit" /></a></td>{/if}
{if $post[i].delete}<td class='content_act'><a title="Hapus" href="{$post[i].delete}"><img src="/style/themes/{$theme_dir}/icons/contentlist_delete.png" alt="Hapus" /></a></td>{/if}

</tr>
{if $post[i].cit}
<tr>
<td colspan="5" class="quote">
<span class="quote_title">{$post[i].cit.nick} ({$post[i].cit.time|vremja})</span>: <span class="quote_msg">{$post[i].cit.msg|output_text}</span>
</td>
</tr>
{/if}
{if $post[i].post}
<tr class="post_msg">
<td colspan="5">{$post[i].post} {if $post[i].link_edit OR $post[i].link_cit}<br />{/if}
</td>
</tr>
{/if}
</table>
{if $post[i].files}
Lampirkan file:<br />
<table class="post_files">
{section name=ff loop=$post[i].files}
<tr><td>
<img src="{$post[i].files[ff].icon}" alt="" /></td><td>
<a href="{$post[i].files[ff].link_down}">{$post[i].files[ff].name}</a></td><td>{$post[i].files[ff].size|size_file}</td><td>
{if $post[i].files[ff].rating_up}
<a title="File berguna" href="{$post[i].files[ff].rating_up}">[+]</a>{/if}
{$post[i].files[ff].summ_vote|intval}/{$post[i].files[ff].k_vote}
{if $post[i].files[ff].rating_down}
<a title="File tak berguna" href="{$post[i].files[ff].rating_down}">[-]</a>{/if}</td>
{if $post[i].files[ff].link_delete}<td>
<a title="Hapus file" href="{$post[i].files[ff].link_delete}">[x]</a></td>
{/if}
</tr>
{/section}
</table>
{/if}
{if $post[i].link_block}</a>{/if}
</div>
{/section}
</div>
