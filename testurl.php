<?php
function remoteupdate($subject,$number){
  $URL="www.uwcourseschedule.com/receiveupdate.php?subject=".$subject."&number=".$number;

  echo $URL;
  set_time_limit(0);
  ini_set('memory_limit', '300M');

  $ch = curl_init($URL);
  curl_setopt($ch, CURLOPT_URL,$URL);
curl_setopt($ch, CURLOPT_TIMEOUT, 30); //timeout after 30 seconds
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);

curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);   //get status code
$result= curl_exec($ch);
$result= json_decode($result,true);
print_r($result);
}
  ?>
