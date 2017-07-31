<?php
$connect=mysqli_connect("localhost","root","1234","table1");
if (!$connect) {
	die("connection Failed".mysqli_connect_error());
}
 ?>