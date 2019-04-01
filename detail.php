<?php

require 'pdo.php';

if($_GET['post_id']){
	if(!is_numeric($_GET['post_id']))header('Location:index.php');
	$query = "SELECT * FROM post_p where post_id=".$_GET['post_id'];
	$result = $conn->query($query);

	if($result->rowCount() >0){
		while($row =$result->fetch()){
			echo "<b>Title: </b>".$row["heading"]."<br>";
			echo "<b>Description: </b>".$row['description']."<br>";
			echo date('M d,Y h:m A',strtotime($row["post_date"]))."<a href='update.php?post_id=". $row["post_id"]. "'>  Edit</a><a href ='index.php?post_id=".$row["post_id"]. "'> back home</a><br>";
		}
	} else{echo "0 results";}
}


?>
