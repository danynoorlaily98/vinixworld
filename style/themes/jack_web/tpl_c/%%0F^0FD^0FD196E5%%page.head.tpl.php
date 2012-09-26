<?php /* Smarty version 2.6.26, created on 2010-12-29 09:45:33
         compiled from page.head.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru-ru" lang="ru-ru" ><head>
<title><?php echo $this->_tpl_vars['title']; ?>
</title>
<link rel="shortcut icon" href="/favicon.ico" />
<link rel="stylesheet" href="/style/themes/<?php echo $this->_tpl_vars['theme_dir']; ?>
/style.css" type="text/css" />
<meta http-equiv="refresh" content="60">
<link rel="alternate" title="t87jack RSS" href="/news/rss.php" type="application/rss+xml" />
<?php if ($this->_tpl_vars['meta_keywords']): ?><meta name="keywords" content="<?php echo $this->_tpl_vars['meta_keywords']; ?>
" /><?php endif; ?>
<?php if ($this->_tpl_vars['meta_description']): ?><meta name="meta_description" content="<?php echo $this->_tpl_vars['meta_description']; ?>
" /><?php endif; ?>
</head>
<body>
<div class="body">
  <table class="wraper">
    <tr>
     <td>
        <div id="left_top"></div>
         <div id="left_c">
<!-- start inc.aut.tpl  -->
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc.aut.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<!-- end inc.aut.tpl  -->
<!-- start inc.main_menu.tpl  -->
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc.main_menu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<!-- end inc.main_menu.tpl  -->
<?php if ($this->_tpl_vars['advertising'][2]): ?>
<?php $this->assign('adv_title', ($this->_tpl_vars['advertising'][2])); ?>
<!-- start inc.rekl.menu.tpl  -->
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc.rekl.menu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<!-- end inc.rekl.menu.tpl  -->
<?php endif; ?><div id="copy">&copy;&nbsp;<a href="http://t87jack.org">http://t87jack.org</a><br>script by <a href="http://dcms.su">http://dcms.su</a></div>
</div></td>
<td>
<!-- start inc.title.tpl  -->
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc.title.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<!-- end inc.title.tpl  -->

<!-- coAp??e c?a?? -->
<div class='content'>

<?php if ($this->_tpl_vars['advertising'][1]): ?>
<?php $this->assign('adv_title', ($this->_tpl_vars['advertising'][1])); ?>
<!-- start inc.rekl.title.tpl  -->
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc.rekl.title.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<!-- end inc.rekl.title.tpl  -->
<?php endif; ?>
<?php if ($this->_tpl_vars['advertising'][101]): ?>
<?php $this->assign('adv_wappc', ($this->_tpl_vars['advertising'][101])); ?>
<!-- start inc.rekl.wappc.tpl  -->
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc.rekl.wappc.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<!-- end inc.rekl.wappc.tpl  -->
<?php endif; ?>
<?php if ($_SERVER['SCRIPT_NAME'] == '/index.php'): ?>
<!-- start inc.index.tpl  -->
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc.index.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<!-- end inc.index.tpl  -->
<?php endif; ?>

