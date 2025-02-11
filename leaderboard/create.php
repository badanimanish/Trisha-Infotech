<?php
// Database connection setup
$host = 'localhost';
$db   = 'leaderboard_db';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $points = $_POST['points'];
    $wins = $_POST['wins'];
    $losses = $_POST['losses'];
    $lastActivity = $_POST['last_activity'];

    $sql = "INSERT INTO user_stats (Username, Points, Wins, Losses, LastActivity) VALUES (?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$username, $points, $wins, $losses, $lastActivity]);

    header("Location: leaderboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User</title>
</head>
<body>

<h2>Create New User</h2>
<form method="POST">
    <label>Username:</label>
    <input type="text" name="username" required><br>

    <label>Points:</label>
    <input type="number" name="points" required><br>

    <label>Wins:</label>
    <input type="number" name="wins" required><br>

    <label>Losses:</label>
    <input type="number" name="losses" required><br>

    <label>Last Activity:</label>
    <input type="datetime-local" name="last_activity" required><br>

    <button type="submit">Create User</button>
</form>
<a href="leaderboard.php">Back to Leaderboard</a>

</body>
</html>
