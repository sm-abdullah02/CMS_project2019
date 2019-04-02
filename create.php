<?php

$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "travelogy";

$user_id    = filter_input(INPUT_POST, 'user_id');
$post_date  = filter_input(INPUT_POST, 'post_date'); 
$heading    = filter_input(INPUT_POST, 'heading');
$image_id   = filter_input(INPUT_POST, 'image_id');
$description  = filter_input(INPUT_POST, 'description');

if($_POST){

    try{

        if($image_id===null){$image_id = 9;}

        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        //$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $heading  = filter_input(INPUT_POST, 'heading', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                         
        //post_id, post_date deleted
        $insert_query   = "INSERT INTO post_p (user_id, heading, image_id, description) VALUE(:user_id, :heading, :image_id, :description)";
        $statement      = $conn->prepare($insert_query);
         
        $statement->bindValue(':user_id', $user_id);     
        $statement->bindValue(':heading', $heading);
        $statement->bindValue(':image_id', $image_id);
        $statement->bindValue(':description', $description);

        $statement->execute();

        $insert_id = $conn->lastInsertId();
        echo "You create description successfully.".$insert_id;  
    }
    catch(PDOExeption $e){
        echo "Error: ".$e->getMessage();
    } 
}

?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Create you journey description</title>
</head>
<body>
    <h2>Create you journey description</h2> 
    
    <form action = "<?php $_PHP_SELF ?>" method = "POST" enctype="multipart/form-data">
        <ul style= "list-style-type: none";>
            <li>
                <label for="heading">Heading of your journey</label><br>
                <input type="text" name="heading" id="heading" value="<?=$heading?>"><br>
            </li>
            <li>
                <label for ="description">Tell us about your journey</label><br>
                <textarea name="description" id="description"><?= $description ?></textarea>
            </li>
            
            <li>
                <label for="user_id">User ID</label><br>
                <input type="text" name="user_id" id="user_id" value="<?=$user_id?>"><br>
            </li>
            <li>
                <input type="submit" name="btn_submit" id="btn_submit" value="Submit">
            </li>
            <li>
                <a href="index.php"> Back to Home</a>
            </li>
        </ul>
    </form>
    <!-- <form action="detail.php" method="POST", enctype="multipart/form-data">
        <ul>
            <li>
                <label for="upload">Upload photo: <br></label>
                <input type="file" name="upload" id="upload">
                <br>
                <label for="btn_upload">Click for upload the file: </label>
                <input type="submit" name="btn_upload" id="btn_upload">
            </li>
            <li>
              <a href="detail.php">Read detail</a>
            </li>
        </ul>
    </form>   --> 

</body>
</html>