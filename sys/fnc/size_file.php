<?
function size_file($filesize=0)
{
$filesize_ed='B';
if ($filesize>=1024){$filesize= round($filesize/1024 , 2);$filesize_ed='KB';}
if ($filesize>=1024){$filesize= round($filesize/1024 , 2);$filesize_ed='MB';}
if ($filesize>=1024){$filesize= round($filesize/1024 , 2);$filesize_ed='GB';}
if ($filesize>=1024){$filesize= round($filesize/1024 , 2);$filesize_ed='TB';}
return $filesize.$filesize_ed;
}
?>