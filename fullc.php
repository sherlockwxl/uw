<!DOCTYPE html>
<html>
<head>
	<title></title>
<link rel='stylesheet' href='./fullcalendar/fullcalendar.css' />
<script src='./fullcalendar/lib/jquery.min.js'></script>
<script src='./fullcalendar/lib/moment.min.js'></script>
<script src='./fullcalendar/fullcalendar.js'></script>
<script type="text/javascript">
var eventarray=[
        {
            title  : 'event1',
            start  : '2016-03-03'
        },
        {
            title  : 'event2',
            start  : '2016-03-05',
            end    : '2016-03-06'
        },
        {
            title  : 'event3',
            start  : '2016-03-04T12:30:00',
            allDay : false // will make the time show
        }
    ];
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
	var newevent=
        {
            title  : 'event4',
            start  : '2016-03-01'
        };
	eventarray={
    events: [
        {
            title: 'Event1',
            start: '2016-03-04T12:30:00',
            end:'2016-03-04T12:45:00',
        },
        {
            title: 'Event2',
            start: '2016-03-04T12:30:00',
               end:'2016-03-04T13:45:00',        
        }
        // etc...
    ],

};
	console.log(eventarray);
	$('#calendar').fullCalendar('removeEvents');
	$('#calendar').fullCalendar('addEventSource', eventarray);
	$('#calendar').fullCalendar('rerenderEvents');
}
function isOverlapping(event){
    // "calendar" on line below should ref the element on which fc has been called 
    var array = calendar.fullCalendar('clientEvents');
    for(i in array){
        if (event.end >= array[i].start && event.start <= array[i].end){
           return true;
        }
    }
    return false;
}
</script>
</head>
<body>
<div id=courseselection></div>
<div id='calendar'></div>
<input type="button" onclick="updateevent()" value="Add new table">

</body>
</html>