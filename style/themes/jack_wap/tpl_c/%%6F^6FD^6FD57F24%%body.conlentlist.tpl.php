<?php /* Smarty version 2.6.26, created on 2010-10-22 12:48:57
         compiled from body.conlentlist.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'vremja', 'body.conlentlist.tpl', 24, false),array('modifier', 'output_text', 'body.conlentlist.tpl', 24, false),array('modifier', 'size_file', 'body.conlentlist.tpl', 47, false),array('modifier', 'intval', 'body.conlentlist.tpl', 50, false),)), $this); ?>
<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['post']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['i']['show'] = true;
$this->_sections['i']['max'] = $this->_sections['i']['loop'];
$this->_sections['i']['step'] = 1;
$this->_sections['i']['start'] = $this->_sections['i']['step'] > 0 ? 0 : $this->_sections['i']['loop']-1;
if ($this->_sections['i']['show']) {
    $this->_sections['i']['total'] = $this->_sections['i']['loop'];
    if ($this->_sections['i']['total'] == 0)
        $this->_sections['i']['show'] = false;
} else
    $this->_sections['i']['total'] = 0;
if ($this->_sections['i']['show']):

            for ($this->_sections['i']['index'] = $this->_sections['i']['start'], $this->_sections['i']['iteration'] = 1;
                 $this->_sections['i']['iteration'] <= $this->_sections['i']['total'];
                 $this->_sections['i']['index'] += $this->_sections['i']['step'], $this->_sections['i']['iteration']++):
$this->_sections['i']['rownum'] = $this->_sections['i']['iteration'];
$this->_sections['i']['index_prev'] = $this->_sections['i']['index'] - $this->_sections['i']['step'];
$this->_sections['i']['index_next'] = $this->_sections['i']['index'] + $this->_sections['i']['step'];
$this->_sections['i']['first']      = ($this->_sections['i']['iteration'] == 1);
$this->_sections['i']['last']       = ($this->_sections['i']['iteration'] == $this->_sections['i']['total']);
?>
<div class="post<?php if (!(1 & $this->_sections['i']['iteration'])): ?>0<?php else: ?>1<?php endif; ?>">
<div class="post_msg"><table>
<?php if ($this->_tpl_vars['post'][$this->_sections['i']['index']]['icon']['size'] == 'big'): ?>
<tr>
<td rowspan="3"><img src="<?php echo $this->_tpl_vars['post'][$this->_sections['i']['index']]['icon']['src']; ?>
" alt="" /></td><td>
<?php echo $this->_tpl_vars['post'][$this->_sections['i']['index']]['title']; ?>
 <?php if ($this->_tpl_vars['post'][$this->_sections['i']['index']]['new']): ?><span class="on">new</span><?php endif; ?>
<?php elseif ($this->_tpl_vars['post'][$this->_sections['i']['index']]['icon']['size'] == 'small'): ?>
<div class="post_title"><tr><td>
<img src="<?php echo $this->_tpl_vars['post'][$this->_sections['i']['index']]['icon']['src']; ?>
" alt="" />
<?php echo $this->_tpl_vars['post'][$this->_sections['i']['index']]['title']; ?>
 <?php if ($this->_tpl_vars['post'][$this->_sections['i']['index']]['new']): ?><span class="on">new</span><?php endif; ?>
<?php else: ?>
<div class="post_title"><tr><td><?php echo $this->_tpl_vars['post'][$this->_sections['i']['index']]['title']; ?>
 <?php if ($this->_tpl_vars['post'][$this->_sections['i']['index']]['new']): ?><span class="on">new</span><?php endif; ?>
<?php endif; ?>
<?php if ($this->_tpl_vars['post'][$this->_sections['i']['index']]['delete']): ?>
<a href="<?php echo $this->_tpl_vars['post'][$this->_sections['i']['index']]['delete']; ?>
">[x]</a>
<?php endif; ?>
</td>
</tr>
</div>
<?php if ($this->_tpl_vars['post'][$this->_sections['i']['index']]['cit']): ?>
<tr><td>
<div class='quote'>
<span><?php echo $this->_tpl_vars['post'][$this->_sections['i']['index']]['cit']['nick']; ?>
 (<?php echo ((is_array($_tmp=$this->_tpl_vars['post'][$this->_sections['i']['index']]['cit']['time'])) ? $this->_run_mod_handler('vremja', true, $_tmp) : vremja($_tmp)); ?>
)</span><br /><?php echo ((is_array($_tmp=$this->_tpl_vars['post'][$this->_sections['i']['index']]['cit']['msg'])) ? $this->_run_mod_handler('output_text', true, $_tmp) : output_text($_tmp)); ?>

</div></td>
</tr>
<?php endif; ?>
<?php if ($this->_tpl_vars['post'][$this->_sections['i']['index']]['post']): ?>
<div class="post_msg"><tr>
<td><?php echo $this->_tpl_vars['post'][$this->_sections['i']['index']]['post']; ?>
 <?php if ($this->_tpl_vars['post'][$this->_sections['i']['index']]['link_edit'] || $this->_tpl_vars['post'][$this->_sections['i']['index']]['link_cit']): ?><br /><?php endif; ?>
<?php if ($this->_tpl_vars['post'][$this->_sections['i']['index']]['link_edit']): ?>
<a title="Edit" href="<?php echo $this->_tpl_vars['post'][$this->_sections['i']['index']]['link_edit']; ?>
">[-Edit-]</a>
<?php endif; ?>
<?php if ($this->_tpl_vars['post'][$this->_sections['i']['index']]['link_cit']): ?>
<a title="Quote" href="<?php echo $this->_tpl_vars['post'][$this->_sections['i']['index']]['link_cit']; ?>
">[-Quote-]</a>
<?php endif; ?>
</td>
</tr>
<?php endif; ?>
</div></table>
</div><?php if ($this->_tpl_vars['post'][$this->_sections['i']['index']]['files']): ?>
File:<br />
<div class="post_files">
<table><?php unset($this->_sections['ff']);
$this->_sections['ff']['name'] = 'ff';
$this->_sections['ff']['loop'] = is_array($_loop=$this->_tpl_vars['post'][$this->_sections['i']['index']]['files']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['ff']['show'] = true;
$this->_sections['ff']['max'] = $this->_sections['ff']['loop'];
$this->_sections['ff']['step'] = 1;
$this->_sections['ff']['start'] = $this->_sections['ff']['step'] > 0 ? 0 : $this->_sections['ff']['loop']-1;
if ($this->_sections['ff']['show']) {
    $this->_sections['ff']['total'] = $this->_sections['ff']['loop'];
    if ($this->_sections['ff']['total'] == 0)
        $this->_sections['ff']['show'] = false;
} else
    $this->_sections['ff']['total'] = 0;
if ($this->_sections['ff']['show']):

            for ($this->_sections['ff']['index'] = $this->_sections['ff']['start'], $this->_sections['ff']['iteration'] = 1;
                 $this->_sections['ff']['iteration'] <= $this->_sections['ff']['total'];
                 $this->_sections['ff']['index'] += $this->_sections['ff']['step'], $this->_sections['ff']['iteration']++):
$this->_sections['ff']['rownum'] = $this->_sections['ff']['iteration'];
$this->_sections['ff']['index_prev'] = $this->_sections['ff']['index'] - $this->_sections['ff']['step'];
$this->_sections['ff']['index_next'] = $this->_sections['ff']['index'] + $this->_sections['ff']['step'];
$this->_sections['ff']['first']      = ($this->_sections['ff']['iteration'] == 1);
$this->_sections['ff']['last']       = ($this->_sections['ff']['iteration'] == $this->_sections['ff']['total']);
?>
<tr><td>
<img src="<?php echo $this->_tpl_vars['post'][$this->_sections['i']['index']]['files'][$this->_sections['ff']['index']]['icon']; ?>
" alt="" /></td><td>
<a href="<?php echo $this->_tpl_vars['post'][$this->_sections['i']['index']]['files'][$this->_sections['ff']['index']]['link_down']; ?>
"><?php echo $this->_tpl_vars['post'][$this->_sections['i']['index']]['files'][$this->_sections['ff']['index']]['name']; ?>
</a></td><td><?php echo ((is_array($_tmp=$this->_tpl_vars['post'][$this->_sections['i']['index']]['files'][$this->_sections['ff']['index']]['size'])) ? $this->_run_mod_handler('size_file', true, $_tmp) : size_file($_tmp)); ?>
</td><td>
<?php if ($this->_tpl_vars['post'][$this->_sections['i']['index']]['files'][$this->_sections['ff']['index']]['rating_up']): ?>
<a title="Rating" href="<?php echo $this->_tpl_vars['post'][$this->_sections['i']['index']]['files'][$this->_sections['ff']['index']]['rating_up']; ?>
">[+]</a><?php endif; ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['post'][$this->_sections['i']['index']]['files'][$this->_sections['ff']['index']]['summ_vote'])) ? $this->_run_mod_handler('intval', true, $_tmp) : intval($_tmp)); ?>
/<?php echo $this->_tpl_vars['post'][$this->_sections['i']['index']]['files'][$this->_sections['ff']['index']]['k_vote']; ?>

<?php if ($this->_tpl_vars['post'][$this->_sections['i']['index']]['files'][$this->_sections['ff']['index']]['rating_down']): ?>
<a title="Rating" href="<?php echo $this->_tpl_vars['post'][$this->_sections['i']['index']]['files'][$this->_sections['ff']['index']]['rating_down']; ?>
">[-]</a><?php endif; ?></td>
<?php if ($this->_tpl_vars['post'][$this->_sections['i']['index']]['files'][$this->_sections['ff']['index']]['link_delete']): ?><td>
<a title="Hapus file" href="<?php echo $this->_tpl_vars['post'][$this->_sections['i']['index']]['files'][$this->_sections['ff']['index']]['link_delete']; ?>
">[x]</a></td>
<?php endif; ?>
</tr>
<?php endfor; endif; ?>
</table>
</div><?php endif; ?>
</div>
<?php endfor; endif; ?>