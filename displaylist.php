<?php
include "update.php";
error_reporting(NULL);
	$term=$_POST["sess"];
	$courselist=array();
	$cataloglist=array();
	for($i=0;$i<6;$i++)
	{
		$course="subject".$i;
		$cata="catalog_number".$i;
		$courselist[]=$_POST[$course];
		$cataloglist[]=$_POST[$cata];
	}
	//print_r($courselist);
	//print_r($cataloglist);
	//echo $term;
	session_start();
	$coursearray=array();
	for($i=0;$i<sizeof($cataloglist);$i++)
	{
		if($cataloglist[$i]!="null"){
		$response=update($courselist[$i],$cataloglist[$i],$term);
			//echo "will update $i ";
		//print_r($response);
		//$coursearray[]=array();
		$coursearray[]=$response;
		}
		//echo gettype($cataloglist[$i]);
	}
	$_SESSION['courses']=$coursearray;
//	print_r($coursearray);
header("Location:./testdisplay.php");
	?>
