<?php
error_reporting(0);
function curl($url, $post = 0, $httpheader = 0, $proxy = 0){ // url, postdata, http headers, proxy, uagent
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        if($post){
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        }
        if($httpheader){
            curl_setopt($ch, CURLOPT_HTTPHEADER, $httpheader);
        }
        if($proxy){
            curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, true);
            curl_setopt($ch, CURLOPT_PROXY, $proxy);
            // curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);
        }
        curl_setopt($ch, CURLOPT_HEADER, true);
        $response = curl_exec($ch);
        $httpcode = curl_getinfo($ch);
        if(!$httpcode) return "Curl Error : ".curl_error($ch); else{
            $header = substr($response, 0, curl_getinfo($ch, CURLINFO_HEADER_SIZE));
            $body = substr($response, curl_getinfo($ch, CURLINFO_HEADER_SIZE));
            curl_close($ch);
            return array($header, $body);
        }
    }
  function pad(){
    $s=shell_exec('tput cols');
    $r=mb_convert_encoding('&#x2591;', 'UTF-8', 'HTML-ENTITIES');
    $z=str_repeat($r,$s);
    $_z=str_repeat("~",$s);
    echo col($_z,"m").PHP_EOL;
    echo $z.PHP_EOL;
    echo col($_z,"m").PHP_EOL;
  }
  function ban($z){
    $_a="kakatoji";
    $_b=mb_convert_encoding('&#x2591;', 'UTF-8', 'HTML-ENTITIES');
    $_c=str_repeat($_b,10);
    pad();
    echo $_c.col(strtoupper(" Author: "),"k").col(strtoupper($_a),"c").PHP_EOL;
    echo $_c.col(strtoupper(" scriptBot: "),"k").col(strtoupper($z),"c").PHP_EOL;
    pad();
  }
  function cxl($in,$text){
  $_a="[";$a_="]";
  echo col($_a,"p").col($in,"m").col($a_,"p").col($text,"u").PHP_EOL;
}
  function name(){
    $url="https://randomuser.me/api/?format=json";
    $data=json_decode(file_get_contents($url),1);
    return $data;}
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
  function col($str,$color){
$warna=array('x'=>"\033[0m",'p'=>"\033[1;37m",'a'=>"\033[1;30m",'m'=>"\033[1;31m",'h'=>"\033[1;32m",'k'=>"\033[1;33m",'b'=>"\033[1;34m",'u'=>"\033[1;35m",'c'=>"\033[1;36m",'px'=>"\033[1;7m",'mp'=>"\033[1;41m",'hp'=>"\033[1;42m",'kp'=>"\033[1;43m",'bp'=>"\033[1;44m",'up'=>"\033[1;45m",'cp'=>"\033[1;46m",'pp'=>"\033[1;47m",'ap'=>"\033[1;100m",'pm'=>"\033[7;41m",);return $warna[$color].$str."\033[0m";}
