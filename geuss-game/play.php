<?php  
session_start();

// Initialize previous_guesses as an array if it's not set
if (!isset($_SESSION['previous_guesses'])) {
    $_SESSION['previous_guesses'] = [];
}

include 'config.php';
include 'functions.php'; // Include this at the top to use saveHighScore

if (!isset($_SESSION['secret_number'])) {
    // If the game hasn't been properly initialized, redirect to the start page
    header('Location: index.php');
    exit;
}

$gameOver = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['guess'])) {
    $guess = filter_input(INPUT_POST, 'guess', FILTER_SANITIZE_NUMBER_INT);
    $_SESSION['num_tries']++;

    $_SESSION['previous_guesses'][] = $guess;

    if ($guess == $_SESSION['secret_number']) {
        $totalTime = time() - $_SESSION['start_time'];
        $message = "Congratulations, {$_SESSION['username']}! You guessed the right number, it take you $totalTime seconds!";

       
        $gameOver = true;
        saveHighScore($_SESSION['username'], $_SESSION['num_tries'], $totalTime);
    } elseif ($_SESSION['num_tries'] >= $_SESSION['max_tries']) {
        $message = "Sorry, you've used all your tries. The number was {$_SESSION['secret_number']}.";
        $gameOver = true;
    } elseif ((time() - $_SESSION['start_time']) > $_SESSION['max_time']) {
        $message = "Time's up! The number was {$_SESSION['secret_number']}.";
        $gameOver = true;
    } elseif ($guess < $_SESSION['secret_number']) {
        $message = "Your guess is too low.";
    } else {
        $message = "Your guess is too high.";
    }
}

if ($gameOver) {
    session_destroy();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Guess The Number</title>
</head>
<body>
    <h1>Guess The Number Game</h1>
    <?php if (isset($message)): ?>
        <p><?php echo $message; ?></p>
    <?php endif; ?>

    <?php if (!$gameOver): ?>
        <form method="post">
            <label for="guess">Enter your guess:</label>
            <input type="number" id="guess" name="guess" required>
            <button type="submit">Submit</button>
        </form>
        <p>Attempts: <?php echo $_SESSION['num_tries']; ?> | Time left: <?php echo $_SESSION['max_time'] - (time() - $_SESSION['start_time']); ?> seconds</p>
        <p>Previous guesses: <?php echo implode(", ", $_SESSION['previous_guesses']); ?></p>
    <?php else: ?>
        <a href="index.php">Play Again</a> | <a href="highscores.php">High Scores</a>
    <?php endif; ?>
</body>
</html>
