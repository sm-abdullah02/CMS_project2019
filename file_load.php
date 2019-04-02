<?php

require 'pdo.php';

$image = filter_input(INPUT_POST, 'image');


   if(isset($_FILES['image'])){
      $errors= array();
      $file_name  =$_FILES['image']['name'];
      $file_size  =$_FILES['image']['size'];
      $file_tmp   =$_FILES['image']['tmp_name'];
      $file_type  =$_FILES['image']['type'];
      $file_ext   =strtolower(end(explode('.',$_FILES['image']['name'])));
      
      $expensions= array("jpeg","jpg","png", "pdf");
      
      if(in_array($file_ext, $expensions)=== false){
         $errors[]="extension not allowed, please choose a JPEG, PDF or PNG file.";
      }
      
      if($file_size > 2097152){
         $errors[]='File size must be less than 2 MB';
      }
      
      if(empty($errors)==true){
         move_uploaded_file($file_tmp,"images/".$file_name);
           // $insert_iamge_query = "INSERT INTO images (image) VALUE(:image) WHERE post_id = post_id AND user_id = user_id";  
           // $statement->bindValue(':image', $image);
           // $statement->execute();
           // $insert_id=$conn->lastInsertId();

         echo "Success";
      }else{
         print_r($errors);
      }
   }
?>


<html>
   <body>
      <hr>
      <form action="" method="POST" enctype="multipart/form-data">
        <ul>
            <li>
                <input type="file" name="image" />
                <input type="submit"/>
            </li>
            <li>
                <a href="index.php">Home</a>
                <a href="detail.php">Read detail</a>
            </li>
        </ul>
         
      </form>
      <hr>
   </body>

















<!-- https://cloudinary.com/blog/file_upload_with_php -->
<!-- https://github.com/gumlet/php-image-resize -->
 
</html>



