<?php

public function xurl($url,$method="GET", $body=NULL, $headers=[]) {
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
