<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel='stylesheet' href='./fullcalendar/fullcalendar.css' />
	<script src='./fullcalendar/lib/jquery.min.js'></script>
	<script src='./fullcalendar/lib/moment.min.js'></script>
	<script src='./fullcalendar/fullcalendar.js'></script>
	<script type="text/javascript">
		var eventarray=new Array;
        var startdate='2016-02-29';
        var enddate='2016-03-04';
        $(document).ready(function() {

    // page is now ready, initialize the calendar...

    $('#calendar').fullCalendar({
        // put your options and callbacks here
        header: {
        	left: 'prev,next today myCustomButton',
        	center: 'title',
        	right: 'month,agendaWeek,agendaDay'

        },
        eventSources:[eventarray],
        eventOverlap:true,
    });
    $('#calendar').fullCalendar( 'changeView', 'agendaWeek');


});
        function updateevent()
        {
        	console.log(eventarray);
        	$('#calendar').fullCalendar('removeEvents');
        	$('#calendar').fullCalendar('addEventSource', eventarray);
        	var bool=isOverlapping();
        	console.log("over lapping is ");
        	console.log(bool);
        	$('#calendar').fullCalendar('rerenderEvents');
        }
        function isOverlapping(){
    // "calendar" on line below should ref the element on which fc has been called
    var array = $('#calendar').fullCalendar('clientEvents');
	for(i in array){
        if(array[i].id != event.id){
            if(!(Date(array[i].start) >= Date(event.end) || Date(array[i].end) <= Date(event.start))){
                return true;
            }
        }
    }
    return false;
}
function update(name,time,date,location,type)
{
	if($type==1)
	{
		addevent(name,time,date,location,start,end);
	}
	else
	{
		deleteevent(name,start,end);
	}
}
function daysBetween(DateOne,DateTwo)  
{   
	var OneMonth = DateOne.substring(5,DateOne.lastIndexOf ('-'));  
	var OneDay = DateOne.substring(DateOne.length,DateOne.lastIndexOf ('-')+1);  
	var OneYear = DateOne.substring(0,DateOne.indexOf ('-'));  

	var TwoMonth = DateTwo.substring(5,DateTwo.lastIndexOf ('-'));  
	var TwoDay = DateTwo.substring(DateTwo.length,DateTwo.lastIndexOf ('-')+1);  
	var TwoYear = DateTwo.substring(0,DateTwo.indexOf ('-'));  

	var cha=((Date.parse(OneMonth+'/'+OneDay+'/'+OneYear)- Date.parse(TwoMonth+'/'+TwoDay+'/'+TwoYear))/86400000);   
	return Math.abs(cha);  
}
function transfer(str)
{
	switch (str){
		case "M":
		return 1;
		case "T":
		return 2;
		case "W":
		return 3;
		case "F":
		return 5;
	}

}

function getdate(date)
{
	var datearray=new Array();
	if(date.search(/Th/)!=-1)
	{
		var location=date.search(/Th/);
		for(var i=0;i<date.length;i++)
		{
			if(i!=location){
				datearray.push(transfer(date[i]));
			}
			else
			{
				datearray.push(4);
				i++;
			}

		}

	}
	else
	{
		for(var i=0;i<date.length;i++)
		{

				datearray.push(transfer(date[i]));


		}
	}
	console.log("the date array is ");
	console.log(datearray);
	return datearray;

}

function in_array(stringToSearch, arrayToSearch) {
	for (s = 0; s < arrayToSearch.length; s++) {
		thisEntry = arrayToSearch[s].toString();
		if (thisEntry == stringToSearch) {
			return true;
		}
	}
	return false;
}


