<div class="rekl_title">
{section name=adv loop=$adv_title}
<a href="{$adv_title[adv].link}">
{if $adv_title[adv].img}
<img src="{$adv_title[adv].img}" alt="{$adv_title[adv].name}" />
{else}
{$adv_title[adv].name}
{/if}
</a>
<br />
{/section}
</div>