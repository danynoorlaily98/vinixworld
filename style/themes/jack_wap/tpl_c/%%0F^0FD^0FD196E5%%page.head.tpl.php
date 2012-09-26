<?php /* Smarty version 2.6.26, created on 2010-12-27 04:09:02
         compiled from page.head.tpl */ ?>
<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru">
<head>
<title><?php echo $this->_tpl_vars['title']; ?>
</title>
<link rel="shortcut icon" href="/favicon.ico" />
<link rel="stylesheet" href="/style/themes/<?php echo $this->_tpl_vars['theme_dir']; ?>
/style.css" type="text/css" />
<link rel="alternate" title="RSS" href="/news/rss.php" type="application/rss+xml" />
<meta http-equiv="refresh" content="60">
<?php if ($this->_tpl_vars['meta_keywords']): ?>
<meta name="keywords" content="<?php echo $this->_tpl_vars['meta_keywords']; ?>
" />
<?php endif; ?><?php if ($this->_tpl_vars['meta_description']): ?>
<meta name="description" content="<?php echo $this->_tpl_vars['meta_description']; ?>
" />
<?php endif; ?>
<meta http-equiv="content-Type" content="application/xhtml+xml; charset=utf-8" />
</head>
<div class='page_foot'><img src='/style/copy.png' alt='logo'/><br>
<?php if ($this->_tpl_vars['user']): ?>
<a href='/index.php'><font color='white'>Beranda</font></a> <a href='/umenu.php'><font color='white'>CPanel</font></a> <a href='/profil.php'><font color='white'>Profil</font></a> <a href='/frend.php'><font color='white'>Teman</font></a> <a href='/mail.php'><font color='white'>Pesan</font></a>
<?php else: ?>
  <a href='/reg.php'><font color='white'>Daftar</font></a> <a href='/aut.php'><font color='white'>Masuk</font></a> <a href='/pass.php'><font color='white'>Lupa sandi</font></a>
<?php endif; ?>
</div>

<body>
<div class="body">