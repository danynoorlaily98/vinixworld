<?php /* Smarty version 2.6.26, created on 2010-12-27 05:56:04
         compiled from page.pagelisting.tpl */ ?>
<div class="pages">
<?php if (user_access ( 'user_prof_edit' )): ?>
<?php if ($this->_tpl_vars['page'] > 1): ?><a href="<?php echo $this->_tpl_vars['link']; ?>
page=<?php echo $this->_tpl_vars['page']-1; ?>
" accesskey="7">&laquo; Kembali [7]</a><?php else: ?>&laquo; Kembali [7]<?php endif; ?> | <?php if ($this->_tpl_vars['page'] < $this->_tpl_vars['k_page']): ?><a href="<?php echo $this->_tpl_vars['link']; ?>
page=<?php echo $this->_tpl_vars['page']+1; ?>
" accesskey="9">[9] Lanjut &raquo;</a><?php else: ?>[9] Lanjut &raquo;<?php endif; ?>
<br />
Page.:
<?php if ($this->_tpl_vars['page'] == 1): ?>
<span>1</span>
<?php else: ?>
<a href="<?php echo $this->_tpl_vars['link']; ?>
page=1">1</a>
<?php endif; ?>
<?php if ($this->_tpl_vars['page'] > 4): ?>
..
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
<span><?php echo $this->_sections['page']['iteration']; ?>
</span>
<?php else: ?>
<a href="<?php echo $this->_tpl_vars['link']; ?>
page=<?php echo $this->_sections['page']['iteration']; ?>
"><?php echo $this->_sections['page']['iteration']; ?>
</a>
<?php endif; ?>
<?php endif; ?>
<?php endfor; endif; ?>
<?php if ($this->_tpl_vars['page'] < $this->_tpl_vars['k_page']-4): ?>
..
<?php endif; ?>
<?php if ($this->_tpl_vars['page'] == $this->_tpl_vars['k_page']): ?>
<span><?php echo $this->_tpl_vars['k_page']; ?>
</span>
<?php else: ?>
<a href="<?php echo $this->_tpl_vars['link']; ?>
page=<?php echo $this->_tpl_vars['k_page']; ?>
"><?php echo $this->_tpl_vars['k_page']; ?>
</a>
<?php endif; ?>
<?php else: ?>
<?php if ($this->_tpl_vars['page'] > 1): ?><a onclick="fun();" href="<?php echo $this->_tpl_vars['link']; ?>
page=<?php echo $this->_tpl_vars['page']-1; ?>
" accesskey="7">&laquo; Kembali [7]</a><?php else: ?>&laquo; Kembali [7]<?php endif; ?> | <?php if ($this->_tpl_vars['page'] < $this->_tpl_vars['k_page']): ?><a onclick="fun();" href="<?php echo $this->_tpl_vars['link']; ?>
page=<?php echo $this->_tpl_vars['page']+1; ?>
" accesskey="9">[9] Lanjut &raquo;</a><?php else: ?>[9] Lanjut &raquo;<?php endif; ?>
<br />
Page.:
<?php if ($this->_tpl_vars['page'] == 1): ?>
<span>1</span>
<?php else: ?>
<a href="<?php echo $this->_tpl_vars['link']; ?>
page=1">1</a>
<?php endif; ?>
<?php if ($this->_tpl_vars['page'] > 4): ?>
..
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
<span><?php echo $this->_sections['page']['iteration']; ?>
</span>
<?php else: ?>
<a href="<?php echo $this->_tpl_vars['link']; ?>
page=<?php echo $this->_sections['page']['iteration']; ?>
"><?php echo $this->_sections['page']['iteration']; ?>
</a>
<?php endif; ?>
<?php endif; ?>
<?php endfor; endif; ?>
<?php if ($this->_tpl_vars['page'] < $this->_tpl_vars['k_page']-4): ?>
..
<?php endif; ?>
<?php if ($this->_tpl_vars['page'] == $this->_tpl_vars['k_page']): ?>
<span><?php echo $this->_tpl_vars['k_page']; ?>
</span>
<?php else: ?>
<a href="<?php echo $this->_tpl_vars['link']; ?>
page=<?php echo $this->_tpl_vars['k_page']; ?>
"><?php echo $this->_tpl_vars['k_page']; ?>
</a>
<?php endif; ?>
<?php endif; ?>
</div>