function addevent(name,time,date,location,start,end)
{
	var newevent=new Array();
	var datearray=getdate(date);
	var gap=daysBetween(end,start);
	//console.log("time gap is ");
	//console.log(gap);
	var uom;
	for(var i=1;i<gap;i++)
	{
		Date.prototype.format = function(format)  
		{  
			var o =  
			{  
        "M+" : this.getMonth()+1, //month  
        "d+" : this.getDate(),    //day  
        "h+" : this.getHours(),   //hour  
        "m+" : this.getMinutes(), //minute  
        "s+" : this.getSeconds(), //second  
        "q+" : Math.floor((this.getMonth()+3)/3),  //quarter  
        "S" : this.getMilliseconds() //millisecond  
    }  
    if(/(y+)/.test(format))  
    	format=format.replace(RegExp.$1,(this.getFullYear()+"").substr(4 - RegExp.$1.length));  
    for(var k in o)  
    	if(new RegExp("("+ k +")").test(format))  
    		format = format.replace(RegExp.$1,RegExp.$1.length==1 ? o[k] : ("00"+ o[k]).substr((""+ o[k]).length));  
    	return format;  
    } 
    //console.log("i is ");
    //console.log(i); 
    //	console.log("start is ");
    //	console.log(start);
     uom = new Date(new Date(start)-0+i*86400000); 
		//console.log(uom.getDay());
		//console.log(uom); 
		
		if(in_array(uom.getDay(),datearray))
		{
			//console.log("the date is in array and will add in array");
			uomtemp1=uom;
			uomtemp=uomtemp1.format("yyyy-MM-dd"); 
			var starttime=uomtemp+"T"+time.substring(0,5);
			var endtime=uomtemp+"T"+time.substring(6,11);
			var namestring=name.toString();
			var stringlength=namestring.length;
			var neweventa={
			title  : namestring.substring(1,stringlength-1),
			start  : starttime.toString(),
			end    : endtime.toString()
		}
		//console.log(neweventa);
			//console.log(uom);
			//console.log(time);
			eventarray.push(neweventa);
		}
		//console.log(uom);
	}
	updateevent();

}



function deleteevent(name,time,date,location,start,end)
{
	//console.log("delete event called");
	var namestring=name.toString();
	var stringlength=namestring.length;
	for(var i=0;i<eventarray.length;i++)
	{
		console.log(eventarray[i]);
		if(eventarray[i]['title']==namestring.substring(1,stringlength-1))
		{
			console.log("item found");
					eventarray.splice(i,1);
		i--;
		}

	}
	updateevent();
}

//for select use
function showconetnt(id)
{
	document.getElementById(id).style.display="inline";
	console.log("id is ");
	console.log(id);
	console.log("function called");
}
function hidecontent(id)
{
	console.log(document.getElementById(id).style.color);
	if(document.getElementById(id).style.color=="black"||document.getElementById(id).style.color==""){
		document.getElementById(id).style.display="none";}
		console.log("hide called");
	}
	function courseselect(id,date,time,location,coursename)
	{
		console.log(id);
		console.log(" course get clicked");

		console.log("date is ");
		var datestring=date.toString();
		var stringlength=datestring.length;
		var datea=datestring.substr(1,stringlength-2);
		console.log(datestring.substr(1,stringlength-2));


		console.log("time is ");
		var timestring=time.toString();
		var stringlength=timestring.length;
		console.log(timestring.substring(1,stringlength-1));
		var timea=timestring.substring(1,stringlength-1);

		console.log("location is ");
		var locationstring=location.toString();
		var stringlength=locationstring.length;
		console.log(locationstring.substring(1,stringlength-1));
		var locationa=locationstring.substring(1,stringlength-1);


		if(document.getElementById(id).style.color=="black"||document.getElementById(id).style.color=="")
		{
			document.getElementById(id).style.color="blue";
			addevent(coursename,timea,datea,locationa,"2016-05-01","2016-08-31");
		}
		else {
			document.getElementById(id).style.color="black";
			deleteevent(coursename,timea,datea,locationa,"2016-05-01","2016-08-31");
		}
	}
	function addintocourse()
	{}
	function deletecourse()
	{}
