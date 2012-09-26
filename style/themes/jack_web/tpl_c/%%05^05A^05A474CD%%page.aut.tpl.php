<?php /* Smarty version 2.6.26, created on 2010-04-30 00:20:55
         compiled from page.aut.tpl */ ?>
<div class="user_aut">
<?php if ($this->_tpl_vars['user']): ?>
<a href='/umenu.php'>Личный кабинет</a><br />
<?php if ($this->_tpl_vars['msg_new_fav']): ?><a href='/new_mess.php'>Избранные сообщения (<?php echo $this->_tpl_vars['msg_new_fav']; ?>
)</a><br />
<?php elseif ($this->_tpl_vars['msg_new']): ?><a href='/new_mess.php'>Новые сообщения (<?php echo $this->_tpl_vars['msg_new']; ?>
)</a><br /><?php endif; ?>
<?php if ($this->_tpl_vars['forum_zakl']): ?><a href='/zakl.php'>Новые сообщения в закладках (<?php echo $this->_tpl_vars['forum_zakl']; ?>
)</a><br /><?php endif; ?>
<?php else: ?>
<a href='/aut.php'>Вход</a> <a href='/reg.php'>Регистрация</a>
<?php endif; ?>
</div>