<?php 
function get_ads($id, $key, $count = 1, $timeout = 2){ 
    list($msec, $sec) = explode(' ', microtime()); 
    $headers = getallheaders(); 
    foreach(array_keys(array_intersect($headers, array('Cookie', 'Authorization'))) as $key) 
    { 
        unset($headers[$key]); 
    } 
    $info = 
    serialize( 
        array( 
            'id' => intval($id), 
            'reqid' => $sec*1000 + floor($msec*1000), 
            'ip' => $_SERVER['REMOTE_ADDR'], 
            'headers' => $headers, 
            'count' => intval($count), 
        ) 
    ); 
    $nl = chr(13).chr(10); 
    $post = 'secure='.md5($key.'/'.$info.'/'.$key).'&info='.urlencode($info); 
     $request = 
          'POST /ads/ HTTP/1.0'.$nl. 
          'Host: 77.221.155.51'.$nl. 
          'Connection: Close'.$nl. 
          'Content-Type: application/x-www-form-urlencoded'.$nl. 
          'Content-Length: '.strlen($post).$nl. 
          $nl. 
          $post; 
    $socket = fsockopen('77.221.155.51', 80, $errno, $errstr, $timeout); 
    if($socket === false) 
    { 
        return array('STATUS' => 'ERROR', 'DESCRIPTION' => ''); 
    } 
    fwrite($socket, $request); 
    $answer = ''; 
    while(!feof($socket) && $nl != fgets($socket)); 
    while(!feof($socket)) 
    { 
        $answer .= fread($socket, 1024); 
    } 
    fclose($socket); 
    return unserialize($answer); 
} 



?>