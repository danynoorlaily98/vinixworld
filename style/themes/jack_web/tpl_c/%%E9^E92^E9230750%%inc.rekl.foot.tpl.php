<?php /* Smarty version 2.6.26, created on 2010-07-27 03:39:15
         compiled from inc.rekl.foot.tpl */ ?>
<table class="rekl_foot">
<tr>
<?php unset($this->_sections['adv']);
$this->_sections['adv']['name'] = 'adv';
$this->_sections['adv']['loop'] = is_array($_loop=$this->_tpl_vars['adv_title']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['adv']['show'] = true;
$this->_sections['adv']['max'] = $this->_sections['adv']['loop'];
$this->_sections['adv']['step'] = 1;
$this->_sections['adv']['start'] = $this->_sections['adv']['step'] > 0 ? 0 : $this->_sections['adv']['loop']-1;
if ($this->_sections['adv']['show']) {
    $this->_sections['adv']['total'] = $this->_sections['adv']['loop'];
    if ($this->_sections['adv']['total'] == 0)
        $this->_sections['adv']['show'] = false;
} else
    $this->_sections['adv']['total'] = 0;
if ($this->_sections['adv']['show']):

            for ($this->_sections['adv']['index'] = $this->_sections['adv']['start'], $this->_sections['adv']['iteration'] = 1;
                 $this->_sections['adv']['iteration'] <= $this->_sections['adv']['total'];
                 $this->_sections['adv']['index'] += $this->_sections['adv']['step'], $this->_sections['adv']['iteration']++):
$this->_sections['adv']['rownum'] = $this->_sections['adv']['iteration'];
$this->_sections['adv']['index_prev'] = $this->_sections['adv']['index'] - $this->_sections['adv']['step'];
$this->_sections['adv']['index_next'] = $this->_sections['adv']['index'] + $this->_sections['adv']['step'];
$this->_sections['adv']['first']      = ($this->_sections['adv']['iteration'] == 1);
$this->_sections['adv']['last']       = ($this->_sections['adv']['iteration'] == $this->_sections['adv']['total']);
?>
<td><a target="_blank" href="<?php echo $this->_tpl_vars['adv_title'][$this->_sections['adv']['index']]['link']; ?>
">
<?php if ($this->_tpl_vars['adv_title'][$this->_sections['adv']['index']]['img']): ?>
<img src="<?php echo $this->_tpl_vars['adv_title'][$this->_sections['adv']['index']]['img']; ?>
" alt="<?php echo $this->_tpl_vars['adv_title'][$this->_sections['adv']['index']]['name']; ?>
">
<?php else: ?>
<?php echo $this->_tpl_vars['adv_title'][$this->_sections['adv']['index']]['name']; ?>

<?php endif; ?>
</a></td>
<?php endfor; endif; ?>
</tr>
</table>