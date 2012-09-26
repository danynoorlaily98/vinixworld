{section name=i loop=$post}
{if $post[i].status}
<span class="ank_status">{$post[i].status}</span>{if !$post[i].nobr}<br />{/if}

{elseif $post[i].0 AND $post[i].1}
<span class="ank_key">{$post[i].0}</span>: <span class="ank_value">{$post[i].1}</span>{if !$post[i].nobr}<br />{/if}

{elseif $post[i].img}
{if $post[i].big}<a href="{$post[i].big}" title="Нажмите для увеличения">{/if}
<img src="{$post[i].img}" alt="{if $post[i].alt}{$post[i].alt}{/if}" />{if !$post[i].nobr}<br />{/if}
{if $post[i].big}</a>{/if}

{/if}
{/section}
