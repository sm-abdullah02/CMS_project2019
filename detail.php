<?php
session_start();

require 'pdo.php';

//$upload = filter_input(INPUT_FILE, );
//filter_input
$post_id = filter_input(INPUT_GET, 'post_id');

if($post_id){
	if(!is_numeric($post_id))header('Location:index.php');
	$query = "SELECT * FROM post_p where post_id=".$post_id;	
	$result = $conn->query($query);

	$image_query = "SELECT * FROM images WHERE post_id=".$post_id;
	$result_image = $conn->query($image_query);
	
}


     
    $user_id = $_SESSION['user_id'];
   //$user_id = 66;

   if(isset($_FILES['upload'])){
      $errors= array();
      $file_name  =$_FILES['upload']['name'];
      $file_size  =$_FILES['upload']['size'];
      $file_tmp   =$_FILES['upload']['tmp_name'];
      $file_type  =$_FILES['upload']['type'];
      $file_ext   =strtolower(end(explode('.',$_FILES['upload']['name'])));

      $expensions= array("jpeg","jpg","png", "pdf");
      
      if(in_array($file_ext, $expensions)=== false){
         $errors[]="extension not allowed, please choose a JPEG, PDF or PNG file.";
      }
      
      if($file_size > 2097152){
         $errors[]='File size must be less than 2 MB';
      }
      
      if(empty($errors)==true){
         	move_uploaded_file($file_tmp,"images/".$file_name);
            $insert_iamge_query = "INSERT INTO images (image, post_id, user_id ) VALUES(:image, :post_id, :user_id)";  
            $statement      = $conn->prepare($insert_iamge_query);

            $statement->bindValue(':image', $file_name);
            $statement->bindValue(':post_id', $post_id);
            $statement->bindValue(':user_id', $user_id);

            $statement->execute();
            $insert_id = $conn->lastInsertId();

         echo "Success"; 
         header("location: detail.php?post_id=".$post_id);
      }else{
         print_r($errors);
      }
   }

  // session_destroy();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Read details of my Journey</title>
	<link rel="stylesheet" type="text/css" href="index.css">
</head>
<body>
	<?php 
	if($result->rowCount() >0):
		while($row =$result->fetch()): ?>

			<b>Title: </b> <?= $row["heading"] ?> <br />
			<b>Description: </b><?= $row['description'] ?>
			<?= date('M d,Y h:m A',strtotime($row["post_date"]))."<a href='update.php?post_id=". $row["post_id"]. "'>  Edit</a><a href ='index.php?post_id=".$row["post_id"]. "'> back home</a><br>"; ?>

		<?php endwhile ?>
	<?php endif ?>

	<?php
	if($result_image->rowCount() >0){
		echo "Images are: </br>";  //how to load image in details page. from image table? every reload creating new database enty			
		while($row = $result_image->fetch()){
			echo '<img id="images" src="images/'.$row['image'].'"/>';
		} 		
	}else{ echo "0 image."; }
	?>

	<?php 
		/*  
		if ($a > $b):
		    echo $a." is greater than ".$b;
		elseif ($a == $b): // Note the combination of the words.
		    echo $a." equals ".$b;
		else:
		    echo $a." is neither greater than or equal to ".$b;
		endif;
		*/
	?>


	<form action="" method="POST", enctype="multipart/form-data">
        <ul>
            <li>
                <label for="upload">Upload photo: <br></label>
                <input type="file" name="upload" id="upload">
                <br>
                <label for="btn_upload">Click for upload the file: </label>
                <input type="submit" name="btn_upload" id="btn_upload">
            </li>
        </ul>
    </form>  
</body>
</html>
