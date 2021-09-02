<?php

private function makeRequest($method="GET", $route, $body=NULL, $headers=[]) {
  // the default return object
  $return = [];
  
  // Exchange the auth code for an access token
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $route);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
  curl_setopt($ch, CURLOPT_HEADER, 1);
  curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
  curl_setopt($ch, CURLOPT_TIMEOUT, 6); //timeout in seconds
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

  // Get the method and set if required
  $method = strtoupper($method);
  if( $method != "GET" ) {
    curl_setopt($sh, CURLOPOT_CUSTOMREQUEST, $method);
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
  $return["code"] = $httpcode;
  if( $httpcode === 0 ) {
    throw new Exception("Connection to API failed with response code: {$httpcode}");
    return $return;
  }

  // Get the respone and set the return payload
  $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
  $return["headers"] = substr($resp, 0, $header_size);
  $return["body"] = substr($resp, $header_size);

  return $return;
}
