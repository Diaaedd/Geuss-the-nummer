<?php

function database()
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "guess-the-nummer";

    try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
    die ("Connection failed: " . $e->getMessage());
    }
    return $conn;
}
function saveHighScore($username, $numTries, $timeSpent) {
    $conn = database();
    $score = 1000 / ($numTries + $timeSpent);  // Example scoring function: adjust as needed
    $stmt = $conn->prepare("INSERT INTO high_scores (username, score, datum, num_tries, time_spent) VALUES (:username, :score, now(), :num_tries, :time_spent)");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':score', $score);
    $stmt->bindParam(':num_tries', $numTries);
    $stmt->bindParam(':time_spent', $timeSpent);
    $stmt->execute();
}

function htmlHead()
{
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Guess The Number</title>
        <link rel="stylesheet" type="text.css" href="css/style.css">
    </head>
    <body>
    <?php
}

function htmlFoot()
{
    ?>
    <footer>&copy; 2024</footer>
    </body>
</html>
    <?php
}
?>
