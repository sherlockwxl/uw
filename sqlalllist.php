	<?php
	function createnewtable($tablename)
	{
		$dbname = "myDB";
		$conn = mysqli_connect("localhost","root","root",$dbname);
		if (!$conn)
		{
			die('Could not connect: ' . mysqli_error());
		}
		$sql = "CREATE TABLE $tablename (
		id INT(6) NOT NULL,
		coursepre VARCHAR(10) NOT NULL,
		coursenumber VARCHAR(10) NOT NULL,
		coursetype VARCHAR(10) NOT NULL,
		courselecnum VARCHAR(10) NOT NULL,
		coursetime VARCHAR(30) NOT NULL,
		coursedate VARCHAR(5) NOT NULL,
		coursename VARCHAR(50) NOT NULL,
		courselocation VARCHAR(30) NOT NULL,
		courselocationbuilding VARCHAR(10) ,
		courselocationbuildingroomnumber VARCHAR(10),
		courseinstructors VARCHAR(30) ,
		enrollment_capacity INT(4),
		enrollment_total INT(4),
		waiting_capacity INT(4),
		waiting_total INT(4),
		reg_date TIMESTAMP
		)";
		if ($conn->query($sql) === TRUE) {
			echo "Database created successfully";
		} else {
			echo "Error creating database: " . $conn->error;
		}

		mysqli_close($conn);
	}

	//the schedule data table name is courses

//createnewtable('courses');
	function createallcoursetable($tablename)
	{
		$dbname = "myDB";
		$conn = mysqli_connect("localhost","root","root",$dbname);
		if (!$conn)
		{
			die('Could not connect: ' . mysqli_error());
		}
		$sql = "CREATE TABLE $tablename (
		subject VARCHAR(10) NOT NULL,
		catalog_number VARCHAR(10) NOT NULL,
		title VARCHAR(30) NOT NULL,
		reg_date TIMESTAMP
		)";
		if ($conn->query($sql) === TRUE) {
			echo "Database created successfully";
		} else {
			echo "Error creating database: " . $conn->error;
		}
		mysqli_close($conn);
	}
		//createallcoursetable('allcourselist');
	function createusertable($tablename)
	{
		$dbname = "myDB";
		$conn = mysqli_connect("localhost","root","root",$dbname);
		if (!$conn)
		{
			die('Could not connect: ' . mysqli_error());
		}
		$sql = "CREATE TABLE $tablename (
		username VARCHAR(15) NOT NULL,
		password VARCHAR(25) NOT NULL,
		userdataarray VARCHAR(150) NOT NULL,
		reg_date TIMESTAMP
		)";
		if ($conn->query($sql) === TRUE) {
			echo "Database $tablename created successfully";
		} else {
			echo "Error creating database: " . $conn->error;
		}

		mysqli_close($conn);
	}
//createusertable('userdata');

	function createdatabase()
	{
	$servername = "localhost";
	$username = "root";
	$password = "root";

	// 创建连接
	$conn = new mysqli($servername, $username, $password);
	// 检测连接
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}

	// Create database
	$sql = "CREATE DATABASE myDB";
	if ($conn->query($sql) === TRUE) {
	    echo "Database created successfully";
	} else {
	    echo "Error creating database: " . $conn->error;
	}

	$conn->close();
	}
	function deletetable($name)
	{
		$dbname = "myDB";
		$conn = mysqli_connect("localhost","root","root",$dbname);
		if (!$conn)
		{
			die('Could not connect: ' . mysqli_error());
		}
		$sql = "DROP table $name";
		if ($conn->query($sql) === TRUE) {
				echo "Database created successfully";
		} else {
				echo "Error creating database: " . $conn->error;
		}

		$conn->close();
	}
	//deletetable("allcourselist");
//	deletetable("courses");
	//createdatabase();
	?>
