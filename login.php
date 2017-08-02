<?php
$login = false; 
if (isset($_POST['submit'])){


$name =$_POST['username'];
$pass = $_POST['password'];


if($name == "onggobit" && $pass == "123")
{
$login = true;
}
else
{
	echo "MALI PO";
}




}



if($login == true)
{
	header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/content.php");
}
 /*
if (isset($_SESSION['badlogin']))
  $_SESSION['badlogin']++;
else
  $_SESSION['badlogin']=1;
  */


/*End of main Submit conditional*/

?>


<html>
	<head>
		<title>Log-In</title>
		<link href='css/login.css' rel='stylesheet'>
		<link href='https://fonts.googleapis.com/css?family=Bitter:400,700' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Raleway:300,200italic' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Oswald:300' rel='stylesheet' type='text/css'>
	</head>
	
	<body>
		<div class="block">
			
			<h1></h1>
			
			<div class="message">
				<p>Please log-in.</p>
				
				<div class="form">
					<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
						<p><input type="text" name="username" placeholder="Username" size=20 required></p>
						<p><input type="password" name="password" placeholder="Password" size=20 required></p>
						<p><input type="submit" name="submit" value="LOG IN" size=20></p>
					</form>
				</div>
			</div>
		</div>
	</body>
</html>