
<?php
include "sql.php";
//module: update the given course
function update($coursename,$courseid,$termid)

{
	$responsearray=searchforcourse($coursename,$courseid,'courses');

		//echo "need update";
	$urlbase="https://api.uwaterloo.ca/v2/courses/";
		$key="75f54f72238b7cd7ccadd35716ecf4e8";     //pre dfine user key
		$URL=$urlbase.$coursename."/".$courseid."/schedule.json?key=".$key."&term=".$termid;
		echo $URL;
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
		$responsearray[]=processresponse($result['data'][$i]);
	}
	if($responsearray==false){
	addrecord($responsearray,'courses');
	}
	else{
		updaterecord($responsearray,'courses');
	}
	//print_r($responsearray);
	return searchforcourse($coursename,$courseid,'courses');
	//echo sizeof($result['data']);
}
//update("CS","246",'1161');

function processresponse($arr)
{
	$response=array();
	$response[]=$arr['class_number'];
	$response[]=$arr['subject'];
	$response[]=$arr['catalog_number'];
	$arrtemp=explode(' ', $arr['section']);
	$response[]=$arrtemp[0];
	$response[]=$arrtemp[1];
	$time=$arr['classes'][0]['date']['start_time'].$arr['classes'][0]['date']['end_time'];
	$response[]=$time;
	$response[]=$arr['classes'][0]['date']['weekdays'];
	$response[]=$arr['title'];
	$response[]=$arr['campus'];
	if($arr['classes'][0]['location']['building']=="")
	{
		$response[]='undefined';
		$response[]='undefined';
	}
	else{
	$response[]=$arr['classes'][0]['location']['building'];
	$response[]=$arr['classes'][0]['location']['room'];}
	if(sizeof($arr['classes'][0]['instructors'])==0)
	{
		$response[]='undefined';
	}
	else{
	$response[]=$arr['classes'][0]['instructors'][0];
	}
	$response[]=$arr['enrollment_capacity'];
	$response[]=$arr['enrollment_total'];
	$response[]=$arr['waiting_capacity'];
	$response[]=$arr['waiting_total'];
	return $response;
}


?>
