<?php

function curl($url,$method="GET", $body=NULL, $headers=[]) {
  // the default return object
  $return = [];
  
  // Exchange the auth code for an access token
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
  curl_setopt($ch, CURLOPT_HEADER, 1);
  curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
  curl_setopt($ch, CURLOPT_TIMEOUT, 6); //timeout in seconds
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

  // Get the method and set if required
  $method = strtoupper($method);
  if( $method != "GET" ) {
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
  }

  // If method is a POST, set the appropriate headers
  if( $method == "POST" ) {
    curl_setopt($ch, CURLOPT_POST, true);
    if ( !empty($body) ) {
      curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
      $headers[] = 'Content-Length: ' . strlen($body);
    }
  }

  // Exec the curl command
  $resp = curl_exec($ch);

  // Evaluate the response code
  $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  $return["status"] = $httpcode;
  if( $httpcode === 0 ) {
    throw new Exception("Connection to API failed with response code: {$httpcode}");
    return $return;
  }

  // Get the respone and set the return payload
  $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
  $return[] = substr($resp, 0, $header_size);
  $return[] = substr($resp, $header_size);

  return $return;
}
function rata($str, $std = 21)
{
    $len = strlen($str);
    if ($len < $std) {
        $n = $std - $len;
        $str .= str_repeat(" ", $n);
    }
    if ($len > $std) {
        $str = substr($str, 0, $std);
    }
    return $str;
}
function slow($str)
{
    $arr = str_split($str);
    foreach ($arr as $az) {
        echo $az;
        usleep(10000);
    }
}
function cetak($msg, $tipe, $dawa=null){
    #listwarna
    $u="\033[1;35m";$m="\033[1;31m";$h="\033[1;32m";$k="\033[1;33m";
    $r="\033[0m";$lb="\033[1;36m";$pt="\033[1;37m";
    #set line
    $lenline = 60;
    $varline = "{$u}►";
    #variasi
    $des["salah"] = "{$u}[{$m}x{$u}]{$m}";
    $des["benar"] = "{$u}[{$h}+{$u}]{$h}";
    $des["warn"] = "{$u}[{$k}!{$u}]{$k}";
    $des["tanya"] = "{$u}[{$k}?{$u}]{$k}";
    $des["var"] = "{$u}[{$r}•{$u}]{$h}";
    $des["wait"] = "{$u}[{$h}>{$u}]{$k}";
    $des["wkt"] = "{$u}[{$lb}".date('H:i:s')."{$u}]{$lb}";
    if (strpos($msg, "|") == ""){
        if ($tipe == "line"){echo $u.str_repeat($varline, $lenline)."\n";}
        else{
           if($tipe == "wait"){return "{$des[$tipe]}{$msg}";}
           else{$lenstr = 3+strlen($msg);
               if ($lenstr > $lenline){$msg = substr($msg, 0, $lenline-5)." ".$varline;}
               else{$msg = $msg.str_repeat(" ", $lenline-(strlen($msg)+4)).$varline;}echo "{$des[$tipe]}{$msg}\n";}}}
    else{
        if ($tipe == "menu"){$w1 = explode("|", $msg)[0];$w2 = explode("|", $msg)[1];$lenstr = 2+strlen($w1)+strlen($w2);
            if ($lenstr > $lenline){$w2 = substr($w2, 0, $lenline-($lenstr+2))." ".$varline;}
            else{$w2 = $w2.str_repeat(" ", $lenline-(strlen($w2)+4)).$varline;}echo "{$u}[{$r}{$w1}{$u}]{$h}{$w2}\n";}
        else{
           if ($dawa){$w1 = explode("|", $msg)[0];
               if (strlen($w1) > $dawa){$w1 = substr($w1, 0, $dawa-strlen($w1));}
               else{$w1 = $w1.str_repeat(" ", $dawa-strlen($w1));}}
           else{$w1 = explode("|", $msg)[0];}$w2 = explode("|", $msg)[1];
           if ($tipe == "tanya"){echo "{$des[$tipe]}{$w1}{$m} : {$pt}{$w2}";}
           else{$lenstr = 6+strlen($w1)+strlen($w2);
               if ($lenstr > $lenline){$w2 = substr($w2, 0, $lenline-($lenstr+2))." ".$varline;}
               else{$w2 = $w2.str_repeat(" ", $lenline-((strlen($w2)+strlen($w1))+7)).$varline;}echo "{$des[$tipe]}{$w1}{$m} : {$pt}{$w2}\n";
           }
        }
    }
}
function col($str,$color){
   $warna=array('x'=>"\033[0m",'p'=>"\033[1;37m",'a'=>"\033[1;30m",'m'=>"\033[1;31m",'h'=>"\033[1;32m",'k'=>"\033[1;33m",'b'=>"\033[1;34m",'u'=>"\033[1;35m",'c'=>"\033[1;36m",'px'=>"\033[1;7m",'mp'=>"\033[1;41m",'hp'=>"\033[1;42m",'kp'=>"\033[1;43m",'bp'=>"\033[1;44m",'up'=>"\033[1;45m",'cp'=>"\033[1;46m",'pp'=>"\033[1;47m",'ap'=>"\033[1;100m",'pm'=>"\033[7;41m",);return $warna[$color].$str."\033[0m";}
function timer($tmr){ 
     $timr=time()+$tmr; 
      while(true): 
      echo "\r                       \r"; 
      $res=$timr-time(); 
      if($res < 1){break;} 
      echo date('H:i:s',$res); 
      sleep(1); 
      endwhile;
  }
 function save($data,$data_post){
   //$data="data.json";
    if(!file_get_contents($data)){
      file_put_contents($data,"[]");}
    $json=json_decode(file_get_contents($data),1);
    $arr=array_merge($json,$data_post);
    file_put_contents($data,json_encode($arr,JSON_PRETTY_PRINT));
  }













