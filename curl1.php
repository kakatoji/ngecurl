<?php


     function imeiRandom(){
        $code = $this->intRandom(14);
        $position = 0;
        $total = 0;
        while ($position < 14) {
            if ($position % 2 == 0) {
                $prod = 1;
            } else {
                $prod = 2;
            }
            $actualNum = $prod * $code[$position];
            if ($actualNum > 9) {
                $strNum = strval($actualNum);
                $total += $strNum[0] + $strNum[1];
            } else {
                $total += $actualNum;
            }
            $position++;
        }
        $last = 10 - ($total % 10);
        if ($last == 10) {
            $imei = $code . 0;
        } else {
            $imei = $code . $last;
        }
        return $imei;
    }
  function RandomPhone(){
        $hp = array(
            "Xiaomi Mi 2/2s",
            "Xiaomi Mi 2A ",
            "Xiaomi Mi 3/4 W",
            "Xiaomi Mi 3 TD",
            "Xiaomi Mi Note LTE",
            "Xiaomi Mi Max 2",
            "Xiaomi Redmi Note 3",
            "Xiaomi Redmi Pro",
            "Xiaomi Redmi 5 Plus",
            "Xiaomi Redmi 4 A",
            "Xiaomi Redmi 4X"
            );
        $random = $hp[array_rand($hp)];
        return $random;
    }
  function generateRandomString($length = 10) { // length
        $characters = '0123456789ABCDEFGHIJKLMNabcdefghijklmnopqrstuvwxyz';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
  function get_string($string, $start, $end){ // source, first tag, end tag
        $str = explode($start, $string);
        $str = explode($end, $str[1]);
        return $str[0];
    }
  function ParseUrl($url){ // url
        $parts = parse_url($url);
        parse_str($parts['query'], $query);
        return array(
            "code" => $query['code'],
            "email" => $query['email']
        );
    }
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
  function array_to_cookies($source){
        if(!is_array($source)){
            return "NOT ARRAY!";
        }else{
            return str_replace(array('\n', '\\', '{"', '"}', '":"', '","'), array('', '', '', '', '=', '; '), json_encode($source));
        }
    }
  function fetch_cookies($source) { // string
        preg_match_all('/^Set-Cookie:\s*([^;\r\n]*)/mi', $source, $matches); 
        $cookies = array(); 
        foreach($matches[1] as $item) { 
            parse_str($item, $cookie); 
            $cookies = array_merge($cookies, $cookie); 
        }
        return $cookies;
    }
  function gen_uuid() {
        return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
            mt_rand( 0, 0xffff ),
            mt_rand( 0, 0x0fff ) | 0x4000,
            mt_rand( 0, 0x3fff ) | 0x8000,
            mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
        );
    }
  function intRandom($size){
        $validCharacters = utf8_decode("0123456789");
        $validCharNumber = strlen($validCharacters);
        $int = '';
        while (strlen($int) < $size) {
            $index = mt_rand(0, $validCharNumber - 1);
            $int .= $validCharacters[$index];
        }
        return $int;
    }
  function name(){
    $url="https://randomuser.me/api/?format=json";
    $data=json_decode(file_get_contents($url),1);
    return $data;
  }
