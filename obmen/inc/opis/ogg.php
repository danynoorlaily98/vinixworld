<?
echo 'Размер: '.size_file($size)."<br />\n";

$jfile=$name;
$media = mysql_fetch_assoc(mysql_query("SELECT * FROM `media_info` WHERE `file` = '".my_esc($jfile)."' AND `size` = '$size' LIMIT 1"));
if ($media!=NULL)
{
echo 'Время: '.$media['lenght']."<br />\n";
echo "Битрейт: ".$media['bit']." KBPS<br />\n";
}
elseif (class_exists('ffmpeg_movie')){
$media = new ffmpeg_movie($file);

if (intval($media->getDuration())>3599)
echo 'Время: '.intval($media->getDuration()/3600).":".date('s',fmod($media->getDuration()/60,60)).":".date('s',fmod($media->getDuration(),3600))."<br />\n";
elseif (intval($media->getDuration())>59)
echo 'Время: '.intval($media->getDuration()/60).":".date('s',fmod($media->getDuration(),60))."<br />\n";
else
echo 'Время: '.intval($media->getDuration())." сек<br />\n";
echo "Битрейт: ".ceil(($media->getBitRate())/1024)." KBPS<br />\n";



if (intval($media->getDuration())>3599)
mysql_query("INSERT INTO `media_info` (`file`, `size`, `lenght`, `bit`, `codec`) values('".my_esc($jfile)."', '$size', '".intval($media->getDuration()/3600).":".date('s',fmod($media->getDuration()/60,60)).":".date('s',fmod($media->getDuration(),3600))."', '".ceil(($media->getBitRate())/1024)."', 'mp3')");
if (intval($media->getDuration())>59)
mysql_query("INSERT INTO `media_info` (`file`, `size`, `lenght`, `bit`, `codec`) values('".my_esc($jfile)."', '$size', '".intval($media->getDuration()/60).":".date('s',fmod($media->getDuration(),60))."', '".ceil(($media->getBitRate())/1024)."', 'mp3')");
else
mysql_query("INSERT INTO `media_info` (`file`, `size`, `lenght`, `bit`, `codec`) values('".my_esc($jfile)."', '$size', '".intval($media->getDuration())." сек', '".ceil(($media->getBitRate())/1024)."', 'mp3')");

}


$ank=mysql_fetch_assoc(mysql_query("SELECT * FROM `user` WHERE `id` = '$post[id_user]' LIMIT 1"));
echo "Выгрузил: <a href='/info.php?id=$ank[id]'>$ank[nick]</a><br />\n";
?>