</script>
<style>
	.clearFloat { clear: both; }

	#calendar
	{
		float:left;
		position:relative;
	}
	.course{
		position:relative;
		left: 5px;
		margin:20px;
		width:250px;
		float:left;



	}

	.lec
	{
		float:left;
		position:relative;
	}
	.tut
	{
		float:left;
		position:relative;
	}
	.tst
	{
		float:left;
		position:relative;
	}

	.lec:hover {
		background:rgba(0,0,100,0.5);
		transition: 0.2s;
	}
	.tut:hover {
		background:rgba(0,0,100,0.5);
		transition: 0.2s;
	}
	.tst:hover {
		background:rgba(0,0,100,0.5);
		transition: 0.2s;
	}
	.coursename{
		float:left;
		position:relative;
		left: 2px;
		width:400px;
		font-size: 15pt;
		font-weight:bold;


	}
	.coursenumber{
		float:left;
		position:relative;
		left: 2px;
		width: 125px;


	}
	.time{
		float:left;
		position:relative;
		left: 2px;
		width: 125px;


	}
	.location
	{
		margin-left: 125px;
		float:left;
		position:relative;
		left: 2px;
		width: 125px;
	}
	.else
	{
		margin-left: 125px;
		float:left;
		position:relative;
		left: 2px;
		width: 125px;
	}
	.hidden{
		display:none;
	}



</style>
</head>
<body>
	<?php
	$displaynumber=0;

	$coursearray=$_SESSION['courses'];
