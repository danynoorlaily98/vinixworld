<div class="rekl_foot">
{section name=adv loop=$adv_title}
<a href="{$adv_title[adv].link}">{if $adv_title[adv].img}<img src="{$adv_title[adv].img}" alt="{$adv_title[adv].name}" />{else}{$adv_title[adv].name}{/if}</a>
{/section}
</div>