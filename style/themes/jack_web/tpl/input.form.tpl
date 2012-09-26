<div class='forms'>
<table class="form_title">
<tr>
<td>{$form_title}</td>
{if $cancel}<td class="form_title2" width="16"><a title="Отмена" href="{$cancel}"><img src="/style/themes/{$theme_dir}/icons/form_cancel.png" alt="x" /></a></td>{/if}
</tr>
</table>
<div class="form">
<form{if $method} method="{$method}"{/if}{if $action} action="{$action}"{/if}{if $files} enctype="multipart/form-data"{/if}>
{section name=sect loop=$el}
{if $el[sect].title}{$el[sect].title}:<br />{/if}
{if $el[sect].type eq 'text'}
{$el[sect].value}
{elseif $el[sect].type eq 'captcha'}
<img id="captcha" src="/captcha.php?{32|passgen}&amp;{$smarty.const.SID}" alt="" /><br />
<script>{literal}function captcha_reload(){document.getElementById('captcha').src = "/captcha.php?" + Math.random()+"&amp;{/literal}{$smarty.const.SID}{literal}";}{/literal}</script>
<a href="javascript:captcha_reload();">Refresh gambar</a><br />
Masukkan kode sesuai pada gambar:<br /><input type="text" name="chislo" size="5" maxlength="5" />
{elseif $el[sect].type eq 'files_list'}
Lampirkan file:<br />
{section name=ff loop=$el[sect].files}
<img src="{$el[sect].files[ff].icon}" alt="" /> {$el[sect].files[ff].name} ({$el[sect].files[ff].size|size_file})
<a href='{$el[sect].files[ff].delete}'>[x]</a><br />
{/section}
{elseif $el[sect].type eq 'input_text'}
<input type="text"{if $el[sect].info.size} size="{$el[sect].info.size}"{/if}{if $el[sect].info.disabled} disabled="disabled"{/if}{if $el[sect].info.name} name="{$el[sect].info.name}"{/if}{if $el[sect].info.value} value="{$el[sect].info.value|@input_value_text}"{/if}{if $el[sect].info.maxlength} maxlength="{$el[sect].info.maxlength}"{/if} />
{elseif $el[sect].type eq 'radio'}
{html_radios name=$el[sect].info.name values=$el[sect].info.values output=$el[sect].info.output selected=$el[sect].info.selected separator="<br />"}
{elseif $el[sect].type eq 'hidden'}
<input type="hidden"{if $el[sect].info.name} name="{$el[sect].info.name}"{/if}{if $el[sect].info.value} value="{$el[sect].info.value|@input_value_text}"{/if} />
{elseif $el[sect].type eq 'password'}
<input type="password"{if $el[sect].info.size} size="{$el[sect].info.size}"{/if}{if $el[sect].info.name} name="{$el[sect].info.name}"{/if}{if $el[sect].info.value} value="{$el[sect].info.value|@input_value_text}"{/if}{if $el[sect].info.maxlength} maxlength="{$el[sect].info.maxlength}"{/if} />
{elseif $el[sect].type eq 'textarea'}
<textarea onkeypress="{literal}if((event.ctrlKey) && ((event.keyCode==10)||(event.keyCode==13))) {this.form.submit();}{/literal}"{if $el[sect].info.name} name="{$el[sect].info.name}"{/if}>{if $el[sect].info.value}{$el[sect].info.value|@input_value_text}{/if}</textarea>
{elseif $el[sect].type eq 'checkbox'}
<label><input type="checkbox"{if $el[sect].info.name} name="{$el[sect].info.name}"{/if}{if $el[sect].info.value} value="{$el[sect].info.value}"{/if}{if $el[sect].info.checked} checked="checked"{/if} />{if $el[sect].info.text} {$el[sect].info.text}{/if}</label>
{elseif $el[sect].type eq 'link'}
<a href='{$el[sect].info.href}'>{$el[sect].info.name}</a>
{elseif $el[sect].type eq 'submit'}
<input type="submit"{if $el[sect].info.name} name="{$el[sect].info.name}"{/if}{if $el[sect].info.value} value="{$el[sect].info.value}"{/if} />
{elseif $el[sect].type eq 'file'}
<input type="file"{if $el[sect].info.name} name="{$el[sect].info.name}"{/if} />
{elseif $el[sect].type eq 'select'}
<select name="{$el[sect].info.name}">
{section name=select loop=$el[sect].info.options}
{if $el[sect].info.options[select].groupstart}
<optgroup label="{$el[sect].info.options[select].0}">
{elseif $el[sect].info.options[select].groupend}
</optgroup>
{else}
<option{if $el[sect].info.options[select].2} selected="selected"{/if} value="{$el[sect].info.options[select].0}">{$el[sect].info.options[select].1}</option>
{/if}
{/section}
</select>
{/if}
{if $el[sect].br}
<br />
{/if}
{/section}
</form>
</div>
</div>
