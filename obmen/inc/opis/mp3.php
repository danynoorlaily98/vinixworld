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
else
{
include_once H.'sys/inc/mp3.php';
$id3 = new MP3_Id(); 
  $result = $id3->read($file); 
  $result = $id3->study();
if(($id3->getTag('length')<>0)){echo 'Время: '.$id3->getTag('length')."<br />\n";}
if(($id3->getTag('bitrate'))<>0){echo'Битрейт: '.$id3->getTag('bitrate')." KBPS<br />\n";}
mysql_query("INSERT INTO `media_info` (`file`, `size`, `lenght`, `bit`, `codec`) values('".my_esc($jfile)."', '$size', '".$id3->getTag('length')."', '".$id3->getTag('bitrate')."', 'mp3')");
}


?>