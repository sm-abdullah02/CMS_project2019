<?php
session_start();

$servername = "localhost";
$username	= "root";
$password 	= "";
$dbname		= "travelogy";

$conn = null;
//$btn_login 	 = $_POST['btn_login'];
$user_name   = filter_input(INPUT_POST, 'user_name');
$pass    	 = filter_input(INPUT_POST, 'pass');

try{
	$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	echo "Connection successfull.";
}
catch(PDOException $e){
	echo "Error: ".$e->getMessage();
}

if($_POST){
//	 

	if(!$user_name || !$pass){
		echo "Required."; 	}else{

		$login_query= "SELECT * FROM user WHERE user_name = :user_name AND pass = :pass";
		$statement = $conn->prepare($login_query);		

		$statement->bindValue(':user_name', $user_name);
		$statement->bindValue(':pass', $pass);

		$statement->execute();

		$count = $statement->rowCount();

		if($count > 0){
			$row =$statement->fetch();
			$_SESSION['user_name'] = $user_name;
			$_SESSION['user_id'] = $row['u_id'];
				header("location:index.php");

		}else{
			$message = "Wrong Data";
		}


	} //if(empty($_POST['user_name']) 

	 

}  //if($_POST['btn_login']){


?>

<!DOCTYPE html>
<html>
<head>
	<title>login</title>
</head>
<body>

<?php  
	if(isset($message)){ echo $message;
}
?>



<form action=" " method="post">
	<ul  style= "list-style-type: none";>
		<li>
			<label for="user_name">User Name: </label>
			<input type="text" name="user_name" id="user_name">
		</li>
		<li>
			<label for="pass">Password: </label>
			<input type="password" name="pass" id="pass">
		</li>
		<li>
			<input type="submit" name="btn_login" id="btn_login" value="Log in">
		</li>
	</ul>
</form>

</body>
</html>