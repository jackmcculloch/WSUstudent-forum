<?php
require_once 'header.php';
require_once 'db.php'; // Make sure you have a connection to your database

// Assuming you're storing the user's ID in the session
$user_id = $_SESSION['user_id'] ?? 0;

if ($user_id) {
    $stmt = $pdo->prepare("SELECT username, email FROM users WHERE id = ?");
    $stmt->execute([$user_id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        echo "<div class='profile'>";
        echo "<h2>Welcome, " . htmlspecialchars($user['username']) . "</h2>";
        echo "<p><strong>Email:</strong> " . htmlspecialchars($user['email']) . "</p>";
        // Add more user details here
        echo "</div>";
    } else {
        echo "<p>User not found.</p>";
    }
} else {
    echo "<p>Please <a href='login.php'>login</a> to view this page.</p>";
}

require_once 'footer.php';
?>
