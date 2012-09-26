<?php /* Smarty version 2.6.26, created on 2010-10-22 12:48:57
         compiled from page.title.tpl */ ?>
<div class='title'><?php echo $this->_tpl_vars['title']; ?>
</div>
<?php if ($this->_tpl_vars['advertising'][1]): ?>
<?php $this->assign('adv_title', ($this->_tpl_vars['advertising'][1])); ?>
<!-- start inc.rekl.title.tpl  --><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc.rekl.title.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><!-- end inc.rekl.title.tpl  -->
<?php endif; ?>

<?php if ($this->_tpl_vars['advertising'][101]): ?>
<?php $this->assign('adv_title', ($this->_tpl_vars['advertising'][101])); ?>
<!-- start inc.rekl.wappc.tpl  --><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc.rekl.wappc.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><!-- end inc.rekl.wappc.tpl  -->
<?php endif; ?>