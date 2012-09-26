<?

// remodified by noe
// http://nnetwork.tk
// loegue.info@gmail.com
// hargailah privasi orang

function bbcodehightlight($arr)
{
$arr[0]=html_entity_decode($arr[0], ENT_QUOTES, 'UTF-8');
return '<div class="cit" style="overflow:scroll;clip:auto;max-width:480px;">'.preg_replace('#<code>(.*?)</code>#si', '\\1' ,highlight_string($arr[0],1)).'</div>'."\n";
}



function BBcode($msg)
{
$bbcode = array(
'/\[i\](.+)\[\/i\]/isU' => '<em>$1</em>',
'/\[b\](.+)\[\/b\]/isU' => '<strong>$1</strong>',
'/\[u\](.+)\[\/u\]/isU' => '<span style="text-decoration:underline;">$1</span>',
'/\[ut\](.+)\[\/ut\]/isU' => '<span style="border-bottom: 1px dotted;">$1</span>',
'/\[xx-small\](.+)\[\/xx-small\]/isU' => '<span style="font-size:xx-small;">$1</span>',
'/\[x-small\](.+)\[\/x-small\]/isU' => '<span style="font-size:x-small;">$1</span>',
'/\[in\](.+)\[\/in\]/isU' => '<input type="text" value="$1" />',
'/\[das\](.+)\[\/das\]/isU' => '<span style="border:1px dashed;">$1</span>',
'/\[marq\](.+)\[\/marq\]/isU' => '<marquee>$1</marquee>',
'/\[c\](.+)\[\/c\]/isU' => '<center>$1</center>',
'/\[sol\](.+)\[\/sol\]/isU' => '<span style="border:1px solid;">$1</span>',
'/\[ex\](.+)\[\/ex\]/isU' => '<span style="text-decoration:line-through;">$1</span>',
'/\[up\](.+)\[\/up\]/isU' => '<span style="text-decoration:overline;">$1</span>',
'/\[bl\](.+)\[\/bl\]/isU' => '<span style="text-decoration:blink;">$1</span>',
'/\[dot\](.+)\[\/dot\]/isU' => '<span style="border:1px dotted;">$1</span>',
'/\[scr-w\](.+)\[\/scr-w\]/isU' => '<span style="background-color:#ffffff;"><span style="color:#ffffff;"><span style="border:1px dashed;">$1</span></span></span>',
'/\[scr-b\](.+)\[\/scr-b\]/isU' => '<span style="background-color:#000000;"><span style="color:#000000;"><span style="border:1px dashed;">$1</span></span></span>',
'/\[dou\](.+)\[\/dou\]/isU' => '<span style="border:3px double #E1E1E4;">$1</span>',
'/\[dou\](.+)\[\/dou\]/isU' => '<span style="border:3px double #E1E1E4;">$1</span>',
'/\[big\](.+)\[\/big\]/isU' => '<span style="font-size:large;">$1</span>',
'/\[small\](.+)\[\/small\]/isU' => '<span style="font-size:small;">$1</span>',
'/\[code\](.+)\[\/code\]/isU' => '<code>$1</code>',
'/\[f=([0-9]+)\/([0-9]+)\/([0-9]+)\](.+)\[\/f\]/isU' => "<a href='/forum/$1/$2/$3'>$4</a>",
'/\[u=([0-9]+)\](.+)\[\/u\]/isU' => "<a href='/info.php?id=$1'>$2</a>",
'/\[red\](.+)\[\/red\]/isU' => '<span style="color:#ff0000;">$1</span>',
'/\[time\](.+)\[\/time\]/isU' => '<span style="color:#808080;">$1</span>',
'/\[wtw\](.+)\[\/wtw\]/isU' => '<span style="color:#343434;">$1</span>',
'/\[yellow\](.+)\[\/yellow\]/isU' => '<span style="color:#ffff22;">$1</span>',
'/\[green\](.+)\[\/green\]/isU' => '<span style="color:#00bb00;">$1</span>',
'/\[blue\](.+)\[\/blue\]/isU' => '<span style="color:#0000bb;">$1</span>',
'/\[nome\](.+)\[\/nome\]/isU' => '<div style="border-left:2px solid #ccc;padding-left:4px;margin-top:2px;font-size:small;">$1</div>',
'/\[white\](.+)\[\/white\]/isU' => '<span style="color:#ffffff;">$1</span>',
'/\[size=([0-9]+)\](.+)\[\/size\]/isU' => '<span style="font-size:$1px;">$2</span>',
'/\[img\](.+)\[\/img\]/isU' => '<img src="$1" alt="" />'
);

if ( preg_match ( "#@([a-zA-Z0-9]+)#i",$msg ) )
{
	$res = mysql_fetch_array ( mysql_query ( "SELECT nick FROM user WHERE nick='". mysql_real_escape_string ( $match [ 1 ] ) ."'" ) );
	if ( $res [ 'nick' ] > 0 )
	{
		$msg = preg_replace ( "#@([a-zA-Z0-9]+)#i", "<a href=\"info.php?id=". $res [ 'user_id' ] ."&amp;sid=$sid\">\\2</a>", $text );
	}
}else{
$msg= preg_replace(array_keys($bbcode), array_values($bbcode), $msg);


$msg=preg_replace_callback('#&lt;\?(.*?)\?&gt;#sui', 'bbcodehightlight', $msg);
$msg=preg_replace('#\[code\](.*?)\[/code\]#si', '\1', $msg);
}
return $msg;
}
function lic_dcms_loc() // получение локальной лицензии
{
$return=false;
$od_lic=opendir(H.'sys/license/');
while ($rd_lic=readdir($od_lic))
{
if (eregi(str_replace('.', '\.', $rd_lic).'$',$_SERVER['HTTP_HOST']))
{
if ($license=@unserialize(@file_get_contents(H.'sys/license/'.$rd_lic)))
{
if (isset($license['url']) && eregi(str_replace('.', '\.', $license['url']).'$',$_SERVER['HTTP_HOST']))
{
if ($license['last_time']<time()-604800 || $license['last_time']<$license['last_update']-604800)
{
@unlink(H.'sys/license/'.$rd_lic);
}
else
{
$return=$license;
}
break;
}
else
{
@unlink(H.'sys/license/'.$rd_lic);
}
}
}
}
return $return;
closedir($od_lic);
}

