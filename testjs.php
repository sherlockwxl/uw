<?php
session_start();
$coursearray=$_SESSION['courses'];
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<script type="text/javascript">
var arraytemp=eval('<?php echo json_encode($coursearray);?>');
console.log(arraytemp.length);
</script>
<body>

</body>
</html>