<?php
include 'config.php'; 

echo "<h1>High Scores</h1>";

$stmt = $conn->prepare("SELECT username, score, datum FROM high_scores ORDER BY score DESC LIMIT 10");
$stmt->execute();
$highScores = $stmt->fetchAll(PDO::FETCH_ASSOC);

//var_dump($highScores); // This line is commented out so it won't execute

?>
<table border="1">
    <thead>
        <tr>
            <th>user</th>
            <th>score</th>
            <th>datum</th>
        </tr>
    </thead>
    <tbody>
    <?php
    foreach ($highScores as $score) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($score['username']) . "</td>";
        echo "<td>" . $score['score'] . "</td>";
        echo "<td>" . $score['datum'] . "</td>";
        echo "</tr>";
    }
    ?>
    
    </tbody>
</table>
<!-- Play Again link with a class for styling -->
<p class="play-again">
    <a href="index.php" class="play-again-button">Play Again</a>
</p>
