<?php /* Smarty version 2.6.26, created on 2010-12-29 12:11:14
         compiled from page.pagelisting.tpl */ ?>
<table class="pages" cellpadding="0" cellspacing="0">
<tr>
<td class="b_left">&nbsp;</td>
<td>Halaman:</td>
<?php if ($this->_tpl_vars['page'] == 1): ?>
<td class="this_page">1</td>
<?php else: ?>
<td class="page"><a href="<?php echo $this->_tpl_vars['link']; ?>
page=1">1</a></td>
<?php endif; ?>
<?php if ($this->_tpl_vars['page'] > 4): ?>
<td>&nbsp;</td>
<?php endif; ?>
<?php unset($this->_sections['page']);
$this->_sections['page']['name'] = 'page';
$this->_sections['page']['loop'] = is_array($_loop=$this->_tpl_vars['k_page']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['page']['show'] = true;
$this->_sections['page']['max'] = $this->_sections['page']['loop'];
$this->_sections['page']['step'] = 1;
$this->_sections['page']['start'] = $this->_sections['page']['step'] > 0 ? 0 : $this->_sections['page']['loop']-1;
if ($this->_sections['page']['show']) {
    $this->_sections['page']['total'] = $this->_sections['page']['loop'];
    if ($this->_sections['page']['total'] == 0)
        $this->_sections['page']['show'] = false;
} else
    $this->_sections['page']['total'] = 0;
if ($this->_sections['page']['show']):

            for ($this->_sections['page']['index'] = $this->_sections['page']['start'], $this->_sections['page']['iteration'] = 1;
                 $this->_sections['page']['iteration'] <= $this->_sections['page']['total'];
                 $this->_sections['page']['index'] += $this->_sections['page']['step'], $this->_sections['page']['iteration']++):
$this->_sections['page']['rownum'] = $this->_sections['page']['iteration'];
$this->_sections['page']['index_prev'] = $this->_sections['page']['index'] - $this->_sections['page']['step'];
$this->_sections['page']['index_next'] = $this->_sections['page']['index'] + $this->_sections['page']['step'];
$this->_sections['page']['first']      = ($this->_sections['page']['iteration'] == 1);
$this->_sections['page']['last']       = ($this->_sections['page']['iteration'] == $this->_sections['page']['total']);
?>
<?php if ($this->_sections['page']['iteration'] > 1 && $this->_sections['page']['iteration'] < $this->_tpl_vars['k_page'] && $this->_sections['page']['iteration'] <= $this->_tpl_vars['page']+3 && $this->_sections['page']['iteration'] >= $this->_tpl_vars['page']-2): ?>
<?php if ($this->_tpl_vars['page'] == $this->_sections['page']['iteration']): ?>
<td class="this_page"><?php echo $this->_sections['page']['iteration']; ?>
</td>
<?php else: ?>
<td class="page"><a href="<?php echo $this->_tpl_vars['link']; ?>
page=<?php echo $this->_sections['page']['iteration']; ?>
"><?php echo $this->_sections['page']['iteration']; ?>
</a></td>
<?php endif; ?>
<?php endif; ?>
<?php endfor; endif; ?>
<?php if ($this->_tpl_vars['page'] < $this->_tpl_vars['k_page']-4): ?>
<td>&nbsp;</td>
<?php endif; ?>
<?php if ($this->_tpl_vars['page'] == $this->_tpl_vars['k_page']): ?>
<td class="this_page"><?php echo $this->_tpl_vars['k_page']; ?>
</td>
<?php else: ?>
<td class="page"><a href="<?php echo $this->_tpl_vars['link']; ?>
page=<?php echo $this->_tpl_vars['k_page']; ?>
"><?php echo $this->_tpl_vars['k_page']; ?>
</a></td>
<?php endif; ?>
<td class="b_right">&nbsp;</td>
</tr>
</table>