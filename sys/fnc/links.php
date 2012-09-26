<?

function img_preg($arr)
{
return '<img src="http://'.$_SERVER['HTTP_HOST'].'/go.php?go='.base64_encode(html_entity_decode($arr[1])).'" alt="img" />';
}

function links_preg1($arr)
{
global $set;

if (ereg('^http://'.$_SERVER['HTTP_HOST'],$arr[1]) || !ereg('://',$arr[1]))
return '<a href="'.$arr[1].'">'.$arr[2].'</a>';
else
return '<a'.($set['web']?' target="_blank"':null).' href="http://'.$_SERVER['HTTP_HOST'].'/go.php?go='.base64_encode(html_entity_decode($arr[1])).'">'.$arr[2].'</a>';

}
function links_preg2($arr)
{
global $set;
if (ereg('^http://'.$_SERVER['HTTP_HOST'],$arr[2]))
return $arr[1].'<a href="'.$arr[2].'">'.$arr[2].'</a>'.$arr[4];
else
if($_SERVER["PHP_SELF"]=="/index.php"){
return $arr[1].'####'.$arr[4];
}
if($_SERVER["PHP_SELF"]=="/home.php"){
return $arr[1].'####'.$arr[4];
}
else
{
return $arr[1].'<a onclick="fun();" '.($set['web']?' target="_blank"':null).' href="http://'.$_SERVER['HTTP_HOST'].'/go.php?go='.base64_encode(html_entity_decode($arr[2])).'">'.$arr[2].'</a>'.$arr[4];
}
}
function links($msg)
{
global $set;
if ($set['bb_img'])$msg=preg_replace_callback('/\[img\](.+)\[\/img\]/isU', 'img_preg', $msg);
if ($set['bb_url'])$msg=preg_replace_callback('/\[url=(.+)\](.+)\[\/url\]/isU', 'links_preg1', $msg);
if ($set['bb_http'])$msg=preg_replace_callback('~(^|\s)([a-z]+://([^ \r\n\t`\'"]+))(\s|$)~iu', 'links_preg2', $msg);
return $msg;
}

//edit by http://indwap.org
?>
