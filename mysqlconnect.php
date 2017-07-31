<?php
$dbc=mysqli_connect("localhost","root","1234","students");
if (!$dbc) {
	die("connection Failed".mysqli_connect_error());
}
else
	//echo "Connection Successfull";
 ?>