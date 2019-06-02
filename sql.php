	<?php
	//name is courses;
	set_time_limit(0);
	function clearrecord($tablename)
	{
		$dbname = "myDB";
		$conn = mysqli_connect("localhost","root","root",$dbname);
		if (!$conn)
		{
			die('Could not connect: ' . mysqli_error());
		}
		$sql = "DELETE FROM $tablename";
		if ($conn->query($sql) === TRUE) {
			echo "Database deleted successfully";
		} else {
			echo "Error creating database: " . $conn->error;
		}



	}
	//clearrecord('courses');
	//clearrecord('allcourselist');


	//loadarray is used for change second level to one level
	function loadarray($dataarray,$num)
	{
		$temparray=array();
		for($i=0;$i<sizeof($dataarray[$num]);$i++)
		{
				$dataarray[$num][$i]=str_replace(",","",$dataarray[$num][$i]); //替换英文逗号,
				$dataarray[$num][$i]=str_replace("<","",$dataarray[$num][$i]); //替换英文小破折号<
				$dataarray[$num][$i]=str_replace(">","",$dataarray[$num][$i]);//替换英文小破折号>
				$dataarray[$num][$i]=str_replace("'","",$dataarray[$num][$i]);//替换英文单引号 '
				$dataarray[$num][$i]=str_replace("{","",$dataarray[$num][$i]);//替换英文大括号{
				$dataarray[$num][$i]=str_replace("}","",$dataarray[$num][$i]);//替换英文大括号}
				$dataarray[$num][$i]=str_replace("(","",$dataarray[$num][$i]);//替换英文小括号(
				$dataarray[$num][$i]=str_replace("）","",$dataarray[$num][$i]);//替换英文小括号）
				htmlentities($dataarray[$num][$i],ENT_QUOTES);//替换英文双引号 "
			$temparray[]=$dataarray[$num][$i];
		}
			//print_r($temparray);
		return $temparray;


	}

	//list array need another load array because of the name is not num
	function loadarraytype2($dataarray,$num)
	{
		$temparray=array();
			foreach ($dataarray[$num] as $key => $value) {
				# code...
				if($key!='units'){
					$value=str_replace(",","",$value); //替换英文逗号,
  				$value=str_replace("<","",$value); //替换英文小破折号<
  				$value=str_replace(">","",$value);//替换英文小破折号>
  				$value=str_replace("'","",$value);//替换英文单引号 '
  				$value=str_replace("{","",$value);//替换英文大括号{
  				$value=str_replace("}","",$value);//替换英文大括号}
  				$value=str_replace("(","",$value);//替换英文小括号(
  				$value=str_replace("）","",$value);//替换英文小括号）
  				htmlentities($value,ENT_QUOTES);//替换英文双引号 "
				$temparray[]=$value;
			}
			}
			//print_r($temparray);
		return $temparray;


	}
	function updaterecord($dataarray,$tablename)
	{
		$dbname = "myDB";
		$conn = mysqli_connect("localhost","root","root",$dbname);
		if (!$conn)
		{
			die('Could not connect: ' . mysqli_error());
		}

		$temparray=loadarray($dataarray,0);




		$sql = "UPDATE $tablename SET enrollment_capacity= '$temparray[12]' ,		enrollment_total = '$temparray[13]' ,		waiting_capacity  = '$temparray[14]',		waiting_total = '$temparray[15]' WHERE coursepre = '$temparray[1]' AND
		coursenumber ='$temparray[2]' AND
		coursetype = '$temparray[3]' AND
		courselecnum = '$temparray[4]';";



		for($i=1;$i<sizeof($dataarray);$i++)
		{
			$temparray=loadarray($dataarray,$i);
			//echo "multi called ";
			//print_r($temparray);
			$sql .= "UPDATE $tablename SET enrollment_capacity= '$temparray[12]' ,		enrollment_total = '$temparray[13]' ,		waiting_capacity  = '$temparray[14]',		waiting_total = '$temparray[15]' WHERE coursepre = '$temparray[1]' AND
			coursenumber ='$temparray[2]' AND
			coursetype = '$temparray[3]' AND
			courselecnum = '$temparray[4]';";
		}


		//print_r ($sql);
		if ($conn->multi_query($sql) === TRUE) {
			echo "$temparray[1] $temparray[2] $temparray[3] $temparray[4] updated successfully";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
		$conn->close();
	}
	//add the record to sql
	function addrecord($dataarray,$tablename)
	{

		$dbname = "myDB";
		$conn = mysqli_connect("localhost","root","root",$dbname);
		if (!$conn)
		{
			die('Could not connect: ' . mysqli_error());
		}

		$temparray=loadarray($dataarray,0);




		$sql = "INSERT INTO $tablename (id, coursepre ,
		coursenumber ,
		coursetype ,
		courselecnum ,
		coursetime ,
		coursedate ,
		coursename ,
		courselocation ,
		courselocationbuilding ,
		courselocationbuildingroomnumber,
		courseinstructors ,
		enrollment_capacity ,
		enrollment_total ,
		waiting_capacity ,
		waiting_total)
		VALUES ('$temparray[0]','$temparray[1]','$temparray[2]','$temparray[3]','$temparray[4]','$temparray[5]','$temparray[6]','$temparray[7]','$temparray[8]','$temparray[9]','$temparray[10]','$temparray[11]','$temparray[12]','$temparray[13]','$temparray[14]','$temparray[15]');";




		for($i=1;$i<sizeof($dataarray);$i++)
		{
			$temparray=loadarray($dataarray,$i);
			//echo "multi called ";
			//print_r($temparray);
			$sql .= "INSERT INTO $tablename (id, coursepre ,
			coursenumber ,
			coursetype ,
			courselecnum ,
			coursetime ,
			coursedate ,
			coursename ,
			courselocation ,
			courselocationbuilding ,
			courselocationbuildingroomnumber,
			courseinstructors ,
			enrollment_capacity ,
			enrollment_total ,
			waiting_capacity ,
			waiting_total)
			VALUES('$temparray[0]','$temparray[1]','$temparray[2]','$temparray[3]','$temparray[4]','$temparray[5]','$temparray[6]','$temparray[7]','$temparray[8]','$temparray[9]','$temparray[10]','$temparray[11]','$temparray[12]','$temparray[13]','$temparray[14]','$temparray[15]');";
		}


		//print_r ($sql);
		if ($conn->multi_query($sql) === TRUE) {
			echo "New records created successfully";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
		$conn->close();




	}

	function searchforuser($username,$password,$tablename)
	{
		$dbname = "myDB";
		$conn = mysqli_connect("localhost","root","root",$dbname);
		if (!$conn)
		{
			die('Could not connect: ' . mysqli_error());
		}

		$sql = "SELECT * FROM $tablename WHERE username='$username' AND password='$password' ";
		$result = $conn->query($sql);
		;
		if ($result->num_rows > 0) {
	    // 输出每行数据
			$returnarray=array();
			while($row = $result->fetch_assoc()) {
			//	print_r($row);
				$returnarray[]=$row;
			}
			return $returnarray;
		} else {
			return false;
		}
		$conn->close();
	}
