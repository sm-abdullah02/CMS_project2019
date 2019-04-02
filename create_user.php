<?php

$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "travelogy";

$email  = filter_input(INPUT_POST, 'email');
$f_name = filter_input(INPUT_POST, 'f_name');
$pass   = filter_input(INPUT_POST, 'pass');
$pass2   = filter_input(INPUT_POST, 'pass2');
$user_name  = filter_input(INPUT_POST, 'user_name');
$u_id   = filter_input(INPUT_POST, 'u_id');
$zip    = filter_input(INPUT_POST, 'zip'); 


if($_POST){

    try{

        
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        //$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $email  = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $f_name = filter_input(INPUT_POST, 'f_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $pass   = filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $user_name = filter_input(INPUT_POST, 'user_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $u_id   = filter_input(INPUT_POST, 'u_id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $Zip    = filter_input(INPUT_POST, 'zip', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                         
        $insert_user_query   = "INSERT INTO user (email, f_name, pass, user_name, u_id, zip) VALUE(:email, :f_name, :pass, :user_name, :u_id, :zip)";
        $statement      = $conn->prepare($insert_user_query);
         
        $statement->bindValue(':email', $email);     
        $statement->bindValue(':f_name', $f_name);
        $statement->bindValue(':pass', $pass);
        $statement->bindValue(':user_name', $user_name);
        $statement->bindValue(':u_id', $u_id);
        $statement->bindValue(':zip', $zip);

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
    <title>Create your login</title>
</head>
<body>
    <h2>Create your information</h2> 
    
    <form action = "<?php $_PHP_SELF ?>" method = "POST">
        <ul style= "list-style-type: none";>
            <li>
                 <label for="email">Email</label><br>
                <input type="text" name="email" id="email" value="<?=$email?>"><br>
            </li>
            <li>
                <label for ="f_name">Your full name: </label><br>
                <input type="text" name="f_name" id="f_name" value="<?=$f_name?>"><br>
            </li>
            <li>
                <label for="pass">Your password: </label><br>
                <input type="password" name="pass" id="pass" value="<?=$pass?>"><br>
            </li>
            <li>
                <label for="pass2">Re-type your password: </label><br>
                <input type="password" name="pass2" id="pass2" value="<?=$pass2?>"><br>
            </li>
            <li>
                <label for="user_name">Your user name: </label><br>
                <input type="text" name="user_name" id="user_name" value="<?=$user_name?>"><br>
            </li>             
            <li>
                <label for="zip">Zip Code: </label><br>
                <input type="text" name="zip" id="zip" value="<?=$zip?>"><br>
            </li>
            <li>
                <input type="submit" name="btn_submit" id="btn_submit" value="Submit">
            </li>
            <li>
                <a href="login.php"> Back to Login</a><br>
                <a href="index.php"> Back to Home</a>
            </li>
        </ul>
    </form>   

</body>
</html>