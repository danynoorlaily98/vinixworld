{section name=i loop=$post}
<div class="post{if $smarty.section.i.iteration is even}0{else}1{/if}">
<div class="post_msg"><table>
{if $post[i].icon.size eq 'big'}
<tr>
<td rowspan="3"><img src="{$post[i].icon.src}" alt="" /></td><td>
{$post[i].title} {if $post[i].new}<span class="on">new</span>{/if}
{elseif $post[i].icon.size eq 'small'}
<div class="post_title"><tr><td>
<img src="{$post[i].icon.src}" alt="" />
{$post[i].title} {if $post[i].new}<span class="on">new</span>{/if}
{else}
<div class="post_title"><tr><td>{$post[i].title} {if $post[i].new}<span class="on">new</span>{/if}
{/if}
{if $post[i].delete}
<a href="{$post[i].delete}">[x]</a>
{/if}
</td>
</tr>
</div>
{if $post[i].cit}
<tr><td>
<div class='quote'>
<span>{$post[i].cit.nick} ({$post[i].cit.time|vremja})</span><br />{$post[i].cit.msg|output_text}
</div></td>
</tr>
{/if}
{if $post[i].post}
<div class="post_msg"><tr>
<td>{$post[i].post} {if $post[i].link_edit OR $post[i].link_cit}<br />{/if}
{if $post[i].link_edit}
<a title="Edit" href="{$post[i].link_edit}">[-Edit-]</a>
{/if}
{if $post[i].link_cit}
<a title="Quote" href="{$post[i].link_cit}">[-Quote-]</a>
{/if}
</td>
</tr>
{/if}
</div></table>
</div>{if $post[i].files}
File:<br />
<div class="post_files">
<table>{section name=ff loop=$post[i].files}
<tr><td>
<img src="{$post[i].files[ff].icon}" alt="" /></td><td>
<a href="{$post[i].files[ff].link_down}">{$post[i].files[ff].name}</a></td><td>{$post[i].files[ff].size|size_file}</td><td>
{if $post[i].files[ff].rating_up}
<a title="Rating" href="{$post[i].files[ff].rating_up}">[+]</a>{/if}
{$post[i].files[ff].summ_vote|intval}/{$post[i].files[ff].k_vote}
{if $post[i].files[ff].rating_down}
<a title="Rating" href="{$post[i].files[ff].rating_down}">[-]</a>{/if}</td>
{if $post[i].files[ff].link_delete}<td>
<a title="Hapus file" href="{$post[i].files[ff].link_delete}">[x]</a></td>
{/if}
</tr>
{/section}
</table>
</div>{/if}
</div>
{/section}
