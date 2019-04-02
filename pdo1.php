<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "travelogy";


try 
    {
        $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        

        $stmt = $conn->prepare("INSERT INTO post_p (post_id, user_id, post_date, heading, image_id, description) 
    VALUES (:post_id, :user_id, :post_date, 
            :heading, :image_id, :description)");

    $stmt->bindParam(':post_id', $post_id);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':post_date', $post_date);
    $stmt->bindParam(':heading', $heading);
    $stmt->bindParam(':image_id', $image_id);
    $stmt->bindParam(':description', $description);

    echo "New records created successfully";

    $article = new Article($pdo);
    }
catch(PDOException $e)
    {
        echo "Error: ".$e->getMessage();
    }

class Article {

    protected $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function fetch_all() {

        $query = $this->pdo->prepare("SELECT * FROM post_p ORDER BY `post_date` ASC");
        $query->execute();

        return $query->fetchAll();
    }

    public function fetch_data($post_id) {
        // note this:
        $query = $this->pdo->prepare("SELECT * FROM post_p WHERE post_id=1");
        $query->bindValue(1, $post_id);
        $query->execute();

        return $query->fetch();
    }
}



var_dump($article->fetch_data($post_id));

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title></title>
</head>
<body>

<h1> <?= $query->rowCount() ?>Row</h1>

<p></p>


</body>
</html>