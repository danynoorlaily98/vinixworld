<?php /* Smarty version 2.6.26, created on 2010-10-22 12:48:58
         compiled from body.mainmenu.tpl */ ?>
<div class="main_menu">

<?php if ($this->_tpl_vars['advertising'][2]): ?>
<?php $this->assign('adv_title', ($this->_tpl_vars['advertising'][2])); ?>
<!-- start inc.rekl.menu.tpl  --><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc.rekl.menu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><!-- end inc.rekl.menu.tpl  -->
<?php endif; ?>
<?php unset($this->_sections['main_menu']);
$this->_sections['main_menu']['name'] = 'main_menu';
$this->_sections['main_menu']['loop'] = is_array($_loop=$this->_tpl_vars['main_menu']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['main_menu']['show'] = true;
$this->_sections['main_menu']['max'] = $this->_sections['main_menu']['loop'];
$this->_sections['main_menu']['step'] = 1;
$this->_sections['main_menu']['start'] = $this->_sections['main_menu']['step'] > 0 ? 0 : $this->_sections['main_menu']['loop']-1;
if ($this->_sections['main_menu']['show']) {
    $this->_sections['main_menu']['total'] = $this->_sections['main_menu']['loop'];
    if ($this->_sections['main_menu']['total'] == 0)
        $this->_sections['main_menu']['show'] = false;
} else
    $this->_sections['main_menu']['total'] = 0;
if ($this->_sections['main_menu']['show']):

            for ($this->_sections['main_menu']['index'] = $this->_sections['main_menu']['start'], $this->_sections['main_menu']['iteration'] = 1;
                 $this->_sections['main_menu']['iteration'] <= $this->_sections['main_menu']['total'];
                 $this->_sections['main_menu']['index'] += $this->_sections['main_menu']['step'], $this->_sections['main_menu']['iteration']++):
$this->_sections['main_menu']['rownum'] = $this->_sections['main_menu']['iteration'];
$this->_sections['main_menu']['index_prev'] = $this->_sections['main_menu']['index'] - $this->_sections['main_menu']['step'];
$this->_sections['main_menu']['index_next'] = $this->_sections['main_menu']['index'] + $this->_sections['main_menu']['step'];
$this->_sections['main_menu']['first']      = ($this->_sections['main_menu']['iteration'] == 1);
$this->_sections['main_menu']['last']       = ($this->_sections['main_menu']['iteration'] == $this->_sections['main_menu']['total']);
?>
<?php if ($this->_tpl_vars['main_menu'][$this->_sections['main_menu']['index']]['type'] == 'link'): ?>
<div style="text-align:left;">
<img src="/style/icons_menu/<?php echo $this->_tpl_vars['main_menu'][$this->_sections['main_menu']['index']]['icon']; ?>
" alt="" />
<a  href="<?php echo $this->_tpl_vars['main_menu'][$this->_sections['main_menu']['index']]['url']; ?>
">
<?php echo $this->_tpl_vars['main_menu'][$this->_sections['main_menu']['index']]['name']; ?>
<?php if ($this->_tpl_vars['main_menu'][$this->_sections['main_menu']['index']]['counter'] !== false): ?> (<?php echo $this->_tpl_vars['main_menu'][$this->_sections['main_menu']['index']]['counter']; ?>
)<?php endif; ?>
</a>
</div><?php elseif ($this->_tpl_vars['main_menu'][$this->_sections['main_menu']['index']]['type'] == 'razd'): ?>
<div class="menu_razd">
<?php echo $this->_tpl_vars['main_menu'][$this->_sections['main_menu']['index']]['name']; ?>

</div>
<?php endif; ?>
<?php endfor; endif; ?>
</div>