<?php /* Smarty version 2.6.26, created on 2010-11-23 14:41:59
         compiled from input.form.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'passgen', 'input.form.tpl', 15, false),array('modifier', 'size_file', 'input.form.tpl', 22, false),array('modifier', 'input_value_text', 'input.form.tpl', 26, false),array('function', 'html_radios', 'input.form.tpl', 28, false),)), $this); ?>
<div class='forms'>
<table class="form_title">
<tr>
<td><?php echo $this->_tpl_vars['form_title']; ?>
</td>
<?php if ($this->_tpl_vars['cancel']): ?><td class="form_title2" width="16"><a title="Отмена" href="<?php echo $this->_tpl_vars['cancel']; ?>
"><img src="/style/themes/<?php echo $this->_tpl_vars['theme_dir']; ?>
/icons/form_cancel.png" alt="x" /></a></td><?php endif; ?>
</tr>
</table>
<div class="form">
<form<?php if ($this->_tpl_vars['method']): ?> method="<?php echo $this->_tpl_vars['method']; ?>
"<?php endif; ?><?php if ($this->_tpl_vars['action']): ?> action="<?php echo $this->_tpl_vars['action']; ?>
"<?php endif; ?><?php if ($this->_tpl_vars['files']): ?> enctype="multipart/form-data"<?php endif; ?>>
<?php unset($this->_sections['sect']);
$this->_sections['sect']['name'] = 'sect';
$this->_sections['sect']['loop'] = is_array($_loop=$this->_tpl_vars['el']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['sect']['show'] = true;
$this->_sections['sect']['max'] = $this->_sections['sect']['loop'];
$this->_sections['sect']['step'] = 1;
$this->_sections['sect']['start'] = $this->_sections['sect']['step'] > 0 ? 0 : $this->_sections['sect']['loop']-1;
if ($this->_sections['sect']['show']) {
    $this->_sections['sect']['total'] = $this->_sections['sect']['loop'];
    if ($this->_sections['sect']['total'] == 0)
        $this->_sections['sect']['show'] = false;
} else
    $this->_sections['sect']['total'] = 0;
if ($this->_sections['sect']['show']):

            for ($this->_sections['sect']['index'] = $this->_sections['sect']['start'], $this->_sections['sect']['iteration'] = 1;
                 $this->_sections['sect']['iteration'] <= $this->_sections['sect']['total'];
                 $this->_sections['sect']['index'] += $this->_sections['sect']['step'], $this->_sections['sect']['iteration']++):
$this->_sections['sect']['rownum'] = $this->_sections['sect']['iteration'];
$this->_sections['sect']['index_prev'] = $this->_sections['sect']['index'] - $this->_sections['sect']['step'];
$this->_sections['sect']['index_next'] = $this->_sections['sect']['index'] + $this->_sections['sect']['step'];
$this->_sections['sect']['first']      = ($this->_sections['sect']['iteration'] == 1);
$this->_sections['sect']['last']       = ($this->_sections['sect']['iteration'] == $this->_sections['sect']['total']);
?>
<?php if ($this->_tpl_vars['el'][$this->_sections['sect']['index']]['title']): ?><?php echo $this->_tpl_vars['el'][$this->_sections['sect']['index']]['title']; ?>
:<br /><?php endif; ?>
<?php if ($this->_tpl_vars['el'][$this->_sections['sect']['index']]['type'] == 'text'): ?>
<?php echo $this->_tpl_vars['el'][$this->_sections['sect']['index']]['value']; ?>

<?php elseif ($this->_tpl_vars['el'][$this->_sections['sect']['index']]['type'] == 'captcha'): ?>
<img id="captcha" src="/captcha.php?<?php echo ((is_array($_tmp=32)) ? $this->_run_mod_handler('passgen', true, $_tmp) : passgen($_tmp)); ?>
&amp;<?php echo @SID; ?>
" alt="" /><br />
<script><?php echo 'function captcha_reload(){document.getElementById(\'captcha\').src = "/captcha.php?" + Math.random()+"&amp;'; ?>
<?php echo @SID; ?>
<?php echo '";}'; ?>
</script>
<a href="javascript:captcha_reload();">Refresh gambar</a><br />
Masukkan kode sesuai pada gambar:<br /><input type="text" name="chislo" size="5" maxlength="5" />
<?php elseif ($this->_tpl_vars['el'][$this->_sections['sect']['index']]['type'] == 'files_list'): ?>
Lampirkan file:<br />
<?php unset($this->_sections['ff']);
$this->_sections['ff']['name'] = 'ff';
$this->_sections['ff']['loop'] = is_array($_loop=$this->_tpl_vars['el'][$this->_sections['sect']['index']]['files']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
<img src="<?php echo $this->_tpl_vars['el'][$this->_sections['sect']['index']]['files'][$this->_sections['ff']['index']]['icon']; ?>
" alt="" /> <?php echo $this->_tpl_vars['el'][$this->_sections['sect']['index']]['files'][$this->_sections['ff']['index']]['name']; ?>
 (<?php echo ((is_array($_tmp=$this->_tpl_vars['el'][$this->_sections['sect']['index']]['files'][$this->_sections['ff']['index']]['size'])) ? $this->_run_mod_handler('size_file', true, $_tmp) : size_file($_tmp)); ?>
)
<a href='<?php echo $this->_tpl_vars['el'][$this->_sections['sect']['index']]['files'][$this->_sections['ff']['index']]['delete']; ?>
'>[x]</a><br />
<?php endfor; endif; ?>
<?php elseif ($this->_tpl_vars['el'][$this->_sections['sect']['index']]['type'] == 'input_text'): ?>
<input type="text"<?php if ($this->_tpl_vars['el'][$this->_sections['sect']['index']]['info']['size']): ?> size="<?php echo $this->_tpl_vars['el'][$this->_sections['sect']['index']]['info']['size']; ?>
"<?php endif; ?><?php if ($this->_tpl_vars['el'][$this->_sections['sect']['index']]['info']['disabled']): ?> disabled="disabled"<?php endif; ?><?php if ($this->_tpl_vars['el'][$this->_sections['sect']['index']]['info']['name']): ?> name="<?php echo $this->_tpl_vars['el'][$this->_sections['sect']['index']]['info']['name']; ?>
"<?php endif; ?><?php if ($this->_tpl_vars['el'][$this->_sections['sect']['index']]['info']['value']): ?> value="<?php echo input_value_text($this->_tpl_vars['el'][$this->_sections['sect']['index']]['info']['value']); ?>
"<?php endif; ?><?php if ($this->_tpl_vars['el'][$this->_sections['sect']['index']]['info']['maxlength']): ?> maxlength="<?php echo $this->_tpl_vars['el'][$this->_sections['sect']['index']]['info']['maxlength']; ?>
"<?php endif; ?> />
<?php elseif ($this->_tpl_vars['el'][$this->_sections['sect']['index']]['type'] == 'radio'): ?>
<?php echo smarty_function_html_radios(array('name' => $this->_tpl_vars['el'][$this->_sections['sect']['index']]['info']['name'],'values' => $this->_tpl_vars['el'][$this->_sections['sect']['index']]['info']['values'],'output' => $this->_tpl_vars['el'][$this->_sections['sect']['index']]['info']['output'],'selected' => $this->_tpl_vars['el'][$this->_sections['sect']['index']]['info']['selected'],'separator' => "<br />"), $this);?>

<?php elseif ($this->_tpl_vars['el'][$this->_sections['sect']['index']]['type'] == 'hidden'): ?>
<input type="hidden"<?php if ($this->_tpl_vars['el'][$this->_sections['sect']['index']]['info']['name']): ?> name="<?php echo $this->_tpl_vars['el'][$this->_sections['sect']['index']]['info']['name']; ?>
"<?php endif; ?><?php if ($this->_tpl_vars['el'][$this->_sections['sect']['index']]['info']['value']): ?> value="<?php echo input_value_text($this->_tpl_vars['el'][$this->_sections['sect']['index']]['info']['value']); ?>
"<?php endif; ?> />
<?php elseif ($this->_tpl_vars['el'][$this->_sections['sect']['index']]['type'] == 'password'): ?>
<input type="password"<?php if ($this->_tpl_vars['el'][$this->_sections['sect']['index']]['info']['size']): ?> size="<?php echo $this->_tpl_vars['el'][$this->_sections['sect']['index']]['info']['size']; ?>
"<?php endif; ?><?php if ($this->_tpl_vars['el'][$this->_sections['sect']['index']]['info']['name']): ?> name="<?php echo $this->_tpl_vars['el'][$this->_sections['sect']['index']]['info']['name']; ?>
"<?php endif; ?><?php if ($this->_tpl_vars['el'][$this->_sections['sect']['index']]['info']['value']): ?> value="<?php echo input_value_text($this->_tpl_vars['el'][$this->_sections['sect']['index']]['info']['value']); ?>
"<?php endif; ?><?php if ($this->_tpl_vars['el'][$this->_sections['sect']['index']]['info']['maxlength']): ?> maxlength="<?php echo $this->_tpl_vars['el'][$this->_sections['sect']['index']]['info']['maxlength']; ?>
"<?php endif; ?> />
<?php elseif ($this->_tpl_vars['el'][$this->_sections['sect']['index']]['type'] == 'textarea'): ?>
<textarea onkeypress="<?php echo 'if((event.ctrlKey) && ((event.keyCode==10)||(event.keyCode==13))) {this.form.submit();}'; ?>
"<?php if ($this->_tpl_vars['el'][$this->_sections['sect']['index']]['info']['name']): ?> name="<?php echo $this->_tpl_vars['el'][$this->_sections['sect']['index']]['info']['name']; ?>
"<?php endif; ?>><?php if ($this->_tpl_vars['el'][$this->_sections['sect']['index']]['info']['value']): ?><?php echo input_value_text($this->_tpl_vars['el'][$this->_sections['sect']['index']]['info']['value']); ?>
<?php endif; ?></textarea>
<?php elseif ($this->_tpl_vars['el'][$this->_sections['sect']['index']]['type'] == 'checkbox'): ?>
<label><input type="checkbox"<?php if ($this->_tpl_vars['el'][$this->_sections['sect']['index']]['info']['name']): ?> name="<?php echo $this->_tpl_vars['el'][$this->_sections['sect']['index']]['info']['name']; ?>
"<?php endif; ?><?php if ($this->_tpl_vars['el'][$this->_sections['sect']['index']]['info']['value']): ?> value="<?php echo $this->_tpl_vars['el'][$this->_sections['sect']['index']]['info']['value']; ?>
"<?php endif; ?><?php if ($this->_tpl_vars['el'][$this->_sections['sect']['index']]['info']['checked']): ?> checked="checked"<?php endif; ?> /><?php if ($this->_tpl_vars['el'][$this->_sections['sect']['index']]['info']['text']): ?> <?php echo $this->_tpl_vars['el'][$this->_sections['sect']['index']]['info']['text']; ?>
<?php endif; ?></label>
<?php elseif ($this->_tpl_vars['el'][$this->_sections['sect']['index']]['type'] == 'link'): ?>
<a href='<?php echo $this->_tpl_vars['el'][$this->_sections['sect']['index']]['info']['href']; ?>
'><?php echo $this->_tpl_vars['el'][$this->_sections['sect']['index']]['info']['name']; ?>
</a>
<?php elseif ($this->_tpl_vars['el'][$this->_sections['sect']['index']]['type'] == 'submit'): ?>
<input type="submit"<?php if ($this->_tpl_vars['el'][$this->_sections['sect']['index']]['info']['name']): ?> name="<?php echo $this->_tpl_vars['el'][$this->_sections['sect']['index']]['info']['name']; ?>
"<?php endif; ?><?php if ($this->_tpl_vars['el'][$this->_sections['sect']['index']]['info']['value']): ?> value="<?php echo $this->_tpl_vars['el'][$this->_sections['sect']['index']]['info']['value']; ?>
"<?php endif; ?> />
<?php elseif ($this->_tpl_vars['el'][$this->_sections['sect']['index']]['type'] == 'file'): ?>
<input type="file"<?php if ($this->_tpl_vars['el'][$this->_sections['sect']['index']]['info']['name']): ?> name="<?php echo $this->_tpl_vars['el'][$this->_sections['sect']['index']]['info']['name']; ?>
"<?php endif; ?> />
<?php elseif ($this->_tpl_vars['el'][$this->_sections['sect']['index']]['type'] == 'select'): ?>
<select name="<?php echo $this->_tpl_vars['el'][$this->_sections['sect']['index']]['info']['name']; ?>
">
<?php unset($this->_sections['select']);
$this->_sections['select']['name'] = 'select';
$this->_sections['select']['loop'] = is_array($_loop=$this->_tpl_vars['el'][$this->_sections['sect']['index']]['info']['options']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['select']['show'] = true;
$this->_sections['select']['max'] = $this->_sections['select']['loop'];
$this->_sections['select']['step'] = 1;
$this->_sections['select']['start'] = $this->_sections['select']['step'] > 0 ? 0 : $this->_sections['select']['loop']-1;
if ($this->_sections['select']['show']) {
    $this->_sections['select']['total'] = $this->_sections['select']['loop'];
    if ($this->_sections['select']['total'] == 0)
        $this->_sections['select']['show'] = false;
} else
    $this->_sections['select']['total'] = 0;
if ($this->_sections['select']['show']):

            for ($this->_sections['select']['index'] = $this->_sections['select']['start'], $this->_sections['select']['iteration'] = 1;
                 $this->_sections['select']['iteration'] <= $this->_sections['select']['total'];
                 $this->_sections['select']['index'] += $this->_sections['select']['step'], $this->_sections['select']['iteration']++):
$this->_sections['select']['rownum'] = $this->_sections['select']['iteration'];
$this->_sections['select']['index_prev'] = $this->_sections['select']['index'] - $this->_sections['select']['step'];
$this->_sections['select']['index_next'] = $this->_sections['select']['index'] + $this->_sections['select']['step'];
$this->_sections['select']['first']      = ($this->_sections['select']['iteration'] == 1);
$this->_sections['select']['last']       = ($this->_sections['select']['iteration'] == $this->_sections['select']['total']);
?>
<?php if ($this->_tpl_vars['el'][$this->_sections['sect']['index']]['info']['options'][$this->_sections['select']['index']]['groupstart']): ?>
<optgroup label="<?php echo $this->_tpl_vars['el'][$this->_sections['sect']['index']]['info']['options'][$this->_sections['select']['index']]['0']; ?>
">
<?php elseif ($this->_tpl_vars['el'][$this->_sections['sect']['index']]['info']['options'][$this->_sections['select']['index']]['groupend']): ?>
</optgroup>
<?php else: ?>
<option<?php if ($this->_tpl_vars['el'][$this->_sections['sect']['index']]['info']['options'][$this->_sections['select']['index']]['2']): ?> selected="selected"<?php endif; ?> value="<?php echo $this->_tpl_vars['el'][$this->_sections['sect']['index']]['info']['options'][$this->_sections['select']['index']]['0']; ?>
"><?php echo $this->_tpl_vars['el'][$this->_sections['sect']['index']]['info']['options'][$this->_sections['select']['index']]['1']; ?>
</option>
<?php endif; ?>
<?php endfor; endif; ?>
</select>
<?php endif; ?>
<?php if ($this->_tpl_vars['el'][$this->_sections['sect']['index']]['br']): ?>
<br />
<?php endif; ?>
<?php endfor; endif; ?>
</form>
</div>
</div>