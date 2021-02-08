<?php

function color($warna='cyan',$text=0){
  $red="\e[3;31m\e[1;31m";
  $green="\e[3;32m\e[1;32m";
  $yellow="\e[3;33m\e[1;33m";
  $pur="\e[3;35m\e[1;35m";
  $cyn="\e[3;36m\e[1;36m";
  $no="\e[0m";
  switch($warna){
    case 'merah':
      echo $red.$text.$no;
      break;
    case 'hijau':
      echo $green.$text.$no;
      break;
    case 'kuning':
      echo $yellow.$text.$no;
      break;
    case 'pur':
      echo $pur.$text.$no;
      break;
    case 'cyan':
      echo $cyn.$text.$no;
      break;
  }
}
function sim($sim="plus"){
  switch($sim){
  case 'strp':
    echo "\n".str_repeat("\e[1;37m~",50);
    break;
  case 'plus':
    echo "\n\e[1;31m[\e[1;37m+\e[1;31m]\e[0m";
    break;
  case 'pnh':
    echo "\n\e[1;36m~>\e[0m";
    break;
  }
}
sim("strp");
echo sim("plus")." ".color('cyan'," Auto reff");
echo sim("plus")." ".color('cyan'," Login");
echo sim("plus")." ".color('cyan'," Balance");
echo sim('pnh')." ".color('hijau'," total claim").color('kuning'," ".  8);
sim('strp');
