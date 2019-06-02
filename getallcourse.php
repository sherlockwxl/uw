<?php
include "sql.php";
	//$urlbase="https://api.uwaterloo.ca/v2/courses/";
		$key="75f54f72238b7cd7ccadd35716ecf4e8";     //pre dfine user key
		$URL="https://api.uwaterloo.ca/v2/terms/1165/courses.json?key=75f54f72238b7cd7ccadd35716ecf4e8";
		//echo $URL;
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

	if(!curl_errno($ch)){
	//echo "Errtime1";
	//echo var_dump(curl_error($ch));
 	//echo "<br/>";
	}
	curl_close ($ch);
	$responsearray=array();
	for($i=0;$i<sizeof($result['data']);$i++)
	{
		//$responsearray[$i]=array();
		$responsearray[$i]=$result['data'][$i];
	}
	//print_r($responsearray);
	addrecordforlist($responsearray,'allcourselist');

	?>