function adduser($username,$password,$tablename)
{
	$json="";
	$dbname = "myDB";
	$conn = mysqli_connect("localhost","root","root",$dbname);
	if (!$conn)
	{
		die('Could not connect: ' . mysqli_error());
	}
	$sql = "INSERT INTO $tablename (username,
	password ,
	userdataarray)
	VALUES ('$username','$password','$json');";
	if ($conn->query($sql) === TRUE) {
		echo "New records created successfully";
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
	$conn->close();
}



function updateuser($username,$password,$json,$tablename)
{

	$dbname = "myDB";
	$conn = mysqli_connect("localhost","root","root",$dbname);
	if (!$conn)
	{
		die('Could not connect: ' . mysqli_error());
	}
	$sql = "UPDATE $tablename SET userdataarray = '$json' WHERE username = '$username' AND password = '$password'";
	if ($conn->query($sql) === TRUE) {
		echo "New records update successfully";
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}$conn->close();
}


	function searchforcourse($coursepre,$coursenumber,$tablename)
	{
		$dbname = "myDB";
		$conn = mysqli_connect("localhost","root","root",$dbname);
		if (!$conn)
		{
			die('Could not connect: ' . mysqli_error());
		}

		$sql = "SELECT * FROM $tablename WHERE coursepre='$coursepre' AND coursenumber='$coursenumber' ";
		$result = $conn->query($sql);
		;
		if ($result->num_rows > 0) {
	    // 输出每行数据
			$returnarray=array();
			while($row = $result->fetch_assoc()) {
				//print_r($row);
				$returnarray[]=$row;
			}
			return $returnarray;
		} else {
			return false;
		}
		$conn->close();
	}
	//searchforcourse('CS','241','courses');
	$testarray=array(
		array(
			'5980','CS','246','LEC','001',"13:00-14:20",'TTh','Object-Oriented Software Development','UWU','B1','271','Buhr,Peter A','110','126','0','0'
			)
		);
	//addrecord($testarray,'courses');
	//print_r($testarray);
	//function search($)
	//addrecordforlist will add all course list into database named allcourselist


