<!DOCTYPE html>
<html>
<head>
    <title>Guess The Number</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <h1>Guess The 10 Number!!</h1>
    <form action="game.php" method="POST">
        Your Name: <input type="text" name="username" required><br>
        Set minimum: <input type="number" name="min_range" required><br>
        Set maximum: <input type="number" name="max_range" required><br>
        Max Number Of Tries: <input type="number" name="max_tries" required><br>
        Max Number Of Seconds: <input type="number" name="max_time" required><br>
        Show Session info? <input type="checkbox" name="show_session" value="1"><br>
        <input type="submit" value="Start Guessing">
    </form>
</body>
</html>