function copyright2($copyright){
return eregi_replace("</div>(\n|\r)*</body>", "<div style='font-size:small;'>&copy; <a href=\"http://dcms.su\">DCMS</a> | <a href=\"http://noestudio.tk\">noestudio</a> | <a href=\"http://api.idhostinger.com/redir/75140\">IdHostinger</a><br/>\n</div>\n</div>\n</body>", $copyright);
}

function lic_dcms($send=null)
{
global $set,$license;
if ($sock=@fsockopen($set['http_license'], 80, $err_no, $err_str, 7))
{
$data_out['host']=$_SERVER['HTTP_HOST']; // адрес сайта
$data_out['ver']=$set['dcms_version']; // версия движка
$data_out['data']=$send; // отправляемые данные


// ключег
if ($license)
{
$data_out['key']=$license['key'];
$data_out['last_time']=$license['last_time'];
}
else
{
$data_out['tmp_key']=md5(passgen());
@file_put_contents(H.'sys/tmp/tmp_key.dat', $data_out['tmp_key']);
@chmod(H.'sys/tmp/tmp_key.dat', 0777);
}

$post_value='data='.serialize($data_out);
$s_head="POST /dcms/license.dcms HTTP/1.0\r\n";
$s_head.="Host: $set[http_license]\r\n";
$s_head.="User-Agent: DCMS/$set[dcms_version]\r\n";
//$s_head.="Keep-Alive: 300\r\n";
$s_head.="Connection: close\r\n";
$s_head .= "Content-Type: application/x-www-form-urlencoded\r\n";
$s_head .= "Content-Length: ".strlen($post_value)."\r\n\r\n";
$s_head .= $post_value;

fwrite($sock, $s_head); // отправка данных

$buffer=null;while (!feof($sock)){$buffer .= fgets($sock);} // прием данных
fclose($sock);


list($header,$content)=explode("\r\n\r\n", $buffer); // разборка данных

$data_in=@unserialize($content);

// информация о лицензии
if (isset($data_in['lic_info']))
{
$data_in['lic_info']['last_update']=time();
@unlink(H.'sys/license/'.$data_in['lic_info']['url']);
@file_put_contents(H.'sys/license/'.$data_in['lic_info']['url'], serialize($data_in['lic_info']));
@chmod(H.'sys/license/'.$data_in['lic_info']['url'], 0777);
$license=$data_in['lic_info'];
}
else $license=false;


// список новых версий
if (isset($data_in['new_ver']))
{
mysql_query('TRUNCATE TABLE `license_list_ver`');
mysql_query('TRUNCATE TABLE `license_list_changelog`');
$new_ver=$data_in['new_ver'];
for ($i=0;$i<count($new_ver);$i++)
{
mysql_query("INSERT INTO `license_list_ver` (`id`, `ver_1`, `ver_2`, `ver_3`, `delete`, `sql`)
VALUES ('".$new_ver[$i]['id']."', '".$new_ver[$i]['ver_1']."', '".$new_ver[$i]['ver_2']."', '".$new_ver[$i]['ver_3']."','".my_esc($new_ver[$i]['delete'])."','".my_esc($new_ver[$i]['sql'])."')");
for ($z=0;(isset($new_ver[$i]['changelog']) && $z<count($new_ver[$i]['changelog']) );$z++)
{
mysql_query("INSERT INTO `license_list_changelog` (`text`, `ver_1`, `ver_2`, `ver_3`) VALUES ('".my_esc($new_ver[$i]['changelog'][$z])."', '".$new_ver[$i]['ver_1']."','".$new_ver[$i]['ver_2']."','".$new_ver[$i]['ver_3']."')");
}
}
}

// запрашиваемые занные
if (isset($data_in['data']))return $data_in['data'];else return false;
}
elseif($license!==false)
{
$license['last_update']=time();
@unlink(H.'sys/license/'.$data_in['lic_info']['url']);
@file_put_contents(H.'sys/license/'.$data_in['lic_info']['url'], serialize($license));
}
else return false;
}


$license=lic_dcms_loc(); // получение локальной лицензии

if (!isset($nolicupdate)){
if (isset($license['last_update']) && $license['last_update']<time()-60*60*6)
lic_dcms(); // обновление сведений раз в 6 часов
}
if (isset($compress) && $license==false)ob_start ("copyright2");
?>
