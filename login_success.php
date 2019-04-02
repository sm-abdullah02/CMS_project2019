<?php
session_start();


if(isset($_SESSION['user_name'])){
	echo "<p>Login success. Welcome ".$_SESSION['user_name']."</p>";
	echo "<a href='index.php'>Home</a>"."<br>";		
	echo "<a href='logout.php'>Log out</a>";	
}else{
	header("location:login.php");
}

?>

<?php

/*	
  define('ADMIN_LOGIN','$_POST['user_name']');

  define('ADMIN_PASSWORD','$_POST['pass']');


  if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW'])

      || ($_SERVER['PHP_AUTH_USER'] != ADMIN_LOGIN)

      || ($_SERVER['PHP_AUTH_PW'] != ADMIN_PASSWORD)) {

    header('HTTP/1.1 401 Unauthorized');

    header('WWW-Authenticate: Basic realm="Our Blog"');

    exit("Access Denied: Username and password required.");

  } 
  */ 

?>


<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>


	

</body>
</html>