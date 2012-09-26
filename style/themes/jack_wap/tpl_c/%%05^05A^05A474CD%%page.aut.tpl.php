<?php /* Smarty version 2.6.26, created on 2010-11-24 07:33:38
         compiled from page.aut.tpl */ ?>
<div class="user_aut">

<?php if ($this->_tpl_vars['user']): ?>
<?php if ($this->_tpl_vars['msg_new_fav']): ?><a href='/new_mess.php'>Feature posts (<?php echo $this->_tpl_vars['msg_new_fav']; ?>
)</a><br />
<?php elseif ($this->_tpl_vars['msg_new']): ?><a href='/new_mess.php'>Pesan baru ! (<?php echo $this->_tpl_vars['msg_new']; ?>
)</a><br /><?php endif; ?>
<?php if ($this->_tpl_vars['forum_zakl']): ?><a href='/zakl.php'>Pesan baru di tab !(<?php echo $this->_tpl_vars['forum_zakl']; ?>
)</a><br /><?php endif; ?>
<?php endif; ?>
</div>

<?php if ($this->_tpl_vars['user']): ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc.index.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php else: ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc.index.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?>