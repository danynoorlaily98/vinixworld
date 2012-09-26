<?
function file_new($file=NULL)
{
global $set;
if (is_file($file) && filectime($file)>time()-60*60)
return ' <span class="off"><b> new!!!</b></span>';
elseif (is_file($file) && filectime($file)>time()-60*60*$set['loads_new_file_hour'])
return ' <span class="off"> new</span>';
}

?>