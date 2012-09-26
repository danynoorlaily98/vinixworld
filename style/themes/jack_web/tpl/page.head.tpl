<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru-ru" lang="ru-ru" ><head>
<title>{$title}</title>
<link rel="shortcut icon" href="/favicon.ico" />
<link rel="stylesheet" href="/style/themes/{$theme_dir}/style.css" type="text/css" />
<meta http-equiv="refresh" content="60">
<link rel="alternate" title="t87jack RSS" href="/news/rss.php" type="application/rss+xml" />
{if $meta_keywords}<meta name="keywords" content="{$meta_keywords}" />{/if}
{if $meta_description}<meta name="meta_description" content="{$meta_description}" />{/if}
</head>
<body>
<div class="body">
  <table class="wraper">
    <tr>
     <td>
        <div id="left_top"></div>
         <div id="left_c">
<!-- start inc.aut.tpl  -->
{include file="inc.aut.tpl"}
<!-- end inc.aut.tpl  -->
<!-- start inc.main_menu.tpl  -->
{include file="inc.main_menu.tpl"}
<!-- end inc.main_menu.tpl  -->
{if $advertising[2]}
{assign var="adv_title" value=`$advertising[2]`}
<!-- start inc.rekl.menu.tpl  -->
{include file="inc.rekl.menu.tpl"}
<!-- end inc.rekl.menu.tpl  -->
{/if}<div id="copy">&copy;&nbsp;<a href="http://t87jack.org">http://t87jack.org</a><br>script by <a href="http://dcms.su">http://dcms.su</a></div>
</div></td>
<td>
<!-- start inc.title.tpl  -->
{include file="inc.title.tpl"}
<!-- end inc.title.tpl  -->

<!-- coAp??e c?a?? -->
<div class='content'>

{if $advertising[1]}
{assign var="adv_title" value=`$advertising[1]`}
<!-- start inc.rekl.title.tpl  -->
{include file="inc.rekl.title.tpl"}
<!-- end inc.rekl.title.tpl  -->
{/if}
{if $advertising[101]}
{assign var="adv_wappc" value=`$advertising[101]`}
<!-- start inc.rekl.wappc.tpl  -->
{include file="inc.rekl.wappc.tpl"}
<!-- end inc.rekl.wappc.tpl  -->
{/if}
{if $smarty.server.SCRIPT_NAME == '/index.php'}
<!-- start inc.index.tpl  -->
{include file="inc.index.tpl"}
<!-- end inc.index.tpl  -->
{/if}


