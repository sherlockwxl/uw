<?php
//这个是用来看 alllist是否完整//
include "sql.php";
	$filename="allcourse.txt";
	$mydata = fopen($filename, "r") or die("Unable to open filedata1!");
	$mydata_1 = fread($mydata,filesize($filename));
	fclose($mydata);
	$json=json_decode($mydata_1,true);
	//print_r($json['data']);
	echo sizeof($json['data']);
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
	$missarray=array();
	for($i=0;$i<sizeof($json['data']);$i++)
	{
		$find=0;
		$subject=$json['data'][$i]['subject'];
		$number=$json['data'][$i]['catalog_number'];
		if(array_key_exists($subject,$courselist)){
		for($a=0;$a<sizeof($courselist[$subject]);$a++)
		{

			if($courselist[$subject][$a]==$number)
			{
				$find=1;
			}
		}
		if($find==0)
		{
			print_r($json['data'][$i]);
		}
	}
	else {
		print_r($json['data'][$i]);
	}
}
	print_r($missarray);
	?>
