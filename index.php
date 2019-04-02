<?php
session_start();
$_SESSION["welcome"] = "Welcome to my travelogy";

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "travelogy";

$conn = null;

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // prepare sql and bind parameters
    $query= $conn->prepare("SELECT * FROM post_p ORDER BY post_date DESC");
    $query->execute();
    
    echo "New records select successfully. \n"."<br>";
    echo "<h1>"."Welcome to my travelogy"."</h2>";

    if(isset($_SESSION['user_name'])){
      echo "<h2>Welcome back ".$_SESSION['user_name']."!</h2><br>";
     } 

    }
catch(PDOException $e)
    { echo "Error: ".$e->getMessage();  }

   // $count = $query->rowCount();
    if ($query->rowCount() > 0) {
        // output data of each row
        while($row = $query->fetch()) {
            echo "<b> Title: </b>" . $row["heading"]. "<br>";

            if(strlen($row["description"]) > 100){
                echo "<b>Description:</b>" . substr($row["description"],0, 200). "..."."<a href='detail.php?post_id=".$row["post_id"]."'><br>Read Full Post</a><br>";
            }else{
                echo "<b>Description:</b>" .$row["description"]."<br>";
            }           
            echo date('M d,Y h:m A',strtotime($row["post_date"]))."<br>"."<a href='update.php?post_id=". $row["post_id"]. "'> edit </a><a href='delete.php?post_id=". $row["post_id"]. "'> delete </a><a href='create.php'>create </a><br>";                  
        }
    } else {
        echo "0 results";
    }

    


?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>My travel log</title>
    <link rel="stylesheet" type="text/css" href="index.css">
</head>
<body>
    <h1><?= $_SESSION["welcome"]."<br>"?></h1>

<div id="index_footer">
    <ul>
        <li><a href="login.php">Login</a></li>
        <li><a href="create_user.php">Create your profile</a></li>
        <li><a href="logout.php">Log out</a></li>
        <li><a href="create.php">Create your blog</a></li>
    </ul>
</div>
<p>Found <?= $query->rowCount() ?>Rows</p>

<!-- <ul> -->    
    <?php while($row = $query->fetch()): ?>
        <div id="user_post">
        	<ul style="list-style-type: none">
	        	<li>
		            <?= $row["heading"] ?>                
		        </li>
		        <LI>
		            <p><?= $row["post_date"]."<br>" ?> </p>
		            <p>Post id: <?= $row["post_id"] ?></p>
		            <p>User: <?= $row["user_id"] ?> </p> 
		        </LI>
		        <li>
		            <p>Description: <?= $row["description"]."<br>" ?></p>
		        </li>
		        <li>
		          <p>Image <?= $row["image_id"] ?></p>  
		        </li>                 
		        <li>
			        <a href="create.php">Create</a>
					<a href="delete.php">Delete</a>
					<a href="update.php">Update</a>
                    <a href="pdo.php">PDO</a>
		        </li>
        	</ul>
	                 
       </div> 
    <?php endwhile ?>    
    
    
<!-- </ul> -->
<h1> </h1>
</body>
</html>