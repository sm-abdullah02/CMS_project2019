<?php 

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "travelogy";

// var_dump($_POST);
$conn = null;
try{
	$conn = new PDO("mysql:host=$servername; dbname=$dbname",$username, $password);
//---------------------------------------------
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	//$error_info = $conn->error_info();
//--------------------------------------------
	echo "Updated successfully \n".'</br>';
}
catch(PDOException $e){
	echo "Update error: ". $e->getMessage();
}


$user_id 	= filter_input(INPUT_POST, 'user_id');
$post_id 	= filter_input(INPUT_GET, 'post_id');	
$post_date 	= filter_input(INPUT_POST, 'post_date'); 
$image_id 	= 1;
//sanitization
$heading  	 = filter_input(INPUT_POST, 'heading', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_FULL_SPECIAL_CHARS);


	    //get the post first then update
	    $get_post ="SELECT heading, description, post_id, user_id 
	    			FROM post_p 
	    			WHERE post_id = :post_id";
	    $statement = $conn->prepare($get_post);
	    $statement->bindValue(":post_id",$post_id, PDO::PARAM_INT);
	   // $conn->prepare($get_post);
	    $statement->execute();
	    $row = $statement->fetch();
	    //if rowcount is 0, error



if($_POST){

	   
	    // binder
	    $update_query    = "UPDATE post_p 
	    					SET heading = :heading, description = :description 
	    					WHERE post_id = :post_id";
	    					//    			SET heading = :heading, description = :description, post_id = :post_id, user_id= ;user_id 

	    $statement = $conn->prepare($update_query);
	    $statement->bindValue(':heading', $heading);        
	    $statement->bindValue(':description', $description);
	    $statement->bindValue(':post_id', $post_id, PDO::PARAM_INT);    
	    // Execute the INSERT.
	    $statement->execute();
	    header('Location:index.php');
	    exit();
} 
?>

<!DOCTYPE html>

<html lang="en">
<head>
	<title></title>
	<meta charset="utf-8">
</head>
<body>
	<h1><a href="blog.php">My Amaizing journey</a></h1>
	<form method="POST">
		<label for="heading">Title</label>
		<br>
		<input type="text" id="heading" name="heading" value='<?= $row['heading']?>'>
		<br>
		<label for="description">Description</label>	 	
		<br>
		<textarea name="description" id="description" rows="5" cols="50"><?= $row['description']?></textarea>

		<br>
		<input type="submit" name="submit" value="submit">
		<input type="reset" name="delete" value="Delete">
	</form>
	<ul>
		<li>
			<a href="index.php">Home</a> 
			<a href="delete.php">Delete</a>			 
        </li>
	</ul>



</body>
</html>