//print_r($coursearray);
	displaymain($coursearray);
	function displaymain($coursearray)
	{
//	echo "display main called ";
		global $displaynumber;
		foreach ($coursearray as $key => $value) {
		# code...
			?>
			<div class="course">
				<?php
				displaycourse($value);
			//$displaynumber++;
				?>
			</div>
			<?php
		}
	}
	function displaycourse($array)
	{
		global $displaynumber;
		?>

		<div class="coursename">
			<?php
			$name= $array[0]['coursepre'].$array[0]['coursenumber'];
			echo $name;
			?>
		</div>
		<?php
		for($i=0;$i<sizeof($array);$i++){
			$displaynumber++;
			$tempcoursetype=$array[$i]['coursetype'];
			switch ($tempcoursetype) {
				case 'LEC':

				$value=$array[$i];
				$time=substr($value['coursetime'],0,5)."-".substr($value['coursetime'],-5);
				$date=$value['coursedate'];
				$location=$value['courselocationbuilding']."-".$value['courselocationbuildingroomnumber'];
				$coursename=$array[0]['coursepre'].$array[0]['coursenumber']."--".$tempcoursetype.sprintf("%03d", $value['courselecnum']);
				?>
				<div class="lec" onmouseover="showconetnt(<?php echo $displaynumber;?>)" onmouseout="hidecontent(<?php echo $displaynumber;?>)" onclick="courseselect(<?php echo $displaynumber;?>,<?php echo "/".$date."/";?>,<?php echo "/".$time."/";?>,<?php echo "/".$location."/";?>,<?php echo "/".$coursename."/";?>)">
					<div class="coursenumber">
						<?php
						echo $tempcoursetype;
						echo "  ";
						echo sprintf("%03d", $value['courselecnum']);?>
					</div>
					<div class="time">
						<?php

						echo $time;
						echo "   ";

						echo $value['coursedate'];
						?>
					</div>
					<div id=<?php echo $displaynumber;?> class="hidden">
						<div class="location" >
							<?php
							echo "Campus: ";
							echo $value['courselocation'];
							echo "<br>";
							echo "Building name: ";
							echo $value['courselocationbuilding'];
							echo "<br>";
							echo "Room number: ";
							echo $value['courselocationbuildingroomnumber'];
							echo "<br>";?>
						</div>
						<div class="else" >
							<?php
							$temp=$value['courseinstructors'];
							echo "Instructor :  $temp";
							echo "<br>";
							$temp1=$value['enrollment_capacity'];
							$temp2=$value['enrollment_total'];
							$remain=$temp1-$temp2;
							echo "remaining seats : $remain";
							echo "<br>";
							$temp=$value['waiting_total'];
							echo "waiting list : $temp";?>
						</div>
					</div>
					<div class="clearFloat"></div>
				</div>

				<?php
				break;
				case 'TUT':

				$value=$array[$i];
				$time=substr($value['coursetime'],0,5)."-".substr($value['coursetime'],-5);
				$date=$value['coursedate'];
				$location=$value['courselocationbuilding']."-".$value['courselocationbuildingroomnumber'];
				$coursename=$array[0]['coursepre'].$array[0]['coursenumber']."--".$tempcoursetype.sprintf("%03d", $value['courselecnum']);
				?>
				<div class="tut" onmouseover="showconetnt(<?php echo $displaynumber;?>)" onmouseout="hidecontent(<?php echo $displaynumber;?>)" onclick="courseselect(<?php echo $displaynumber;?>,<?php echo "/".$date."/";?>,<?php echo "/".$time."/";?>,<?php echo "/".$location."/";?>,<?php echo "/".$coursename."/";?>)">
					<div class="coursenumber">
						<?php
						echo $tempcoursetype;
						echo "  ";
						echo sprintf("%03d", $value['courselecnum']);?>
					</div>
					<div class="time">
						<?php

						echo $time;
						echo "   ";

						echo $value['coursedate'];
						?>
					</div>
					<div id=<?php echo $displaynumber;?> class="hidden">
						<div class="location" >
							<?php
							echo "Campus: ";
							echo $value['courselocation'];
							echo "<br>";
							echo "Building name: ";
							echo $value['courselocationbuilding'];
							echo "<br>";
							echo "Room number: ";
							echo $value['courselocationbuildingroomnumber'];
							echo "<br>";?>
						</div>
						<div class="else" >
							<?php
							$temp=$value['courseinstructors'];
							echo "Instructor :  $temp";
							echo "<br>";
							$temp1=$value['enrollment_capacity'];
							$temp2=$value['enrollment_total'];
							$remain=$temp1-$temp2;
							echo "remaining seats : $remain";
							echo "<br>";
							$temp=$value['waiting_total'];
							echo "waiting list : $temp";?>
						</div>
					</div>
					<div class="clearFloat"></div>
				</div>
				<?php
				break;
				case 'TST':

				$value=$array[$i];
				$time=substr($value['coursetime'],0,5)."-".substr($value['coursetime'],-5);
				$date=$value['coursedate'];
				?>
				<div class="tst" onmouseover="showconetnt(<?php echo $displaynumber;?>)" onmouseout="hidecontent(<?php echo $displaynumber;?>)" >
					<div class="coursenumber">
						<?php
						echo $tempcoursetype;
						echo "  ";
						echo sprintf("%03d", $value['courselecnum']);?>
					</div>
					<div class="time">
						<?php

						echo $time;
						echo "   ";

						echo $value['coursedate'];
						?>
					</div>
					<div id=<?php echo $displaynumber;?> class="hidden">
						<div class="location" >
							<?php
							echo "Campus: ";
							echo $value['courselocation'];
							echo "<br>";
							echo "Building name: ";
							echo $value['courselocationbuilding'];
							echo "<br>";
							echo "Room number: ";
							echo $value['courselocationbuildingroomnumber'];
							echo "<br>";?>
						</div>
						<div class="else" >
							<?php
							$temp=$value['courseinstructors'];
							echo "Instructor :  $temp";
							echo "<br>";
							$temp1=$value['enrollment_capacity'];
							$temp2=$value['enrollment_total'];
							$remain=$temp1-$temp2;
							echo "remaining seats : $remain";
							echo "<br>";
							$temp=$value['waiting_total'];
							echo "waiting list : $temp";?>
						</div>
					</div>
					<div class="clearFloat"></div>
				</div>
				<?php
				break;


			}
		}




	}
	?>


	<div id='calendar'></div>
	<!<input type="button" onclick="updateevent()" value="Add new table">

</body>
</html>