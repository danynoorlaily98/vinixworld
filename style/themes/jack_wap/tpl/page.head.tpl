<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru">
<head>
<title>{$title}</title>
<link rel="shortcut icon" href="/favicon.ico" />
<link rel="stylesheet" href="/style/themes/{$theme_dir}/style.css" type="text/css" />
<link rel="alternate" title="RSS" href="/news/rss.php" type="application/rss+xml" />
<meta http-equiv="refresh" content="60">
{if $meta_keywords}
<meta name="keywords" content="{$meta_keywords}" />
{/if}{if $meta_description}
<meta name="description" content="{$meta_description}" />
{/if}
<meta http-equiv="content-Type" content="application/xhtml+xml; charset=utf-8" />
</head>
<div class='page_foot'><img src='/style/copy.png' alt='logo'/><br>
{if $user}
<a href='/index.php'><font color='white'>Beranda</font></a> <a href='/umenu.php'><font color='white'>CPanel</font></a> <a href='/profil.php'><font color='white'>Profil</font></a> <a href='/frend.php'><font color='white'>Teman</font></a> <a href='/mail.php'><font color='white'>Pesan</font></a>
{else}
  <a href='/reg.php'><font color='white'>Daftar</font></a> <a href='/aut.php'><font color='white'>Masuk</font></a> <a href='/pass.php'><font color='white'>Lupa sandi</font></a>
{/if}
</div>

<body>
<div class="body">
