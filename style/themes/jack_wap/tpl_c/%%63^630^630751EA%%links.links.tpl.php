<?php /* Smarty version 2.6.26, created on 2010-10-22 12:51:35
         compiled from links.links.tpl */ ?>
<div class="links_title"><?php echo $this->_tpl_vars['menu_title']; ?>
</div>
<div class="links">
<?php unset($this->_sections['any_menu']);
$this->_sections['any_menu']['name'] = 'any_menu';
$this->_sections['any_menu']['loop'] = is_array($_loop=$this->_tpl_vars['menu']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['any_menu']['show'] = true;
$this->_sections['any_menu']['max'] = $this->_sections['any_menu']['loop'];
$this->_sections['any_menu']['step'] = 1;
$this->_sections['any_menu']['start'] = $this->_sections['any_menu']['step'] > 0 ? 0 : $this->_sections['any_menu']['loop']-1;
if ($this->_sections['any_menu']['show']) {
    $this->_sections['any_menu']['total'] = $this->_sections['any_menu']['loop'];
    if ($this->_sections['any_menu']['total'] == 0)
        $this->_sections['any_menu']['show'] = false;
} else
    $this->_sections['any_menu']['total'] = 0;
if ($this->_sections['any_menu']['show']):

            for ($this->_sections['any_menu']['index'] = $this->_sections['any_menu']['start'], $this->_sections['any_menu']['iteration'] = 1;
                 $this->_sections['any_menu']['iteration'] <= $this->_sections['any_menu']['total'];
                 $this->_sections['any_menu']['index'] += $this->_sections['any_menu']['step'], $this->_sections['any_menu']['iteration']++):
$this->_sections['any_menu']['rownum'] = $this->_sections['any_menu']['iteration'];
$this->_sections['any_menu']['index_prev'] = $this->_sections['any_menu']['index'] - $this->_sections['any_menu']['step'];
$this->_sections['any_menu']['index_next'] = $this->_sections['any_menu']['index'] + $this->_sections['any_menu']['step'];
$this->_sections['any_menu']['first']      = ($this->_sections['any_menu']['iteration'] == 1);
$this->_sections['any_menu']['last']       = ($this->_sections['any_menu']['iteration'] == $this->_sections['any_menu']['total']);
?>
<a class='links' href='<?php echo $this->_tpl_vars['menu'][$this->_sections['any_menu']['index']][0]; ?>
'><?php echo $this->_tpl_vars['menu'][$this->_sections['any_menu']['index']][1]; ?>
</a><?php if ($this->_tpl_vars['menu'][$this->_sections['any_menu']['index']][2]): ?> (<?php echo $this->_tpl_vars['menu'][$this->_sections['any_menu']['index']][2]; ?>
)<?php endif; ?><br />
<?php if ($this->_tpl_vars['menu'][$this->_sections['any_menu']['index']]['input']): ?><input type="text" value="http://<?php echo $_SERVER['SERVER_NAME']; ?>
<?php echo $this->_tpl_vars['menu'][$this->_sections['any_menu']['index']][0]; ?>
" /><br /><?php endif; ?>
<?php endfor; endif; ?>
</div>