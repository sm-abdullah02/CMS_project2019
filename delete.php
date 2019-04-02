 <?php 



$servername = "localhost";
$username = "root";
$password = "";
$dbname = "travelogy";

$conn = null;
$post_id = filter_input(INPUT_GET, 'post_id');
//$id = $_POST['post_id'];  //protect from sql injection

try {
	$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);	 
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	 	
	} 
catch (PDOException $e) {
	echo "Connection error: ".$sql."<br>".$e->getMessage();
	}

	if($post_id){
		
		$sql = "DELETE FROM post_p WHERE post_id=$post_id";
					//$sql = "DELETE FROM post_p WHERE post_id".$post_id;
					//$sql =  "DELETE FROM post_p WHERE post_id ='{$post_id}'";

		$conn->exec($sql);
		echo "Record deleted successfully";

		//var_dump(post_id);

	}


//var_dump($post_id);

 
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title></title>
</head>
<body>

<p><a href='index.php'>back</a></p>

</body>
</html>




