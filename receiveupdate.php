<?php
include "update.php";
$subject=$_GET['subject'];
$number=$_GET['number'];
update($subject,$number,'1165');
deletenull('courses');
echo "update $subject $number done";
?>
