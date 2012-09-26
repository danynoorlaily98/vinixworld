<div class='title'>{$title}</div>
{if $advertising[1]}
{assign var="adv_title" value=`$advertising[1]`}
<!-- start inc.rekl.title.tpl  -->{include file="inc.rekl.title.tpl"}<!-- end inc.rekl.title.tpl  -->
{/if}

{if $advertising[101]}
{assign var="adv_title" value=`$advertising[101]`}
<!-- start inc.rekl.wappc.tpl  -->{include file="inc.rekl.wappc.tpl"}<!-- end inc.rekl.wappc.tpl  -->
{/if}
