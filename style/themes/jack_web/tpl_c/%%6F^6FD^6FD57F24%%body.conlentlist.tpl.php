<?php /* Smarty version 2.6.26, created on 2010-11-23 10:11:25
         compiled from body.conlentlist.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'vremja', 'body.conlentlist.tpl', 26, false),array('modifier', 'output_text', 'body.conlentlist.tpl', 26, false),array('modifier', 'size_file', 'body.conlentlist.tpl', 43, false),array('modifier', 'intval', 'body.conlentlist.tpl', 46, false),)), $this); ?>
<div class='contentlist'>
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
<div class="post_item<?php if ($this->_tpl_vars['post'][$this->_sections['i']['index']]['new']): ?>_new<?php endif; ?>">
<?php if ($this->_tpl_vars['post'][$this->_sections['i']['index']]['link_block']): ?><a href="<?php echo $this->_tpl_vars['post'][$this->_sections['i']['index']]['link_block']; ?>
" class="block"><?php endif; ?>
<table class="post_msg" cellspacing="0" callpadding="0">
<?php if ($this->_tpl_vars['post'][$this->_sections['i']['index']]['icon']['size'] == 'big'): ?>
<tr>
<td width="50" rowspan="3"><img src="<?php echo $this->_tpl_vars['post'][$this->_sections['i']['index']]['icon']['src']; ?>
" alt="" /></td><td width="100%">
<?php echo $this->_tpl_vars['post'][$this->_sections['i']['index']]['title']; ?>

<?php elseif ($this->_tpl_vars['post'][$this->_sections['i']['index']]['icon']['size'] == 'small'): ?>
<tr class="post_title"><td width="100%">
<img src="<?php echo $this->_tpl_vars['post'][$this->_sections['i']['index']]['icon']['src']; ?>
" alt="" />
<?php echo $this->_tpl_vars['post'][$this->_sections['i']['index']]['title']; ?>

<?php else: ?>
<tr class="post_title"><td><?php echo $this->_tpl_vars['post'][$this->_sections['i']['index']]['title']; ?>

<?php endif; ?>
</td>
<?php if ($this->_tpl_vars['post'][$this->_sections['i']['index']]['link_cit']): ?><td class='content_act'><a title="Kutip" href="<?php echo $this->_tpl_vars['post'][$this->_sections['i']['index']]['link_cit']; ?>
"><img src="/style/themes/<?php echo $this->_tpl_vars['theme_dir']; ?>
/icons/contentlist_cit.png" alt="Kutip" /></a></td><?php endif; ?>
<?php if ($this->_tpl_vars['post'][$this->_sections['i']['index']]['link_edit']): ?><td class='content_act'><a title="Edit" href="<?php echo $this->_tpl_vars['post'][$this->_sections['i']['index']]['link_edit']; ?>
"><img src="/style/themes/<?php echo $this->_tpl_vars['theme_dir']; ?>
/icons/contentlist_edit.png" alt="Edit" /></a></td><?php endif; ?>
<?php if ($this->_tpl_vars['post'][$this->_sections['i']['index']]['delete']): ?><td class='content_act'><a title="Hapus" href="<?php echo $this->_tpl_vars['post'][$this->_sections['i']['index']]['delete']; ?>
"><img src="/style/themes/<?php echo $this->_tpl_vars['theme_dir']; ?>
/icons/contentlist_delete.png" alt="Hapus" /></a></td><?php endif; ?>

</tr>
<?php if ($this->_tpl_vars['post'][$this->_sections['i']['index']]['cit']): ?>
<tr>
<td colspan="5" class="quote">
<span class="quote_title"><?php echo $this->_tpl_vars['post'][$this->_sections['i']['index']]['cit']['nick']; ?>
 (<?php echo ((is_array($_tmp=$this->_tpl_vars['post'][$this->_sections['i']['index']]['cit']['time'])) ? $this->_run_mod_handler('vremja', true, $_tmp) : vremja($_tmp)); ?>
)</span>: <span class="quote_msg"><?php echo ((is_array($_tmp=$this->_tpl_vars['post'][$this->_sections['i']['index']]['cit']['msg'])) ? $this->_run_mod_handler('output_text', true, $_tmp) : output_text($_tmp)); ?>
</span>
</td>
</tr>
<?php endif; ?>
<?php if ($this->_tpl_vars['post'][$this->_sections['i']['index']]['post']): ?>
<tr class="post_msg">
<td colspan="5"><?php echo $this->_tpl_vars['post'][$this->_sections['i']['index']]['post']; ?>
 <?php if ($this->_tpl_vars['post'][$this->_sections['i']['index']]['link_edit'] || $this->_tpl_vars['post'][$this->_sections['i']['index']]['link_cit']): ?><br /><?php endif; ?>
</td>
</tr>
<?php endif; ?>
</table>
<?php if ($this->_tpl_vars['post'][$this->_sections['i']['index']]['files']): ?>
Lampirkan file:<br />
<table class="post_files">
<?php unset($this->_sections['ff']);
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
<a title="File berguna" href="<?php echo $this->_tpl_vars['post'][$this->_sections['i']['index']]['files'][$this->_sections['ff']['index']]['rating_up']; ?>
">[+]</a><?php endif; ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['post'][$this->_sections['i']['index']]['files'][$this->_sections['ff']['index']]['summ_vote'])) ? $this->_run_mod_handler('intval', true, $_tmp) : intval($_tmp)); ?>
/<?php echo $this->_tpl_vars['post'][$this->_sections['i']['index']]['files'][$this->_sections['ff']['index']]['k_vote']; ?>

<?php if ($this->_tpl_vars['post'][$this->_sections['i']['index']]['files'][$this->_sections['ff']['index']]['rating_down']): ?>
<a title="File tak berguna" href="<?php echo $this->_tpl_vars['post'][$this->_sections['i']['index']]['files'][$this->_sections['ff']['index']]['rating_down']; ?>
">[-]</a><?php endif; ?></td>
<?php if ($this->_tpl_vars['post'][$this->_sections['i']['index']]['files'][$this->_sections['ff']['index']]['link_delete']): ?><td>
<a title="Hapus file" href="<?php echo $this->_tpl_vars['post'][$this->_sections['i']['index']]['files'][$this->_sections['ff']['index']]['link_delete']; ?>
">[x]</a></td>
<?php endif; ?>
</tr>
<?php endfor; endif; ?>
</table>
<?php endif; ?>
<?php if ($this->_tpl_vars['post'][$this->_sections['i']['index']]['link_block']): ?></a><?php endif; ?>
</div>
<?php endfor; endif; ?>
</div>