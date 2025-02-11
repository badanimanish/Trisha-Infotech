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

// Fetch user data
if (isset($_GET['user_id'])) {
    $userID = $_GET['user_id'];
    $stmt = $pdo->prepare("SELECT * FROM user_stats WHERE UserID = ?");
    $stmt->execute([$userID]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$user) {
        die("User not found.");
    }
} else {
    die("Invalid request.");
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $points = $_POST['points'];
    $wins = $_POST['wins'];
    $losses = $_POST['losses'];
    $lastActivity = $_POST['last_activity'];

    $sql = "UPDATE user_stats SET Username = ?, Points = ?, Wins = ?, Losses = ?, LastActivity = ? WHERE UserID = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$username, $points, $wins, $losses, $lastActivity, $userID]);

    header("Location: leaderboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
</head>
<body>

<h2>Update User</h2>
<form method="POST">
    <label>Username:</label>
    <input type="text" name="username" value="<?= htmlspecialchars($user['Username']) ?>" required><br>

    <label>Points:</label>
    <input type="number" name="points" value="<?= $user['Points'] ?>" required><br>

    <label>Wins:</label>
    <input type="number" name="wins" value="<?= $user['Wins'] ?>" required><br>

    <label>Losses:</label>
    <input type="number" name="losses" value="<?= $user['Losses'] ?>" required><br>

    <label>Last Activity:</label>
    <input type="datetime-local" name="last_activity" value="<?= date('Y-m-d\TH:i', strtotime($user['LastActivity'])) ?>" required><br>

    <button type="submit">Update User</button>
</form>
<a href="leaderboard.php">Back to Leaderboard</a>

</body>
</html>
