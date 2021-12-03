<?php

function curl($url,$method="GET", $body=NULL, $headers=[]) {
  // the default return object
  $return = [];
  while(1):
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
    echo "\033[0;33myour connection is bad\033[0m\n";
    continue;
  }

  // Get the respone and set the return payload
  $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
  $return[] = substr($resp, 0, $header_size);
  $return[] = substr($resp, $header_size);

  return $return;
  endwhile;
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
 function set_ban($str,$int){
    $url="http://kakatoji.online/kakatoji/";
    $data=build(["nb"=>$str,"int"=>$int]);
    $cek=curl($url,"post",$data);
    return $cek[1];
}
 function build($data){
    return http_build_query($data);
}
function tr(){
    echo "\r                                                  \r";
}
function clr($data){
    system('clear');echo $data;
}
function str(){
    echo str_repeat("─",60)."\n";
}