function deletenull($tablename)
{
	$dbname = "myDB";
	$conn = mysqli_connect("localhost","root","root",$dbname);
	if (!$conn)
	{
		die('Could not connect: ' . mysqli_error());
	}

	$sql = "Delete from $tablename where id = '0' ";
	if ($conn->query($sql) === TRUE) {
	echo "delete null successfully";
	} else {
	echo "Error: " . $sql . "<br>" . $conn->error;
	}
//print_r ($sql);
$conn->close();
}



	function addrecordforlist($dataarray,$tablename)
	{
		$dbname = "myDB";
		$conn = mysqli_connect("localhost","root","root",$dbname);
		if (!$conn)
		{
			die('Could not connect: ' . mysqli_error());
		}

		/*$temparray=loadarraytype2($dataarray,0);




		$sql = "INSERT INTO $tablename (subject,
		catalog_number ,
		title)
		VALUES ('$temparray[0]','$temparray[1]','$temparray[2]');";*/



	$sql="";
		for($i=0;$i<sizeof($dataarray);$i++)
		{
			$temparray=loadarraytype2($dataarray,$i);
			//echo "multi called ";
			//print_r($temparray);
			$sql .= "INSERT INTO $tablename (subject,
		catalog_number,
		title)VALUES('$temparray[0]','$temparray[1]','$temparray[2]');";
			if($i%10==0)
			{

				if ($conn->multi_query($sql) === TRUE) {
				echo "New records created successfully";
				} else {
				echo "Error: " . $sql . "<br>" . $conn->error;
				}
				$sql="";
					mysqli_close($conn);
					$dbname = "myDB";
					$conn = mysqli_connect("localhost","root","root",$dbname);
			}
		}


				if ($conn->multi_query($sql) === TRUE) {
				echo "New records created successfully";
				} else {
				echo "Error: " . $sql . "<br>" . $conn->error;
				}
		//print_r ($sql);


	}


	//search for course in all list

	function searchforcoursetyepe2($coursepre,$coursenumber,$tablename)
	{
		$dbname = "myDB";
		$conn = mysqli_connect("localhost","root","root",$dbname);
		if (!$conn)
		{
			die('Could not connect: ' . mysqli_error());
		}

		$sql = "SELECT * FROM $tablename WHERE 1=1";
		$result = $conn->query($sql);
		//print_r(mysqli_fetch_array($result));
		$num=0;
		if ($result->num_rows > 0)
			{
				$returnarray=array();
			while($row = $result->fetch_assoc()) {
				//print_r($row);
				$num++;
				$returnarray[]=$row;
			}
		//	echo "total have $num";
					return $returnarray;
		} else {
			return false;
		}
		$conn->close();
	}

	//searchforcoursetyepe2('CS','246','allcourselist');
	//add this because wowan's
/*	$dbname = "myDB";
		$conn = mysqli_connect("localhost","root","root",$dbname);
		if (!$conn)
		{
			die('Could not connect: ' . mysqli_error());
		}
	$sql="INSERT INTO allcourselist (subject, catalog_number, title)VALUES('FR','484','Childrens Literature in French');INSERT INTO allcourselist (subject, catalog_number, title)VALUES('FR','685','Studies in Selected Topics');INSERT INTO allcourselist (subject, catalog_number, title)VALUES('GENE','101','Strategies and Skills for Academic Success');INSERT INTO allcourselist (subject, catalog_number, title)VALUES('GENE','119','Problems Seminar');INSERT INTO allcourselist (subject, catalog_number, title)VALUES('GENE','121','Digital Computation');INSERT INTO allcourselist (subject, catalog_number, title)VALUES('GENE','123','Electrical Engineering');INSERT INTO allcourselist (subject, catalog_number, title)VALUES('GENE','21A','Topics for Technical Courses Taken on Exchange by Architecture Students');INSERT INTO allcourselist (subject, catalog_number, title)VALUES('GENE','21C','Topics for Technical Courses Taken on Exchange by Chemical Engineering Students');INSERT INTO allcourselist (subject, catalog_number, title)VALUES('GENE','21M','Topics for Technical Courses Taken on Exchange by Mechanical Engineering Students');INSERT INTO allcourselist (subject, catalog_number, title)VALUES('GENE','301','Special Directed Studies');";

				if ($conn->multi_query($sql) === TRUE) {
				echo "New records created successfully";
				} else {
				echo "Error: " . $sql . "<br>" . $conn->error;
			};*/
	?>
