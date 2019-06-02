<?php
set_time_limit(0);
include "update.php";
  function allupdate()
  {
    $allcourselist=searchforcoursetyepe2("","",'allcourselist');
    $courselist=array();
    for($i=0;$i<sizeof($allcourselist);$i++)
    {
    	if(!array_key_exists($allcourselist[$i]['subject'],$courselist))
    	{
    		//$courselist[$allcourselist[$i]['subject']]=array();
    		$courselist[$allcourselist[$i]['subject']][]=$allcourselist[$i]['catalog_number'];
    	}
    	else
    	{
    		$courselist[$allcourselist[$i]['subject']][]=$allcourselist[$i]['catalog_number'];
    	}
    }
    $num=0;
    foreach ($courselist as $key => $value) {
      # code...
      $subject=$key;
      for($i=0;$i<sizeof($value);$i++)
      {
        echo "will update $key and $value[$i]";
        echo "<br>";
        $num++;
        $string="update".$key."and".$value[$i];
        $filename="update.txt";

        $handle=fopen($filename,"a+");

        $str=fwrite($handle,$string);
        $str=fwrite($handle,"\n");

         fclose($handle);
        //update($key,$value[$i],'1165');
        remoteupdate($key,$value[$i]);
      }
    }
    echo "total update $num courses";
  }
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
allupdate();
  ?>
