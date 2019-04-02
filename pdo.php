<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "travelogy";


$conn = null;
try{
    $conn= new PDO("mysql:host=$servername; dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Server Connected.";
}
catch(PDOException $e){
    echo "Error: ".$e->getMessage();
}

?>