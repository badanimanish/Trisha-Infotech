<?php
// Database connection setup
$host = 'localhost';
$db   = 'leaderboard_db';
$user = 'root';  // Default XAMPP username
$pass = '';      // Default XAMPP password (empty)

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Function to fetch leaderboard data
function getLeaderboard($pdo) {
    $stmt = $pdo->query(
        "SELECT * FROM user_stats 
         ORDER BY Points DESC, Wins DESC, Losses ASC, LastActivity DESC"
    );
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Function to delete a user
function deleteUser($pdo, $userID) {
    $sql = "DELETE FROM user_stats WHERE UserID = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$userID]);
}

// Handling delete request
if (isset($_GET['delete'])) {
    deleteUser($pdo, $_GET['delete']);
    header("Location: leaderboard.php");
    exit;
}

$leaderboard = getLeaderboard($pdo);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leaderboard</title>
    <style>
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        .action-buttons a {
            margin: 0 5px;
            padding: 5px 10px;
            text-decoration: none;
            color: white;
            background-color: #4CAF50;
            border-radius: 3px;
        }
        .action-buttons a.delete {
            background-color: #f44336;
        }
        .create-user-btn {
            display: block;
            width: 150px;
            margin: 20px auto;
            padding: 10px;
            text-align: center;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>

<h2 style="text-align: center;">Leaderboard</h2>
<a href="create.php" class="create-user-btn">Create User</a>
<table>
    <tr>
        <th>Rank</th>
        <th>Username</th>
        <th>Points</th>
        <th>Wins</th>
        <th>Losses</th>
        <th>Last Activity</th>
        <th>Action</th>
    </tr>
    <?php 
    $rank = 1;
    foreach ($leaderboard as $user): ?>
        <tr>
            <td><?= $rank++ ?></td>
            <td><?= htmlspecialchars($user['Username']) ?></td>
            <td><?= $user['Points'] ?></td>
            <td><?= $user['Wins'] ?></td>
            <td><?= $user['Losses'] ?></td>
            <td><?= $user['LastActivity'] ?></td>
            <td class="action-buttons">
                <a href="update.php?user_id=<?= $user['UserID'] ?>">Update</a>
                <a href="leaderboard.php?delete=<?= $user['UserID'] ?>" class="delete" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

</body>
</html>
