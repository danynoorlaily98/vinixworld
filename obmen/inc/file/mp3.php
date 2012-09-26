<?
if (is_file(H."sys/obmen/screens/128/$file_id[id].gif"))
{
echo "<img src='/sys/obmen/screens/128/$file_id[id].gif' alt='Скрин...' /><br />\n";
}
if ($file_id['opis']!=NULL)
{
echo "Descripcion: ";

echo trim(br(links($file_id['opis'])));

echo "<br />\n";
}

echo "Agregado: ".vremja($file_id['time'])."<br />\n";



if (class_exists('ffmpeg_movie')){
$media = new ffmpeg_movie($file);

if (intval($media->getDuration())>3599)
echo 'Duracion: '.intval($media->getDuration()/3600).":".date('s',fmod($media->getDuration()/60,60)).":".date('s',fmod($media->getDuration(),3600))."<br />\n";
elseif (intval($media->getDuration())>59)
echo 'Duracion: '.intval($media->getDuration()/60).":".date('s',fmod($media->getDuration(),60))."<br />\n";
else
echo 'Duracion: '.intval($media->getDuration())." сек<br />\n";
echo "Bitrate: ".ceil(($media->getBitRate())/1024)." KBPS<br />\n";
if($media->getAudioChannels()==1)echo "mhz: Mono<br />\n";else echo "mhz: Stereo<br />\n";
echo 'Samplerate: '.$media->getAudioSampleRate()." Гц<br />\n";
if(($media->getArtist())<>""){
if (function_exists('iconv'))
echo 'Artista: '.iconv('windows-1251', 'utf-8', $media->getArtist())."<br />\n";
else
echo 'Artista: '.$media->getArtist()."<br />\n";
}
if(($media->getGenre())<>"")echo 'Жанр: '.$media->getGenre()."<br />\n";
}
else
{
include_once H.'sys/inc/mp3.php';
$id3 = new MP3_Id(); 
  $result = $id3->read($file); 
  $result = $id3->study();
if(($id3->getTag('length')<>0)){echo 'Duracion: '.$id3->getTag('length')."<br />\n";}
if(($id3->getTag('bitrate'))<>0){echo'Bitrate: '.$id3->getTag('bitrate')." KBPS<br />\n";}
if(($id3->getTag('mode'))<>""){echo 'Modo: '.$id3->getTag('mode')."<br />\n";}
if(($id3->getTag('frequency'))<>0){echo 'Frecuencia: '.$id3->getTag('frequency')." mhz<br />\n";}
if(($id3->getTag('album'))<>""){
if (function_exists('iconv'))
echo 'Album: '.iconv('windows-1251', 'utf-8', $id3->getTag('album'))."<br />\n";
else
echo 'Album: '.$id3->getTag('album')."<br />\n";
}
if(($id3->getTag('artists'))<>""){
if (function_exists('iconv'))
echo 'Artista: '.iconv('windows-1251', 'utf-8', $id3->getTag('artists'))."<br />\n";
else
echo 'Artista: '.$id3->getTag('artists')."<br />\n";
}
if(($id3->getTag('genre'))<>""){echo 'Жанр: '.$id3->getTag('genre')."<br />\n";}
}

echo "Tama&ntilde;o: ".size_file($size)."<br />\n";

?>